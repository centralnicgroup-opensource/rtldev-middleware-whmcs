<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function bubble_sort_special_version_compare($arr)
{
    $size = count($arr);
    for ($i=0; $i<$size; $i++) {
        for ($j=0; $j<$size-1-$i; $j++) {
            if (version_compare($arr[$j+1], $arr[$j]) <= 0) {
                swap($arr, $j, $j+1);
            }
        }
    }
    return $arr;
}

function swap(&$arr, $a, $b)
{
    $tmp = $arr[$a];
    $arr[$a] = $arr[$b];
    $arr[$b] = $tmp;
}

function widget_hexonet_summary($vars)
{
    global $_ADMINLANG;

    // Registrar Version Check
    // ####################################
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, "https://api.github.com/repos/hexonet/ispapi_whmcs/releases/latest");
    $registrarData = curl_exec($ch);
    if ($registrarData === false) {
        $registrarData = "{}";
        $registrar_url = "";
    }
    curl_close($ch);
    $registrarData = json_decode($registrarData, true);
    $current_registrar_version = array_key_exists("name", $registrarData) ? $registrarData["name"] : "n/a";
    if (array_key_exists("assets", $registrarData)) {
        foreach ($registrarData["assets"] as &$asset) {
            if (preg_match("/ispapi_whmcs\.zip$/i", $asset["browser_download_url"])) {
                $registrar_url = $asset["browser_download_url"];
                break;
            }
        }
    }
    // ####################################

    $url = "https://www.hexonet.net/files/whmcs/ispapi";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);

    // Domainchecker Version Check
    // ####################################
    $domainchecker_versions = array();
    $regexp = "\/ispapi_whmcs-domaincheckaddon-([\d.]*).zip";
    if (preg_match_all("/$regexp/siU", $data, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $match) {
            array_push($domainchecker_versions, $match[1]);
        }
    }
    $current_domainchecker_version = array_pop(bubble_sort_special_version_compare($domainchecker_versions));
    // ####################################

    $content = "";
    if (!empty($current_registrar_version)) {
        $registrar_path = dirname(__FILE__)."/../../modules/registrars/ispapi/ispapi.php";
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

    if (!empty($current_domainchecker_version)) {
        $domainchecker_path = dirname(__FILE__)."/../../modules/addons/ispapidomaincheck/ispapidomaincheck.php";
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

    $content .= '<div style="margin:10px 10px 10px 10px;padding:8px 10px;background-color:#FDF8E1;border:1px dashed #FADA5A;-moz-border-radius: 5px;-webkit-border-radius: 5px;-o-border-radius: 5px;border-radius: 5px;"><h3 style="font-weight:bold;margin-bottom:8px;color:#779500;">Need more?</h3>
                     <a target="_blank" href="https://wiki.hexonet.net/index.php/WHMCS_Modules">Check out all our WHMCS Modules! >></a></div>';

    if (empty($content)) {
        $content = "<div style='text-align:center;padding:5px;background:#f7d5d1;'><i style=''>Service Temporarily Unavailable. Please try again later...</i>";
    }

    return array( 'title' => 'Hexonet Modules', 'content' => "<div style='margin-left:5px; margin-top:5px;'>".$content."</div>" );
}

    add_hook("AdminHomeWidgets", 1, "widget_hexonet_summary");
