<?php

use WHMCS\Module\Registrar\Ispapi\Ispapi;
use WHMCS\Module\Registrar\Ispapi\Helper;
use WHMCS\Module\Registrar\Ispapi\Domain as HXDomain;
use Illuminate\Database\Capsule\Manager as DB;

$path = implode(DIRECTORY_SEPARATOR, [__DIR__, "hooks_migration.php"]);
if (file_exists($path)) {
    include $path;
}

add_hook("ShoppingCartValidateCheckout", 1, function ($vars) {
    // load registrar functions
    if (!function_exists("getregistrarconfigoptions")) {
        require_once implode(DIRECTORY_SEPARATOR, [ROOTDIR, "includes", "registrarfunctions.php"]);
    }

    // error container
    $errors = [];

    // load registrar module settings and check if transfer precheck are activated
    $regcfg = getregistrarconfigoptions("ispapi");
    $cartprecheck = ($regcfg["TRANSFERCARTPRECHECK"] === "on");
    if (!$cartprecheck || empty($_SESSION["cart"]["domains"])) {
        return $errors;
    }

    // precheck all transfers
    foreach ($_SESSION["cart"]["domains"] as $d) {
        if ($d["type"] === "transfer") {
            $tld = preg_replace("/^[^.]+\./", "", $d["domain"]);
            // check if the registrar configured for that tld is `ispapi`
            $count = DB::table("tbldomainpricing")
                ->select("autoreg")
                ->where("extension", "." . $tld)
                ->where("autoreg", "ispapi")
                ->count();
            if (!$count) {
                continue;
            }
            $cmd = [
                "COMMAND" => "CheckDomainTransfer",
                "DOMAIN" => $d["domain"]
            ];
            if (!empty($d["eppcode"])) {
                $cmd["AUTH"] = $d["eppcode"];
            }
            $r = Ispapi::call($cmd);
            if ($r["CODE"] === "219") {
                $errors[] = $d["domain"] . ": " . $r["DESCRIPTION"];
            }
        }
    }
    return $errors;
});

add_hook("ClientAreaHeadOutput", 1, function ($vars) {
    // Auto-Prefill VAT-ID, X-DK-REGISTRANT/ADMIN additional domain field when provided in client data
    $ispapilang = $vars["clientsdetails"]["language"];
    $ispapivatid = $vars["clientsdetails"]["tax_id"];
    $ispapidkid = "";

    if (function_exists("getCustomFields")) {
        $cfs = getCustomFields("client", "", $vars["clientsdetails"]["userid"], "on", "");
        foreach ($cfs as $cf) {
            if ("dkhostmasteruserid" === $cf["textid"] && !empty($cf["value"])) {
                $ispapidkid = strtoupper($cf["value"]);
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

add_hook("AfterRegistrarRegistrationFailed", 1, function ($vars) {
    // ONLY FOR .SWISS: saves the .swiss application ID in the admin note
    $params = $vars["params"];
    $domain = $params["sld"] . "." . $params["tld"];
    if (preg_match("/[.]swiss$/i", $domain)) {
        preg_match("/<#(.+?)#>/i", $vars["error"], $matches);
        if (isset($matches[1])) {
            $application_id = $matches[1];
            $data = [
                ":id" => $params["domainid"],
                ":notes" => "### DO NOT DELETE ANYTHING BELOW THIS LINE \nAPPLICATION:" . $application_id . "\n"
            ];
            Helper::SQLCall("UPDATE tbldomains SET additionalnotes=:notes WHERE id=:id", $data, "execute");
        }
    }
});

add_hook("DailyCronJob", 1, function ($vars) {
    //Save information about module versions in the environment
    Ispapi::sendStatisticsData();

    // ONLY FOR .SWISS: runs over all pending applications to check if the registration was successful or not.
    $data = [
        ":registrar" => "ispapi",
        ":stat" => "Pending"
    ];
    $r = Helper::SQLCall(
        "SELECT id, additionalnotes FROM tbldomains WHERE additionalnotes!=\"\" AND registrar=:registrar AND status=:stat",
        $data,
        "fetchall"
    );
    if ($r["success"]) {
        foreach ($r["result"] as $row) {
            preg_match("/APPLICATION:(.+?)(?:$|\n)/i", $row["additionalnotes"], $matches);
            if (isset($matches[1])) {
                $data = [
                    ":id" => $row["id"]
                ];
                $response = Ispapi::call([
                    "COMMAND" => "StatusDomainApplication",
                    "APPLICATION" => $matches[1]
                ]);
                if ($response["PROPERTY"]["STATUS"][0] === "SUCCESSFUL") {
                    //echo $row["domain"]." > Status:".$response["PROPERTY"]["STATUS"][0];
                    $data[":stat"] = "Active";
                    Helper::SQLCall("UPDATE tbldomains SET status=:stat WHERE id=:id", $data, "execute");
                }
                if ($response["PROPERTY"]["STATUS"][0] === "FAILED") {
                    //echo $row["domain"]." > Status:".$response["PROPERTY"]["STATUS"][0];
                    $data[":stat"] = "Cancelled";
                    Helper::SQLCall("UPDATE tbldomains SET status=:stat WHERE id=:id", $data, "execute");
                }
            }
        }
    }
});

$ispapi_domainMenuUpdate = function ($vars) {
    // TLDs not supporting Transfer Lock: remove "Registrar Lock" menu entry.
    $domain = Menu::context("domain");

    if ($domain->registrar === "ispapi") {
        // load registrar functions
        if (!function_exists("getregistrarconfigoptions")) {
            require_once implode(DIRECTORY_SEPARATOR, [ROOTDIR, "includes", "registrarfunctions.php"]);
        }

        $menu = $vars["primarySidebar"]->getChild("Domain Details Management");

        $r = HXDomain::getRegistrarLock(getregistrarconfigoptions("ispapi"), $domain->domain);
        if (isset($r["error"])) {
            $vars["managementoptions"]["locking"] = false;
            $vars["lockstatus"] = false;
            if (!is_null($menu)) {
                $menu->removeChild("Registrar Lock Status");
            }
        }

        if (!is_null($menu)) {
            $menuItem = $menu->getChild("Manage Private Nameservers");
            if (!is_null($menuItem)) {
                $menuItem->moveToBack();
            }
            $menuItem = $menu->getChild("Private Nameservers List");
            if (!is_null($menuItem)) {
                $menuItem->moveToBack();
            }
        }
        return $vars;
    }
};

add_hook("ClientAreaPageDomainDNSManagement", 1, $ispapi_domainMenuUpdate);
add_hook("ClientAreaPageDomainEPPCode", 1, $ispapi_domainMenuUpdate);
add_hook("ClientAreaPageDomainContacts", 1, $ispapi_domainMenuUpdate);
add_hook("ClientAreaPageDomainRegisterNameservers", 1, $ispapi_domainMenuUpdate);
add_hook("ClientAreaPageDomainDetails", 1, $ispapi_domainMenuUpdate);
