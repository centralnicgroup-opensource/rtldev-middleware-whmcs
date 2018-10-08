<?php

ini_set("display_errors", 1);

$registrar = "ispapi";

#include_once dirname(__FILE__)."/../../../dbconnect.php";
#include_once dirname(__FILE__)."/../../../includes/functions.php";
include_once dirname(__FILE__)."/../../../includes/registrarfunctions.php";
include_once dirname(__FILE__)."/../../registrars/$registrar/$registrar.php";

print "<h3>Import Domains from ".strtoupper($registrar)." Account</h3>";

$params = getregistrarconfigoptions($registrar);

if (!strlen($params["Username"])) {
    print "You need to configure the Registrar Module '<b>$registrar</b>' before using this tool!";
    print "<ul><li><a href='configregistrars.php?registrar=$registrar'>Configure Registrar Module '<b>$registrar</b>'</li></ul>";
    return;
}

if ($params["TestMode"] == "on") {
    print strtoupper($registrar)." Test Account: <b>".$params["Username"]." - ";
} else {
    print strtoupper($registrar)." Production Account: <b>".$params["Username"]." - ";
}

$ispapi_config = ispapi_config(getregistrarconfigoptions($registrar));

$c = array("COMMAND" => "StatusAccount");
$r = ispapi_call($c, $ispapi_config);

if (!($r["CODE"] == 200)) {
    print "<font color='#a00000'>".$r["DESCRIPTION"]."</font>";
    print "<ul><li><a href='configregistrars.php?registrar=$registrar'>Configure Registrar Module '<b>$registrar</b>'</li></ul>";
    return;
}

print "<font color='#00a000'>Connected!</font>";
print "<br />";
print "<br />";

if (isset($_REQUEST["action_list"])) {
    $_REQUEST["domains"] = "";
    $c = array(
        "COMMAND" => "QueryDomainList",
        "USERDEPTH" => "SELF",
        "ORDERBY" => "DOMAIN",
        "LIMIT" => 10000,
        "DOMAIN" => $_REQUEST["domain"],
    );
    $r = ispapi_call($c, $ispapi_config);
    print "Got ".$r["PROPERTY"]["COUNT"][0]." Domains!\n";
    foreach ($r["PROPERTY"]["DOMAIN"] as $domain) {
        $_REQUEST["domains"] .= "$domain\n";
    }
}

if (isset($_REQUEST["action_import"])) {
    $domains = array();
    foreach (explode("\n", $_REQUEST["domains"]) as $domain) {
        if (preg_match('/([a-zA-Z0-9\-\.]+)/', $domain, $m)) {
            $domains[] = $m[1];
        }
    }

    if (count($domains)) {
        print "Importing...";
        print '<ul>';
        foreach ($domains as $domain) {
            print "<li>";
            print "<span style='display: block; float:left; min-width:15em;'>$domain: </span>\r\n";
            ob_flush();
            flush();
            ispapi_import_domain($domain, $ispapi_config);
            print "</li>\n";
        }
        print '</ul>';
        print "<form method='POST'>";
        print "<input type='hidden' name='gateway' value='".htmlspecialchars($_REQUEST["gateway"])."' />";
        print "<input type='hidden' name='currency' value='".htmlspecialchars($_REQUEST["currency"])."' />";
        print "<input type='hidden' name='domain' value='".htmlspecialchars($_REQUEST["domain"])."' />";
        print "<input type='hidden' name='domains' value='".htmlspecialchars($_REQUEST["domains"])."' />";
        print "<input type='submit' value='back' />";
        print "</form>";
        exit;
    }
}

print "<form method='POST'>";

$gateways = ispapi_find_paymentgateways();
$gateway_selected[$_REQUEST["gateway"]] = " selected";

$currencies = ispapi_find_currencies();
$currency_selected[$_REQUEST["currency"]] = " selected";

print '<p><b>Query Domainlist</b></p>';
print '<table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">';

print '<tr>';
print '<td width="15%" class="fieldlabel"><label for="domain">Domain:</label></td>';
print '<td class="fieldarea">';
if (!isset($_REQUEST["domain"])) {
    $_REQUEST["domain"] = "*";
}
print '<input type="text" name="domain" value="'.htmlspecialchars($_REQUEST["domain"]).'" />';
print '</td>';
print '</tr>';

print '</table>';

print '<p>';
print '<input type="submit" name="action_list" value="Pull Domainlist" class="button" />';
print '</p>';


