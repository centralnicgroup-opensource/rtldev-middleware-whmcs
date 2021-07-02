<?php

namespace WHMCS\Module\Registrar\Ispapi;

use WHMCS\Module\Registrar\Ispapi\Ispapi;

class WebApps
{
    /**
     * get smarty configuration to render custom pages
     * @param array $params common module parameters
     * @return array
     */
    public static function getPage($params)
    {
        $params = injectDomainObjectIfNecessary($params);
        /** @var \WHMCS\Domains\Domain $domain */
        $subaction = \App::getFromRequest("subaction");
        $webapp = \App::getFromRequest("webapp");
        $domain = $params["domainObj"]->getDomain();
        $availableapps = self::getAvailableApps();
        $allApps = self::getAllApps();
        $path = getcwd() . self::getAssetsPath("templates");

        // web app list overview
        if (empty($subaction) && empty($webapp)) {
            $connectedApps = self::getConnectedApps($params);
            return [
                "templatefile" => "tpl_ca_webapps_overview",
                "vars" => [
                    "id" => $params["domainid"],
                    "domain" => $domain,
                    "assetspath" => self::getAssetsPath("img"),
                    "popularCats" => self::getPopularCategories(),
                    "availableApps" => $availableapps,
                    "connectedApps" => $connectedApps,
                    "allApps" => $allApps
                ]
            ];
        }
        // check against whitelisted apps and sub actions
        if (!in_array($webapp, $availableapps) || !preg_match("/^(do)?(dis)?connect$/", $subaction)) {
            return [
                "templatefile" => "tpl_ca_webapps_error",
                "vars" => [
                    "error" => "Invalid access."
                ]
            ];
        }
        // perform webapp connect
        if ("doconnect" === $subaction) {
            $extraData = [];
            if (isset($allApps[$webapp]["extraData"])) {
                foreach ($allApps[$webapp]["extraData"] as $fieldName) {
                    $extraData[$fieldName] = \App::getFromRequest($fieldName);
                }
            }
            return [
                "templatefile" => "tpl_ca_webapps_result",
                "vars" => self::$subaction($params, $domain, $webapp, $extraData)
            ];
        }
        // perform webapp disconnect
        if ("dodisconnect" === $subaction) {
            return [
                "templatefile" => "tpl_ca_webapps_result",
                "vars" => self::$subaction($params, $domain, $webapp)
            ];
        }
        // disconnect form
        if ("disconnect" === $subaction) {
            return [
                "templatefile" => "tpl_ca_webapps_disconnect",
                "vars" => array_merge([
                    "id" => $params["domainid"],
                    "domain" => $domain,
                    "webapp" =>  $webapp,
                    "path" => $path,
                    "allApps" => $allApps,
                    "cfg" => self::getAppConfiguration($params, $webapp)
                ])
            ];
        }
        // webapp connect form
        return [
            "templatefile" => "tpl_ca_webapps_connect",
            "vars" => [
                "id" => $params["domainid"],
                "domain" => $domain,
                "webapp" =>  $webapp,
                "path" => $path,
                "conflictingApps" => self::getConflictingApps($params, $webapp),
                "allApps" => $allApps
            ]
        ];
    }
    /**
     * get full configuration settings
     * @return array
     */
    private static function getConfiguration()
    {
        static $cfg = null;
        if (!$cfg) {
            $path = implode(DIRECTORY_SEPARATOR, [ROOTDIR, "modules", "registrars", "ispapi", "lib", "webapps.json"]);
            $cfg = json_decode(file_get_contents($path), true);
        }
        return $cfg;
    }
    /**
     * get list of already connected web apps
     * @param array $params common module parameters
     * @return array
     */
    public static function getConnectedApps($params)
    {
        $domain = $params["domainObj"]->getDomain();
        $dnszone = $domain . ".";

        $r = Ispapi::call([
            "COMMAND" => "StatusDNSZone",
            "DNSZONE" => $dnszone
        ], $params);
        if ($r["CODE"] !== "200") {
            if ($r["CODE"] === "545") {
                return [
                    "success" => false,
                    "dnszoneMissing" => true
                ];
            }
            return [
                "success" => false,
                "error" => $r["CODE"] . " " . $r["DESCRIPTION"]
            ];
        }
        if ($r["USER"][0] === "0") {
            return [
                "success" => false,
                "error" => "Access to the DNSZone not allowed. Please contact support."
            ];
        }
        $r = $r["PROPERTY"];

        // web apps handling
        $r = Ispapi::call([
            "COMMAND"   => "QueryDNSZoneRRList",
            "DNSZONE"   => $dnszone,
            "SHORT"     => 1,
            "EXTENDED"  => 1
        ], $params);
        if ($r["CODE"] !== "200") {
            return [
                "error" => $r["CODE"] . " " . $r["DESCRIPTION"]
            ];
        }
        $rrs = preg_grep("/X-ALIAS-.*-WEBAPP/", $r["PROPERTY"]["RR"]);
        $webapps = [
            "success" => true,
            "webapps" => []
        ];
        foreach ($rrs as $idx => $rr) {
            $tempRR = explode(" ", $rr);
            $webapps["webapps"][] = preg_replace("/\..+$/", "", $tempRR[4]);
        }
        return $webapps;
    }
    /**
     * get list of conflicting web apps for given web app identifier
     * @param array $params common module parameters
     * @param string $webapp web app identifier
     * @return array
     */
    public static function getConflictingApps($params, $webapp)
    {
        $connectedApps = self::getConnectedApps($params);
        if (!$connectedApps["success"]) {
            return $connectedApps;
        }
        $allApps = self::getAllApps();
        $webappcfg = $allApps[$webapp];
        $conflicting = [];
        foreach ($connectedApps as $app) {
            $cfg = $allApps[$app];
            $tmp = array_intersect($webappcfg["type"], $cfg["type"]);
            $conflicting = array_values(array_unique(array_merge($conflicting, $tmp)));
        }
        return [
            "success" => true,
            "webapps" => $conflicting
        ];
    }
    /**
     * Authorization check, if Web Apps can be offered
     * @param array $params common module parameters
     * @param bool $checkWHMCS flag to include WHMCS-settings in check (AA vs CA)
     * @return bool
     */
    public static function canUse($params)
    {
        $env = Ispapi::call([
            "COMMAND" => "GetEnvironment",
            "ENVIRONMENTKEY" => "_cp3/config_subuser",
            "ENVIRONMENTNAME" => "enable_webapps",
            "USEPARENT" => 1,
            "LEVEL" => 1
        ], $params);
        if ($env["CODE"] === "200") {
            $env = $env["PROPERTY"];
            if ($env["ENVIRONMENTVALUE"][0] === "true") {
                return true;
            } elseif ($env["ENVIRONMENTVALUE"][0] === "false") {
                return false;
            }
        }

        $r = Ispapi::call([
            "COMMAND" => "StatusUser",
            "RELATIONS" => 0
        ], $params);
        if ($r["CODE"] !== "200") {
            return false;
        }
        $r = $r["PROPERTY"];

        $userregex = "/^(hexonet(\.(net|ca))?|demo\.hexonet\.net)$/i";
        $isdirectcustomer = (
            preg_match($userregex, $r["PARENTUSER"][0])
            || preg_match($userregex, $r["USER"][0])
        );
        if ($isdirectcustomer/* && $canAccessDomains*/) {
            return true;
        }
        return false;
    }
    /**
     * get current Web App configuration
     * @param array $params common module parameters
     * @param string $webapp web app identifier
     * @return array
     */
    public static function getAppConfiguration($params, $webapp)
    {
        $r = Ispapi::call([
            "COMMAND" => "GetEnvironment",
            "ENVIRONMENTKEY0" => "_cp3/config/webapps",
            "ENVIRONMENTNAME0" => $webapp
        ], $params);
        if ($r["CODE"] === "200") {
            return json_decode($r["PROPERTY"]["ENVIRONMENTVALUE"][0], true);
        }
        return [];
    }
    /**
     * connect web app to domain
     * @param array $params common module parameters
     * @param \WHMCS\Domains\Domain $domain domain object
     * @param string $webapp web app identifier
     * @param array $extraData web app configuration settings
     * @return array
     */
    public static function doconnect($params, $domain, $webapp, $extraData)
    {
        if (!$params["dnsmanagement"]) {
            return [
                "success" => false,
                "error" => "DNS Management is not allowed by domain configuration."
            ];
        }
        $extraData["domain"] = $domain;
        $conflictingApps = self::getConflictingApps($params, $webapp);
        if (!$conflictingApps["success"] && !isset($conflictingApps["dnszoneMissing"])) {
            return $conflictingApps;
        }
        if ($conflictingApps["dnszoneMissing"]) {//create dnszone
            $r = Ispapi::call([
                "COMMAND" => "ModifyDomain",
                "DOMAIN" => $params["domainObj"]->getDomain(),
                "INTERNALDNS" => 1
            ], $params);
            if ($r["CODE"] !== "200") {
                return [
                    "success" => false,
                    "error" => ("Creating DNSZone failed: (" . $r["CODE"] . " " . $r["DESCRIPTION"] . ")")
                ];
            }
        }
        foreach ($conflictingApps["webapps"] as $app) {
            self::dodisconnect($params, $domain, $app);
        }
        $allApps = self::getAllApps();
        $cfg = $allApps[$webapp];
        $command = [
            "COMMAND" => "UpdateDNSZone",
            "EXTENDED" => 1,
            "DNSZONE" => $domain . "."
        ];
        $eExtraData = [];
        foreach ($cfg["command"] as $key => $val) {
            foreach ($cfg["extraData"] as $ed) {
                $reqval = \App::getFromRequest($ed);
                $val = preg_replace("/<" . $ed . ">/", $reqval, $val);
                $eExtraData[substr($ed, 2)] = $reqval;
            }
            $command[$key] = $val;
        }
        $r = Ispapi::call($command, $params);
        if ($r["CODE"] === "200") {
            Ispapi::call([
                "COMMAND" => "SetEnvironment",
                "ENVIRONMENTKEY0" => "_cp3/config/webapps",
                "ENVIRONMENTNAME0" => $webapp,
                "ENVIRONMENTVALUE0" => json_encode($eExtraData)
            ], $params);
            return [
                "success" => true
            ];
        }
        return [
            "success" => false,
            "error" => ("Connecting Web App failed. (" . $r["CODE"] . " " . $r["DESCRIPTION"] . ")")
        ];
    }
    /**
     * disconnect web app from domain
     * @param array $params common module parameters
     * @param \WHMCS\Domains\Domain $domain domain object
     * @param string $webapp web app identifier
     * @return string
     */
    public static function dodisconnect($params, $domain, $webapp)
    {
        $allApps = self::getAllApps();
        $cfg = $allApps[$webapp];
        $data = self::getAppConfiguration($params, $webapp);
        if (empty($data)) {
            return [
                "success" => false,
                "error" => ("Disconnecting Web App failed. Configuration missing in environment.")
            ];
        }
        $command = [
            "COMMAND" => "UpdateDNSZone",
            "EXTENDED" => 1,
            "DNSZONE" => $domain . "."
        ];
        foreach ($cfg["command"] as $key => $val) {
            if (preg_match("/^ADDRR([0-9+])$/i", $key, $m)) {
                foreach ($cfg["extraData"] as $ed) {
                    $val = preg_replace("/<" . $ed . ">/", $data[substr($ed, 2)], $val);
                }
                $command["DELRR" . $m[1]] = $val;
            }
        }
        $r = Ispapi::call($command, $params);
        if ($r["CODE"] === "200") {
            Ispapi::call([
                "COMMAND" => "SetEnvironment",
                "ENVIRONMENTKEY0" => "_cp3/config/webapps",
                "ENVIRONMENTNAME0" => $webapp
            ], $params);
            return [
                "success" => true
            ];
        }
        return [
            "success" => false,
            "error" => ("Disconnecting Web App failed. (" . $r["CODE"] . " " . $r["DESCRIPTION"] . ")")
        ];
    }
    /**
     * get assets path
     * @param string $type asset type
     * @return string
     */
    public static function getAssetsPath($type = "img")
    {
        return implode(DIRECTORY_SEPARATOR, [$WEB_ROOT, "modules", "registrars", "ispapi", "lib", "assets", basename($type), "webapps", ""]);
    }
    /**
     * get list of offered web apps
     * @return array
     */
    public static function getAvailableApps()
    {
        $cfg = self::getConfiguration();
        return $cfg["apps"]["available"];
    }
    /**
     * get popular web app categories
     * @return array
     */
    public static function getPopularCategories()
    {
        $cfg = self::getConfiguration();
        return $cfg["categories"]["popular"];
    }
    /**
     * get all web app configurations
     * @return array
     */
    public static function getAllApps()
    {
        $cfg = self::getConfiguration();
        return $cfg["apps"]["all"];
    }
}
