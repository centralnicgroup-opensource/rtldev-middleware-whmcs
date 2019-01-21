<?php
/**
 * ISPAPI Registrar Module
 *
 * @author HEXONET GmbH <support@hexonet.net>
 */

$module_version = "1.6.0";

use WHMCS\Domains\DomainLookup\ResultsList;
use WHMCS\Domains\DomainLookup\SearchResult;
use WHMCS\Module\Registrar\Registrarmodule\ApiClient;
use WHMCS\Database\Capsule;

/**
 * Check the availability of domains using HEXONET's fast API
 *
 * @param array $params common module parameters
 *
 * @return \WHMCS\Domains\DomainLookup\ResultsList An ArrayObject based collection of \WHMCS\Domains\DomainLookup\SearchResult results
 */
function ispapi_CheckAvailability($params)
{
    //GET AN ARRAY OF ALL TLDS CONFIGURED WITH HEXONET
    $pdo = Capsule::connection()->getPdo();
    $stmt = $pdo->prepare("SELECT extension FROM tbldomainpricing WHERE autoreg REGEXP '^(ispapi|hexonet)$'");
    $stmt->execute();
    $ispapi_tlds = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    //GET ALL CURRENCIES EXISTING IN WHMCS
    $whmcs_existing_currencies = localAPI('GetCurrencies', array());

    if ($params['isIdnDomain']) {
        $label = empty($params['punyCodeSearchTerm']) ? strtolower($params['searchTerm']) : strtolower($params['punyCodeSearchTerm']);
    } else {
        $label = strtolower($params['searchTerm']);
    }

    $tldslist = $params['tldsToInclude'];
    $premiumEnabled = (bool) $params['premiumEnabled'];
    $domainslist = array();
    $results = new ResultsList();

    foreach ($tldslist as $tld) {
        if (!empty($tld[0])) {
            if ($tld[0] != '.') {
                $tld = ".".$tld;
            }
            $domain = $label.$tld;
            if (!in_array($domain, $domainslist["all"])) {
                $domainslist["all"][] = $domain;
                $domainslist["list"][] = array("sld" => $label, "tld" => $tld);
            }
        }
    }

    //ONLY FOR SUGGESTIONS
    if (isset($params["suggestions"]) && !empty($params["suggestions"])) {
        $domainslist["all"] = array();
        $domainslist["list"] = array();
        foreach ($params["suggestions"] as $suggestion) {
            if (!in_array($suggestion, $domainslist["all"])) {
                $domainslist["all"][] = $suggestion;
                $suggested_domain = preg_split("/\./", $suggestion, 2);
                $domainslist["list"][] = array("sld" => $suggested_domain[0], "tld" => ".".$suggested_domain[1]);
            }
        }
    }

    $command = array(
            "COMMAND" => "CheckDomains",
            "DOMAIN" => $domainslist["all"],
            "PREMIUMCHANNELS" => "*"
    );
    $check = ispapi_call($command, ispapi_config($params));

    if ($check["CODE"] == 200) {
        $index=0;
        foreach ($domainslist["list"] as $domain) {
            $registerprice = $renewprice = $currency = $status = "";
            $searchResult = new SearchResult($domain['sld'], $domain['tld']);
            if (preg_match('/549/', $check["PROPERTY"]["DOMAINCHECK"][$index])) {
                //TLD NOT SUPPORTED AT HEXONET USE A FALLBACK TO THE WHOIS LOOKUP.
                $whois = localAPI("DomainWhois", array("domain" => $domain['sld'].$domain['tld']));
                if ($whois["status"] == "available") {
                    //DOMAIN AVAILABLE
                    $status = SearchResult::STATUS_NOT_REGISTERED;
                } else {
                    //DOMAIN TAKEN
                    $status = SearchResult::STATUS_REGISTERED;
                }
            } elseif (preg_match('/210/', $check["PROPERTY"]["DOMAINCHECK"][$index])) {
                //DOMAIN AVAILABLE
                $status = SearchResult::STATUS_NOT_REGISTERED;
            } elseif (!empty($check["PROPERTY"]["PREMIUMCHANNEL"][$index]) || !empty($check["PROPERTY"]["CLASS"][$index])) { //IT IS A PREMIUMDOMAIN
                //IF PREMIUM DOMAIN ENABLED IN WHMCS - DISPLAY AVAILABLE + PRICE
                if ($premiumEnabled) {
                    //CHECK IF HEXONET IS CONFIGURED AS REGISTRAR FOR THIS EXTENSION
                    if (!in_array($domain['tld'], $ispapi_tlds)) {
                        //PREMIUM DOMAIN BUT NOT REGISTERED WITH HEXONET - RETURN TAKEN
                        $status = SearchResult::STATUS_REGISTERED;
                    } else {
                        //GET THE REGISTER PRICE
                        if (isset($check["PROPERTY"]["PRICE"][$index]) && is_numeric($check["PROPERTY"]["PRICE"][$index])) {
                            $registerprice = $check["PROPERTY"]["PRICE"][$index];
                        }

                        if (isset($check["PROPERTY"]["CURRENCY"][$index]) && !empty($check["PROPERTY"]["CURRENCY"][$index])) {
                            $currency = $check["PROPERTY"]["CURRENCY"][$index];
                        }

                        //GET ALL CURRENCIES EXISTING IN WHMCS AND THE PREMIUM DOMAIN CURRENCY
                        $currency_id = 0;
                        $currency_list = array();
                        foreach ($whmcs_existing_currencies["currencies"]["currency"] as $cur) {
                            $currency_list[] = $cur["code"];
                            if ($cur["code"] == $currency) {
                                $currency_id = $cur["id"];
                            }
                        }

                        if (!in_array($currency, $currency_list) || empty($registerprice)) {
                            //IF CURRENCY OF THE DOMAIN NOT IN WHMCS OR PRICE NOT FOUND, RETURN TAKEN BECAUSE IT'S NOT POSSIBLE TO CALCULATE THE PRICE.
                            $status = SearchResult::STATUS_REGISTERED;
                        } else {
                            //AFTERMARKET OR REGISTRY PREMIUM DOMAIN
                            $renewprice = ispapi_getRenewPrice($params, $check["PROPERTY"]["CLASS"][$index], $currency_id, ltrim($domain['tld'], '.'));

                            if (isset($registerprice) && isset($currency) && !empty($renewprice)) {
                                $status = SearchResult::STATUS_NOT_REGISTERED;
                                $searchResult->setPremiumDomain(true);
                                $premiuminformation = array('register' => $registerprice,
                                                            'renew' => $renewprice,
                                                            'CurrencyCode' => $currency);
                                $searchResult->setPremiumCostPricing($premiuminformation);
                            } else {
                                //PROBLEM, COULD NOT GET REGISTRATION OR RENEW PRICES -> DISPLAY THE DOMAIN AS TAKEN
                                $status = SearchResult::STATUS_REGISTERED;
                            }
                        }
                    }
                } else {
                    //PREMIUM DOMAIN NOT ENABLED IN WHMCS -> DISPLAY THE DOMAIN AS TAKEN
                    $status = SearchResult::STATUS_REGISTERED;
                }
            } else {
                //DOMAIN TAKEN
                $status = SearchResult::STATUS_REGISTERED;
            }

            $searchResult->setStatus($status);
            $index++;

            if (isset($params["suggestions"])) {
                //ONLY RETURNS AVAILABLE DOMAINS FOR SUGGESTIONS
                if ($status != SearchResult::STATUS_REGISTERED) {
                    $results->append($searchResult);
                }
            } else {
                $results->append($searchResult);
            }
        }
    }

    return $results;
}

/**
 * Provide domain suggestions based on the domain lookup term provided
 *
 * @param array $params common module parameters
 *
 * @return \WHMCS\Domains\DomainLookup\ResultsList An ArrayObject based collection of \WHMCS\Domains\DomainLookup\SearchResult results
 */
function ispapi_GetDomainSuggestions($params)
{
    //return;

    //GET THE TLD OF THE SEARCHED VALUE
    if (isset($_REQUEST["domain"]) && preg_match('/\./', $_REQUEST["domain"])) {
        $search = preg_split("/\./", $_REQUEST["domain"], 2);
        $searched_zone = $search[1];
    }

    //RETURN EMPTY ResultsList OBJECT WHEN SUGGESTIONS ARE DEACTIVATED
    if (empty($params['suggestionSettings']['suggestions'])) {
        return new ResultsList();
    }

    if ($params['isIdnDomain']) {
           $label = empty($params['punyCodeSearchTerm']) ? strtolower($params['searchTerm']) : strtolower($params['punyCodeSearchTerm']);
    } else {
           $label = strtolower($params['searchTerm']);
    }
    $tldslist = $params['tldsToInclude'];
    $zones = array();
    foreach ($tldslist as $tld) {
        #IGNORE 3RD LEVEL TLDS - NOT FULLY SUPPORTED BY QueryDomainSuggestionList
        if (!preg_match("/\./", $tld)) {
            $zones[] = $tld;
        }
    }

    //IF SEARCHED VALUE CONTAINS TLD THEN ONLY DISPLAY SUGGESTIONS WITH THIS TLD
    //$zones_for_suggestions = isset($searched_zone) ? array($searched_zone) : $zones;

    $command = array(
            "COMMAND" => "QueryDomainSuggestionList",
            "KEYWORD" => $label,
            "ZONE" => $zones,
            "SOURCE" => "ISPAPI-SUGGESTIONS",
    );
    $suggestions = ispapi_call($command, ispapi_config($params));

    $domains = array();
    if ($suggestions["CODE"] == 200) {
        $domains = $suggestions["PROPERTY"]["DOMAIN"];
    }
    $params["suggestions"] = $domains;

    return ispapi_CheckAvailability($params);
}

/**
 * Define the settings relating to domain suggestions
 *
 * @param array an array with different settings
 */
function ispapi_DomainSuggestionOptions($params)
{
    if ($params['whmcsVersion'] < 7.6) {
        $marginleft = '60px';
    } else {
        $marginleft = '220px';
    }

    return array(
        'information' => array(
            'FriendlyName' => '<b>Don\'t have a HEXONET Account yet?</b>',
            'Description' => 'Get one here: <a target="_blank" href="https://www.hexonet.net/sign-up">https://www.hexonet.net/sign-up</a><br><br>
			<b>The HEXONET Lookup Provider provides the following features:</b>
			<ul style="text-align:left;margin-left:'.$marginleft.';margin-top:5px;">
			<li>High Performance availability checks using our fast API</li>
			<li>Suggestion Engine</li>
			<li>Aftermarket and Registry Premium Domains support</li>
			<li>Fallback to WHOIS Lookup for non-supported TLDs</li>
			</ul>
            ',
        ),
        'suggestions' => array(
            'FriendlyName' => '<b style="color:#FF6600;">Suggestion Engine based on search term:</b>',
            'Type' => 'yesno',
            'Description' => 'Tick to activate (recommended)',
        ),
    );
}

/**
 * Calculate the domain renew price
 *
 * @param array $params common module parameters
 * @param string $class the class of the domain name
 * @param integer $cur_id the currency of the domain name
 * @param string $tld the tld of the domain name
 *
 * @return integer/bool the renew price, false if not found
 */