print '<p><b>Import Domains</b></p>';
print '<table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">';
print '<tr>';
print '<td width="15%" class="fieldlabel"><label for="gateway">Payment Gateway</label></td>';
print '<td class="fieldarea">';
print '<select name="gateway">';
foreach ($gateways as $gateway => $name) {
    print '<option value="'.htmlspecialchars($gateway).'"'.$gateway_selected[$gateway].'>'.htmlspecialchars($name).'</option>';
}
print '</select>';
print '</td>';
print '</tr>';

print '<tr>';
print '<td width="15%" class="fieldlabel"><label for="currency">Currency</label></td>';
print '<td class="fieldarea">';
print '<select name="currency">';
foreach ($currencies as $id => $currency) {
    print '<option value="'.htmlspecialchars($id).'"'.$currency_selected[$id].'>'.htmlspecialchars($currency).'</option>';
}
print '</select>';
print '</td>';
print '</tr>';



print '<tr>';
print '<td width="15%" class="fieldlabel"><label for="domains">Domains</label></td>';
print '<td class="fieldarea">';
print "<textarea name='domains' id='domains' cols='60' rows='10'>";
print htmlspecialchars($_REQUEST["domains"]);
print "</textarea>";
print '</td>';
print '</tr>';
print '</table>';

print '<p>';
print '<input type="submit" name="action_import" value="Import Domains" class="button" />';
print '</p>';

print "</form>";



function ispapi_find_paymentgateways()
{
    $gateways = array();

    $result = full_query("
		SELECT gateway,value FROM tblpaymentgateways
		WHERE setting='name' and `order`
	");
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $gateways[$row["gateway"]] = $row["value"];
    }
    return $gateways;
}

function ispapi_find_currencies()
{
    $currencies = array();

    $result = full_query("
		SELECT `code`, `id` FROM tblcurrencies
		ORDER BY `default` DESC, `code`
	");
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $currencies[$row["id"]] = $row['code'];
    }
    return $currencies;
}



function ispapi_find_client_by_email($email)
{
    $result = full_query("
		SELECT id FROM tblclients
		WHERE email='".db_escape_string($email)."'
		LIMIT 1
	");
    if ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        return $row["id"];
    }

    return false;
}


function ispapi_create_client($contact)
{

    $info = array(
        firstname => $contact["FIRSTNAME"][0],
        lastname => $contact["LASTNAME"][0],
        companyname => $contact["ORGANIZATION"][0],
        email => $contact["EMAIL"][0],
        address1 => $contact["STREET"][0],
        address2 => $contact["STREET"][1],
        city => $contact["CITY"][0],
        state => $contact["STATE"][0],
        postcode => $contact["ZIP"][0],
        country => strtoupper($contact["COUNTRY"][0]),
        phonenumber => $contact["PHONE"][0],
        password => "",
        currency => $_REQUEST["currency"],
        language => "English",
        credit => "0.00",
        lastlogin => "0000-00-00 00:00:00",
    );

    $info["phonenumber"] = preg_replace('/^\+/', '', $info["phonenumber"]);
    $info["postcode"] = preg_replace('/[^0-9a-zA-Z ]/', '', $info["postcode"]);
    if (!strlen($info["postcode"])) {
        $info["postcode"] = "NONE";
    }
    if (!strlen($info["state"])) {
        $info["state"] = "N/A";
    }

    foreach ($info as $key => $value) {
        $info[$key] = "'".db_escape_string($value)."'";
    }

    $sql = "INSERT INTO tblclients (datecreated, ".implode(", ", array_keys($info)).") VALUES (now(), ".implode(", ", array_values($info)).")";

    $result = full_query($sql);

    return ispapi_find_client_by_email($contact["EMAIL"][0]);
}


function ispapi_get_domainprices($currencyid)
{
    $sql = "SELECT tdp.extension, tp.type, msetupfee year1, qsetupfee year2, ssetupfee year3, asetupfee year4, bsetupfee year5, monthly year6, quarterly year7, semiannually year8, annually year9, biennially year10
		FROM tbldomainpricing tdp, tblpricing tp
		WHERE tp.relid = tdp.id
		AND tp.currency = ".$currencyid;
    $query = mysql_query($sql);
    while ($row = @mysql_fetch_array($query, MYSQL_ASSOC)) {
        if ($row['year1'] != 0) {
            $domainprices[$row['extension']][$row['type']][1] = $row['year1'];
        }
        if ($row['year2'] != 0) {
            $domainprices[$row['extension']][$row['type']][2] = $row['year2'];
        }
        if ($row['year3'] != 0) {
            $domainprices[$row['extension']][$row['type']][3] = $row['year3'];
        }
        if ($row['year4'] != 0) {
            $domainprices[$row['extension']][$row['type']][4] = $row['year4'];
        }
        if ($row['year5'] != 0) {
            $domainprices[$row['extension']][$row['type']][5] = $row['year5'];
        }
        if ($row['year6'] != 0) {
            $domainprices[$row['extension']][$row['type']][6] = $row['year6'];
        }
        if ($row['year7'] != 0) {
            $domainprices[$row['extension']][$row['type']][7] = $row['year7'];
        }
        if ($row['year8'] != 0) {
            $domainprices[$row['extension']][$row['type']][8] = $row['year8'];
        }
        if ($row['year9'] != 0) {
            $domainprices[$row['extension']][$row['type']][9] = $row['year9'];
        }
        if ($row['year10'] != 0) {
            $domainprices[$row['extension']][$row['type']][10] = $row['year10'];
        }
    }
    return $domainprices;
}

