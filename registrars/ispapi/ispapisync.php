<?php

// ini_set("display_errors", 1);

include_once dirname(__FILE__)."/../../../dbconnect.php";
include_once dirname(__FILE__)."/../../../includes/functions.php";
include_once dirname(__FILE__)."/../../../includes/registrarfunctions.php";

$registrar = "ispapi";
include_once "$registrar.php";

$params = getregistrarconfigoptions($registrar);
$ispapi_config = ispapi_config($params);

$report = ucwords($registrar)." Domain Sync Report\n"
        . "---------------------------------------------------\n\n";


$report .= "Processing transfers:\n";
$result = select_query(
    "tbldomains",
    "id, domain",
    array('registrar' => $registrar,  'status' => "Pending Transfer")
);

if (!$result || !mysql_num_rows($result)) {
    $report .= "No domains with status 'Pending Transfer' found\n";
}
else {
	$count = 0;
        while (($row = mysql_fetch_assoc($result)) !== false) {
		$command = array("COMMAND" => "StatusDomain", "DOMAIN" => $row['domain']);
		$response = ispapi_call($command, $ispapi_config);
		if ( ($response["CODE"] == 200) && isset($response["PROPERTY"]["PEERUSER"]) ) {
		        update_query(
		            "tbldomains",
		            array('status' => 'Active'),
		            array('id' => $row['id'])
		        );
		        $report .= "Domain " . $row['domain'] . " transfer status updated (successful)\n";
			$count++;
		}
		else {
			$command = array("COMMAND" => "StatusDomainTransfer", "DOMAIN" => $row['domain']);
			$response = ispapi_call($command, $ispapi_config);
			if ( ($response["CODE"] != 200) ) {
				$report .= "Domain " . $row['domain'] . " transfer not running - please check\n";
				$count++;
			}
		}
	}
	if ( !$count ) {
		$report .= "No activity required\n";
	}
}

$report .= "\nProcessing active domains:\n";

$command = array("COMMAND" => "GetEnvironment", "ENVIRONMENTNAME" => "_system/defaults/renewalmode");
$response = ispapi_call($command, $ispapi_config);
$renewalmode = FALSE;

if ( isset($response["PROPERTY"]["ENVIRONMENTVALUE"]) ) {
	if ( preg_match('/renew/i', $response["PROPERTY"]["ENVIRONMENTVALUE"][0]) ) {
		$renewalmode = "RENEW";
	}
	if ( preg_match('/expire/i', $response["PROPERTY"]["ENVIRONMENTVALUE"][0]) ) {
		$renewalmode = "EXPIRE";
	}
	if ( preg_match('/delete/i', $response["PROPERTY"]["ENVIRONMENTVALUE"][0]) ) {
		$renewalmode = "DELETE";
	}
}

$result = select_query(
	"tbldomains",
	"id, domain, expirydate, nextduedate, donotrenew",
	array('registrar' => $registrar,  'status' => "Active")
);

