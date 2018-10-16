<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function widget_hexonet_summary($vars)
{
    global $_ADMINLANG;
    $content = "";

    // Registrar Version Check
    // ####################################
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT,'HEXONET WIDGET');
    curl_setopt($ch, CURLOPT_URL, "https://api.github.com/repos/hexonet/whmcs-ispapi-registrar/releases/latest");
    $registrarData = curl_exec($ch);
    if ($registrarData === false) {
        $registrarData = "{}";
        $registrar_url = "";
    }
    curl_close($ch);
    $registrarData = json_decode($registrarData, true);
    $current_registrar_version = array_key_exists("name", $registrarData) ? substr($registrarData["name"], 1) : "n/a";
    if (array_key_exists("assets", $registrarData)) {
        foreach ($registrarData["assets"] as &$asset) {
            if (preg_match("/whmcs-ispapi-registrar\.zip$/i", $asset["browser_download_url"])) {
                $registrar_url = $asset["browser_download_url"];
                break;
            }
        }
    }

    if (!empty($current_registrar_version)) {
        $registrar_path = $_SERVER["DOCUMENT_ROOT"]."/modules/registrars/ispapi/ispapi.php";
        if (file_exists($registrar_path)) {
            require_once($registrar_path);
            if (function_exists('ispapi_GetISPAPIModuleVersion')) {
                $content .= "<h3 style='font-weight:bold;margin-bottom:8px;color:#29467c;'>ISPAPI Registrar Module</h3>";
                $my_registrar_version = call_user_func('ispapi_GetISPAPIModuleVersion');

                $diff = version_compare($my_registrar_version, $current_registrar_version);
                $content .= "You are currently running version ".$my_registrar_version.".";
                if ($diff < 0) {
                    $content .= '<div class="textred">An update is available!<br>Please install the latest version '.$current_registrar_version.'. (<a href="' . $registrar_url . '">download</a>)</div>';
                }
                if ($diff >= 0) {
                    $content .= '<div class="textgreen">Your version is up to date.</div>';
                }
                $content .= '<div style="margin-bottom:20px;"></div>';
            }
        }
    }
    // ####################################

    // Domainchecker Version Check
    // ####################################
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT,'HEXONET WIDGET');
    curl_setopt($ch, CURLOPT_URL, "https://api.github.com/repos/hexonet/whmcs-ispapi-domainchecker/releases/latest");
    $domaincheckerData = curl_exec($ch);
    if ($domaincheckerData === false) {
        $domaincheckerData = "{}";
        $domainchecker_url = "";
    }
    curl_close($ch);
    $domaincheckerData = json_decode($domaincheckerData, true);
    $current_domainchecker_version = array_key_exists("name", $domaincheckerData) ? substr($domaincheckerData["name"], 1) : "n/a";
    if (array_key_exists("assets", $domaincheckerData)) {
        foreach ($domaincheckerData["assets"] as &$asset) {
            if (preg_match("/whmcs-ispapi-domainchecker\.zip$/i", $asset["browser_download_url"])) {
                $domainchecker_url = $asset["browser_download_url"];
                break;
            }
        }
    }

    if (!empty($current_domainchecker_version)) {
        $domainchecker_path = $_SERVER["DOCUMENT_ROOT"]."/modules/addons/ispapidomaincheck/ispapidomaincheck.php";
        if (file_exists($domainchecker_path)) {
            $content .= "<h3 style='font-weight:bold;margin-bottom:8px;color:#29467c;'>ISPAPI High Performance DomainChecker Module</h3>";
            require_once($domainchecker_path);
            $my_domainchecker_version = $module_version;

            $diff = version_compare($my_domainchecker_version, $current_domainchecker_version);
            $content .= "You are currently running version ".$my_domainchecker_version.".";
            if ($diff < 0) {
                $content .= '<div class="textred">An update is available!<br>Please install the latest version '.$current_domainchecker_version.'. (<a href="https://www.hexonet.net/files/whmcs/ispapi/ispapi_whmcs-domaincheckaddon-7-latest.zip">download</a>)</div>';
            }
            if ($diff >= 0) {
                $content .= '<div class="textgreen">Your version is up to date.</div>';
            }
        }
        $content .= '<div style="margin-bottom:20px;"></div>';
    }
    // ####################################


    $content .= '<div style="margin:10px 10px 10px 10px;padding:8px 10px;background-color:#FDF8E1;border:1px dashed #FADA5A;-moz-border-radius: 5px;-webkit-border-radius: 5px;-o-border-radius: 5px;border-radius: 5px;"><h3 style="font-weight:bold;margin-bottom:8px;color:#779500;">Need more?</h3>
                     <a target="_blank" href="https://www.hexonet.net/resellers/integration#whmcs">Check out all our WHMCS Modules! >></a></div>';

    if (empty($content)) {
        $content = "<div style='text-align:center;padding:5px;background:#f7d5d1;'><i style=''>Service Temporarily Unavailable. Please try again later...</i>";
    }

    return array( 'title' => 'Hexonet Modules', 'content' => "<div style='margin-left:5px; margin-top:5px;'>".$content."</div>" );
}

add_hook("AdminHomeWidgets", 1, "widget_hexonet_summary");
