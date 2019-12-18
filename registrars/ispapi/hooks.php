<?php

/*
 * Autofill VAT-ID additional domain field
 * if the client contact details contain the VAT-ID, the VAT-ID fields are autofilled during domain registrations.
 */
add_hook('ClientAreaHeadOutput', 1, function ($vars) {
    $vatid = $vars['clientsdetails']['tax_id'];

    if ($vatid) {
        return <<<HTML
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#frmConfigureDomains .row .col-sm-4').each(function () {
                        if($(this).text().match(/VAT ID|VATID/i)){
                            $(this).siblings().children(':input').val('$vatid');
                        }
                    });
                });
            </script>
HTML;
    }
});

/**
 * Special Handling of .SWISS Applications
 * runs over all pending applications to check if the registration was successful or not.
 */
add_hook('DailyCronJob', 1, function ($vars) {
    if (file_exists(dirname(__FILE__)."/ispapi.php")) {
        require_once(dirname(__FILE__)."/ispapi.php");
        $ispapi_config = ispapi_config(getregistrarconfigoptions("ispapi"));

        $result = mysql_query("SELECT * from tbldomains WHERE domain REGEXP '\\.swiss$' and additionalnotes!='' and registrar='ispapi' type='Register' and status='Pending'");
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            preg_match('/ApplicationID:\s?(\d+)\n$/i', $row["additionalnotes"], $m);
            if (isset($m[1])) {
                $r = ispapi_call([//TODO: improve by using QueryEventList
                    "COMMAND" => "StatusDomainApplication",
                    "APPLICATION" => $m[1]
                ], $ispapi_config);

                if ($r["PROPERTY"]["STATUS"][0] == "SUCCESSFUL") {
                    mysql_query("UPDATE tbldomains SET status='Active', additionalnotes='' WHERE id=".$row["id"]);
                } elseif ($r["PROPERTY"]["STATUS"][0] == "FAILED") {
                    mysql_query("UPDATE tbldomains SET status='Cancelled' WHERE id=".$row["id"]);
                }
            }
        }
    }
});

/**
 * for TLDs those do not support Transfer/Registrar lock
 * remove 'Registrar Lock' option and error message (on 'overview') on client area domain details page.
 */
add_hook('ClientAreaPageDomainDetails', 1, function ($vars) {
    $domain = Menu::context('domain');
    if ($domain->registrar == "ispapi") {
        $r = ispapi_call([
            "COMMAND" => "QueryDomainList",
            "DOMAIN" => $this_domain,
            "WIDE" => 1
        ], ispapi_config(getregistrarconfigoptions("ispapi")));


        if (($r['CODE'] == 200) && (
                $r['PROPERTY']['DOMAINTRANSFERLOCK'] &&
                $r['PROPERTY']['DOMAINTRANSFERLOCK'][0] == ""
            )
        ) {
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