function ispapi_getRenewPrice($params, $class, $cur_id, $tld)
{
    session_start();

    if (empty($class)) {
        //NO PREMIUM RENEW, RETURN THE PRICE SET IN WHMCS
        $pdo = Capsule::connection()->getPdo();
        $stmt = $pdo->prepare("select * from tbldomainpricing tbldp, tblpricing tblp where tbldp.extension = ? and tbldp.id = tblp.relid and tblp.type = 'domainrenew' and tblp.currency=?");
        $stmt->execute(array(".".$tld, $cur_id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($data) && !in_array($data["msetupfee"], array("-1", "0"))) {
            return $data["msetupfee"];
        } else {
            return false;
        }
        //API COMMAND GetTLDPricing IS TRIGERING JS ERROR AND IS UNUSABLE.
        // $gettldpricing_res = localAPI('GetTLDPricing', array('currencyid' => $cur_id));
        // $renewprice = $gettldpricing_res["pricing"][$tld]["renew"][1];
        //return !empty($renewprice) ? $renewprice : false;
    }

    if (!preg_match('/\:/', $class)) {
        //REGISTRY PREMIUM DOMAIN (e.g. PREMIUM_DATE_F)
        $class = "PRICE_CLASS_DOMAIN_".$class."_ANNUAL";
        $type = "PREMIUM";
    } else {
        //VARIABLE FEE PREMIUM DOMAINS (e.g. PREMIUM_TOP_CNY:24:2976)
        $p = preg_split("/\:/", $class);
        $type = "VARIABLEPREMIUM";
    }

    if ($type == "VARIABLEPREMIUM") {
        //HANDLE VARIABLE FEE PREMIUM DOMAINS
        $cl = preg_split("/_/", $p[0]);
        $premiummarkupfix_value = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_".$cl[0]."_".$cl[1]."_*_ANNUAL_MARKUP_FIX");
        $premiummarkupvar_value = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_".$cl[0]."_".$cl[1]."_*_ANNUAL_MARKUP_VAR");
        if ($premiummarkupfix_value && $premiummarkupvar_value) {
            $renewprice = $p[1] * (1 + $premiummarkupvar_value/100) + $premiummarkupfix_value;
            return $renewprice;
        }
    } else {
        //HANDLE REGISTRY PREMIUM DOMAINS
        return ispapi_getUserRelationValue($params, $class);
    }
    return false;
}

/**
 * Get the value for a given user relationtype
 *
 * @param array $params common module parameters
 * @param string $relationtype the name of the user relationtype
 *
 * @return integer/bool the user relationvalue, false if not found
 */
function ispapi_getUserRelationValue($params, $relationtype)
{
    $relations = ispapi_getUserRelations($params);
    $i=0;
    foreach ($relations["RELATIONTYPE"] as $relation) {
        if ($relation == $relationtype) {
            return $relations["RELATIONVALUE"][$i];
        }
        $i++;
    }
    return false;
}

/**
 * Generate and return the user relations (StatusUser)
 * The user relations are stored in a session ($_SESSION["ISPAPICACHE"]["RELATIONS"]) and are regenerated after 600 seconds.
 *
 * @param array $params common module parameters
 *
 * @return array/bool the user relations, false if not found
 */
function ispapi_getUserRelations($params)
{
    $date = new DateTime();
    if ((!isset($_SESSION["ISPAPICACHE"])) || ($_SESSION["ISPAPICACHE"]["TIMESTAMP"] + 600 < $date->getTimestamp() )) {
        $command["COMMAND"] = "StatusUser";
        $response = ispapi_call($command, ispapi_config($params));
        if ($response["CODE"] == 200) {
            $_SESSION["ISPAPICACHE"] = array("TIMESTAMP" => $date->getTimestamp() , "RELATIONS" => $response["PROPERTY"]);
            return $_SESSION["ISPAPICACHE"]["RELATIONS"];
        } else {
            return false;
        }
    } else {
        return $_SESSION["ISPAPICACHE"]["RELATIONS"];
    }
}

/**
 * Initialize the version of the module
 *
 * @param string $version the version of the module
 *
 */
function ispapi_InitModule($version)
{
    global $ispapi_module_version;
    $ispapi_module_version = $version;
}

/**
 * Return the version of the module
 *
 * @return string $version the version of the module
 */
function ispapi_GetISPAPIModuleVersion()
{
    global $ispapi_module_version;
    return $ispapi_module_version;
}

/**
 * Return the configuration array of the module (Setup > Products / Services > Domain Registrars > ISPAPI > Configure)
 *
 * @param array $params common module parameters
 *
 * @return array $configarray configuration array of the module
 */
function ispapi_getConfigArray($params)
{
    $version = ispapi_GetISPAPIModuleVersion();
    $configarray = array(
            "FriendlyName" => array("Type" => "System", "Value"=>"ISPAPI v".$version),
            "Description" => array("Type" => "System", "Value"=>"The Official ISPAPI Registrar Module. <a target='blank_' href='https://www.hexonet.net'>www.hexonet.net</a>"),
            "Username" => array( "Type" => "text", "Size" => "20", "Description" => "Enter your ISPAPI Login ID", ),
            "Password" => array( "Type" => "password", "Size" => "20", "Description" => "Enter your ISPAPI Password ", ),
            "UseSSL" => array( "Type" => "yesno", "Description" => "Use HTTPS for API Connections" ),
            "TestMode" => array( "Type" => "yesno", "Description" => "Connect to OT&amp;E (Test Environment)" ),
            "ProxyServer" => array( "Type" => "text", "Description" => "Optional (HTTP(S) Proxy Server)" ),
            "ConvertIDNs" => array( "Type" => "dropdown", "Options" => "API,PHP", "Default" => "API", "Description" => "Use API or PHP function (idn_to_ascii)" ),
            "DNSSEC" => array( "Type" => "yesno", "Description" => "Display the DNSSEC Management functionality in the domain details" ),
            "TRANSFERLOCK" => array( "Type" => "yesno", "Description" => "Locks automatically a domain after a new registration" ),
    );
    if (!function_exists('idn_to_ascii')) {
        $configarray["ConvertIDNs"] = array( "Type" => "dropdown", "Options" => "API", "Default" => "API", "Description" => "Use API (PHP function idn_to_ascii not available)" );
    }

    if (!empty($params["Username"])) {
        //Check authentication
        $command = array(
                "COMMAND" => "CheckAuthentication",
                "SUBUSER" => $params["Username"],
                "PASSWORD" => $params["Password"]
        );

        $response = ispapi_call($command, ispapi_config($params));
        $mode_text = ($params["TestMode"]=="on") ? "to OT&E environment" : "to PRODUCTION environment";
        $state = ($response["CODE"] == 200) ? "<div style='color:white;font-weight:bold;background-color:green;padding:3px;width:400px;text-align:center;'>Connected ".$mode_text."</div>" : "<div style='color:white;font-weight:bold;background-color:red;padding:3px;width:400px;text-align:center;'>Disconnected (Verify Username and Password)</div>";
        $configarray[""] = array( "Description" => $state );
    }

    //Save information about module versions in the environment
    if ($response["CODE"] == 200) {
        //workarround to call that only 1 time.
        static $included = false;

        if (!$included) {
            $included = true;
            $date = new DateTime("now", new DateTimeZone('UTC'));
            $hostname = $_SERVER["HTTP_HOST"];
            $values = array("whmcs" => $params["whmcsVersion"],
                            "updated_date" => $date->format('Y-m-d H:i:s')." (UTC)",
                            "ispapiwhmcs" => $version,
            );

            //check ispapi modules version
            $modules = array("ispapidomaincheck", "ispapibackorder", "ispapidpi");
            foreach ($modules as $module) {
                $path = implode(DIRECTORY_SEPARATOR, array(ROOTDIR,"modules","addons",$module, "$module.php"));
                if (file_exists($path)) {
                    require_once $path;
                    $values[$module] = $module_version;
                }
            }

            //check ispapissl module version
            $modules = array("ispapissl");
            foreach ($modules as $module) {
                $path = implode(DIRECTORY_SEPARATOR, array(ROOTDIR,"modules","servers",$module, "$module.php"));
                if (file_exists($path)) {
                    require_once $path;
                    $values[$module] = $module_version;
                }
            }

            $command = array(
                    "COMMAND" => "SetEnvironment",
            );
            $i=0;
            foreach ($values as $key => $value) {
                $command["ENVIRONMENTKEY$i"] = "middleware/whmcs/".$hostname;
                $command["ENVIRONMENTNAME$i"] = $key;
                $command["ENVIRONMENTVALUE$i"] = $value;
                $i++;
            }
            $response = ispapi_call($command, ispapi_config($params));
        }
    }
    return $configarray;
}

/**
 * Check if a domain is PREMIUM (required in combination with ISPAPI DomainCheck Addon)
 * Will be deprecated with the new Lookup Feature which will support Premium Domains
 *
 * @param array $params common module parameters
 *
 * @return array an array with a template name
 */
function ispapi_ClientArea($params)
{
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    global $smarty;

    $domain = $params["sld"].".".$params["tld"];
    $premium = false;

    $result = mysql_query("select g.name from tblproductgroups g, tblproducts p, tblhosting h where p.id = h.packageid and p.gid = g.id and h.domain = '".$domain."'");
    $data = mysql_fetch_array($result);
    if (!empty($data) && $data["name"]=="PREMIUM DOMAIN") {
        $premium = true;
    }

    if ($premium) {
        $command = array(
                "COMMAND" => "StatusDomain",
                "DOMAIN" => $domain
        );
        $response = ispapi_call($command, ispapi_config($params));

        if ($response["CODE"] == 200) {
            $smarty->assign("statusdomain", $response["PROPERTY"]);
        }

        return array(
                'templatefile' => 'clientarea_premium'
        );
    }
}

/**
 * Provide custom buttons (whoisprivacy, DNSSEC Management) for domains and change of registrant button for certain domain names on client area
 *
 * @param array $params common module parameters
 *
 * @return array $buttonarray an array custum buttons
 */
function ispapi_ClientAreaCustomButtonArray($params)
{
    $buttonarray = array();

    if (isset($params["domainid"])) {
        $domainid = $params["domainid"];
    } elseif (!isset($_REQUEST["id"])) {
        $params = $GLOBALS["params"];
        $domainid = $params["domainid"];
    } else {
        $domainid = $_REQUEST["id"];
    }
    $result = select_query('tbldomains', 'idprotection,domain', array ('id' => $domainid));
    $data = mysql_fetch_array($result);

    if ($data && ($data["idprotection"])) {
        $buttonarray["WHOIS Privacy"] = "whoisprivacy";
    }

    if ($data && (preg_match('/[.]ca$/i', $data["domain"]))) {
        $buttonarray[".CA Registrant WHOIS Privacy"] = "whoisprivacy_ca";
    }

    if ($data && (preg_match('/[.]ca$/i', $data["domain"]))) {
        $buttonarray[".CA Change of Registrant"] = "registrantmodification_ca";
    }

    if ($data && (preg_match('/[.]it$/i', $data["domain"]))) {
        $buttonarray[".IT Change of Registrant"] = "registrantmodification_it";
    }
    if ($data && (preg_match('/[.]ch$/i', $data["domain"]))) {
        $buttonarray[".CH Change of Registrant"] = "registrantmodification_tld";
    }

    if ($data && (preg_match('/[.]li$/i', $data["domain"]))) {
        $buttonarray[".LI Change of Registrant"] = "registrantmodification_tld";
    }

    if ($data && (preg_match('/[.]se$/i', $data["domain"]))) {
        $buttonarray[".SE Change of Registrant"] = "registrantmodification_tld";
    }

    if ($data && (preg_match('/[.]sg$/i', $data["domain"]))) {
        $buttonarray[".SG Change of Registrant"] = "registrantmodification_tld";
    }

    if ($params["DNSSEC"] == "on") {
        $buttonarray["DNSSEC Management"] = "dnssec";
    }

    return $buttonarray;
}

/**
 * Handle the DNSSEC management page of a domain
 *
 * @param array $params common module parameters
 *
 * @return array an array with a template name
 */
function ispapi_dnssec($params)
{
    $origparams = $params;

    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $error = false;
    $successful = false;
    $domain = $params["sld"].".".$params["tld"];

    if (isset($_POST["submit"])) {
        $command = array(
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain,
            "SECDNS-MAXSIGLIFE" => $_POST["MAXSIGLIFE"],
            //"SECDNS-URGENT" => $_POST["URGENT"]
        );

        //add DS records
        $command["SECDNS-DS"] = array();
        if (isset($_POST["SECDNS-DS"])) {
            foreach ($_POST["SECDNS-DS"] as $dnssecrecord) {
                $everything_empty = true;
                foreach ($dnssecrecord as $attribute) {
                    if (!empty($attribute)) {
                        $everything_empty = false;
                    }
                }
                if (!$everything_empty) {
                    array_push($command["SECDNS-DS"], implode(" ", $dnssecrecord));
                }
            }
        }


        //remove DS records - bugfix
        if (empty($command["SECDNS-DS"])) {
            unset($command["SECDNS-DS"]);
            $secdnsds = array();
            $command2 = array(
                    "COMMAND" => "StatusDomain",
                    "DOMAIN" => $domain
            );
            $response = ispapi_call($command2, ispapi_config($params));
            if ($response["CODE"] == 200) {
                    $secdnsds = (isset($response["PROPERTY"]["SECDNS-DS"])) ? $response["PROPERTY"]["SECDNS-DS"] : array();
            }
            $command["DELSECDNS-DS"] = array();
            foreach ($secdnsds as $item) {
                array_push($command["DELSECDNS-DS"], $item);
            }
        }

        //add KEY records
        $command["SECDNS-KEY"] = array();
        if (isset($_POST["SECDNS-KEY"])) {
            foreach ($_POST["SECDNS-KEY"] as $dnssecrecord) {
                $everything_empty = true;
                foreach ($dnssecrecord as $attribute) {
                    if (!empty($attribute)) {
                        $everything_empty = false;
                    }
                }
                if (!$everything_empty) {
                    array_push($command["SECDNS-KEY"], implode(" ", $dnssecrecord));
                }
            }
        }
        $response = ispapi_call($command, ispapi_config($params));
        if ($response["CODE"] == 200) {
            $successful = $response["DESCRIPTION"];
        } else {
            $error = $response["DESCRIPTION"];
        }
    }

    $secdnsds = array();
    $secdnskey = array();
    $maxsiglife = "";
    $command = array(
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain
    );
    $response = ispapi_call($command, ispapi_config($params));

    if ($response["CODE"] == 200) {
            $maxsiglife = (isset($response["PROPERTY"]["SECDNS-MAXSIGLIFE"])) ? $response["PROPERTY"]["SECDNS-MAXSIGLIFE"][0] : "";
            $secdnsds = (isset($response["PROPERTY"]["SECDNS-DS"])) ? $response["PROPERTY"]["SECDNS-DS"] : array();
            $secdnskey = (isset($response["PROPERTY"]["SECDNS-KEY"])) ? $response["PROPERTY"]["SECDNS-KEY"] : array();
            //delete empty KEY records
            $secdnskeynew = array();
        foreach ($secdnskey as $k) {
            if (!empty($k)) {
                $secdnskeynew[] = $k;
            }
        }
            $secdnskey = $secdnskeynew;
    } else {
        $error = $response["DESCRIPTION"];
    }

    //split in different fields
    $secdnsds_newformat = array();
    foreach ($secdnsds as $ds) {
        list($keytag, $alg, $digesttype, $digest) = preg_split('/\s+/', $ds);
        array_push($secdnsds_newformat, array("keytag" => $keytag, "alg" => $alg, "digesttype" => $digesttype, "digest" => $digest));
    }

    $secdnskey_newformat = array();
    foreach ($secdnskey as $key) {
        list($flags, $protocol, $alg, $pubkey) = preg_split('/\s+/', $key);
        array_push($secdnskey_newformat, array("flags" => $flags, "protocol" => $protocol, "alg" => $alg, "pubkey" => $pubkey));
    }

    return array(
            'templatefile' => "dnssec",
            'vars' => array('error' => $error, 'successful' => $successful, 'secdnsds' => $secdnsds_newformat, 'secdnskey' => $secdnskey_newformat, 'maxsiglife' => $maxsiglife )
    );
}

/**
 * Return a special page for the registrant modification of a .IT domain
 *
 * @param array $params common module parameters
 *
 * @return array an array with a template name and some variables
 */
function ispapi_registrantmodification_it($params)
{
    global $additionaldomainfields;

    $origparams = $params;
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $error = false;
    $successful = false;
    $domain = $params["sld"].".".$params["tld"];
    $values = array();

    $command = array(
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain
    );
    $response = ispapi_call($command, ispapi_config($params));

    if ($response["CODE"] == 200) {
        $values["Registrant"] = ispapi_get_contact_info($response["PROPERTY"]["OWNERCONTACT"][0], $params);
    }

    //handle additionaldomainfields
    //------------------------------------------------------------------------------
    ispapi_include_additionaladditionalfields();

    $myadditionalfields = array();
    if (is_array($additionaldomainfields) && isset($additionaldomainfields[".".$params["tld"]])) {
        $myadditionalfields = $additionaldomainfields[".".$params["tld"]];
    }

    foreach ($myadditionalfields as $field_index => $field) {
        if (!is_array($field["Ispapi-Replacements"])) {
            $field["Ispapi-Replacements"] = array();
        }
        if (isset($field["Ispapi-Options"]) && isset($field["Options"])) {
            $options = explode(",", $field["Options"]);
            foreach (explode(",", $field["Ispapi-Options"]) as $index => $new_option) {
                $option = $options[$index];
                if (!isset($field["Ispapi-Replacements"][$option])) {
                    $field["Ispapi-Replacements"][$option] = $new_option;
                }
            }
        }
        $myadditionalfields[$field_index] = $field;
    }

    //------------------------------------------------------------------------------

    if (isset($_POST["submit"])) {
        if (empty($_POST["additionalfields"]["Section 3 Agreement"]) || empty($_POST["additionalfields"]["Section 5 Agreement"]) || empty($_POST["additionalfields"]["Section 6 Agreement"]) || empty($_POST["additionalfields"]["Section 7 Agreement"])) {
            $error = "You have to accept the agreement section 3, 5, 6 and 7.";
        } else {
            $newvalues["Registrant"] = $_POST["contactdetails"]["Registrant"];
            $values = $newvalues;

            $command = array(
                    "COMMAND" => "TradeDomain",
                    "DOMAIN" => $domain
            );
            $map = array(
                    "OWNERCONTACT0" => "Registrant",
                    "ADMINCONTACT0" => "Registrant",
            );

            foreach ($map as $ctype => $ptype) {
                if (isset($_POST["contactdetails"][$ptype])) {
                    $p = $_POST["contactdetails"][$ptype];
                    $command[$ctype] = array(
                            "FIRSTNAME" => html_entity_decode($p["First Name"], ENT_QUOTES),
                            "LASTNAME" => html_entity_decode($p["Last Name"], ENT_QUOTES),
                            "ORGANIZATION" => html_entity_decode($p["Company Name"], ENT_QUOTES),
                            "STREET" => html_entity_decode($p["Address"], ENT_QUOTES),
                            "CITY" => html_entity_decode($p["City"], ENT_QUOTES),
                            "STATE" => html_entity_decode($p["State"], ENT_QUOTES),
                            "ZIP" => html_entity_decode($p["Postcode"], ENT_QUOTES),
                            "COUNTRY" => html_entity_decode($p["Country"], ENT_QUOTES),
                            "PHONE" => html_entity_decode($p["Phone"], ENT_QUOTES),
                            "FAX" => html_entity_decode($p["Fax"], ENT_QUOTES),
                            "EMAIL" => html_entity_decode($p["Email"], ENT_QUOTES),
                    );
                    if (strlen($p["Address 2"])) {
                        $command[$ctype]["STREET"] .= " , ".html_entity_decode($p["Address 2"], ENT_QUOTES);
                    }
                }
            }

            if (isset($params["additionalfields"]["Local Presence"])) {
                if (!empty($_POST["additionalfields"]["Local Presence"])) {
                    $params["additionalfields"]["Local Presence"] = "1";
                } else {
                    unset($params["additionalfields"]["Local Presence"]);
                }
            }

            $params["additionalfields"]["PIN"] = $_POST["additionalfields"]["PIN"];
            $params["additionalfields"]["Section 3 Agreement"] = "1";
            $params["additionalfields"]["Section 5 Agreement"] = "1";
            $params["additionalfields"]["Section 6 Agreement"] = "1";
            $params["additionalfields"]["Section 7 Agreement"] = "1";
            ispapi_use_additionalfields($params, $command);
            $response = ispapi_call($command, ispapi_config($origparams));

            if ($response["CODE"] == 200) {
                $successful = $response["DESCRIPTION"];
            } else {
                $error = $response["DESCRIPTION"];
            }
        }
    }

    return array(
            'templatefile' => "registrantmodification_it",
            'vars' => array('error' => $error, 'successful' => $successful, 'values' => $values, 'additionalfields' => $myadditionalfields),
    );
}

/**
 * Return a page for the registrant modification of a domain name
 *
 * @param array $params common module parameters
 *
 * @return array an array with a template name and some variables
 */
function ispapi_registrantmodification_tld($params)
{
    global $additionaldomainfields;

    $origparams = $params;
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $error = false;
    $successful = false;
    $domain = $params["sld"].".".$params["tld"];

    $values = array();

    $command = array(
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain
    );
    $response = ispapi_call($command, ispapi_config($params));

    if ($response["CODE"] == 200) {
        $values["Registrant"] = ispapi_get_contact_info($response["PROPERTY"]["OWNERCONTACT"][0], $params);
    }

    if (isset($_POST["submit"])) {
            $newvalues["Registrant"] = $_POST["contactdetails"]["Registrant"];
            $values = $newvalues;

            $command = array(
                    "COMMAND" => "TradeDomain",
                    "DOMAIN" => $domain
            );
            $map = array(
                    "OWNERCONTACT0" => "Registrant",
                    "ADMINCONTACT0" => "Registrant",
            );

        foreach ($map as $ctype => $ptype) {
            if (isset($_POST["contactdetails"][$ptype])) {
                $p = $_POST["contactdetails"][$ptype];
                $command[$ctype] = array(
                        "FIRSTNAME" => html_entity_decode($p["First Name"], ENT_QUOTES),
                        "LASTNAME" => html_entity_decode($p["Last Name"], ENT_QUOTES),
                        "ORGANIZATION" => html_entity_decode($p["Company Name"], ENT_QUOTES),
                        "STREET" => html_entity_decode($p["Address"], ENT_QUOTES),
                        "CITY" => html_entity_decode($p["City"], ENT_QUOTES),
                        "STATE" => html_entity_decode($p["State"], ENT_QUOTES),
                        "ZIP" => html_entity_decode($p["Postcode"], ENT_QUOTES),
                        "COUNTRY" => html_entity_decode($p["Country"], ENT_QUOTES),
                        "PHONE" => html_entity_decode($p["Phone"], ENT_QUOTES),
                        "FAX" => html_entity_decode($p["Fax"], ENT_QUOTES),
                        "EMAIL" => html_entity_decode($p["Email"], ENT_QUOTES),
                );
                if (strlen($p["Address 2"])) {
                    $command[$ctype]["STREET"] .= " , ".html_entity_decode($p["Address 2"], ENT_QUOTES);
                }
            }
        }

        if (preg_match('/[.]se$/i', $domain)) {
            //check if the checkbox has been checked.
            if (!$_POST['se-checkbox'] == "on") {
                $error = "Please confirm that you will send the form back to complete the process";
            }
        }
        if (!$error) {
            ispapi_use_additionalfields($params, $command);
            $response = ispapi_call($command, ispapi_config($origparams));

            if ($response["CODE"] == 200) {
                $successful = $response["DESCRIPTION"];
            } else {
                $error = $response["DESCRIPTION"];
            }
        }
    }

    return array(
            'templatefile' => "registrantmodification_tld",
            'vars' => array('error' => $error, 'successful' => $successful, 'values' => $values, 'additionalfields' => $myadditionalfields),
    );
}

/**
 * Return a special page for the registrant modification of a .CA domain name
 *
 * @param array $params common module parameters
 *
 * @return array an array with a template name and some variables
 */
function ispapi_registrantmodification_ca($params)
{
    global $additionaldomainfields;

    $origparams = $params;
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $error = false;
    $successful = false;
    $domain = $params["sld"].".".$params["tld"];
    $values = array();


    //handle additionaldomainfields
    //------------------------------------------------------------------------------
    ispapi_include_additionaladditionalfields();

    $myadditionalfields = array();
    if (is_array($additionaldomainfields) && isset($additionaldomainfields[".".$params["tld"]])) {
        $myadditionalfields = $additionaldomainfields[".".$params["tld"]];
    }

    foreach ($myadditionalfields as $field_index => $field) {
        if (!is_array($field["Ispapi-Replacements"])) {
            $field["Ispapi-Replacements"] = array();
        }
        if (isset($field["Ispapi-Options"]) && isset($field["Options"])) {
            $options = explode(",", $field["Options"]);
            foreach (explode(",", $field["Ispapi-Options"]) as $index => $new_option) {
                $option = $options[$index];
                if (!isset($field["Ispapi-Replacements"][$option])) {
                    $field["Ispapi-Replacements"][$option] = $new_option;
                }
            }
        }
        $myadditionalfields[$field_index] = $field;
    }

    //delete "Contact Language" and "Trademark Number"
    $i = 0;
    foreach ($myadditionalfields as $item) {
        if (in_array($item["Name"], array("Contact Language", "Trademark Number"))) {
            unset($myadditionalfields[$i]);
        }
        $i++;
    }
    //------------------------------------------------------------------------------


    $command = array(
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain
    );
    $response = ispapi_call($command, ispapi_config($params));

    if ($response["CODE"] == 200) {
        $values["Registrant"] = ispapi_get_contact_info($response["PROPERTY"]["OWNERCONTACT"][0], $params);

        foreach ($myadditionalfields as $item) {
            if ($item["Ispapi-Name"] == "X-CA-LEGALTYPE") {
                $ispapi_options = explode(",", $item["Ispapi-Options"]);
                $options = explode(",", $item["Options"]);
                $index = array_search($response["PROPERTY"]["X-CA-LEGALTYPE"][0], $ispapi_options);
                $values["Legal Type"] = $options[$index];
            }
        }
    }

    if (isset($_POST["submit"])) {
        if (isset($_POST["additionalfields"]["CIRA Agreement"])) {
            //save
            //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $command = array(
                    "COMMAND" => "ModifyDomain",
                    "DOMAIN" => $domain
            );

            $map = array(
                    "OWNERCONTACT0" => "Registrant",
            );

            foreach ($map as $ctype => $ptype) {
                if (isset($_POST["contactdetails"][$ptype])) {
                    $p = $_POST["contactdetails"][$ptype];
                    $command[$ctype] = array(
                            "FIRSTNAME" => html_entity_decode($p["First Name"], ENT_QUOTES),
                            "LASTNAME" => html_entity_decode($p["Last Name"], ENT_QUOTES),
                            "ORGANIZATION" => html_entity_decode($p["Company Name"], ENT_QUOTES),
                            "STREET" => html_entity_decode($p["Address"], ENT_QUOTES),
                            "CITY" => html_entity_decode($p["City"], ENT_QUOTES),
                            "STATE" => html_entity_decode($p["State"], ENT_QUOTES),
                            "ZIP" => html_entity_decode($p["Postcode"], ENT_QUOTES),
                            "COUNTRY" => html_entity_decode($p["Country"], ENT_QUOTES),
                            "PHONE" => html_entity_decode($p["Phone"], ENT_QUOTES),
                            "FAX" => html_entity_decode($p["Fax"], ENT_QUOTES),
                            "EMAIL" => html_entity_decode($p["Email"], ENT_QUOTES),
                    );
                    if (strlen($p["Address 2"])) {
                        $command[$ctype]["STREET"] .= " , ".html_entity_decode($p["Address 2"], ENT_QUOTES);
                    }
                }
            }

            $params["additionalfields"]["Legal Type"] = $_POST["additionalfields"]["Legal Type"];
            $params["additionalfields"]["CIRA Agreement"] = $_POST["additionalfields"]["CIRA Agreement"];
            $params["additionalfields"]["WHOIS Opt-out"] = $_POST["additionalfields"]["WHOIS Opt-out"];

            ispapi_use_additionalfields($params, $command);

            $response = ispapi_call($command, ispapi_config($origparams));

            if ($response["CODE"] == 200) {
                $successful = $response["DESCRIPTION"];
            } else {
                $error = $response["DESCRIPTION"];
            }
            //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        } else {
            $error = "You have to accept the CIRA Agreement.";
        }
    }

    // replace values with post values
    if (isset($_POST["submit"])) {
        $newvalues["Registrant"] = $_POST["contactdetails"]["Registrant"];
        $newvalues["Legal Type"] = $_POST["additionalfields"]["Legal Type"];
        $newvalues["CIRA Agreement"] = $_POST["additionalfields"]["CIRA Agreement"];
        $newvalues["WHOIS Opt-out"] = $_POST["additionalfields"]["WHOIS Opt-out"];
        $values = $newvalues;
    }

    return array(
            'templatefile' => "registrantmodification_ca",
            'vars' => array('error' => $error, 'successful' => $successful, 'values' => $values, 'additionalfields' => $myadditionalfields),
    );
}