if (!$result || !mysql_num_rows($result)) {
    $report .= "No domains with status 'Active' found\n";
}
else {
	$count = 0;
	while ( $row = mysql_fetch_array($result, MYSQL_ASSOC) ) {
		$id = $row["id"];
		$domain = $row["domain"];
		$expirydate = $row["expirydate"];
		$nextduedate = $row["nextduedate"];
		$command = array("COMMAND" => "StatusDomain", "DOMAIN" => $domain);
		$response = ispapi_call($command, $ispapi_config);

		if ( $response["CODE"] == 200 ) {
			# IGNORE RENEWALMODE FOR DOMAINS ON REGISTRAR SUBACCOUNTS!
			# ONLY PROCESS IF REGISTRAR ACCCOUNT SET TO AUTORENEW
			if ( !strlen($response["PROPERTY"]["PEERUSER"][0]) ) {
				if ( ($renewalmode == "RENEW") && ($response["PROPERTY"]["RENEWALMODE"][0] != "AUTORENEW") && (!$row["donotrenew"]) ) {
					$renewalmode_command = array("COMMAND" => "SetDomainRenewalMode", "DOMAIN" => $domain, "RENEWALMODE" => "AUTORENEW");
					$renewalmode_response = ispapi_call($renewalmode_command, $ispapi_config);
					$count++;
					if ( $renewalmode_response["CODE"] == 200 ) {
						$report .= "Domain $domain renewalmode has been set to AUTORENEW at registrar\n";
					}
					else {
						$report .= "Domain $domain renewalmode could not be set to AUTORENEW at registrar: $renewalmode_response[CODE] $renewalmode_response[DESCRIPTION]\n";
					}
				}
				if ( ($renewalmode == "RENEW") && ($response["PROPERTY"]["RENEWALMODE"][0] == "AUTORENEW") && ($row["donotrenew"]) ) {
					$renewalmode_command = array("COMMAND" => "SetDomainRenewalMode", "DOMAIN" => $domain, "RENEWALMODE" => "AUTOEXPIRE");
					$renewalmode_response = ispapi_call($renewalmode_command, $ispapi_config);
					$count++;
					if ( $renewalmode_response["CODE"] == 200 ) {
						$report .= "Domain $domain renewalmode has been set to AUTOEXPIRE at registrar\n";
					}
					else {
						$report .= "Domain $domain renewalmode could not be set to AUTOEXPIRE at registrar: $renewalmode_response[CODE] $renewalmode_response[DESCRIPTION]\n";
					}
				}
			}

			$expdate = $response["PROPERTY"]["PAIDUNTILDATE"][0];
			$duedate = $response["PROPERTY"]["ACCOUNTINGDATE"][0];

			$expdate = preg_replace('/ .*/', '', $expdate);
			$duedate = preg_replace('/ .*/', '', $duedate);

			if ( (preg_match('/^2/', $expdate)) && (preg_match('/^2/', $duedate)) ) {
				if ( ($params["SyncNextDueDate"]) && (($duedate != $nextduedate) || ($expdate != $expirydate)) ) {
					full_query ("
						UPDATE tbldomains
						SET expirydate='".db_escape_string($expdate)."',
						nextinvoicedate=DATE_ADD(nextinvoicedate, INTERVAL (UNIX_TIMESTAMP('".db_escape_string($duedate)."')-UNIX_TIMESTAMP(nextduedate)) SECOND),
						nextduedate='".db_escape_string($duedate)."'
						WHERE id='".db_escape_string($id)."'
						LIMIT 1
					");
					$report .= "Domain $domain expirydate and nextduedate updated\n";
					$count++;
				}
				elseif ( (!$expirydate) || (preg_match('/^0/', $expirydate)) ) {
					full_query ("
						UPDATE tbldomains
						SET expirydate='".db_escape_string($expdate)."'
						WHERE id='".db_escape_string($id)."'
						LIMIT 1
					");
					$report .= "Domain $domain expirydate updated (was null)\n";
					$count++;
				}
			}
		}
		if ( ($response["CODE"] == 545) || ($response["CODE"] == 531) ) {
			$loglist_command = array("COMMAND" => "QueryObjectLogList", "OBJECTCLASS" => "DOMAIN", "OBJECTID" => $domain, "ORDERBY" => "LOGDATEDESC", "LIMIT" => 3);
			$loglist_response = ispapi_call($loglist_command, $ispapi_config);
			$resolved = 0;
			if ( ($loglist_response["CODE"] == 200) && ($loglist_response["PROPERTY"]["TOTAL"][0]) ) {
				foreach ( $loglist_response["PROPERTY"]["LOGINDEX"] as $index => $logindex ) {
					if ( !$resolved ) {
						$type = $loglist_response["PROPERTY"]["OPERATIONTYPE"][$index];
						$status = $loglist_response["PROPERTY"]["OPERATIONSTATUS"][$index];
						if ( ($type == "TRANSFER") && ($status == "REQUEST") ) {
							$log_command = array("COMMAND" => "StatusObjectLog", "LOGINDEX" => $logindex);
							$log_response = ispapi_call($log_command, $ispapi_config);
							$log = implode("\n", $log_response["PROPERTY"]["OPERATIONINFO"]);
							if ( preg_match('/(^|\n)action\s*\=\s*approve/i', $log) ) {
								$report .= "Domain $domain has been transferred out (approved)\n";
								update_query(
								    "tbldomains",
								    array('status' => 'Cancelled'),
								    array('id' => $row['id'])
								);
								$resolved = 1;
							}						
						}
						if ( ($type == "OUTBOUND_TRANSFER") && ($status == "SUCCESSFUL") ) {
							$report .= "Domain $domain has been transferred out (auto-approved)\n";
							update_query(
							    "tbldomains",
							    array('status' => 'Cancelled'),
							    array('id' => $row['id'])
							);
							$resolved = 1;
						}
					}
				}
			}
			if ( !$resolved ) {
				$report .= "Domain $domain not in registrar account ($response[CODE]) - please check\n";
			}
			$count++;
		}
	}
	if ( !$count ) {
		$report .= "No activity required\n";
	}
}

$report .= "\n---------------------------------------------------\nAll done.\n";

logactivity(ucwords($registrar)." Domain Sync Run");
sendadminnotification("system", "WHMCS ".ucwords($registrar)." Domain Synchronization Report", nl2br($report));

?>
