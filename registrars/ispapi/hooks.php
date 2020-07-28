<?php

use WHMCS\Module\Registrar\Ispapi\Ispapi;
use WHMCS\Module\Registrar\Ispapi\Helper;

add_hook('ClientAreaHeadOutput', 1, function ($vars) {
    // Auto-Prefill VAT-ID, X-DK-REGISTRANT/ADMIN additional domain field when provided in client data
    $ispapilang = $vars['clientsdetails']['language'];
    $ispapivatid = $vars['clientsdetails']['tax_id'];
    $ispapidkid = '';

    if (function_exists('getCustomFields')) {
        $cfs = getCustomFields("client", "", $vars['clientsdetails']['userid'], "on", "");
        foreach ($cfs as $cf) {
            if ("dkhostmasteruserid" === $cf['textid'] && !empty($cf['value'])) {
                $ispapidkid = $cf['value'];
            }
        }
    }

    if ($ispapivatid || $ispapidkid || $ispapilang) {
        return <<<HTML
            <style>
                img.webappthumb {
                    width: 115px;
                    padding: 4px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                }
            </style>
            <script type="text/javascript">
                const ispapi_vatid = '$ispapivatid';
                const ispapi_dkid = '$ispapidkid';
                const ispapi_lang = '$ispapilang';
                $(document).ready(function () {
                    $('#frmConfigureDomains .row .col-sm-4').each(function () {
                        if(ispapi_vatid && $(this).text().match(/VAT ID|VATID/i)){
                            $(this).siblings().children(':input').val(ispapi_vatid);
                        }
                        if (ispapi_dkid && $(this).text().match(/^(registrant|admin) contact\:$/i)) {
                            $(this).siblings().children(':input').val(ispapi_dkid);
                        }
                        if ($(this).text().match(/^Contact Language\:$/i)) {
                            if (/^(english|french)$/i.test(ispapi_lang)){
                                const mylang = ispapi_lang.charAt(0).toUpperCase() + ispapi_lang.slice(1);
                                $(this).siblings().find('select option').prop('selected', false);
                                $(this).siblings().find('select option[value="' + mylang + '"]').prop('selected', true);
                            }
                        }
                    });
                });
            </script>
HTML;
    }
});

add_hook('AfterRegistrarRegistrationFailed', 1, function ($vars) {
    // ONLY FOR .SWISS: saves the .swiss application ID in the admin note
    $params = $vars["params"];
    $domain = $params["sld"] . "." . $params["tld"];
    if (preg_match('/[.]swiss$/i', $domain)) {
        preg_match('/<#(.+?)#>/i', $vars["error"], $matches);
        if (isset($matches[1])) {
            $application_id = $matches[1];
            $data = [
                ":id" => $params["domainid"],
                ":notes" => '### DO NOT DELETE ANYTHING BELOW THIS LINE \nAPPLICATION:".$application_id."\n'
            ];
            Helper::SQLCall("UPDATE tbldomains SET additionalnotes=:notes WHERE id=:id", $data, "execute");
        }
    }
});

add_hook('DailyCronJob', 1, function ($vars) {
    // ONLY FOR .SWISS: runs over all pending applications to check if the registration was successful or not.
    if (file_exists(dirname(__FILE__) . "/ispapi.php")) {
        require_once(dirname(__FILE__) . "/ispapi.php");
        $registrarconfigoptions = getregistrarconfigoptions("ispapi");

        $data = [
            ":registrar" => "ispapi",
            ":stat" => "Pending"
        ];
        $r = Helper::SQLCall("SELECT id, additionalnotes FROM tbldomains WHERE additionalnotes!='' AND registrar=:registrar AND status=:stat", $data, "fetchall");
        if ($r["success"]) {
            foreach ($r["result"] as $row) {
                preg_match('/APPLICATION:(.+?)(?:$|\n)/i', $row["additionalnotes"], $matches);
                if (isset($matches[1])) {
                    $data = [
                        ":id" => $row["id"]
                    ];
                    $response = Ispapi::call([
                        "COMMAND" => "StatusDomainApplication",
                        "APPLICATION" => $matches[1]
                    ], $registrarconfigoptions);
                    if ($response["PROPERTY"]["STATUS"][0] == "SUCCESSFUL") {
                        //echo $row["domain"]." > Status:".$response["PROPERTY"]["STATUS"][0];
                        $data[":stat"] = "Active";
                        Helper::SQLCall("UPDATE tbldomains SET status=:stat WHERE id=:id", $data, "execute");
                    }
                    if ($response["PROPERTY"]["STATUS"][0] == "FAILED") {
                        //echo $row["domain"]." > Status:".$response["PROPERTY"]["STATUS"][0];
                        $data[":stat"] = "Cancelled";
                        Helper::SQLCall("UPDATE tbldomains SET status=:stat WHERE id=:id", $data, "execute");
                    }
                }
            }
        }
    }
});

add_hook('ClientAreaPageDomainDetails', 1, function ($vars) {
    // TLDs not supporting Transfer Lock: remove 'Registrar Lock' menu entry.
    $domain = Menu::context('domain');
    
    if ($domain->registrar == "ispapi") {
        $r = Ispapi::call([
            "COMMAND" => "QueryDomainList",
            "VERSION" => 2,
            "DOMAIN" => $domain->domain,
            "WIDE" => 1,
            "NOTOTAL" => 1
        ], getregistrarconfigoptions("ispapi"));

        if (($r['CODE'] == 200) && ($r['PROPERTY']['DOMAINTRANSFERLOCK'] && $r['PROPERTY']['DOMAINTRANSFERLOCK'][0] == "")) {
            $vars['managementoptions']['locking'] = false;
            $vars['lockstatus'] = false;
            $menu = $vars['primarySidebar']->getChild('Domain Details Management');
            if (!is_null($menu)) {
                $menu->removeChild('Registrar Lock Status');
            }
        }

        return $vars;
    }
});
