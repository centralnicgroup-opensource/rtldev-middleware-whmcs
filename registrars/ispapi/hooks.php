<?php

use WHMCS\View\Menu\Item as MenuItem;

/*
 * ONLY FOR .SWISS
 * saves the .swiss application ID in the admin note
 */
add_hook('AfterRegistrarRegistrationFailed', 1, function ($vars) {
    $params = $vars["params"];
    $domain = $params["sld"].".".$params["tld"];
    if (preg_match('/[.]swiss$/i', $domain)) {
        preg_match('/<#(.+?)#>/i', $vars["error"], $matches);
        if (isset($matches[1])) {
            $application_id=$matches[1];
            $result = mysql_query("UPDATE tbldomains SET additionalnotes='### DO NOT DELETE ANYTHING BELOW THIS LINE \nAPPLICATION:".$application_id."\n' WHERE id=".$params["domainid"]);
        }
    }
});

/*
 * ONLY FOR .SWISS
 * runs over all pending applications to check if the registration was successful or not.
 */
add_hook('DailyCronJob', 1, function ($vars) {
    if (file_exists(dirname(__FILE__)."/ispapi.php")) {
        require_once(dirname(__FILE__)."/ispapi.php");
        $registrarconfigoptions = getregistrarconfigoptions("ispapi");
        $ispapi_config = ispapi_config($registrarconfigoptions);

        $result = mysql_query("SELECT * from tbldomains WHERE additionalnotes!='' and registrar='ispapi' and status='Pending'");
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            preg_match('/APPLICATION:(.+?)(?:$|\n)/i', $row["additionalnotes"], $matches);
            if (isset($matches[1])) {
                $application_id=$matches[1];

                $command = array(
                    "COMMAND" => "StatusDomainApplication",
                    "APPLICATION" => $application_id
                 );
                 $response = ispapi_call($command, $ispapi_config);
                if ($response["PROPERTY"]["STATUS"][0] == "SUCCESSFUL") {
                    //echo $row["domain"]." > Status:".$response["PROPERTY"]["STATUS"][0];
                    mysql_query("UPDATE tbldomains SET status='Active' WHERE id=".$row["id"]);
                }
                if ($response["PROPERTY"]["STATUS"][0] == "FAILED") {
                      //echo $row["domain"]." > Status:".$response["PROPERTY"]["STATUS"][0];
                      mysql_query("UPDATE tbldomains SET status='Cancelled' WHERE id=".$row["id"]);
                }
            }
        }
    }
});

/*
 * for TLDs those do not support Transfer/Registrar lock
 * remove 'Registrar Lock' option and error message (on 'overview') on client area domain details page.
 */
add_hook('ClientAreaPageDomainDetails', 1, function ($vars) {

    $domain          = Menu::context('domain');
    $this_domain     = $domain->domain;
    $this_registrar  = $domain->registrar;//ispapi
        
    if ($this_registrar == "ispapi") {
        $registrarconfigoptions = getregistrarconfigoptions("ispapi");
        $ispapi_config = ispapi_config($registrarconfigoptions);

        $commandQueryDomainList = array(
            "COMMAND" => "QueryDomainList",
            "DOMAIN" => $this_domain,
            "WIDE" => 1
        );
        $responseQueryDomainList = ispapi_call($commandQueryDomainList, $ispapi_config);

        if (($responseQueryDomainList['CODE'] == 200) && ($responseQueryDomainList['PROPERTY']['DOMAINTRANSFERLOCK'] && $responseQueryDomainList['PROPERTY']['DOMAINTRANSFERLOCK'][0] == "")) {
            $vars['managementoptions']['locking'] = false;
            $vars['lockstatus'] = false;

            if (!is_null($vars['primarySidebar']->getChild('Domain Details Management'))) {
                $vars['primarySidebar']->getChild('Domain Details Management')
                                        ->removeChild('Registrar Lock Status');
            }
        }

        return $vars;
    }
});
