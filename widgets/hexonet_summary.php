<?php

    if (!defined("WHMCS"))
        die("This file cannot be accessed directly");

    function widget_hexonet_summary($vars) {
        global $_ADMINLANG;
        $current_registrar_version = file_get_contents('http://www.hexonet.net/files/whmcs/ispapi/current_registrar_version.php');
        $current_domainchecker_version = file_get_contents('http://www.hexonet.net/files/whmcs/ispapi/current_domainchecker_version.php');
        $hexonet_info = file_get_contents('http://www.hexonet.net/whmcs/hexonet_info.php');
        $content = "";
        
		if(!empty($current_registrar_version)){
			$registrar_path = dirname(__FILE__)."/../../modules/registrars/ispapi/ispapi.php";
			if(file_exists($registrar_path)){
				require_once($registrar_path);
				if(function_exists('ispapi_GetISPAPIModuleVersion')){
					$content .= "<h3 style='font-weight:bold;margin-bottom:8px;color:#29467c;'>ISPAPI Registrar Module</h3>";
					$my_registrar_version = call_user_func('ispapi_GetISPAPIModuleVersion');

					$diff = version_compare($my_registrar_version, $current_registrar_version);
					$content .= "You are currently running version ".$my_registrar_version.".";
					if($diff < 0){
						$content .= '<div class="textred">An update is available!<br>Please install the latest version '.$current_registrar_version.'. (<a href="https://www.hexonet.net/files/whmcs/ispapi/ispapi_whmcs-latest.zip">download</a>)</div>';
					}
					if($diff >= 0){
						$content .= '<div class="textgreen">Your version is up to date.</div>';
					}
					$content .= '<div style="margin-bottom:20px;"></div>';
				}
			}
		}
		
		if(!empty($current_domainchecker_version)){
			$domainchecker_path = dirname(__FILE__)."/../../modules/addons/ispapidomaincheck/ispapidomaincheck.php";
			if(file_exists($domainchecker_path)){
				$content .= "<h3 style='font-weight:bold;margin-bottom:8px;color:#29467c;'>High Performance DomainChecker Module</h3>";
				require_once($domainchecker_path);
				$my_domainchecker_version = $module_version;

				$diff = version_compare($my_domainchecker_version, $current_domainchecker_version);
				$content .= "You are currently running version ".$my_domainchecker_version.".";
				if($diff < 0){
					$content .= '<div class="textred">An update is available!<br>Please install the latest version '.$current_domainchecker_version.'. (<a href="https://www.hexonet.net/files/whmcs/ispapi/ispapi_whmcs-domaincheckaddon-latest.zip">download</a>)</div>';
				}
				if($diff >= 0){
					$content .= '<div class="textgreen">Your version is up to date.</div>';
				}

			}else{
				$content .= '<div style="margin:10px 10px 10px 10px;padding:8px 10px;background-color:#FDF8E1;border:1px dashed #FADA5A;-moz-border-radius: 5px;-webkit-border-radius: 5px;-o-border-radius: 5px;border-radius: 5px;"><h3 style="font-weight:bold;margin-bottom:8px;color:#779500;">Need more?</h3>
							 <b>Check Out our new High Performance DomainChecker Module!</b><br>
							 A public demo site is available at: <a target="_blank" href="http://try-whmcs.hexonet.net/">http://try-whmcs.hexonet.net/</a> (demo/demo)<br>
							 <a target="_blank" href="https://wiki.hexonet.net/index.php/WHMCS_Modules">Learn more >></a></div>';
			}
			$content .= '<div style="margin-bottom:20px;"></div>';
		}

		if(!empty($hexonet_info)){
			$content .= $hexonet_info;
		}

        return array( 'title' => 'Hexonet', 'content' => $content );

    }

    add_hook("AdminHomeWidgets",1,"widget_hexonet_summary");

?>