/**
 * Handle the ID Protection (whoisprivacy) of a domain name
 *
 * @param array $params common module parameters
 *
 * @return array an array with a template name and some variables
 */
function ispapi_whoisprivacy($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $error = false;
    $domain = $params["sld"].".".$params["tld"];

    if (isset($_REQUEST["idprotection"])) {
        $command = array(
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain,
            "X-ACCEPT-WHOISTRUSTEE-TAC" => ($_REQUEST["idprotection"] == 'enable')? '1' : '0'
        );
        $response = ispapi_call($command, ispapi_config($params));
        if ($response["CODE"] == 200) {
            return false;
        } else {
            $error = $response["DESCRIPTION"];
        }
    }

    $command = array(
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain
    );
    $protected = 0;
    $response = ispapi_call($command, ispapi_config($params));
    if ($response["CODE"] == 200) {
        if (isset($response["PROPERTY"]["X-ACCEPT-WHOISTRUSTEE-TAC"])) {
            if ($response["PROPERTY"]["X-ACCEPT-WHOISTRUSTEE-TAC"][0]) {
                $protected = 1;
            }
        }
    } elseif (!$error) {
        $error = $response["DESCRIPTION"];
    }

    return array(
        'templatefile' => "whoisprivacy",
        'vars' => array('error' => $error, 'protected' => $protected),
    );
}