function ispapi_get_currency_by_customer($clientid)
{
    $query = mysql_query("SELECT currency FROM tblclients WHERE id='$clientid'");
    if ($row = @mysql_fetch_array($query, MYSQL_ASSOC)) {
        return $row['currency'];
    }
    return null;
}



function ispapi_import_domain($domain, &$ispapi_config)
{

    if (preg_match('/(\..*)$/i', $domain, $m)) {
        $tld = strtolower($m[1]);
    } else {
        print "<font color='#a00000'>Could not find TLD in Domain Name</font>";
        return;
    }

    $result = full_query("
		SELECT id FROM tbldomains
		WHERE domain='".db_escape_string($domain)."'
		AND status IN ('Pending', 'Pending Transfer', 'Active')
		AND registrar='ispapi'
		LIMIT 1
	");
    if ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        print "<font color='#a0a000'>Already existing</font>";
        return;
    }
    

    $c = array("COMMAND" => "StatusDomain", "DOMAIN" => $domain);
    $r = ispapi_call($c, $ispapi_config);
    if (!($r["CODE"] == 200)) {
        print "<font color='#a00000'>".$r["DESCRIPTION"]."</font>";
        return;
    }
    $registrant = $r["PROPERTY"]["OWNERCONTACT"][0];
    if (!$registrant) {
        print "<font color='#a00000'>No Registrant!</font>";
        return;
    }

    if (!isset($ispapi_config["_contact_hash"][$registrant])) {
        $c2 = array("COMMAND" => "StatusContact", "CONTACT" => $registrant);
        $r2 = ispapi_call($c2, $ispapi_config);
        $ispapi_config["_contact_hash"][$registrant] = $r2["PROPERTY"];
    }

    $contact = $ispapi_config["_contact_hash"][$registrant];

    if ((!$contact["EMAIL"][0]) || (preg_match('/null$/i', $contact["EMAIL"][0]))) {
        $contact["EMAIL"][0] = "info@".$domain;
    }

    $client = ispapi_find_client_by_email($contact["EMAIL"][0]);
    if (!$client) {
        $client = ispapi_create_client($contact);
    }

    if (!$client) {
        print "<font color='#a00000'>Could not create client!</font>";
        return;
    }

    $domainprices = ispapi_get_domainprices(ispapi_get_currency_by_customer($client));
    if (!isset($domainprices[$tld]['domainrenew'][1])) {
        print "<font color='#a00000'>Could not find domain renewal price for TLD $tld</font>";
        return;
    }
    $recurringamount = $domainprices[$tld]['domainrenew'][1];

    $info = array(
        userid => $client,
        orderid => 0,
        type => "Register",
        registrationdate => $r["PROPERTY"]["CREATEDDATE"][0],
        domain => strtolower($domain),
        firstpaymentamount => $recurringamount,
        recurringamount => $recurringamount,
        paymentmethod => $_REQUEST["gateway"],
        registrar => "ispapi",
        registrationperiod => 1,
        expirydate => $r["PROPERTY"]["PAIDUNTILDATE"][0],
        subscriptionid => "",
        status => "Active",
        nextduedate => $r["PROPERTY"]["PAIDUNTILDATE"][0],
        nextinvoicedate => $r["PROPERTY"]["PAIDUNTILDATE"][0],
        dnsmanagement => "on",
        emailforwarding => "on"
    );

    foreach ($info as $key => $value) {
        $info[$key] = "'".db_escape_string($value)."'";
    }

    $sql = "INSERT INTO tbldomains (".implode(", ", array_keys($info)).") VALUES (".implode(", ", array_values($info)).")";

    $result = full_query($sql);

    if (!$result) {
        print "<font color='#a00000'>Could not create domain in database!</font>";
        return;
    }
    print "<font color='#00a000'>OK</font>";
}
