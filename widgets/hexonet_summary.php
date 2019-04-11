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
        $d["imgurl"] = "https://raw.githubusercontent.com/hexonet/whmcs-ispapi-" . $module . "/master/module.png";
        return $d;
    }
    return false;
}

function widget_hexonet_module($module)
{
    if ($module) {
        $diff = version_compare($module["version_used"], $module["version_latest"]);
        return (
            '<div class="col-sm-4 text-center">' .
                '<div class="thumbnail">' .
                    '<img style="width:120px; height: 120px" src="' . $module["imgurl"] . '" alt="' .  $module["title"] . '"/>' .
                    (($diff < 0) ?
                        '<div class="caption"><a class="textred" href="' . $module["url"] . '">v' . $module["version_used"] . '</a></div>' :
                        '<div class="caption"><p class="textgreen">v' . $module["version_used"] . '</p></div>'
                    ) .
                '</div>' .
            '</div>'
        );
    }
    return '<div class="col-sm-4"></div>';
}

function widget_hexonet_block($modules)
{
    $content = '<div class="widget-content-padded" style="max-height: 450px">';
    while (!empty($modules)) {
        $content .= '<div class="row">';
        $content .= widget_hexonet_module(array_shift($modules));
        $content .= widget_hexonet_module(array_shift($modules));
        $content .= widget_hexonet_module(array_shift($modules));
        $content .= '</div>';
    }
    $content .= '</div>';
    return $content;
}

function widget_hexonet_summary($vars)
{
    global $_ADMINLANG;
    $content = "";
    $modules = array();

    // ####################################
    // Registrar Version Check
    // ####################################
    $d = widget_hexonet_data("registrar");
    if ($d !== false) {
        $path = ROOTDIR."/modules/registrars/ispapi/ispapi.php";
        if (file_exists($path)) {
            require_once($path);
            if (function_exists('ispapi_GetISPAPIModuleVersion')) {
                $modules[] = array(
                    "title" => "ISPAPI Registrar Module",
                    "version_used" => call_user_func('ispapi_GetISPAPIModuleVersion'),
                    "version_latest" => $d["version"],
                    "url" => $d["url"],
                    "imgurl" => $d["imgurl"]
                );
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
            $modules[] = array(
                "title" => "ISPAPI High Performance DomainChecker Module",
                "version_used" => $module_version,
                "version_latest" => $d["version"],
                "url" => $d["url"],
                "imgurl" => $d["imgurl"]
            );
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
            $modules[] = array(
                "title" => "ISPAPI Backorder Module",
                "version_used" => $module_version,
                "version_latest" => $d["version"],
                "url" => $d["url"],
                "imgurl" => $d["imgurl"]
            );
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
            $modules[] = array(
                "title" => "ISPAPI Pricing Importer Module",
                "version_used" => $module_version,
                "version_latest" => $d["version"],
                "url" => $d["url"],
                "imgurl" => $d["imgurl"]
            );
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
            $modules[] = array(
                "title" => "ISPAPI SSL Module",
                "version_used" => $module_version,
                "version_latest" => $d["version"],
                "url" => $d["url"],
                "imgurl" => $d["imgurl"]
            );
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
            $modules[] = array(
                "title" => "ISPAPI Domain Import Module",
                "version_used" => $module_version,
                "version_latest" => $d["version"],
                "url" => $d["url"],
                "imgurl" => $d["imgurl"]
            );
        }
    }

    // ####################################
    // Additonal Output
    // ####################################
    if (empty($modules)) {
        return array(
            'title' => 'HEXONET Modules',
            'content' => "<div class='widget-content-padded'><i style=''>No active HEXONET Modules found.</i></div>"
        );
    }
    return array(
        'title' => 'HEXONET Modules',
        'content' => "". widget_hexonet_block($modules) . ""
    );
}

add_hook("AdminHomeWidgets", 1, "widget_hexonet_summary");