/**
 * Handle the ID Protection (whoisprivacy) of a .CA domain name
 *
 * @param array $params common module parameters
 *
 * @return array an array with a template name and some variables
 */
function ispapi_whoisprivacy_ca($params)
{
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $error = false;
    $domain = $params["sld"].".".$params["tld"];

    $protected = 1;
    $protectable = 0;
    $legaltype = "";

    $command = array(
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain
    );
    $response = ispapi_call($command, ispapi_config($params));

    if ($response["CODE"] == 200) {
        $registrant = $response["PROPERTY"]["OWNERCONTACT"][0];
        $command2 = array(
            "COMMAND" => "StatusContact",
            "CONTACT" => $registrant
        );
        $response2 = ispapi_call($command2, ispapi_config($params));
        if ($response2["CODE"] == 200) {
            if (isset($response2["PROPERTY"]["X-CA-DISCLOSE"]) && ($response2["PROPERTY"]["X-CA-DISCLOSE"][0])) {
                $protected = 0;
            }
            if (isset($response2["PROPERTY"]["X-CA-LEGALTYPE"])) {
                $legaltype = $response2["PROPERTY"]["X-CA-LEGALTYPE"][0];
            }
        } elseif (!$error) {
            $error = $response2["DESCRIPTION"];
        }
        if (isset($response["PROPERTY"]["X-CA-LEGALTYPE"])) {
            $legaltype = $response["PROPERTY"]["X-CA-LEGALTYPE"][0];
        }
    } elseif (!$error) {
        $error = $response["DESCRIPTION"];
    }

    if (preg_match('/^(CCT|RES|ABO|LGR)$/i', $legaltype)) {
        $protectable = 1;
    }

    if (isset($_REQUEST["idprotection"])) {
        $command3 = array(
            "COMMAND" => "ModifyContact",
            "CONTACT" => $registrant,
            "X-CA-DISCLOSE" => ($_REQUEST["idprotection"] == 'enable')? '0' : '1'
        );
        $response3 = ispapi_call($command3, ispapi_config($params));
        if ($response3["CODE"] == 200) {
            // force immediate contact sync
            $command4 = array(
                "COMMAND" => "ModifyDomain",
                "DOMAIN" => $domain,
                "OWNERCONTACT0" => $registrant
            );
            $response4 = ispapi_call($command4, ispapi_config($params));

            return false;
        } else {
            $error = $response3["DESCRIPTION"];
        }
    }

    return array(
        'templatefile' => "whoisprivacy_ca",
        'vars' => array('error' => $error, 'protected' => $protected, 'protectable' => $protectable, 'legaltype' => $legaltype ),
    );
}

/**
 * Get Transferlock settings of a domain name
 *
 * @param array $params common module parameters
 *
 * @return array $values - an array with transferlock setting information
 */
function ispapi_GetRegistrarLock($params)
{
    ;
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $domain = $params["sld"].".".$params["tld"];

    $command = array(
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain
    );

    $response = ispapi_call($command, ispapi_config($params));

    if ($response["CODE"] == 200) {
        if (isset($response["PROPERTY"]["TRANSFERLOCK"])) {
            if ($response["PROPERTY"]["TRANSFERLOCK"][0]) {
                return "locked";
            }
            return "unlocked";
        }
        return "";
    } else {
        $values["error"] = $response["DESCRIPTION"];
    }

    return $values;
}

/**
 * Modify and save Transferlock settings of a domain name
 *
 * @param array $params common module parameters
 *
 * @return array $values - returns an array with command response description
 */
function ispapi_SaveRegistrarLock($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $domain = $params["sld"].".".$params["tld"];

    $commandQueryDomainList = array(
        "COMMAND" => "QueryDomainList",
        "DOMAIN" => $domain,
        "WIDE" => 1
    );
    $responseQueryDomainList = ispapi_call($commandQueryDomainList, ispapi_config($params));
    if ($responseQueryDomainList['PROPERTY']['DOMAINTRANSFERLOCK'][0] == "") {
        $values["error"] = "Not supported by this TLD";
    } else {
        $command = array(
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain,
            "TRANSFERLOCK" => ($params["lockenabled"] == "locked")? "1" : "0"
        );
        $response = ispapi_call($command, ispapi_config($params));
        if ($response["CODE"] != 200) {
            $values["error"] = $response["DESCRIPTION"];
        }
    }
    
    return $values;
}

/**
 * Return the authcode of a domain name
 *
 * @param array $params common module parameters
 *
 * @return array $values an array with the authcode
 */
