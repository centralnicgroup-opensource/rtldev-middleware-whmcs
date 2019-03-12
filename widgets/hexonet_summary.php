<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function widget_hexonet_data($module)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'HEXONET WIDGET');
    curl_setopt($ch, CURLOPT_URL, "https://raw.githubusercontent.com/hexonet/whmcs-ispapi-" . $module . "/master/release.json");
    $d = curl_exec($ch);
    curl_close($ch);
    if ($d !== false) {
        $d = json_decode($d, true);
        $d["url"] = "https://github.com/hexonet/whmcs-ispapi-" . $module . "/raw/master/whmcs-ispapi-" . $module . "-latest.zip";
        return $d;
    }
    return false;
}

function widget_hexonet_block($cfg)
{
    $content = "<h3 style='font-weight:bold;margin-bottom:8px;color:#29467c;'>" . $cfg["title"] . "</h3>";
    $diff = version_compare($cfg["version_used"], $cfg["version_latest"]);
    $content .= "You are currently running version ".$cfg["version_used"].".";
    if ($diff < 0) {
        $content .= '<div class="textred">An update is available!<br>Please install the latest version '.$cfg["version_latest"].'. (<a href="' . $cfg["url"] . '">download</a>)</div>';
    }
    if ($diff >= 0) {
        $content .= '<div class="textgreen">Your version is up to date.</div>';
    }
    $content .= '<div style="margin-bottom:20px;"></div>';
    return $content;
}

function widget_hexonet_summary($vars)
{
    global $_ADMINLANG;
    $content = "";

    // ####################################
    // Registrar Version Check
    // ####################################
    $d = widget_hexonet_data("registrar");
    if ($d !== false) {
        $path = ROOTDIR."/modules/registrars/ispapi/ispapi.php";
        if (file_exists($path)) {
            require_once($path);
            if (function_exists('ispapi_GetISPAPIModuleVersion')) {
                $content .= widget_hexonet_block(array(
                    "title" => "ISPAPI Registrar Module",
                    "version_used" => call_user_func('ispapi_GetISPAPIModuleVersion'),
                    "version_latest" => $d["version"],
                    "url" => $d["url"]
                ));
            }
        }
    }

    // ####################################
    // Domainchecker Version Check
    // ####################################
    $d = widget_hexonet_data("domainchecker");
    if ($d !== false) {
        $path = ROOTDIR."/modules/addons/ispapidomaincheck/ispapidomaincheck.php";
        if (file_exists($path)) {
            require_once($path);
            $content .= widget_hexonet_block(array(
                "title" => "ISPAPI High Performance DomainChecker Module",
                "version_used" => $module_version,
                "version_latest" => $d["version"],
                "url" => $d["url"]
            ));
        }
    }

    // ####################################
    // Backorder Version Check
    // ####################################
    $d = widget_hexonet_data("backorder");
    if ($d !== false) {
        $path = ROOTDIR."/modules/addons/ispapibackorder/ispapibackorder.php";
        if (file_exists($path)) {
            require_once($path);
            $content .= widget_hexonet_block(array(
                "title" => "ISPAPI Backorder Module",
                "version_used" => $module_version,
                "version_latest" => $d["version"],
                "url" => $d["url"]
            ));
        }
    }

    // ####################################
    // PricingImporter Version Check
    // ####################################
    $d = widget_hexonet_data("pricingimporter");
    if ($d !== false) {
        $path = ROOTDIR."/modules/addons/ispapidpi/ispapidpi.php";
        if (file_exists($path)) {
            require_once($path);
            $content .= widget_hexonet_block(array(
                "title" => "ISPAPI Pricing Importer Module",
                "version_used" => $module_version,
                "version_latest" => $d["version"],
                "url" => $d["url"]
            ));
        }
    }

    // ####################################
    // SSL Version Check
    // ####################################
    $d = widget_hexonet_data("ssl");
    if ($d !== false) {
        $path = ROOTDIR."/modules/servers/ispapissl/ispapissl.php";
        if (file_exists($path)) {
            require_once($path);
            $content .= widget_hexonet_block(array(
                "title" => "ISPAPI SSL Module",
                "version_used" => $module_version,
                "version_latest" => $d["version"],
                "url" => $d["url"]
            ));
        }
    }

    // ####################################
    // Domain Import Module Version Check
    // ####################################
    $d = widget_hexonet_data("domainimport");
    if ($d !== false) {
        $path = ROOTDIR."/modules/addons/ispapidomainimport/ispapidomainimport.php";
        if (file_exists($path)) {
            require_once($path);
            $content .= widget_hexonet_block(array(
                "title" => "ISPAPI Domain Import Module",
                "version_used" => $module_version,
                "version_latest" => $d["version"],
                "url" => $d["url"]
            ));
        }
    }

    // ####################################
    // Additonal Output
    // ####################################
    if (empty($content)) {
        $content = "<div style='text-align:center;padding:5px;background:#f7d5d1;'><i style=''>Service Temporarily Unavailable. Please try again later...</i>";
    }
    return array( 'title' => 'Hexonet Modules', 'content' => "<div style='margin-left:5px; margin-top:5px;'>".$content."</div>" );
}

add_hook("AdminHomeWidgets", 1, "widget_hexonet_summary");