function ispapi_GetEPPCode($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $domain = $params["sld"].".".$params["tld"];

    if ($params["tld"] == "de") {
        $command = array(
            "COMMAND" => "DENIC_CreateAuthInfo1",
            "DOMAIN" => $domain
        );
        $response = ispapi_call($command, ispapi_config($params));
    }

    if ($params["tld"] == "eu") {
        $command = array(
            "COMMAND" => "RequestDomainAuthInfo",
            "DOMAIN" => $domain
        );
        $response = ispapi_call($command, ispapi_config($params));
    } else {
        $command = array(
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain
        );
        $response = ispapi_call($command, ispapi_config($params));
    }

    if ($response["CODE"] == 200) {
        if (strlen($response["PROPERTY"]["AUTH"][0])) {
            $values["eppcode"] = htmlspecialchars($response["PROPERTY"]["AUTH"][0]);
        } else {
            $values["error"] = "No AuthInfo code assigned to this domain!";
        }
    } else {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $values;
}

/**
 * Return Nameservers of a domain name
 *
 * @param array $params common module parameters
 *
 * @return array $values an array with the Nameservers
 */
function ispapi_GetNameservers($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $domain = $params["sld"].".".$params["tld"];

    $command = array(
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain
    );
    $response = ispapi_call($command, ispapi_config($params));
    if ($response["CODE"] == 200) {
        $values["ns1"] = htmlspecialchars($response["PROPERTY"]["NAMESERVER"][0]);
        $values["ns2"] = htmlspecialchars($response["PROPERTY"]["NAMESERVER"][1]);
        $values["ns3"] = htmlspecialchars($response["PROPERTY"]["NAMESERVER"][2]);
        $values["ns4"] = htmlspecialchars($response["PROPERTY"]["NAMESERVER"][3]);
        $values["ns5"] = htmlspecialchars($response["PROPERTY"]["NAMESERVER"][4]);
    } else {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $values;
}

/**
 * Modify and save Nameservers of a domain name
 *
 * @param array $params common module parameters
 *
 * @return array $values - returns an array with command response description
 */
function ispapi_SaveNameservers($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $domain = $params["sld"].".".$params["tld"];

    $command = array(
        "COMMAND" => "ModifyDomain",
        "DOMAIN" => $domain,
        "NAMESERVER" => array($params["ns1"], $params["ns2"], $params["ns3"], $params["ns4"], $params["ns5"]),
        "INTERNALDNS" => 1
    );
    $response = ispapi_call($command, ispapi_config($params));
    if ($response["CODE"] != 200) {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $values;
}

/**
 * Get DNS Zone of a domain name
 *
 * @param array $params common module parameters
 *
 * @return array $hostrecords - an array with hostrecord of the domain name
 */
function ispapi_GetDNS($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $dnszone = $params["sld"].".".$params["tld"].".";
    $domain = $params["sld"].".".$params["tld"];

    //convert the dnszone in idn
    $command = array(
            "COMMAND" => "ConvertIDN",
            "DOMAIN" => $domain
    );
    $response = ispapi_call($command, ispapi_config($params));
    $dnszone_idn = $response["PROPERTY"]["ACE"][0].".";

    $command = array(
            "COMMAND" => "QueryDNSZoneRRList",
            "DNSZONE" => $dnszone,
            "EXTENDED" => 1
    );
    $response = ispapi_call($command, ispapi_config($params));
    $hostrecords = array();
    if ($response["CODE"] == 200) {
        $i = 0;
        foreach ($response["PROPERTY"]["RR"] as $rr) {
            $fields = explode(" ", $rr);
            $domain = array_shift($fields);
            $ttl = array_shift($fields);
            $class = array_shift($fields);
            $rrtype = array_shift($fields);

            if ($domain == $dnszone) {
                $domain = "@";
            }
            $domain = str_replace(".".$dnszone_idn, "", $domain);

            if ($rrtype == "A") {
                $hostrecords[$i] = array( "hostname" => $domain, "type" => $rrtype, "address" => $fields[0], );
                if (preg_match('/^mxe-host-for-ip-(\d+)-(\d+)-(\d+)-(\d+)$/i', $domain, $m)) {
                    unset($hostrecords[$i]);
                    $i--;
                }
                $i++;
            }

            if ($rrtype == "AAAA") {
                $hostrecords[$i] = array( "hostname" => $domain, "type" => "AAAA", "address" => $fields[0], );
                $i++;
            }

            if ($rrtype == "TXT") {
                $hostrecords[$i] = array( "hostname" => $domain, "type" => $rrtype, "address" => (implode(" ", $fields)), );
                $i++;
            }

            if ($rrtype == "SRV") {
                $priority = array_shift($fields);
                $hostrecords[$i] = array( "hostname" => $domain, "type" => $rrtype, "address" => implode(" ", $fields), "priority" => $priority );
                $i++;
            }

            if ($rrtype == "CNAME") {
                $hostrecords[$i] = array( "hostname" => $domain, "type" => $rrtype, "address" => $fields[0], );
                $i++;
            }

            if ($rrtype == "X-HTTP") {
                if (preg_match('/^\//', $fields[0])) {
                    $domain .= array_shift($fields);
                    /*while(substr($domain, -1)=="/"){
                        $domain = substr_replace($domain, "", -1);
                    }*/
                }

                $url_type = array_shift($fields);
                if ($url_type == "REDIRECT") {
                    $url_type = "URL";
                }

                $hostrecords[$i] = array( "hostname" => $domain, "type" => $url_type, "address" => implode(" ", $fields), );
                $i++;
            }
        }

        //only for MX fields, they are note displayed in the "EXTENDED" version
        $command = array(
                "COMMAND" => "QueryDNSZoneRRList",
                "DNSZONE" => $dnszone,
                "SHORT" => 1,
        );
        $response = ispapi_call($command, ispapi_config($params));
        if ($response["CODE"] == 200) {
            foreach ($response["PROPERTY"]["RR"] as $rr) {
                $fields = explode(" ", $rr);
                $domain = array_shift($fields);
                $ttl = array_shift($fields);
                $class = array_shift($fields);
                $rrtype = array_shift($fields);

                if ($rrtype == "MX") {
                    if (preg_match('/^mxe-host-for-ip-(\d+)-(\d+)-(\d+)-(\d+)($|\.)/i', $fields[1], $m)) {
                        $hostrecords[$i] = array( "hostname" => $domain, "type" => "MXE", "address" => $m[1].".".$m[2].".".$m[3].".".$m[4], );
                    } else {
                        $hostrecords[$i] = array( "hostname" => $domain, "type" => $rrtype, "address" => $fields[1], "priority" => $fields[0] );
                    }
                    $i++;
                }
            }
        }
    } else {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $hostrecords;
}

/**
 * Modify and save DNS Zone of a domain name
 *
 * @param array $params common module parameters
 *
 * @return array $hostrecords - an array with hostrecord of the domain name
 */
function ispapi_SaveDNS($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $dnszone = $params["sld"].".".$params["tld"].".";
    $domain = $params["sld"].".".$params["tld"];

    $command = array(
        "COMMAND" => "UpdateDNSZone",
        "DNSZONE" => $dnszone,
        "RESOLVETTLCONFLICTS" => 1,
        "INCSERIAL" => 1,
        "EXTENDED" => 1,
        "DELRR" => array("% A", "% AAAA", "% CNAME", "% TXT", "% MX", "% X-HTTP", "% X-SMTP", "% SRV"),
        "ADDRR" => array(),
    );

    $mxe_hosts = array();
    foreach ($params["dnsrecords"] as $key => $values) {
        $hostname = $values["hostname"];
        $type = strtoupper($values["type"]);
        $address = $values["address"];
        $priority = $values["priority"];

        if (strlen($hostname) && strlen($address)) {
            if ($type == "A") {
                $command["ADDRR"][] = "$hostname $type $address";
            }
            if ($type == "AAAA") {
                $command["ADDRR"][] = "$hostname $type $address";
            }
            if ($type == "CNAME") {
                $command["ADDRR"][] = "$hostname $type $address";
            }
            if ($type == "TXT") {
                $command["ADDRR"][] = "$hostname $type $address";
            }
            if ($type == "SRV") {
                if (empty($priority)) {
                    $priority=0;
                }
                array_push($command["DELRR"], "% SRV");
                $command["ADDRR"][] = "$hostname $type $priority $address";
            }
            if ($type == "MXE") {
                $mxpref = 100;
                if (preg_match('/^([0-9]+) (.*)$/', $address, $m)) {
                    $mxpref = $m[1];
                    $address = $m[2];
                }
                if (preg_match('/^([0-9]+)$/', $priority)) {
                    $mxpref = $priority;
                }

                if (preg_match('/^(\d+)\.(\d+)\.(\d+)\.(\d+)$/', $address, $m)) {
                    $mxe_host = "mxe-host-for-ip-$m[1]-$m[2]-$m[3]-$m[4]";
                    $ip = $m[1].".".$m[2].".".$m[3].".".$m[4];
                    $mxe_hosts[$ip] = $mxe_host;
                    $command["ADDRR"][] = "$hostname MX $mxpref $mxe_host";
                } else {
                    $address = "$mxpref $address";
                    $type = "MX";
                }
            }
            if ($type == "MX") {
                $mxpref = 100;
                if (preg_match('/^([0-9]+) (.*)$/', $address, $m)) {
                    $mxpref = $m[1];
                    $address = $m[2];
                }
                if (preg_match('/^([0-9]+)$/', $priority)) {
                    $mxpref = $priority;
                }

                $command["ADDRR"][] = "$hostname $type $mxpref $address";
            }
            if ($type == "FRAME") {
                $redirect = "FRAME";
                if (preg_match('/^([^\/]+)(.*)$/', $hostname, $m)) {
                    $hostname = $m[1];
                    $redirect = $m[2]." ".$redirect;
                }
                $command["ADDRR"][] = "$hostname X-HTTP $redirect $address";
            }
            if ($type == "URL") {
                $redirect = "REDIRECT";
                if (preg_match('/^([^\/]+)(.*)$/', $hostname, $m)) {
                    $hostname = $m[1];
                    $redirect = $m[2]." ".$redirect;
                }
                $command["ADDRR"][] = "$hostname X-HTTP $redirect $address";
            }
        }
    }
    foreach ($mxe_hosts as $address => $hostname) {
        $command["ADDRR"][] = "$hostname A $address";
    }

    //add X-SMTP to the list
    $command2 = array(
            "COMMAND" => "QueryDNSZoneRRList",
            "DNSZONE" => $dnszone,
            "EXTENDED" => 1
    );
    $response = ispapi_call($command2, ispapi_config($params));

    if ($response["CODE"] == 200) {
        foreach ($response["PROPERTY"]["RR"] as $rr) {
            $fields = explode(" ", $rr);
            $domain = array_shift($fields);
            $ttl = array_shift($fields);
            $class = array_shift($fields);
            $rrtype = array_shift($fields);

            if ($rrtype == "X-SMTP") {
                $command["ADDRR"][] = $rr;

                $item = preg_grep("/@ MX [0-9 ]* mx.ispapi.net./i", $command["ADDRR"]);
                if (!empty($item)) {
                    $index_arr = array_keys($item);
                    $index = $index_arr[0];
                    unset($command["ADDRR"][$index]);
                    $command["ADDRR"] = array_values($command["ADDRR"]);
                }
            }
        }
    }

    //send command to update DNS Zone
    $response = ispapi_call($command, ispapi_config($params));

    //if DNS Zone not existing, create one automatically
    if ($response["CODE"] == 545) {
        $creatednszone_command = array(
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain,
            "INTERNALDNS" => 1
        );
        $creatednszone = ispapi_call($creatednszone_command, ispapi_config($params));
        if ($creatednszone["CODE"] == 200) {
            //resend command to update DNS Zone
            $response = ispapi_call($command, ispapi_config($params));
        }
    }

    if ($response["CODE"] != 200) {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $values;
}

/**
 * Get Email forwarding of a domain name with its DNS zone
 *
 * @param array $params common module parameters
 *
 * @return array $result - returns an array with command response description
 */
function ispapi_GetEmailForwarding($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $dnszone = $params["sld"].".".$params["tld"].".";

    $command = array(
        "COMMAND" => "QueryDNSZoneRRList",
        "DNSZONE" => $dnszone,
        "SHORT" => 1,
        "EXTENDED" => 1
    );
    $response = ispapi_call($command, ispapi_config($params));

    $result = array();

    if ($response["CODE"] == 200) {
        foreach ($response["PROPERTY"]["RR"] as $rr) {
            $fields = explode(" ", $rr);
            $domain = array_shift($fields);
            $ttl = array_shift($fields);
            $class = array_shift($fields);
            $rrtype = array_shift($fields);

            if (($rrtype == "X-SMTP") && ($fields[1] == "MAILFORWARD")) {
                if (preg_match('/^(.*)\@$/', $fields[0], $m)) {
                    $address = $m[1];
                    if (!strlen($address)) {
                        $address = "*";
                    }
                }
                $result[] = array("prefix" => $address, "forwardto" => $fields[2]);
            }
        }
    } else {
        $values["error"] = $response["DESCRIPTION"];
    }

    return $result;
}

/**
 * Save Email forwarding of a domain name by updating its DNS zone
 *
 * @param array $params common module parameters
 *
 * @return array $values - returns an array with command response description
 */
function ispapi_SaveEmailForwarding($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    //Bug fix - Issue WHMCS
    //###########
    if (is_array($params["prefix"][0])) {
        $params["prefix"][0] = $params["prefix"][0][0];
    }
    if (is_array($params["forwardto"][0])) {
        $params["forwardto"][0] = $params["forwardto"][0][0];
    }
    //###########

    $username = $params["Username"];
    $password = $params["Password"];
    $testmode = $params["TestMode"];
    $tld = $params["tld"];
    $sld = $params["sld"];
    foreach ($params["prefix"] as $key => $value) {
        $forwardarray[$key]["prefix"] =  $params["prefix"][$key];
        $forwardarray[$key]["forwardto"] =  $params["forwardto"][$key];
    }

    $dnszone = $params["sld"].".".$params["tld"].".";

    $command = array(
        "COMMAND" => "UpdateDNSZone",
        "DNSZONE" => $dnszone,
        "RESOLVETTLCONFLICTS" => 1,
        "INCSERIAL" => 1,
        "EXTENDED" => 1,
        "DELRR" => array("@ X-SMTP"),
        "ADDRR" => array(),
    );

    foreach ($params["prefix"] as $key => $value) {
        $prefix = $params["prefix"][$key];
        $target = $params["forwardto"][$key];
        if (strlen($prefix) && strlen($target)) {
            $redirect = "MAILFORWARD";
            if ($prefix == "*") {
                $prefix = "";
            }
            $redirect = $prefix."@ ".$redirect;
            $command["ADDRR"][] = "@ X-SMTP $redirect $target";
        }
    }

    $response = ispapi_call($command, ispapi_config($params));

    if ($response["CODE"] != 200) {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $values;
}

/**
 * Contact data of a domain name
 *
 * @param array $params common module parameters
 *
 * @return array $values - an array with different contact values.
 */
function ispapi_GetContactDetails($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $domain = $params["sld"].".".$params["tld"];
    $values = array();
    $command = array(
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain
    );
    $response = ispapi_call($command, ispapi_config($params));

    if ($response["CODE"] == 200) {
        $values["Registrant"] = ispapi_get_contact_info($response["PROPERTY"]["OWNERCONTACT"][0], $params);
        $values["Admin"] = ispapi_get_contact_info($response["PROPERTY"]["ADMINCONTACT"][0], $params);
        $values["Technical"] = ispapi_get_contact_info($response["PROPERTY"]["TECHCONTACT"][0], $params);
        $values["Billing"] = ispapi_get_contact_info($response["PROPERTY"]["BILLINGCONTACT"][0], $params);
        if (preg_match('/[.]ca|it|ch|li|se|sg$/i', $domain)) {
            unset($values["Registrant"]["First Name"]);
            unset($values["Registrant"]["Last Name"]);
            unset($values["Registrant"]["Company Name"]);
        }
    }
    return $values;
}

/**
 * Modify and save contact data of a domain name
 *
 * @param array $params common module parameters
 *
 * @return array $values - an array with command response description
 */
function ispapi_SaveContactDetails($params)
{
    global $additionaldomainfields;

    $values = array();
    $origparams = $params;
    $params = ispapi_get_utf8_params($params);

    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $domain = $params["sld"].".".$params["tld"];

    $command = array(
        "COMMAND" => "ModifyDomain",
        "DOMAIN" => $domain
    );

    $map = array(
        "OWNERCONTACT0" => "Registrant",
        "ADMINCONTACT0" => "Admin",
        "TECHCONTACT0" => "Technical",
        "BILLINGCONTACT0" => "Billing",
    );

    //bug in WHMCS since 6.1, $params["original"] is completely stripped, we will take the $_POST array to have the unstipped version
    $unstrippedparams = $_POST;

    foreach ($map as $ctype => $ptype) {
        //when using "Use Existing Contact" function in WHMCS, the $_POST array is empty, so we have to use the $params version.
        //in this case the special characters will be replaced due to the default transliteration hook. (https://docs.whmcs.com/Custom_Transliteration)
        //workarround for customers will be to deactivate the transliteration hook.
        //once this issue has been fixed on WHMCS side we will release a new version which will support special characters in each cases.
        if (array_key_exists("First Name", $unstrippedparams["contactdetails"][$ptype])) {
            $p = $unstrippedparams["contactdetails"][$ptype];
        } else {
            $p = $params["contactdetails"][$ptype];
        }

        $command[$ctype] = array(
            "FIRSTNAME" => html_entity_decode($p["First Name"], ENT_QUOTES | ENT_XML1, 'UTF-8'),
            "LASTNAME" => html_entity_decode($p["Last Name"], ENT_QUOTES | ENT_XML1, 'UTF-8'),
            "ORGANIZATION" => html_entity_decode($p["Company Name"], ENT_QUOTES | ENT_XML1, 'UTF-8'),
            "STREET" => html_entity_decode($p["Address"], ENT_QUOTES | ENT_XML1, 'UTF-8'),
            "CITY" => html_entity_decode($p["City"], ENT_QUOTES | ENT_XML1, 'UTF-8'),
            "STATE" => html_entity_decode($p["State"], ENT_QUOTES | ENT_XML1, 'UTF-8'),
            "ZIP" => html_entity_decode($p["Postcode"], ENT_QUOTES | ENT_XML1, 'UTF-8'),
            "COUNTRY" => html_entity_decode($p["Country"], ENT_QUOTES | ENT_XML1, 'UTF-8'),
            "PHONE" => html_entity_decode($p["Phone"], ENT_QUOTES | ENT_XML1, 'UTF-8'),
            "FAX" => html_entity_decode($p["Fax"], ENT_QUOTES | ENT_XML1, 'UTF-8'),
            "EMAIL" => html_entity_decode($p["Email"], ENT_QUOTES | ENT_XML1, 'UTF-8'),
        );
        if (strlen($p["Address 2"])) {
            $command[$ctype]["STREET"] .= " , ".html_entity_decode($p["Address 2"], ENT_QUOTES | ENT_XML1, 'UTF-8');
        }
    }

    if (preg_match('/[.]it|ch|li|se|sg$/i', $domain)) {
        unset($command["OWNERCONTACT0"]["FIRSTNAME"]);
        unset($command["OWNERCONTACT0"]["LASTNAME"]);
        unset($command["OWNERCONTACT0"]["ORGANIZATION"]);

        $status_command = array(
                "COMMAND" => "StatusDomain",
                "DOMAIN" => $domain
        );
        $status_response = ispapi_call($status_command, ispapi_config($origparams));

        if ($status_response["CODE"] != 200) {
            $values["error"] = $status_response["DESCRIPTION"];
            return $values;
        }

        $registrant = ispapi_get_contact_info($status_response["PROPERTY"]["OWNERCONTACT"][0], $params);
        $command["OWNERCONTACT0"]["FIRSTNAME"] = $registrant["First Name"];
        $command["OWNERCONTACT0"]["LASTNAME"] = $registrant["Last Name"];
        $command["OWNERCONTACT0"]["ORGANIZATION"] = $registrant["Company Name"];
    }

    if (preg_match('/[.]ca$/i', $domain)) {
        $registrant_command = $command["OWNERCONTACT0"];

        $status_command = array(
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain
        );
        $status_response = ispapi_call($status_command, ispapi_config($origparams));

        if ($status_response["CODE"] != 200) {
            $values["error"] = $status_response["DESCRIPTION"];
            return $values;
        }

        $registrant_command["COMMAND"] = "ModifyContact";
        $registrant_command["CONTACT"] = $status_response["PROPERTY"]["OWNERCONTACT"][0];

        if (!preg_match('/^AUTO\-/i', $registrant_command["CONTACT"])) {
            unset($registrant_command["FIRSTNAME"]);
            unset($registrant_command["LASTNAME"]);
            unset($registrant_command["ORGANIZATION"]);
            $registrant_response = ispapi_call($registrant_command, ispapi_config($origparams));

            if ($registrant_response["CODE"] != 200) {
                $values["error"] = $registrant_response["DESCRIPTION"];
                return $values;
            }
            unset($command["OWNERCONTACT0"]);
        }

        ispapi_query_additionalfields($params);
        ispapi_use_additionalfields($params, $command);
        unset($command["OWNERCONTACT0X-CA-DISCLOSE"]);
        unset($command["X-CA-LEGALTYPE"]);
    }

    $response = ispapi_call($command, ispapi_config($origparams));

    if ($response["CODE"] != 200) {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $values;
}

/**
 * Add a new Private Nameserver (=GLUE RECORD)
 * A glue record is simply the association of a hostname (nameserver in our case) with an IP address at the registry
 *
 * @param array $params common module parameters
 *
 * @return array $values - an array with command response description
 */
function ispapi_RegisterNameserver($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $nameserver = $params["nameserver"];

    $command = array(
        "COMMAND" => "AddNameserver",
        "NAMESERVER" => $nameserver,
        "IPADDRESS0" => $params["ipaddress"],
    );
    $response = ispapi_call($command, ispapi_config($params));
    if ($response["CODE"] != 200) {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $values;
}

/**
 * Modify a Private Nameserver
 *
 * @param array $params common module parameters
 *
 * @return array $values - an array with command response description
 */
function ispapi_ModifyNameserver($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $nameserver = $params["nameserver"];

    $command = array(
        "COMMAND" => "ModifyNameserver",
        "NAMESERVER" => $nameserver,
        "DELIPADDRESS0" => $params["currentipaddress"],
        "ADDIPADDRESS0" => $params["newipaddress"],
    );
    $response = ispapi_call($command, ispapi_config($params));
    if ($response["CODE"] != 200) {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $values;
}

/**
 * Delete a Private Nameserver
 *
 * @param array $params common module parameters
 *
 * @return array $values - an array with command response description
 */
function ispapi_DeleteNameserver($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $nameserver = $params["nameserver"];

    $command = array(
        "COMMAND" => "DeleteNameserver",
        "NAMESERVER" => $nameserver,
    );
    $response = ispapi_call($command, ispapi_config($params));
    if ($response["CODE"] != 200) {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $values;
}

/**
 * Toggle the ID Protection of a domain name
 *
 * @param array $params common module parameters
 *
 * @return array
 */
function ispapi_IDProtectToggle($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $domain = $params["sld"].".".$params["tld"];

    $command = array(
        "COMMAND" => "ModifyDomain",
        "DOMAIN" => $domain,
        "X-ACCEPT-WHOISTRUSTEE-TAC" => ($params["protectenable"])? "1" : "0"
    );
    $response = ispapi_call($command, ispapi_config($params));
    if ($response["CODE"] != 200) {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $values;
}

/**
 * Register a domain name - Premium support
 *
 * @param array $params common module parameters
 *
 * @return array $values - an array with command response description
 */
function ispapi_RegisterDomain($params)
{
    global $additionaldomainfields;

    $values = array();
    $origparams = $params;

    $premiumDomainsEnabled = (bool) $params['premiumEnabled'];
    $premiumDomainsCost = $params['premiumCost'];

    $params = ispapi_get_utf8_params($params);

    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $domain = $params["sld"].".".$params["tld"];

    $registrant = array(
        "FIRSTNAME" => $params["firstname"],
        "LASTNAME" => $params["lastname"],
        "ORGANIZATION" => $params["companyname"],
        "STREET" => $params["address1"],
        "CITY" => $params["city"],
        "STATE" => $params["state"],
        "ZIP" => $params["postcode"],
        "COUNTRY" => $params["country"],
        "PHONE" => $params["phonenumber"],
        "EMAIL" => $params["email"]
    );
    if (strlen($params["address2"])) {
        $registrant["STREET"] .= " , ".$params["address2"];
    }

    $admin = array(
        "FIRSTNAME" => $params["adminfirstname"],
        "LASTNAME" => $params["adminlastname"],
        "ORGANIZATION" => $params["admincompanyname"],
        "STREET" => $params["adminaddress1"],
        "CITY" => $params["admincity"],
        "STATE" => $params["adminstate"],
        "ZIP" => $params["adminpostcode"],
        "COUNTRY" => $params["admincountry"],
        "PHONE" => $params["adminphonenumber"],
        "EMAIL" => $params["adminemail"]
    );
    if (strlen($params["adminaddress2"])) {
        $admin["STREET"] .= " , ".$params["adminaddress2"];
    }

    $command = array(
        "COMMAND" => "AddDomain",
        "DOMAIN" => $domain,
        "PERIOD" => $params["regperiod"],
        "NAMESERVER0" => $params["ns1"],
        "NAMESERVER1" => $params["ns2"],
        "NAMESERVER2" => $params["ns3"],
        "NAMESERVER3" => $params["ns4"],
        "OWNERCONTACT0" => $registrant,
        "ADMINCONTACT0" => $admin,
        "TECHCONTACT0" => $admin,
        "BILLINGCONTACT0" => $admin
    );

    if ($origparams["TRANSFERLOCK"]) {
        $command["TRANSFERLOCK"] = 1;
    }

    if ($params["dnsmanagement"]) {
        $command["INTERNALDNS"] = 1;
    }

    if ($params["idprotection"]) {
        $command["X-ACCEPT-WHOISTRUSTEE-TAC"] = 1;
    }

    if (preg_match('/[.]swiss$/i', $domain)) {
        $command["COMMAND"] = "AddDomainApplication";
        $command["CLASS"] = "GOLIVE";
        unset($command["INTERNALDNS"]);
        unset($command["X-ACCEPT-WHOISTRUSTEE-TAC"]);
    }

    ispapi_use_additionalfields($params, $command);

    //#####################################################################
    //##################### PREMIUM DOMAIN HANDLING #######################
    //######################################################################
    if ($premiumDomainsEnabled) { //check if premium domain functionality is enabled by the admin
        if (!empty($premiumDomainsCost)) { //check if the domain has a premium price
            $c = array(
                    "COMMAND" => "CheckDomains",
                    "DOMAIN" => array($domain),
                    "PREMIUMCHANNELS" => "*"
            );
            $check = ispapi_call($c, ispapi_config($origparams));
            if ($check["CODE"] == 200) {
                $registrar_premium_domain_price = $check["PROPERTY"]["PRICE"][0];
                $registrar_premium_domain_class = empty($check["PROPERTY"]["CLASS"][0]) ? "AFTERMARKET_PURCHASE_".$check["PROPERTY"]["PREMIUMCHANNEL"][0] : $check["PROPERTY"]["CLASS"][0];
                $registrar_premium_domain_currency = $check["PROPERTY"]["CURRENCY"][0];

                if ($premiumDomainsCost == $registrar_premium_domain_price) { //check if the price displayed to the customer is equal to the real cost at the registar
                    $command["COMMAND"] = "AddDomainApplication";
                    $command["CLASS"] =  $registrar_premium_domain_class;
                    $command["PRICE"] =  $premiumDomainsCost;
                    $command["CURRENCY"] = $registrar_premium_domain_currency;
                    //INTERNALDNS parameter is not supported in AddDomainApplication command
                    unset($command["INTERNALDNS"]);
                }
            }
        }
    }
    //#####################################################################

    $response = ispapi_call($command, ispapi_config($origparams));

    if ($response["CODE"] != 200) {
        $values["error"] = $response["DESCRIPTION"];
    }

    if (preg_match('/[.]swiss$/i', $domain)) {
        if ($response["CODE"] == 200) {
            $application_id = $response["PROPERTY"]["APPLICATION"][0];
            $values["error"] = "APPLICATION <#".$application_id."#> SUCCESSFULLY SUBMITTED. STATUS SET TO PENDING UNTIL THE SWISS REGISTRATION PROCESS IS COMPLETED";
        }
    }

    return $values;
}


/**
 * Transfer a domain name
 *
 * @param array $params common module parameters
 *
 * @return array $values - an array with command response description
 */
function ispapi_TransferDomain($params)
{
    $values = array();
    $origparams = $params;
    $params = ispapi_get_utf8_params($params);
    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $domain = $params["sld"].".".$params["tld"];

    $registrant = array(
        "FIRSTNAME" => $params["firstname"],
        "LASTNAME" => $params["lastname"],
        "ORGANIZATION" => $params["companyname"],
        "STREET" => $params["address1"],
        "CITY" => $params["city"],
        "STATE" => $params["state"],
        "ZIP" => $params["postcode"],
        "COUNTRY" => $params["country"],
        "PHONE" => $params["phonenumber"],
        "EMAIL" => $params["email"]
    );
    if (strlen($params["address2"])) {
        $registrant["STREET"] .= " , ".$params["address2"];
    }

    $admin = array(
        "FIRSTNAME" => $params["adminfirstname"],
        "LASTNAME" => $params["adminlastname"],
        "ORGANIZATION" => $params["admincompanyname"],
        "STREET" => $params["adminaddress1"],
        "CITY" => $params["admincity"],
        "STATE" => $params["adminstate"],
        "ZIP" => $params["adminpostcode"],
        "COUNTRY" => $params["admincountry"],
        "PHONE" => $params["adminphonenumber"],
        "EMAIL" => $params["adminemail"]
    );
    if (strlen($params["adminaddress2"])) {
        $admin["STREET"] .= " , ".$params["adminaddress2"];
    }

    $command = array(
        "COMMAND" => "TransferDomain",
        "DOMAIN" => $domain,
        "PERIOD" => $params["regperiod"],
        "NAMESERVER0" => $params["ns1"],
        "NAMESERVER1" => $params["ns2"],
        "NAMESERVER2" => $params["ns3"],
        "NAMESERVER3" => $params["ns4"],
        "OWNERCONTACT0" => $registrant,
        "ADMINCONTACT0" => $admin,
        "TECHCONTACT0" => $admin,
        "BILLINGCONTACT0" => $admin,
        "AUTH" => $origparams["transfersecret"]
    );


    //don't send owner admin tech billing contact for .NU .DK .CA, .US, .PT, .NO, .SE, .ES domains
    if (preg_match('/[.](nu|dk|ca|us|pt|no|se|es)$/i', $domain)) {
        unset($command["OWNERCONTACT0"]);
        unset($command["ADMINCONTACT0"]);
        unset($command["TECHCONTACT0"]);
        unset($command["BILLINGCONTACT0"]);
    }

    //don't send owner billing contact for .FR domains
    if (preg_match('/[.]fr$/i', $domain)) {
        unset($command["OWNERCONTACT0"]);
        unset($command["BILLINGCONTACT0"]);
    }

    //send PERIOD=0 for .NO and .NU domains
    if (preg_match('/[.](no|nu|es)$/i', $domain)) {
        $command["PERIOD"] = 0;
    }

    //do not send contact information for gTLD (Including nTLDs)
    if (preg_match('/\.[a-z]{3,}$/i', $domain)) {
        unset($command["OWNERCONTACT0"]);
        unset($command["ADMINCONTACT0"]);
        unset($command["TECHCONTACT0"]);
        unset($command["BILLINGCONTACT0"]);
    }

    $response = ispapi_call($command, ispapi_config($origparams));

    //Bug fix Issue WHMCS #4166
    //############
    if (preg_match('/Authorization failed/', $response["DESCRIPTION"]) && preg_match('/&#039;/', $origparams["transfersecret"])) {
        $command["AUTH"] = htmlspecialchars_decode($origparams["transfersecret"], ENT_QUOTES);
        $response = ispapi_call($command, ispapi_config($origparams));
    }
    //############

    if (preg_match('/USERTRANSFER/', $response["DESCRIPTION"])) {
        $command["ACTION"] = "USERTRANSFER";
        $response = ispapi_call($command, ispapi_config($origparams));
    }

    if ($response["CODE"] != 200) {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $values;
}

/**
 * Renew a domain name
 *
 * @param array $params common module parameters
 *
 * @return array $values - an array with command response description
 */
function ispapi_RenewDomain($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $domain = $params["sld"].".".$params["tld"];

    $command = array(
        "COMMAND" => "RenewDomain",
        "DOMAIN" => $domain,
        "PERIOD" => $params["regperiod"]
    );

    $response = ispapi_call($command, ispapi_config($params));

    if ($response["CODE"] == 510) {
        $command["COMMAND"] = "PayDomainRenewal";
        $response = ispapi_call($command, ispapi_config($params));
    }

    if ($response["CODE"] != 200) {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $values;
}

/**
 * Release a domain name
 * A domain name can be pushed to the registry or to another registrar.
 * This feature currently works for .DE domains (DENIC Transit), .UK domains (.UK detagging), .VE domains, .IS domains and .AT domains (.AT Billwithdraw).
 *
 * @param array $params common module parameters
 *
 * @return array $values - an array with command response description
 */
function ispapi_ReleaseDomain($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $domain = $params["sld"].".".$params["tld"];
    $target = $params["transfertag"];

    $command = array(
        "COMMAND" => "PushDomain",
        "DOMAIN" => $domain
    );
    if (!empty($target)) {
        $command["TARGET"] = $target;
    }

    $response = ispapi_call($command, ispapi_config($params));

    if ($response["CODE"] != 200) {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $values;
}

/**
 * Delete a domain name
 *
 * @param array $params common module parameters
 *
 * @return array $values - an array with command response description
 */
function ispapi_RequestDelete($params)
{
    $values = array();
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $domain = $params["sld"].".".$params["tld"];

    $command = array(
        "COMMAND" => "DeleteDomain",
        "DOMAIN" => $domain
    );
    $response = ispapi_call($command, ispapi_config($params));

    if ($response["CODE"] != 200) {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $values;
}

/**
 * Incoming Domain Transfer Sync.
 *
 * Check status of incoming domain transfers and notify end-user upon
 * completion. This function is called daily for incoming domains.
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_TransferSync($params)
{
    $values = array();
    $domain = $params["sld"].".".$params["tld"];

    $command = array(
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain
    );
    $response = ispapi_call($command, ispapi_config($params));
    if ($response["CODE"] == 200) {
        $values['completed'] = true; #  when transfer completes successfully

        if ($response["PROPERTY"]["FAILUREDATE"][0] > $response["PROPERTY"]["PAIDUNTILDATE"][0]) {
            $paiduntildate = preg_replace('/ .*/', '', $response["PROPERTY"]["PAIDUNTILDATE"][0]);
            $values['expirydate'] = $paiduntildate;
        } else {
            $accountingdate = preg_replace('/ .*/', '', $response["PROPERTY"]["ACCOUNTINGDATE"][0]);
            $values['expirydate'] = $accountingdate;
        }

        //activate the whoistrustee if set to 1 in WHMCS
        if ($params["idprotection"] == "1" || $params["idprotection"] == "on") {
            $command = array(
                    "COMMAND" => "ModifyDomain",
                    "DOMAIN" => $domain,
                    "X-ACCEPT-WHOISTRUSTEE-TAC" => "1"
            );
            $response = ispapi_call($command, ispapi_config($params));
        }
    } elseif (($response["CODE"] == 545) || ($response["CODE"] == 531)) {
        $command = array("COMMAND" => "StatusDomainTransfer", "DOMAIN" => $domain);
        $response = ispapi_call($command, ispapi_config($params));
        if (($response["CODE"] == 545) || ($response["CODE"] == 531)) {
            $values['failed'] = true;
            $values['reason'] = "Transfer Failed";

            $loglist_command = array("COMMAND" => "QueryObjectLogList", "OBJECTCLASS" => "DOMAIN", "OBJECTID" => $domain, "ORDERBY" => "LOGDATEDESC", "LIMIT" => 1);
            $loglist_response = ispapi_call($loglist_command, ispapi_config($params));
            if (isset($loglist_response["PROPERTY"]["LOGINDEX"])) {
                foreach ($loglist_response["PROPERTY"]["LOGINDEX"] as $index => $logindex) {
                    $type = $loglist_response["PROPERTY"]["OPERATIONTYPE"][$index];
                    $status = $loglist_response["PROPERTY"]["OPERATIONSTATUS"][$index];
                    if (($type == "INBOUND_TRANSFER") && ($status == "FAILED")) {
                        $logstatus_command = array("COMMAND" => "StatusObjectLog", "LOGINDEX" => $logindex);
                        $logstatus_response = ispapi_call($logstatus_command, ispapi_config($params));
                        if ($logstatus_response["CODE"] == 200) {
                            $values['reason'] = implode("\n", $logstatus_response["PROPERTY"]["OPERATIONINFO"]);
                        }
                    }
                }
            }
        }
    } else {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $values;
}

/**
 * Sync Domain Status & Expiration Date
 *
 * Domain syncing is intended to ensure domain status and expiry date
 * changes made directly at the domain registrar are synced to WHMCS.
 * It is called periodically for a domain.
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_Sync($params)
{
    $values = array();
    $domain = $params["sld"].".".$params["tld"];

    $command = array(
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain
    );
    $response = ispapi_call($command, ispapi_config($params));
    if ($response["CODE"] == 200) {
        $status = $response["PROPERTY"]["STATUS"][0];
        if (preg_match('/ACTIVE/i', $status)) {
            $values["active"] = true;
        } elseif (preg_match('/DELETE/i', $status)) {
            $expirydate = preg_replace('/ .*/', '', $response["PROPERTY"]["EXPIRATIONDATE"][0]);
            $values['expirydate'] = $expirydate;
        }

        if ($response["PROPERTY"]["FAILUREDATE"][0] > $response["PROPERTY"]["PAIDUNTILDATE"][0]) {
            $paiduntildate = preg_replace('/ .*/', '', $response["PROPERTY"]["PAIDUNTILDATE"][0]);
            $values['expirydate'] = $paiduntildate;
        } else {
            $accountingdate = preg_replace('/ .*/', '', $response["PROPERTY"]["ACCOUNTINGDATE"][0]);
            $values['expirydate'] = $accountingdate;
        }
    } elseif ($response["CODE"] == 531) {
        $values['transferredAway'] = (bool) true;
    } elseif ($response["CODE"] == 545) {
        $values['transferredAway'] = (bool) true;
    } else {
        $values["error"] = $response["DESCRIPTION"];
    }
    return $values;
}

/**
 * Return an array with the contact information of a contact handle
 * Uses the StatusContact command
 *
 * @param array $contact - contact handle
 * @param array &$params - common module parameters
 *
 * @return array $values - an array with contact information
 */
function ispapi_get_contact_info($contact, &$params)
{
    if (isset($params["_contact_hash"][$contact])) {
        return $params["_contact_hash"][$contact];
    }

    $domain = $params["sld"].".".$params["tld"];

    $values = array();
    $command = array(
        "COMMAND" => "StatusContact",
        "CONTACT" => $contact
    );
    $response = ispapi_call($command, ispapi_config($params));

    if (1 || $response["CODE"] == 200) {
        $values["First Name"] = $response["PROPERTY"]["FIRSTNAME"][0];
        $values["Last Name"] = $response["PROPERTY"]["LASTNAME"][0];
        $values["Company Name"] = $response["PROPERTY"]["ORGANIZATION"][0];
        $values["Address"] = $response["PROPERTY"]["STREET"][0];
        $values["Address 2"] = $response["PROPERTY"]["STREET"][1];
        $values["City"] = $response["PROPERTY"]["CITY"][0];
        $values["State"] = $response["PROPERTY"]["STATE"][0];
        $values["Postcode"] = $response["PROPERTY"]["ZIP"][0];
        $values["Country"] = $response["PROPERTY"]["COUNTRY"][0];
        $values["Phone"] = $response["PROPERTY"]["PHONE"][0];
        $values["Fax"] = $response["PROPERTY"]["FAX"][0];
        $values["Email"] = $response["PROPERTY"]["EMAIL"][0];

        if ((count($response["PROPERTY"]["STREET"]) < 2) && preg_match('/^(.*) , (.*)/', $response["PROPERTY"]["STREET"][0], $m)) {
            $values["Address"] = $m[1];
            $values["Address 2"] = $m[2];
        }

        // handle imported .ca domains properly
        if (preg_match('/[.]ca$/i', $domain) && isset($response["PROPERTY"]["X-CA-LEGALTYPE"])) {
            if (preg_match('/^(CCT|RES|ABO|LGR)$/i', $response["PROPERTY"]["X-CA-LEGALTYPE"][0])) {
                // keep name/org
            } else {
                if ((!isset($response["PROPERTY"]["ORGANIZATION"])) || !$response["PROPERTY"]["ORGANIZATION"][0]) {
                    $response["PROPERTY"]["ORGANIZATION"] = $response["PROPERTY"]["NAME"];
                }
            }
        }
    }
    $params["_contact_hash"][$contact] = $values;
    return $values;
}



// ------------------------------------------------------------------------------
// ------- Helper functions and functions required to connect the API ----------
// ------------------------------------------------------------------------------

function ispapi_query_additionalfields(&$params)
{
    $result = mysql_query("SELECT name,value FROM tbldomainsadditionalfields
		WHERE domainid='".mysql_real_escape_string($params["domainid"])."'");
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $params['additionalfields'][$row['name']] = $row['value'];
    }
}

/**
 * Includes the corret additionl fields path based on the WHMCS vesion.
 * More information here: https://docs.whmcs.com/Additional_Domain_Fields
 *
 */
function ispapi_include_additionaladditionalfields()
{
    global $additionaldomainfields;

    $old_additionalfieldsfile_path = implode(DIRECTORY_SEPARATOR, array(ROOTDIR,"includes","additionaldomainfields.php"));
    $new_additionalfieldsfile_path = implode(DIRECTORY_SEPARATOR, array(ROOTDIR,"resources","domains", "additionalfields.php"));

    if (file_exists($new_additionalfieldsfile_path)) {
        // for WHMCS >= 7.0
        include $new_additionalfieldsfile_path;
    } elseif (file_exists($old_additionalfieldsfile_path)) {
        // for WHMCS < 7.0
        include $old_additionalfieldsfile_path;
    }
}

function ispapi_use_additionalfields($params, &$command)
{
    global $additionaldomainfields;

    ispapi_include_additionaladditionalfields();

    $myadditionalfields = array();
    if (is_array($additionaldomainfields) && isset($additionaldomainfields[".".$params["tld"]])) {
        $myadditionalfields = $additionaldomainfields[".".$params["tld"]];
    }

    foreach ($myadditionalfields as $field_index => $field) {
        if (!is_array($field["Ispapi-Replacements"])) {
            $field["Ispapi-Replacements"] = array();
        }

        if (isset($field["Ispapi-Options"]) && isset($field["Options"])) {
            $options = explode(",", $field["Options"]);
            foreach (explode(",", $field["Ispapi-Options"]) as $index => $new_option) {
                $option = $options[$index];
                if (!isset($field["Ispapi-Replacements"][$option])) {
                    $field["Ispapi-Replacements"][$option] = $new_option;
                }
            }
        }

        $myadditionalfields[$field_index] = $field;
    }

    foreach ($myadditionalfields as $field) {
        if (isset($params['additionalfields'][$field["Name"]])) {
            $value = $params['additionalfields'][$field["Name"]];

            $ignore_countries = array();
            if (isset($field["Ispapi-IgnoreForCountries"])) {
                foreach (explode(",", $field["Ispapi-IgnoreForCountries"]) as $country) {
                    $ignore_countries[strtoupper($country)] = 1;
                }
            }

            if (!$ignore_countries[strtoupper($params["country"])]) {
                if (isset($field["Ispapi-Replacements"][$value])) {
                    $value = $field["Ispapi-Replacements"][$value];
                }

                if (isset($field["Ispapi-Eval"])) {
                    eval($field["Ispapi-Eval"]);
                }

                if (isset($field["Ispapi-Name"])) {
                    if (strlen($value)) {
                        $command[$field["Ispapi-Name"]] = $value;
                    }
                }
            }
        }
    }
}

function ispapi_get_utf8_params($params)
{
    if (isset($params["original"])) {
        return $params["original"];
    }
    $config = array();
    $result = mysql_query("SELECT setting, value FROM tblconfiguration;");
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $config[strtolower($row['setting'])] = $row['value'];
    }
    if ((strtolower($config["charset"]) != "utf-8") && (strtolower($config["charset"]) != "utf8")) {
        return $params;
    }

    $result = mysql_query("SELECT orderid FROM tbldomains WHERE id='".mysql_real_escape_string($params["domainid"])."' LIMIT 1;");
    if (!($row = mysql_fetch_array($result, MYSQL_ASSOC))) {
        return $params;
    }

    $result = mysql_query("SELECT userid,contactid FROM tblorders WHERE id='".mysql_real_escape_string($row['orderid'])."' LIMIT 1;");
    if (!($row = mysql_fetch_array($result, MYSQL_ASSOC))) {
        return $params;
    }

    if ($row['contactid']) {
        $result = mysql_query("SELECT firstname, lastname, companyname, email, address1, address2, city, state, postcode, country, phonenumber FROM tblcontacts WHERE id='".mysql_real_escape_string($row['contactid'])."' LIMIT 1;");
        if (!($row = mysql_fetch_array($result, MYSQL_ASSOC))) {
            return $params;
        }
        foreach ($row as $key => $value) {
            $params[$key] = $value;
        }
    } elseif ($row['userid']) {
        $result = mysql_query("SELECT firstname, lastname, companyname, email, address1, address2, city, state, postcode, country, phonenumber FROM tblclients WHERE id='".mysql_real_escape_string($row['userid'])."' LIMIT 1;");
        if (!($row = mysql_fetch_array($result, MYSQL_ASSOC))) {
            return $params;
        }
        foreach ($row as $key => $value) {
            $params[$key] = $value;
        }
    }

    if ($config['registraradminuseclientdetails']) {
        $params['adminfirstname'] = $params['firstname'];
        $params['adminlastname'] = $params['lastname'];
        $params['admincompanyname'] = $params['companyname'];
        $params['adminemail'] = $params['email'];
        $params['adminaddress1'] = $params['address1'];
        $params['adminaddress2'] = $params['address2'];
        $params['admincity'] = $params['city'];
        $params['adminstate'] = $params['state'];
        $params['adminpostcode'] = $params['postcode'];
        $params['admincountry'] = $params['country'];
        $params['adminphonenumber'] = $params['phonenumber'];
    } else {
        $params['adminfirstname'] = $config['registraradminfirstname'];
        $params['adminlastname'] = $config['registraradminlastname'];
        $params['admincompanyname'] = $config['registraradmincompanyname'];
        $params['adminemail'] = $config['registraradminemailaddress'];
        $params['adminaddress1'] = $config['registraradminaddress1'];
        $params['adminaddress2'] = $config['registraradminaddress2'];
        $params['admincity'] = $config['registraradmincity'];
        $params['adminstate'] = $config['registraradminstateprovince'];
        $params['adminpostcode'] = $config['registraradminpostalcode'];
        $params['admincountry'] = $config['registraradmincountry'];
        $params['adminphonenumber'] = $config['registraradminphone'];
    }

    $result = mysql_query("SELECT name,value FROM tbldomainsadditionalfields
		WHERE domainid='".mysql_real_escape_string($params["domainid"])."'");
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $params['additionalfields'][$row['name']] = $row['value'];
    }

    return $params;
}

function ispapi_config($params)
{
    $config = array();
    $config["registrar"] = $params["registrar"];
    $config["entity"] = "54cd";
    $config["url"] = "http://api.ispapi.net/api/call.cgi";
    $config["idns"] = $params["ConvertIDNs"];
    if ($params["TestMode"] == 1 || $params["TestMode"] == "on") {
        $config["entity"] = "1234";
    }
    if ($params["UseSSL"] == 1 || $params["UseSSL"] == "on") {
        $config["url"] = "https://coreapi.1api.net/api/call.cgi";
    }
    if (strlen($params["ProxyServer"])) {
        $config["proxy"] = $params["ProxyServer"];
    }
    $config["login"] = $params["Username"];
    $config["password"] = $params["Password"];
    return $config;
}

function ispapi_call($command, $config)
{
    return ispapi_parse_response(ispapi_call_raw($command, $config));
}

function ispapi_call_raw($command, $config)
{
    global $ispapi_module_version;
    $args = array();
    $url = $config["url"];
    if (isset($config["login"])) {
        $args["s_login"] = $config["login"];
    }
    if (isset($config["password"])) {
        $args["s_pw"] = html_entity_decode($config["password"], ENT_QUOTES);
    }
    if (isset($config["user"])) {
        $args["s_user"] = $config["user"];
    }
    if (isset($config["entity"])) {
        $args["s_entity"] = $config["entity"];
    }
    $args["s_command"] = ispapi_encode_command($command);

    # Convert IDNs via API
    if (1) {
        $new_command = array();
        foreach (explode("\n", $args["s_command"]) as $line) {
            if (preg_match('/^([^\=]+)\=(.*)/', $line, $m)) {
                $new_command[strtoupper(trim($m[1]))] = trim($m[2]);
            }
        }
        if (strtoupper($new_command["COMMAND"]) != "CONVERTIDN") {
            $replace = array();
            $domains = array();
            foreach ($new_command as $k => $v) {
                if (preg_match('/^(DOMAIN|NAMESERVER|DNSZONE)([0-9]*)$/i', $k)) {
                    if (preg_match('/[^a-z0-9\.\- ]/i', $v)) {
                        $replace[] = $k;
                        $domains[] = $v;
                    }
                }
            }
            if (count($replace)) {
                if ($config["idns"] == "PHP") {
                    foreach ($replace as $index => $k) {
                        $new_command[$k] = ispapi_to_punycode($new_command[$k]);
                    }
                } else {
                    $r = ispapi_call(array("COMMAND" => "ConvertIDN", "DOMAIN" => $domains), $config);
                    if (($r["CODE"] == 200) && isset($r["PROPERTY"]["ACE"])) {
                        foreach ($replace as $index => $k) {
                            $new_command[$k] = $r["PROPERTY"]["ACE"][$index];
                        }
                        $args["s_command"] = ispapi_encode_command($new_command);
                    }
                }
            }
        }
    }

    $config["curl"] = curl_init($url);
    if ($config["curl"] === false) {
        return "[RESPONSE]\nCODE=423\nAPI access error: curl_init failed\nEOF\n";
    }
    $postfields = array();
    foreach ($args as $key => $value) {
        $postfields[] = urlencode($key)."=".urlencode($value);
    }
    $postfields = implode('&', $postfields);
    curl_setopt($config["curl"], CURLOPT_POST, 1);
    curl_setopt($config["curl"], CURLOPT_POSTFIELDS, $postfields);
    curl_setopt($config["curl"], CURLOPT_HEADER, 0);
    curl_setopt($config["curl"], CURLOPT_RETURNTRANSFER, 1);
    if (strlen($config["proxy"])) {
        curl_setopt($config["curl"], CURLOPT_PROXY, $config["proxy"]);
    }
    curl_setopt($config["curl"], CURLOPT_USERAGENT, "ISPAPI/$ispapi_module_version WHMCS/".$GLOBALS["CONFIG"]["Version"]." PHP/".phpversion()." (".php_uname("s").")");
    curl_setopt($config["curl"], CURLOPT_REFERER, $GLOBALS["CONFIG"]["SystemURL"]);
    $response = curl_exec($config["curl"]);

    if (preg_match('/(^|\n)\s*COMMAND\s*=\s*([^\s]+)/i', $args["s_command"], $m)) {
        $command = $m[2];
        // don't log read-only requests
        if (!preg_match('/^(Check|Status|Query|Convert)/i', $command)) {
            ispapi_logModuleCall($config["registrar"], $command, $args["s_command"], $response);
        }
    }

    return $response;
}

function ispapi_to_punycode($domain)
{
    if (!strlen($domain)) {
        return $domain;
    }
    if (preg_match('/^[a-z0-9\.\-]+$/i', $domain)) {
        return $domain;
    }

    $charset = $GLOBALS["CONFIG"]["Charset"];
    if (function_exists("idn_to_ascii")) {
        $punycode = idn_to_ascii($domain, $charset);
        if (strlen($punycode)) {
            return $punycode;
        }
    }
    return $domain;
}

function ispapi_encode_command($commandarray)
{
    if (!is_array($commandarray)) {
        return $commandarray;
    }
    $command = "";
    foreach ($commandarray as $k => $v) {
        if (is_array($v)) {
            $v = ispapi_encode_command($v);
            $l = explode("\n", trim($v));
            foreach ($l as $line) {
                $command .= "$k$line\n";
            }
        } else {
            $v = preg_replace("/\r|\n/", "", $v);
            $command .= "$k=$v\n";
        }
    }
    return $command;
}

function ispapi_parse_response($response)
{
    if (is_array($response)) {
        return $response;
    }
    $hash = array(
        "PROPERTY" => array(),
        "CODE" => "423",
        "DESCRIPTION" => "Empty response from API"
    );
    if (!$response) {
        return $hash;
    }
    $rlist = explode("\n", $response);
    foreach ($rlist as $item) {
        if (preg_match("/^([^\=]*[^\t\= ])[\t ]*=[\t ]*(.*)$/", $item, $m)) {
            $attr = $m[1];
            $value = $m[2];
            $value = preg_replace("/[\t ]*$/", "", $value);
            if (preg_match("/^property\[([^\]]*)\]/i", $attr, $m)) {
                $prop = strtoupper($m[1]);
                $prop = preg_replace("/\s/", "", $prop);
                if (in_array($prop, array_keys($hash["PROPERTY"]))) {
                    array_push($hash["PROPERTY"][$prop], $value);
                } else {
                     $hash["PROPERTY"][$prop] = array($value);
                }
            } else {
                $hash[strtoupper($attr)] = $value;
            }
        }
    }
    if ((!$hash["CODE"]) || (!$hash["DESCRIPTION"])) {
        $hash = array(
            "PROPERTY" => array(),
            "CODE" => "423",
            "DESCRIPTION" => "Invalid response from API"
        );
    }
    return $hash;
}

function ispapi_logModuleCall($registrar, $action, $requeststring, $responsedata, $processeddata = null, $replacevars = null)
{
    if (!function_exists('logModuleCall')) {
        return;
    }
    return logModuleCall($registrar, $action, $requeststring, $responsedata, $processeddata, $replacevars);
}

ispapi_InitModule($module_version);
