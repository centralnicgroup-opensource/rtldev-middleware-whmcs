<?php

/**
 * ISPAPI Registrar Module
 *
 * @author HEXONET GmbH <support@hexonet.net>
 */

define("ISPAPI_MODULE_VERSION", "5.1.10");

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

use Illuminate\Database\Capsule\Manager as DB;
use WHMCS\Module\Registrar\Ispapi\Ispapi as Ispapi;
use WHMCS\Module\Registrar\Ispapi\Helper as Helper;
use WHMCS\Module\Registrar\Ispapi\WebApps as WebApps;
use WHMCS\Module\Registrar\Ispapi\DomainTransfer as HXDomainTransfer;
use WHMCS\Module\Registrar\Ispapi\Domain as HXDomain;
use WHMCS\Module\Registrar\Ispapi\DomainApplication as HXApplication;
use WHMCS\Domains\DomainLookup\SearchResult as SR;

/**
 * Check the availability of domains using HEXONET's fast API
 *
 * Availability Premium Enabled CODE    DESCRIPTION                                 CLASS   PRICE   CURRENCY    PREMIUMCHANNEL
 * NO               NO          211     Premium Domain name not available [PREMIUM] YES     N/A     N/A         N/A
 *                 YES          211     Premium Domain name not available [PREMIUM] YES     N/A     N/A         N/A
 * YES              NO          211     Premium Domain name available [PREMIUM]     YES     N/A     N/A         N/A
 *                 YES          211     Premium Domain name available [PREMIUM]     YES     YES     YES         YES
 *
 * @param array $params common module parameters *
 * @return \WHMCS\Domains\DomainLookup\ResultsList An ArrayObject based collection of \WHMCS\Domains\DomainLookup\SearchResult results
 * @see https://confluence.hexonet.net/pages/viewpage.action?pageId=8589377 for diagram
 * @throws \Exception in case of an error
 */
function ispapi_CheckAvailability($params)
{
    $maxGroupSize = 25;
    $premiumEnabled = (bool) $params["premiumEnabled"];

    if ($params["isIdnDomain"]) {
        $label = empty($params["punyCodeSearchTerm"]) ? strtolower($params["searchTerm"]) : strtolower($params["punyCodeSearchTerm"]);
    } else {
        $label = strtolower($params["searchTerm"]);
    }

    $command = [
        "COMMAND" => "CheckDomains",
        "PREMIUMCHANNELS" => $premiumEnabled ? "*" : ""
    ];
    // build domainlist to check
    if (!empty($params["suggestions"])) {
        // for domain name suggestion mode (we get already a list of domains)
        // remove duplicates and empty ones
        $tocheck = $params["suggestions"];
    } else {
        // for common availability checks (we get just a search label and list of tlds)
        // remove duplicates and empty ones
        $tocheck = array_values(array_unique(array_filter($params["tldsToInclude"])));
        $tocheck = array_map(function ($tld) use ($label) {
            return $label  . "." . ltrim($tld, ".");
        }, $tocheck);
    }

    // build the result list for WHMCS
    // chunk the check list, only ~250 are allowed at once
    $results = new \WHMCS\Domains\DomainLookup\ResultsList();
    foreach (array_chunk($tocheck, $maxGroupSize) as $command["DOMAIN"]) {
        $r = Ispapi::call($command, $params);
        foreach ($command["DOMAIN"] as $idx => $domain) {
            $parts = preg_split("/\./", $domain, 2);
            $sr = new SR($parts[0], $parts[1]);
            if ($r["CODE"] != "200" || empty($r["PROPERTY"]["DOMAINCHECK"][$idx])) {
                $dc = "421 Temporary issue";
            } else {
                $dc = $r["PROPERTY"]["DOMAINCHECK"][$idx];
            }

            switch (substr($dc, 0, 3)) {
                case "421":
                    $sr->setStatus($sr::STATUS_UNKNOWN);
                    break;
                case "549": //TLD not supported at HEXONET or check failed; fallback to whois lookup
                    $whois = localAPI("DomainWhois", ["domain" => $domain]);
                    if ($whois["status"] === "available") {
                        //DOMAIN AVAILABLE
                        $sr->setStatus($sr::STATUS_NOT_REGISTERED);
                    } else {
                        $sr->setStatus($sr::STATUS_TLD_NOT_SUPPORTED);
                    }
                    break;
                case "210": //DOMAIN AVAILABLE
                    $sr->setStatus($sr::STATUS_NOT_REGISTERED);
                    break;
                case "211":
                    if (preg_match("/block/", $r["PROPERTY"]["REASON"][$idx])) {// CASE: DOMAIN BLOCK
                        $sr->setStatus($sr::STATUS_REGISTERED);
                    } elseif (preg_match("/^Collision Domain name available \{/i", substr($dc, 3))) {// CASE: NXD DOMAIN
                        $sr->setStatus($sr::STATUS_RESERVED);
                    } elseif (!empty($r["PROPERTY"]["PREMIUMCHANNEL"][$idx])) {// CASE: PREMIUM
                        $params["AvailabilityCheckResult"] = $r;
                        $params["AvailabilityCheckResultIndex"] = $idx;
                        $sr->setPremiumDomain(true);
                        try {
                            $prices = ispapi_GetPremiumPrice($params);
                            $sr->setPremiumCostPricing($prices);
                            if (isset($prices["register"])) {
                                //PREMIUM DOMAIN AVAILABLE
                                $sr->setStatus($sr::STATUS_NOT_REGISTERED);
                            } else {
                                $sr->setStatus($sr::STATUS_REGISTERED);
                            }
                        } catch (\Exception $e) {
                            $sr->setPremiumCostPricing([]);
                            $sr->setStatus($sr::STATUS_RESERVED);
                        }
                    } elseif (!empty($r["PROPERTY"]["CLASS"][$idx])) { // CASE: RESERVED or PREMIUM? BACKORDER
                        if (stripos($r["PROPERTY"]["REASON"][$idx], "reserved")) {//RESERVED
                            $sr->setStatus($sr::STATUS_RESERVED);
                        } else {
                            $sr->setStatus($sr::STATUS_REGISTERED);
                        }
                    } else {
                        $sr->setStatus($sr::STATUS_REGISTERED);
                    }
                    break;
                default:
                    // set by default to `REGISTERED`
                    $sr->setStatus($sr::STATUS_REGISTERED);
                    break;
            }

            //ONLY RETURNS AVAILABLE DOMAINS FOR DOMAIN NAME SUGGESTIONS MODE
            //AND ALL RESULTS OTHERWISE
            if (!isset($params["suggestions"]) || $sr->getStatus() == $sr::STATUS_NOT_REGISTERED) {
                $results->append($sr);
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
    // go through configuration settings
    if (empty($params["suggestionSettings"]["suggestions"])) {
        return new \WHMCS\Domains\DomainLookup\ResultsList();
    }
    $suppressWeigthed = $params["suggestionSettings"]["suggestionsnoweighted"];
    $suggestionsLimit = 100;
    if (!empty($params["suggestionSettings"]["suggstionsamount"])) {
        $suggestionsLimit = $params["suggestionSettings"]["suggstionsamount"];
    }

    // build search label
    if ($params["isIdnDomain"]) {
        $label = empty($params["punyCodeSearchTerm"]) ? $params["searchTerm"] : $params["punyCodeSearchTerm"];
    } else {
        $label = $params["searchTerm"];
    }
    $label = strtolower($label);

    // build zone list parameter
    $zones = [];
    foreach ($params["tldsToInclude"] as $tld) {
        // IGNORE 3RD LEVEL TLDS - NOT FULLY SUPPORTED BY QueryDomainSuggestionList
        // Suppress .com, .net by configuration
        if (!preg_match("/\./", $tld) && (!$suppressWeigthed || !preg_match("/^(com|net)$/", $tld))) {
            $zones[] = $tld;
        }
    }

    // request domain name suggestions from engine
    $first = 0;
    $command = [
        "COMMAND" => "QueryDomainSuggestionList",
        "KEYWORD" => $label,
        "ZONE" => $zones,
        "SOURCE" => "ISPAPI-SUGGESTIONS",
        "LIMIT" => $suggestionsLimit
    ];
    $results = new \WHMCS\Domains\DomainLookup\ResultsList();
    do {
        // get domain name suggestions
        $command["FIRST"] = $first;
        $r = Ispapi::call($command, $params);
        if ($r["CODE"] != 200 || empty($r["PROPERTY"]["DOMAIN"])) {
            break;//leave while and return $results
        }
        // check the availability, as also taken/reserved/blocked domains could be returned
        $params["suggestions"] = array_values(array_unique(array_filter($r["PROPERTY"]["DOMAIN"])));
        $tmp = ispapi_CheckAvailability($params);
        // add entries to the list of entries to return
        $resultsCount = count($results);
        $resultsFilled = $resultsCount >= $suggestionsLimit;
        foreach ($tmp as $sr) {
            if ($resultsFilled) {
                break 2;//leave foreach and while
            }
            $results->append($sr);
            $resultsCount++;
            $resultsFilled = $resultsCount >= $suggestionsLimit;
        }
        $first += $suggestionsLimit;
    } while (!$resultsFilled && ($r["PROPERTY"]["TOTAL"][0] > $first));
    return $results;
}

/**
 * Define the settings relating to domain suggestions
 *
 * @param array an array with different settings
 */
function ispapi_DomainSuggestionOptions($params)
{
    $version = implode(".", array_slice(explode(".", $params["whmcsVersion"]), 0, 2));
    if (version_compare($version, "7.6") === -1) {
        $marginleft = "60px";
    } else {
        $marginleft = "220px";
    }

    /*$r = Ispapi::call([
        "COMMAND" => "QueryDomainSuggestionList",
        "SOURCE" => "ISPAPI-CATEGORIES"
    ], $params);
    $categories = ["" => "Not set (default)"];
    if ($r["CODE"] != "200") {
        $r["PROPERTY"]["CATEGORY"] = [ // 06-08-2020
            "professions", "geographic", "education", "entertainment", "business", "adult", "travel", "technology", "realEstate", "community",
            "identity", "arts", "shopping", "other", "financial", "food", "fitness", "lifestyle", "culture", "popular", "health", "idns"
        ];
    }
    sort($r["PROPERTY"]["CATEGORY"]);
    foreach ($r["PROPERTY"]["CATEGORY"] as $category) {
        $categories[$category] = $category;
    }

    $languages = ["" => "Not set (default)"];*/
    return [
        "information" => [
            "FriendlyName" => "<b>Don't have a HEXONET Account yet?</b>",
            "Description" => "Get one here: <a target=\"_blank\" href=\"https://www.hexonet.net/sign-up\">https://www.hexonet.net/sign-up</a><br><br>
			<b>The HEXONET Lookup Provider provides the following features:</b>
			<ul style=\"text-align:left;margin-left:" . $marginleft . ";margin-top:5px;\">
			<li>High Performance availability checks using our fast API</li>
			<li>Suggestion Engine</li>
			<li>Aftermarket and Registry Premium Domains support</li>
			<li>Fallback to WHOIS Lookup for non-supported TLDs</li>
			</ul>"
        ],
        "suggestions" => [
            "FriendlyName" => "<b style=\"color:#FF6600;\">Suggestion Engine based on search term:</b>",
            "Type" => "yesno",
            "Description" => AdminLang::trans("global.ticktoenable") . " (" . AdminLang::trans("global.recommended") . ")"
        ],
        "suggstionsamount" => [
            "FriendlyName" => "<b style=\"color:#FF6600;\">" . AdminLang::trans("general.maxsuggestions") . "</b>",
            "Type" => "dropdown",
            "Options" => [
                10 => "10",
                25 => "25",
                50 => "50",
                75 => "75",
                100 => "100 (" . AdminLang::trans("global.recommended") . ")",
                150 => "150",
                200 => "200"
            ],
            "Default" => "100",
            "Description" => ""
        ],
        /*"suggestionscategories" => [
            "FriendlyName" => "<b style=\"color:#FF6600;\">Category-based suggestions:</b>",
            "Type" => "dropdown",
            "Multiple" => true,
            "Size" => 5,
            "Options" => $categories,
            "Default" => "",
            "Description" => "<br/>Get Suggestions related to the selected categories."
        ],
        "suggestionslangs" => [
            "FriendlyName" => "<b style=\"color:#FF6600;\">Language-dependent Suggestions:</b>",
            "Type" => "dropdown",
            "Multiple" => true,
            "Size" => 3,
            "Options" => $languages,
            "Default" => "",
            "Description" => "<br/>(Better localized Suggestions)"
        ],
        "suggestionsip" => [
            "FriendlyName" => "<b style=\"color:#FF6600;\">Use IP Address for region-dependent Suggestions:</b>",
            "Type" => "yesno",
            "Default" => "",
            "Description" => AdminLang::trans("global.ticktoenable") . " (Better localized Suggestions)"
        ],*/
        "suggestionsnoweighted" => [
            "FriendlyName" => "<b style=\"color:#FF6600;\">Suppress .com and .net:</b>",
            "Type" => "yesno",
            "Default" => "",
            "Description" => AdminLang::trans("global.ticktoenable") . "<br/>.com and .net have by default a very high weight."
        ]
    ];
}
/**
 * Get Premium Price for given domain,
 * $params -> array(
 *      "domain" => ...,
 *      "sld" => ...
 *      "tld" => ...
 *      "type" => ...
 * );
 * @throws Exception in case currency configuration is missing
 */
function ispapi_GetPremiumPrice($params)
{
    if (isset($params["AvailabilityCheckResult"])) {
        $index = $params["AvailabilityCheckResultIndex"];
        $r = $params["AvailabilityCheckResult"];
        unset(
            $params["AvailabilityCheckResultIndex"],
            $params["AvailabilityCheckResult"]
        );
    } else {
        $index = 0;
        $r = Ispapi::call([
            "COMMAND" => "CheckDomains",
            "DOMAIN0" => $params["domain"],
            "PREMIUMCHANNELS" => "*"
        ], $params);
    }
    if (
        ($r["CODE"] != 200) ||
        (empty($r["PROPERTY"]["PREMIUMCHANNEL"][0]) && empty($r["PROPERTY"]["CLASS"][0]))
    ) {
        return [];
    }
    $r = $r["PROPERTY"];

    //GET THE PRICES
    if (isset($r["CURRENCY"][$index]) && isset($r["PRICE"][$index]) && is_numeric($r["PRICE"][$index])) {
        $prices = [
            "CurrencyCode" => $r["CURRENCY"][$index]
        ];
        $currency = \WHMCS\Billing\Currency::where("code", $prices["CurrencyCode"])->first();
        if (!$currency) {
            throw new Exception("Missing currency configuration for: " . $prices["CurrencyCode"]);
        }
        // probably registration case (domain name available), API provides PRICE/CURRENCY Properties
        // get registration price (as of variable fee premiums calculation is more complex)
        $renewprice = ispapi_getPremiumRenewPrice($params, $r["CLASS"][$index], $currency->id);
        if ($renewprice !== false) {
            $prices["renew"] = $renewprice;
        }
        $registerprice = ispapi_getPremiumRegisterPrice($params, $r["CLASS"][$index], $r["PRICE"][$index], $currency->id);
        if ($registerprice !== false) {
            $prices["register"] = $registerprice;
        }
    } else {
        $prices = [
            "CurrencyCode" =>  ispapi_getPremiumCurrency($params, $r["CLASS"][$index])
        ];
        if ($prices["CurrencyCode"] === false) {
            $racc = Ispapi::call([ // worst case fallback
                "COMMAND" => "StatusAccount"
            ], $params);
            if ($racc["CODE"] != "200" || empty($racc["PROPERTY"]["CURRENCY"][0])) {
                return [];
            }
            $prices["CurrencyCode"] = $racc["PROPERTY"]["CURRENCY"][0];
        }

        $currency = \WHMCS\Billing\Currency::where("code", $prices["CurrencyCode"])->first();
        if (!$currency) {
            throw new Exception("Missing currency configuration for: " . $prices["CurrencyCode"]);
        }
        // probably transfer case (domain name n/a), API doesn't provide PRICE/CURRENCY Properties
        $renewprice = ispapi_getPremiumRenewPrice($params, $r["CLASS"][$index], $currency->id);
        if ($renewprice !== false) {
            $prices["renew"] = $renewprice;
        }
        $transferprice = ispapi_getPremiumTransferPrice($params, $r["CLASS"][$index], $currency->id);
        if ($transferprice !== false) {
            $prices["transfer"] = $transferprice;
        }
    }
    return $prices;
}

/**
 * Get the API currency for the given premium domain class
 * @param array $params common module parameters
 * @param string $class the class of the domain name
 * @return string/bool the premium currency, false if not found
 */
function ispapi_getPremiumCurrency($params, $class)
{
    if (!preg_match("/\:/", $class)) {
        //REGISTRY PREMIUM DOMAIN (e.g. PREMIUM_DATE_F)
        return  ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_" . $class . "_CURRENCY");
    }
    //VARIABLE FEE PREMIUM DOMAINS (e.g. PREMIUM_TOP_CNY:24:2976)
    return preg_replace("/(^.+_|:.+$)/", "", $class);
}

/**
 * Calculate the domain premium registration price
 *
 * @param array $params common module parameters
 * @param string $class the class of the domain name
 * @param string $registerprice the price we have from CheckDoamins
 * @param integer $cur_id the currency id of the currency we have form CheckDomains
 *
 * @return integer/bool the renew price, false if not found
 */
function ispapi_getPremiumRegisterPrice($params, $class, $registerprice, $cur_id)
{
    if (!preg_match("/\:/", $class)) {
        //REGISTRY PREMIUM DOMAIN (e.g. PREMIUM_DATE_F)
        return $registerprice;// looking up relations not necessary API provided the prices
    }
    //VARIABLE FEE PREMIUM DOMAINS (e.g. PREMIUM_TOP_CNY:24:2976)
    $p = preg_split("/\:/", $class);
    $cl = preg_split("/_/", $p[0]);
    $premiummarkupfix_value = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_" . $cl[0] . "_" . $cl[1] . "_*_SETUP_MARKUP_FIX");
    $premiummarkupvar_value = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_" . $cl[0] . "_" . $cl[1] . "_*_SETUP_MARKUP_VAR");
    if ($premiummarkupfix_value && $premiummarkupvar_value) {
        $currency = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_" . $cl[0] . "_" . $cl[1] . "_*_CURRENCY");
        if ($currency !== false) {
            $currency = \WHMCS\Billing\Currency::where("code", $prices["CurrencyCode"])->first();
            if (!$currency) {
                return false;
            }
            if ($currency->id != $cur_id) {
                $premiummarkupvar_value = convertCurrency($premiummarkupvar_value, $currency->id, $cur_id);
                $premiummarkupfix_value = convertCurrency($premiummarkupfix_value, $currency->id, $cur_id);
            }
        }
        return $p[2] * (1 + $premiummarkupvar_value / 100) + $premiummarkupfix_value;
    }
    return false;
}

/**
 * Calculate the domain registration price
 *
 * @param array $params common module parameters
 * @param string $class the class of the domain name
 * @param integer $cur_id the currency of the domain name
 *
 * @return integer/bool the premium transfer price, false if not found
 */
function ispapi_getPremiumTransferPrice($params, $class, $cur_id)
{
    if (!preg_match("/\:/", $class)) {
        //REGISTRY PREMIUM DOMAIN (e.g. PREMIUM_DATE_F)
        $currency = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_" . $class . "_CURRENCY");
        if ($currency === false) {
            return false;
        }
        $currency = \WHMCS\Billing\Currency::where("code", $currency)->first();
        if (!$currency) {
            return false;
        }
        $transfer = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_" . $class . "_TRANSFER");
        // premium period is in general 1Y, no need to reflect period in calculations
        if ($transfer !== false && ($currency->id != $cur_id)) {
            return convertCurrency($transfer, $currency->id, $cur_id);
        }
        return  $transfer;
    }
    //VARIABLE FEE PREMIUM DOMAINS (e.g. PREMIUM_TOP_CNY:24:2976)
    $p = preg_split("/\:/", $class);
    $cl = preg_split("/_/", $p[0]);
    $premiummarkupfix_value = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_" . $cl[0] . "_" . $cl[1] . "_*_TRANSFER_MARKUP_FIX");
    $premiummarkupvar_value = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_" . $cl[0] . "_" . $cl[1] . "_*_TRANSFER_MARKUP_VAR");
    if ($premiummarkupfix_value && $premiummarkupvar_value) {
        $currency = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_" . $cl[0] . "_" . $cl[1] . "_*_CURRENCY");
        if ($currency !== false) {
            $currency = \WHMCS\Billing\Currency::where("code", $currency)->first();
            if (!$currency) {
                return false;
            }
            if ($currency->id != $cur_id) {
                $premiummarkupvar_value = convertCurrency($premiummarkupvar_value, $currency->id, $cur_id);
                $premiummarkupfix_value = convertCurrency($premiummarkupfix_value, $currency->id, $cur_id);
            }
        }
        return $p[1] * (1 + $premiummarkupvar_value / 100) + $premiummarkupfix_value;
    }
    return false;
}

/**
 * Calculate the premium domain renew price
 *
 * @param array $params common module parameters
 * @param string $class the class of the domain name
 * @param integer $cur_id the currency of the domain name
 *
 * @return integer/bool the premium renew price, false if not found
 */
function ispapi_getPremiumRenewPrice($params, $class, $cur_id)
{
    if (!preg_match("/\:/", $class)) {
        //REGISTRY PREMIUM DOMAIN (e.g. PREMIUM_DATE_F)
        $currency = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_" . $class . "_CURRENCY");
        if ($currency === false) {
            return false;
        }
        $currency = \WHMCS\Billing\Currency::where("code", $currency)->first();
        if (!$currency) {
            return false;
        }
        $renewprice = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_" . $class . "_ANNUAL");
        if ($renewprice && ($currency->id != $cur_id)) {
            $renewprice = convertCurrency($renewprice, $cur_id2->id, $cur_id);
        }
        return $renewprice;
    }
    //VARIABLE FEE PREMIUM DOMAINS (e.g. PREMIUM_TOP_CNY:24:2976)
    $p = preg_split("/\:/", $class);
    $cl = preg_split("/_/", $p[0]);
    $premiummarkupfix_value = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_" . $cl[0] . "_" . $cl[1] . "_*_ANNUAL_MARKUP_FIX");
    $premiummarkupvar_value = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_" . $cl[0] . "_" . $cl[1] . "_*_ANNUAL_MARKUP_VAR");
    if ($premiummarkupfix_value && $premiummarkupvar_value) {
        $currency = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_" . $cl[0] . "_" . $cl[1] . "_*_CURRENCY");
        if ($currency !== false) {
            $currency = \WHMCS\Billing\Currency::where("code", $currency)->first();
            if (!$currency) {
                return false;
            }
            if ($currency->id != $cur_id) {
                $premiummarkupvar_value = convertCurrency($premiummarkupvar_value, $currency->id, $cur_id);
                $premiummarkupfix_value = convertCurrency($premiummarkupfix_value, $currency->id, $cur_id);
            }
        }
        return $p[1] * (1 + $premiummarkupvar_value / 100) + $premiummarkupfix_value;
    }
    return false;
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
    if (empty($class)) {
        //NO PREMIUM RENEW, RETURN THE PRICE SET IN WHMCS
        $pdo = \WHMCS\Database\Capsule::connection()->getPdo();
        $stmt = $pdo->prepare("select * from tbldomainpricing tbldp, tblpricing tblp where tbldp.extension = ? and tbldp.id = tblp.relid and tblp.type = 'domainrenew' and tblp.currency=?");
        $stmt->execute(array("." . $tld, $cur_id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($data) && !in_array($data["msetupfee"], array("-1", "0"))) {
            return $data["msetupfee"];
        }
        return false;
        //API COMMAND GetTLDPricing IS TRIGERING JS ERROR AND IS UNUSABLE.
        // $gettldpricing_res = localAPI("GetTLDPricing", array("currencyid" => $cur_id));
        // $renewprice = $gettldpricing_res["pricing"][$tld]["renew"][1];
        //return !empty($renewprice) ? $renewprice : false;
    }

    return ispapi_getPremiumRenewPrice($params, $class, $cur_id);
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
    $i = 0;
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
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $date = new DateTime();
    if ((!isset($_SESSION["ISPAPICACHE"])) || ($_SESSION["ISPAPICACHE"]["TIMESTAMP"] + 600 < $date->getTimestamp() )) {
        $command["COMMAND"] = "StatusUser";
        $response = Ispapi::call($command, $params);
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
 * Undocumented function to validate user inputs in getConfigArray's form - only invoked if configuration settings are submitted
 * commenting out as things are cached, not reliable to use
 * @link https://www.whmcs.com/members/viewticket.php?tid=ESD-183344&c=wjZ1LjOs #ESD-183344
 * @param array $params common module parameters
 * @throws Exception if estabilishing the API connection failed
 */
/*function ispapi_config_validate($params)
{
    $authOk = Ispapi::checkAuth($params);
    if ($authOk===false) {
        $parts = parse_url(\WHMCS\Config\Setting::getValue("SystemURL"));
        $ip = gethostbyname($parts["host"]);
        $error = Ispapi::getAuthError();
        $url = "https://github.com/hexonet/whmcs-ispapi-registrar/wiki/FAQs#49-login-failed-in-registrar-module";
        throw new \Exception(
            <<<HTML
            <h2>Connection failed. <small>({$error})</small></h2>
            <p>Read <a href="{$url}" target="_blank" style="text-decoration:underline;">here</a> for possible reasons. <b>Your Server IP Address</b>: {$ip}</p>
HTML
        );
    }
}*/

/**
 * Return the configuration array of the module (Setup > Products / Services > Domain Registrars > ISPAPI > Configure)
 *
 * @param array $params common module parameters
 *
 * @return array $configarray configuration array of the module
 */
function ispapi_getConfigArray($params)
{
    $newModule = "ispapi";
    $oldModule = "hexonet";
    $oldConfig = \getregistrarconfigoptions($oldModule);

    if (@$_GET["migrate"]) {
        $migrate = false;
        // migrate registrar module settings
        if (!$params["Username"]) {
            $isLowerWHMCS8 = version_compare($params["whmcsVersion"], "8.0.0") === -1;
            foreach ($oldConfig as $key => $val) {
                $tmp = $val;
                if (!$isLowerWHMCS8) {
                    $r = localAPI("EncryptPassword", [
                        "password2" => $val
                    ]);
                    if ($r["result"] === "success") {
                        $tmp = $r["password"];
                    }
                }

                DB::table("tblregistrars")
                    ->where("registrar", $newModule)
                    ->where("setting", $key)
                    ->update([
                        "value" => $tmp
                    ]);
            }
            // reassign domains
            DB::table("tbldomains")->where("registrar", $oldModule)->update(["registrar" => $newModule]);
            // reassign pricing settings
            DB::table("tbldomainpricing")->where("autoreg", $oldModule)->update(["autoreg" => $newModule]);
            // deactivate built-in hexonet module
            DB::table("tblregistrars")->where("registrar", $oldModule)->delete();
        }
    } else {
        $matchingConfig = false;
        if ($params["Username"]) {
            $matchingConfig = (
                !empty($oldConfig)
                && ($oldConfig["Username"] === $params["Username"])
                && ($oldConfig["Password"] === $params["Password"])
                && ($oldConfig["TestMode"] === $params["TestMode"])
            );
        }
        $migrate = (
            (!$params["Username"] || $matchingConfig) && (
                DB::table("tbldomains")->where("registrar", $oldModule)->count() > 0
                || DB::table("tbldomainpricing")->where("autoreg", $oldModule)->count() > 0
            )
        );
    }

    $configarray = [
        "FriendlyName" => [
            "Type" => "System",
            "Value" => "ISPAPI v" . ISPAPI_MODULE_VERSION
        ],
        "Description" => [
            "Type" => "System",
            "Value" => (
                "<a target=\"_blank\" href=\"https://www.hexonet.net\">HEXONET</a>'s official maintained white-label Registrar Module." .
                ($migrate ? "<br /><a href=\"configregistrars.php?migrate=true&amp;saved=true\" class=\"btn btn-sm btn-default\" title=\"Click here to automatically migrate domains and TLD pricings related to Hexonet to this module!\">Migrate from HEXONET module</a>" : "")
            )
        ],
        "Username" => [
            "FriendlyName" => "Username",
            "Type" => "text",
            "Size" => "20",
            "Description" => "Enter your ISPAPI Login ID"
        ],
        "Password" => [
            "FriendlyName" => "Password",
            "Type" => "password",
            "Size" => "20",
            "Description" => "Enter your ISPAPI Password"
        ],
        "TestMode" => [
            "FriendlyName" => "Use Test Environment",
            "Type" => "yesno",
            "Description" => "Connect to OT&amp;E (Test Environment)"
        ],
        "ProxyServer" => [
            "FriendlyName" => "Proxy Server",
            "Type" => "text",
            "Description" => "Optional (HTTP(S) Proxy Server)"
        ],
        "IRTP" => [
            "FriendlyName" => "IRTP (Inter-Registrar Transfer Policy)",
            "Type" => "radio",
            "Options" => (
                "Check to act as Designated Agent for all contact changes. Ensure you understand your role and responsibilities before checking this option.," .
                "Check to use IRTP feature from our API."
            ),
            "Default" => "Check to act as Designated Agent for all contact changes. Ensure you understand your role and responsibilities before checking this option.",
            "Description" => (
                "General info about IRTP can be found <a target=\"_blank\" href=\"https://wiki.hexonet.net/wiki/IRTP\" style=\"border-bottom: 1px solid blue; color: blue\">here</a>. " .
                "Documentation about option one can be found <a target=\"_blank\" href=\"https://github.com/hexonet/whmcs-ispapi-registrar/wiki/Start-selling-domains-with-HEXONET-&-WHMCS#option-one\" " .
                "style=\"border-bottom: 1px solid blue; color: blue\">here</a> and option two <a target=\"_blank\" href=\"https://github.com/hexonet/whmcs-ispapi-registrar/wiki/Start-selling-domains-with-HEXONET-&-WHMCS#option-two\" " .
                "style=\"border-bottom: 1px solid blue; color: blue\">here</a>"
            )
        ],
        "TRANSFERLOCK" => [
            "FriendlyName" => "Automatic Transfer Lock",
            "Type" => "yesno",
            "Description" => "Automatically locks a Domain after Registration"
        ],
        "NSUpdTransfer" => [
            "FriendlyName" => "Automatic NS Update",
            "Type" => "yesno",
            "Description" => "Automatically update the domain's nameservers after successful transfer to the ones submitted with the order.<br/>NOTE: By default WHMCS suggests your configured Defaultnameservers in the configuration step of the shopping cart."
        ],
        "CHUpdTransfer" => [
            "FriendlyName" => "Automatic Contact Update",
            "Type" => "yesno",
            "Description" => ".com/.net/.cc/.tv: Automatically update the domain's contact details after successful transfer to the client details in case we were not able to parse data out of WHOIS data because of active id protection service.<br/>NOTE: This might lead to an IRTP contact verification."
        ],
        "DNSSEC" => [
            "FriendlyName" => "Offer DNSSEC / Secure DNS",
            "Type" => "yesno",
            "Description" => "Display the DNSSEC Management functionality in the Domain Details View."
        ],
        "TRANSFERCARTPRECHECK" => [
            "FriendlyName" => "Transfer Checkout Pre-Checks",
            "Type" => "yesno",
            "Description" => "Validate Domain Transfers on Shopping Cart Checkout. This will block the checkout until all Transfer pre-checks succeed. e.g. valid eppcode, unlocked domain etc."
        ]
    ];

    $authOk = Ispapi::checkAuth($params); //keep this line here as it generates the canUse object
    if ($authOk !== false && $authOk["WEBAPPS"]) {
        $configarray["WebApps"] = [
            "FriendlyName" => "Offer Web Apps",
            "Type" => "yesno",
            "Description" => "Enable Offering Web Apps in Domain Details View. Read <a href=\"https://www.hexonet.net/de/products/webapps\" target=\"_blank\" style=\"border-bottom: 1px solid blue; color: blue\">here</a>."
        ];
    }

    $system = $params["TestMode"] === "on" ? "OT&E" : "LIVE";
    $parts = parse_url(\WHMCS\Config\Setting::getValue("SystemURL"));
    $ip = gethostbyname($parts["host"]);

    if ($authOk === false) {
        $error = Ispapi::getAuthError();
        $url = "https://github.com/hexonet/whmcs-ispapi-registrar/wiki/FAQs#49-login-failed-in-registrar-module";
        $configarray[""] = [
            "Description" => (
                <<<HTML
                <div class="alert alert-danger" style="font-size:medium;margin-bottom:0px;">
                    <h2>Connecting to the {$system} Environment failed. <small>({$error})</small></h2>
                    <p>Read <a href="{$url}" target="_blank" class="alert-link">here</a> for possible reasons. <b>Your Server IP Address</b>: {$ip}</p>
                </div>
HTML
            )
        ];
    } else {
        $configarray[""] = [
            "Description" => (
                <<<HTML
                <div class="alert alert-success" style="font-size:medium;margin-bottom:0px;">
                    <h2>Connection to the {$system} Environment established.</h2><b>Your Server IP Address</b>: {$ip}
                </div>
HTML
            )
        ];
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
    global $smarty;

    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $domain = $params["sld"] . "." . $params["tld"];

    $data = [
        ":domain" => $domain
    ];
    $result = Helper::SQLCall("SELECT g.name FROM tblproductgroups g, tblproducts p, tblhosting h WHERE p.id = h.packageid AND p.gid = g.id AND h.domain = :domain", $data, "fetch");
    if ($result["success"]) {
        $data = $result["result"];
        if ($data["name"] == "PREMIUM DOMAIN") {
            $response = Ispapi::call([
                "COMMAND" => "StatusDomain",
                "DOMAIN" => $domain
            ], $params);
            if ($response["CODE"] == 200) {
                $smarty->assign("statusdomain", $response["PROPERTY"]);
            }
            return [
                "templatefile" => "tpl_ca_premium"
            ];
        }
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
    $params = injectDomainObjectIfNecessary($params);
    $buttonarray = [];

    if (isset($params["domainid"])) {
        $domainid = $params["domainid"];
    } elseif (!isset($_REQUEST["id"])) {
        $params = $GLOBALS["params"];
        $domainid = $params["domainid"];
    } else {
        $domainid = $_REQUEST["id"];
    }
    if (!isset($params["idprotection"], $params["dnsmanagement"])) {
        $r = Helper::SQLCall("SELECT idprotection, dnsmanagement FROM tbldomains WHERE id=:id", [":id" => $domainid], "fetch");
        if ($r["success"]) {
            $params["idprotection"] = $r["result"]["idprotection"];
            $params["dnsmanagement"] = $r["result"]["dnsmanagement"];
        }
    }
    if ($params["idprotection"]) {
        $buttonarray["WHOIS Privacy"] = "whoisprivacy";
    }
    $domain = $params["domainObj"]->getDomain();

    if (preg_match("/\.ca$/i", $domain)) {
        $buttonarray[".CA Registrant WHOIS Privacy"] = "whoisprivacy_ca";
        $buttonarray[".CA Change of Registrant"] = "registrantmodification_ca";
    } elseif (preg_match("/\.it$/i", $domain)) {
        $buttonarray[".IT Change of Registrant"] = "registrantmodification_it";
    } elseif (preg_match("/\.(ch|li|se|sg|nu)$/i", $domain)) {
        $tld = strtoupper(preg_replace("/.+\./", ".", $domain));
        $buttonarray[$tld . " Change of Registrant"] = "registrantmodification_tld";
    }
    if ($params["DNSSEC"] == "on") {
        $buttonarray["DNSSEC Management"] = "dnssec";
    }
    if ($params["dnsmanagement"]) {
        if ($params["WebApps"] && Ispapi::canUse("WEBAPPS", $params)) {
            $buttonarray["Web Apps"] = "webapps";
        }
    }
    $buttonarray["Private Nameservers List"] = "pnslist";
    return $buttonarray;
}

/**
 * Handle the WebApps management page of a domain
 *
 * @param array $params common module parameters
 *
 * @return array an array with a template name
 */
function ispapi_pnslist($params)
{
    $params = injectDomainObjectIfNecessary($params);
    $r = HXDomain::getStatus($params, $params["domainObj"]->getDomain(), true);
    return [
        "templatefile" => "tpl_ca_pnslist",
        "vars" => $r
    ];
}

/**
 * Handle the WebApps management page of a domain
 *
 * @param array $params common module parameters
 *
 * @return array an array with a template name
 */
function ispapi_webapps($params)
{
    return WebApps::getPage($params);
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
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $error = false;
    $successful = false;
    $domain = $params["sld"] . "." . $params["tld"];

    if (isset($_POST["submit"])) {
        $command = [
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain,
            "SECDNS-MAXSIGLIFE" => $_POST["MAXSIGLIFE"],
            "SECDNS-DS" => [],
            "SECDNS-KEY" => []
        ];

        //add DS and KEY records
        foreach (["SECDNS-DS", "SECDNS-KEY"] as $keyname) {
            if (isset($_POST[$keyname])) {
                foreach ($_POST[$keyname] as $dnssecrecord) {
                    $everything_empty = true;
                    foreach ($dnssecrecord as $attribute) {
                        if (!empty($attribute)) {
                            $everything_empty = false;
                        }
                    }
                    if (!$everything_empty) {
                        $command[$keyname][] = implode(" ", $dnssecrecord);
                    }
                }
            }
        }

        //remove DS records - bugfix (REASON? TICKET?)
        if (empty($command["SECDNS-DS"])) {
            unset($command["SECDNS-DS"]);
            $r = Ispapi::call([
                "COMMAND" => "StatusDomain",
                "DOMAIN" => $domain
            ], $params);
            if ($r["CODE"] == 200) {
                $command["DELSECDNS-DS"] = $r["PROPERTY"]["SECDNS-DS"];
            }
        }

        //process domain update
        $r = Ispapi::call($command, $params);
        if ($r["CODE"] == 200) {
            $successful = $r["DESCRIPTION"];
        } else {
            $error = $r["DESCRIPTION"];
        }
    }

    $maxsiglife = "";
    $secdnsds_newformat = [];
    $secdnskey_newformat = [];

    $r = Ispapi::call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain
    ], $params);

    if ($r["CODE"] == 200) {
        $r = $r["PROPERTY"];
        $maxsiglife = (isset($r["SECDNS-MAXSIGLIFE"])) ? $r["SECDNS-MAXSIGLIFE"][0] : "";
        $secdnsds = (isset($r["SECDNS-DS"])) ? $r["SECDNS-DS"] : [];
        //delete empty KEY records, if cb fn not provided, array_filter will remove empty entries
        $secdnskey = (isset($r["SECDNS-KEY"])) ? array_values(array_filter($r["SECDNS-KEY"])) : [];

        //split in different fields
        foreach ($secdnskey as $key) {
            list($flags, $protocol, $alg, $pubkey) = preg_split("/\s+/", $key);
            $secdnskey_newformat[] = [
                "flags" => $flags,
                "protocol" => $protocol,
                "alg" => $alg,
                "pubkey" => $pubkey
            ];
        }

        //split in different fields
        foreach ($secdnsds as $ds) {
            list($keytag, $alg, $digesttype, $digest) = preg_split("/\s+/", $ds);
            $secdnsds_newformat[] = [
                "keytag" => $keytag,
                "alg" => $alg,
                "digesttype" => $digesttype,
                "digest" => $digest
            ];
        }
    } else {
        $error = $r["DESCRIPTION"];
    }

    return [
        "templatefile" => "tpl_ca_dnssec",
        "vars" => [
            "error" => $error,
            "successful" => $successful,
            "secdnsds" => $secdnsds_newformat,
            "secdnskey" => $secdnskey_newformat,
            "maxsiglife" => $maxsiglife
        ]
    ];
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
    $domain = $params["sld"] . "." . $params["tld"];
    $values = array();

    $command = array(
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain
    );
    $response = Ispapi::call($command, $params);

    if ($response["CODE"] == 200) {
        $values["Registrant"] = ispapi_get_contact_info($response["PROPERTY"]["OWNERCONTACT"][0], $params);
    }

    //handle additionaldomainfields
    //------------------------------------------------------------------------------
    ispapi_include_additionaladditionalfields();

    $myadditionalfields = array();
    if (is_array($additionaldomainfields) && isset($additionaldomainfields["." . $params["tld"]])) {
        $myadditionalfields = $additionaldomainfields["." . $params["tld"]];
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
                        $command[$ctype]["STREET"] .= " , " . html_entity_decode($p["Address 2"], ENT_QUOTES);
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
            $response = Ispapi::call($command, $origparams);

            if ($response["CODE"] == 200) {
                $successful = $response["DESCRIPTION"];
            } else {
                $error = $response["DESCRIPTION"];
            }
        }
    }

    return [
        "templatefile" => "tpl_ca_regmod_it",
        "vars" => [
            "error" => $error,
            "successful" => $successful,
            "values" => $values,
            "additionalfields" => $myadditionalfields
        ]
    ];
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
    $domain = $params["sld"] . "." . $params["tld"];

    $values = array();

    $command = array(
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain
    );
    $response = Ispapi::call($command, $params);

    if ($response["CODE"] == 200) {
        $values["Registrant"] = ispapi_get_contact_info($response["PROPERTY"]["OWNERCONTACT"][0], $params);
    }

    //handle additionaldomainfields
    //------------------------------------------------------------------------------
    ispapi_include_additionaladditionalfields();

    $myadditionalfields = array();
    if (is_array($additionaldomainfields) && isset($additionaldomainfields["." . $params["tld"]])) {
        $myadditionalfields = $additionaldomainfields["." . $params["tld"]];
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
                        $command[$ctype]["STREET"] .= " , " . html_entity_decode($p["Address 2"], ENT_QUOTES);
                    }
                }
            }

            if (preg_match("/\.se$/i", $domain)) {
                //check if the checkbox has been checked.
                if (!$_POST["se-checkbox"] == "on") {
                    $error = "Please confirm that you will send the form back to complete the process";
                }
            }
            if (!$error) {
                $params["additionalfields"] = $_POST["additionalfields"];
                ispapi_use_additionalfields($params, $command);
                $response = Ispapi::call($command, $origparams);

                if ($response["CODE"] == 200) {
                    $successful = $response["DESCRIPTION"];
                } else {
                    $error = $response["DESCRIPTION"];
                }
            }
    }

    return [
        "templatefile" => "tpl_ca_regmod",
        "vars" => [
            "error" => $error,
            "successful" => $successful,
            "values" => $values,
            "additionalfields" => $myadditionalfields
        ]
    ];
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
    $domain = $params["sld"] . "." . $params["tld"];
    $values = array();


    //handle additionaldomainfields
    //------------------------------------------------------------------------------
    ispapi_include_additionaladditionalfields();

    $myadditionalfields = array();
    if (is_array($additionaldomainfields) && isset($additionaldomainfields["." . $params["tld"]])) {
        $myadditionalfields = $additionaldomainfields["." . $params["tld"]];
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
    $response = Ispapi::call($command, $params);

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
                    $command[$ctype]["STREET"] .= " , " . html_entity_decode($p["Address 2"], ENT_QUOTES);
                }
            }
        }
        $params["additionalfields"]["Legal Type"] = $_POST["additionalfields"]["Legal Type"];
        $params["additionalfields"]["WHOIS Opt-out"] = $_POST["additionalfields"]["WHOIS Opt-out"];

        ispapi_use_additionalfields($params, $command);

        $response = Ispapi::call($command, $origparams);

        if ($response["CODE"] == 200) {
            $successful = $response["DESCRIPTION"];
        } else {
            $error = $response["DESCRIPTION"];
        }
    }

    // replace values with post values
    if (isset($_POST["submit"])) {
        $newvalues["Registrant"] = $_POST["contactdetails"]["Registrant"];
        $newvalues["Legal Type"] = $_POST["additionalfields"]["Legal Type"];
        $newvalues["WHOIS Opt-out"] = $_POST["additionalfields"]["WHOIS Opt-out"];
        $values = $newvalues;
    }

    return [
        "templatefile" => "tpl_ca_regmod_ca",
        "vars" => [
            "error" => $error,
            "successful" => $successful,
            "values" => $values,
            "additionalfields" => $myadditionalfields
        ]
    ];
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
    $domain = $params["sld"] . "." . $params["tld"];

    if (isset($_REQUEST["idprotection"])) {
        $command = array(
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain,
            "X-ACCEPT-WHOISTRUSTEE-TAC" => ($_REQUEST["idprotection"] == "enable") ? "1" : "0"
        );
        $response = Ispapi::call($command, $params);
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
    $response = Ispapi::call($command, $params);
    if ($response["CODE"] == 200) {
        if (isset($response["PROPERTY"]["X-ACCEPT-WHOISTRUSTEE-TAC"])) {
            if ($response["PROPERTY"]["X-ACCEPT-WHOISTRUSTEE-TAC"][0]) {
                $protected = 1;
            }
        }
    } elseif (!$error) {
        $error = $response["DESCRIPTION"];
    }

    return [
        "templatefile" => "tpl_ca_whoisprivacy",
        "vars" => [
            "error" => $error,
            "protected" => $protected
        ]
    ];
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
    $domain = $params["sld"] . "." . $params["tld"];
    $protected = 1;
    $protectable = 0;
    $legaltype = "";
    $apicfg = $params;
    $r = Ispapi::call(array(
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain
    ), $apicfg);
    if ($r["CODE"] == 200) {
        $protected = (isset($r["PROPERTY"]["X-CA-DISCLOSE"]) && $r["PROPERTY"]["X-CA-DISCLOSE"][0]) ? 0 : 1;//inverse logic???
        $registrant = $r["PROPERTY"]["OWNERCONTACT"][0];
        if (isset($r["PROPERTY"]["X-CA-LEGALTYPE"])) {
            $legaltype = $r["PROPERTY"]["X-CA-LEGALTYPE"][0];
        }
    } else {
        $error = $r["DESCRIPTION"];
    }
    if (preg_match("/^(CCT|RES|ABO|LGR)$/i", $legaltype)) {
        $protectable = 1;
    }
    if (isset($_REQUEST["idprotection"])) {
        $r = Ispapi::call(array(
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain,
            "X-CA-DISCLOSE" => ($_REQUEST["idprotection"] == "enable") ? "0" : "1"//inverse logic???
        ), $apicfg);
        if ($r["CODE"] == 200) {
            return false;
        } else {
            $error = $r["DESCRIPTION"];
        }
    }
    return [
        "templatefile" => "tpl_ca_whoisprivacy_ca",
        "vars" => [
            "error" => $error,
            "protected" => $protected,
            "protectable" => $protectable,
            "legaltype" => $legaltype
        ]
    ];
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
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $domain = $params["sld"] . "." . $params["tld"];

    // NOTE: returning an error still shows up as "unlocked"
    // Removing the menu entry by hook therefore ftw.
    return HXDomain::getRegistrarLock($params, $domain);
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
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $domain = $params["sld"] . "." . $params["tld"];

    $result = HXDomain::saveRegistrarLock($params, $domain);
    logActivity(isset($result["error"]) ? $result["error"] : $result["success"]);
    return $result;
}

/**
 * Returns domain's information
 *
 * @param array $params common module parameters
 *
 * @return array $values - returns true
 */
function ispapi_GetDomainInformation($params)
{
    //code optimization on getting nameservers and transferLock setting (applicable since WHMCS 7.6)
    //we kept the GetNameservers(), GetRegistrarLock() for the users with < WHMCS 7.6
    $params = ispapi_get_utf8_params($params);
    $domain = $params["domainObj"]->getDomain();

    $r = HXDomainTransfer::getStatus($params, $domain);
    if ($r["success"]) {
        $thedomain = new \WHMCS\Domain\Registrar\Domain();
        $thedomain
            ->setDomain($domain)
            ->setNameservers(Ispapi::castNameservers($r["data"]["NAMESERVER"]));
        return $thedomain;
    }

    $r = HXDomain::getStatus($params, $domain);
    if ($r["success"] !== true) {
        if ($r["errorcode"] === "531") {
            throw new \Exception("Domain no longer in management - probably transferred away.");
        }

        if ($r["errorcode"] !== "545") {
            throw new \Exception("Loading Domain information failed. You may retry in few minutes.<br/><small>" . $r["errorcode"] . " " . $r["error"] . "</small>");
        }

        $r = HXApplication::getStatus($params, $domain);
        if ($r["success"] && !empty($r["data"]["STATUS"][0])) {
            switch ($r["data"]["STATUS"][0]) {
                case "FAILED":
                    throw new \Exception("Premium Domain order failed.");
                    break;
                case "ACTIVE":
                case "SUCCESSFUL":
                    throw new \Exception("Premium Domain order succeeded. Will be soon in your Account.");
                    break;
                default:
                    throw new \Exception("Premium Domain order is pending. Check back again later.");
                    break;
            }
        }

        $status = DB::table("tbldomains")
            ->where("id", $params["domainid"])
            ->value("status");
        if ($status === "Pending") {
            $thedomain = new \WHMCS\Domain\Registrar\Domain();
            $thedomain->setDomain($domain);
            return $thedomain;
        }

        $rconv = HXDomain::convert($params, $domain);
        $domainstr = $rconv["punycode"];
        $values = HXDomain::getExpiredStatus($params, $domainstr, null, false);
        if (isset($values["transferredAway"]) && $values["transferredAway"] === true) {
            throw new \Exception("Domain no longer in management - probably transferred away.");
        }
        if (isset($values["expired"]) && isset($values["expirationdate"])) {
            if ($values["expired"] === true) {
                // in redemption period
                throw new \Exception("Domain expired, but is still renewable leading to redemption fees.");
            }
            // in ARGP
            throw new \Exception("Domain expired, but is still renewable.");
        }
        if (isset($values["expired"]) && $values["expired"] === true) {
            // expired, deleted
            $params["searchTerm"] = $params["sld"];
            $params["tldsToInclude"] = [$params["tld"]];
            $ac = ispapi_CheckAvailability($params);
            $ac = array_pop($ac->toArray());
            $msg = "Domain not found in Registrar's System. ";
            switch ($ac["status"]) {
                case SR::STATUS_NOT_REGISTERED:
                    $msg .= "Available for registration.";
                    break;
                case SR::STATUS_RESERVED:
                    $msg .= "Reserved Domain Name.";
                    break;
                case SR::STATUS_TLD_NOT_SUPPORTED:
                    $msg .= "TLD not supported.";
                    break;
                case SR::STATUS_REGISTERED:
                    $msg .= "Not available for registration.";
                    break;
                default:
                    $msg = "Eventually available for registration.";
                    break;
            }
            throw new \Exception($msg);
        }
        throw new \Exception("Loading Domain information failed. You may retry in few minutes.");
    }

    // get data: expired, expirydate, active
    $values = HXDomain::getExpiryData($params, $domain, false, $r, true);

    $r = $r["data"];
    //nameservers
    $values["nameservers"] = Ispapi::castNameservers($r["NAMESERVER"]);
    //transferlock settings
    $values["setIrtpTransferLock"] = isset($r["TRADE-TRANSFERLOCK-EXPIRATIONDATE"][0]);
    $values["transferlock"] = (isset($r["TRANSFERLOCK"][0]) && $r["TRANSFERLOCK"][0] === "1");

    //IRTP handling
    $isAffectedByIRTP = HXDomain::needsIRTPForRegistrantModification($params, $domain);
    $values["contactChangeExpiryDate"] = null;
    $values["setDomainContactChangePending"] = false;
    $values["setPendingSuspension"] = false;
    $values["setIsIrtpEnabled"] = false;
    if (preg_match("/Designated Agent/", $params["IRTP"]) && $isAffectedByIRTP) {
        //setIsIrtpEnabled
        $values["setIsIrtpEnabled"] = true;

        //setDomainContactChangePending
        $r2 = Ispapi::call([
            "COMMAND" => "QueryDomainPendingRegistrantVerificationList",
            "DOMAIN" => $domain
        ], $params);

        if ($r2["CODE"] === "200") {
            $r2 = $r2["PROPERTY"];
            //check if registrant change has been requested
            $rTrade = Ispapi::call([
                "COMMAND" => "StatusDomainTrade",
                "DOMAIN" => $domain
            ], $params);
            if (
                ($rTrade["CODE"] === "200")
                && isset($r2["X-REGISTRANT-VERIFICATION-STATUS"][0])
                && preg_match("/^(PENDING|OVERDUE)$/i", $r2["X-REGISTRANT-VERIFICATION-STATUS"][0])
            ) {
                $values["setDomainContactChangePending"] = true;
                $values["setPendingSuspension"] = true;
            }
            //setDomainContactChangeExpiryDate
            if (isset($r["X-REGISTRANT-VERIFICATION-DUEDATE"][0])) {
                $values["contactChangeExpiryDate"] = Ispapi::castDate($r2["X-REGISTRANT-VERIFICATION-DUEDATE"][0]);
                $values["contactChangeExpiryDate"] = \WHMCS\Carbon::createFromFormat("Y-m-d H:i:s", $values["contactChangeExpiryDate"]["long"]);
            }
        }
    }

    // Docs:
    // https://classdocs.whmcs.com/8.1/WHMCS/Domain/Registrar/Domain.html
    // https://developers.whmcs.com/domain-registrars/domain-information/
    // https://carbon.nesbot.com/docs/
    $thedomain = new \WHMCS\Domain\Registrar\Domain();
    $thedomain
        ->setDomain($domain)
        ->setNameservers($values["nameservers"])
        //->setRegistrationStatus($response["status"])
        ->setTransferLock($values["transferlock"])
        //->setTransferLockExpiryDate(null)
        ->setExpiryDate($values["expirydate"])
        //->setRestorable(false)
        ->setIdProtectionStatus($values["idprotection"])
        //->setDnsManagementStatus($response["addons"]["hasdnsmanagement"])
        //->setEmailForwardingStatus($response["addons"]["hasemailforwarding"])
        ->setIsIrtpEnabled($values["setIsIrtpEnabled"])
        ->setIrtpTransferLock($values["setIrtpTransferLock"])
        //->IrtpTransferLockExpiryDate($irtpTransferLockExpiryDate)
        //-- ->setIrtpOptOutStatus(false)
        ->setDomainContactChangePending($values["setDomainContactChangePending"])
        ->setPendingSuspension($values["setPendingSuspension"])
        ->setDomainContactChangeExpiryDate($values["contactChangeExpiryDate"])
        //->setRegistrantEmailAddress($response["registrant"]["email"])
        ->setIrtpVerificationTriggerFields(
            [
                "Registrant" => [
                    "First Name",
                    "Last Name",
                    "Organization Name",
                    "Email",
                ]
            ]
        );
    return $thedomain;
}
/**
 * Resend verification email
 *
 * @param array $params common module parameters
 *
 * @return array returns success or error
 */
function ispapi_ResendIRTPVerificationEmail($params)
{
    $r = Ispapi::call([
        "COMMAND" => "ResendDomainTransferConfirmationEmails",
        "DOMAIN" => $params["sld"] . "." . $params["tld"]
    ], $params);
    if ($r["CODE"] !== "200") {
        return ["error" => $r["DESCRIPTION"]];
    }
    return ["success" => true];
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
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $domain = $params["sld"] . "." . $params["tld"];
    $r = HXDomain::getAuthCode($params, $domain);
    logActivity($domain . ": " . (isset($r["error"]) ? $r["error"] : "Successfully loaded the epp code."));
    return $r;
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
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $r = Ispapi::call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $params["sld"] . "." . $params["tld"]
    ], $params);
    if ($r["CODE"] === "200") {
        //no findings for htmlspecialchars in other registrar modules, looks like this got fixed
        return Ispapi::castNameservers($r["PROPERTY"]["NAMESERVER"]);
    }
    return [
        "error" => $r["DESCRIPTION"]
    ];
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
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $r = Ispapi::call([
        "COMMAND" => "ModifyDomain",
        "DOMAIN" => $params["sld"] . "." . $params["tld"],
        "NAMESERVER" => Ispapi::castNameserversBE($params),
        "INTERNALDNS" => (int)$params["dnsmanagement"]
    ], $params);
    if ($r["CODE"] !== "200") {
        $error = $r["DESCRIPTION"];
        if ($r["CODE"] === "504" && preg_match("/TOO FEW.+CONTACTS/", $values["error"])) {
            $error = "Please update contact data first to be able to update nameserver data.";
        }
        return [
            "error" => $error
        ];
    }
    return [
        "success" => true
    ];
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
    $dnszone = $params["sld"] . "." . $params["tld"] . ".";
    $domain = $params["sld"] . "." . $params["tld"];

    //convert the dnszone in idn
    $command = array(
            "COMMAND" => "ConvertIDN",
            "DOMAIN" => $domain
    );
    $response = Ispapi::call($command, $params);
    $dnszone_idn = $response["PROPERTY"]["ACE"][0] . ".";

    $command = array(
            "COMMAND" => "QueryDNSZoneRRList",
            "DNSZONE" => $dnszone,
            "EXTENDED" => 1
    );
    $response = Ispapi::call($command, $params);
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
            $domain = str_replace("." . $dnszone_idn, "", $domain);

            if ($rrtype == "A") {
                $hostrecords[$i] = array( "hostname" => $domain, "type" => $rrtype, "address" => $fields[0], );
                if (preg_match("/^mxe-host-for-ip-(\d+)-(\d+)-(\d+)-(\d+)$/i", $domain, $m)) {
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
                if (preg_match("/^\//", $fields[0])) {
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
        $response = Ispapi::call($command, $params);
        if ($response["CODE"] == 200) {
            foreach ($response["PROPERTY"]["RR"] as $rr) {
                $fields = explode(" ", $rr);
                $domain = array_shift($fields);
                $ttl = array_shift($fields);
                $class = array_shift($fields);
                $rrtype = array_shift($fields);

                if ($rrtype == "MX") {
                    if (preg_match("/^mxe-host-for-ip-(\d+)-(\d+)-(\d+)-(\d+)($|\.)/i", $fields[1], $m)) {
                        $hostrecords[$i] = array( "hostname" => $domain, "type" => "MXE", "address" => $m[1] . "." . $m[2] . "." . $m[3] . "." . $m[4], );
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
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $dnszone = $params["sld"] . "." . $params["tld"] . ".";
    $domain = $params["sld"] . "." . $params["tld"];

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
                    $priority = 0;
                }
                array_push($command["DELRR"], "% SRV");
                $command["ADDRR"][] = "$hostname $type $priority $address";
            }
            if ($type == "MXE") {
                $mxpref = 100;
                if (preg_match("/^([0-9]+) (.*)$/", $address, $m)) {
                    $mxpref = $m[1];
                    $address = $m[2];
                }
                if (preg_match("/^([0-9]+)$/", $priority)) {
                    $mxpref = $priority;
                }

                if (preg_match("/^(\d+)\.(\d+)\.(\d+)\.(\d+)$/", $address, $m)) {
                    $mxe_host = "mxe-host-for-ip-$m[1]-$m[2]-$m[3]-$m[4]";
                    $ip = $m[1] . "." . $m[2] . "." . $m[3] . "." . $m[4];
                    $mxe_hosts[$ip] = $mxe_host;
                    $command["ADDRR"][] = "$hostname MX $mxpref $mxe_host";
                } else {
                    $address = "$mxpref $address";
                    $type = "MX";
                }
            }
            if ($type == "MX") {
                $mxpref = 100;
                if (preg_match("/^([0-9]+) (.*)$/", $address, $m)) {
                    $mxpref = $m[1];
                    $address = $m[2];
                }
                if (preg_match("/^([0-9]+)$/", $priority)) {
                    $mxpref = $priority;
                }

                $command["ADDRR"][] = "$hostname $type $mxpref $address";
            }
            if ($type == "FRAME") {
                $redirect = "FRAME";
                if (preg_match("/^([^\/]+)(.*)$/", $hostname, $m)) {
                    $hostname = $m[1];
                    $redirect = $m[2] . " " . $redirect;
                }
                $command["ADDRR"][] = "$hostname X-HTTP $redirect $address";
            }
            if ($type == "URL") {
                $redirect = "REDIRECT";
                if (preg_match("/^([^\/]+)(.*)$/", $hostname, $m)) {
                    $hostname = $m[1];
                    $redirect = $m[2] . " " . $redirect;
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
    $response = Ispapi::call($command2, $params);

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
    $response = Ispapi::call($command, $params);

    //if DNS Zone not existing, create one automatically
    if ($response["CODE"] == 545) {
        $creatednszone_command = array(
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain,
            "INTERNALDNS" => 1
        );
        $creatednszone = Ispapi::call($creatednszone_command, $params);
        if ($creatednszone["CODE"] == 200) {
            //resend command to update DNS Zone
            $response = Ispapi::call($command, $params);
        }
    }

    if ($response["CODE"] != 200) {
        return [
            "error" => $response["DESCRIPTION"]
        ];
    }
    return [
        "success" => "success"
    ];
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
    $dnszone = $params["sld"] . "." . $params["tld"] . ".";

    $command = array(
        "COMMAND" => "QueryDNSZoneRRList",
        "DNSZONE" => $dnszone,
        "SHORT" => 1,
        "EXTENDED" => 1
    );
    $response = Ispapi::call($command, $params);

    $result = array();

    if ($response["CODE"] == 200) {
        foreach ($response["PROPERTY"]["RR"] as $rr) {
            $fields = explode(" ", $rr);
            $domain = array_shift($fields);
            $ttl = array_shift($fields);
            $class = array_shift($fields);
            $rrtype = array_shift($fields);

            if (($rrtype == "X-SMTP") && ($fields[1] == "MAILFORWARD")) {
                if (preg_match("/^(.*)\@$/", $fields[0], $m)) {
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

    $dnszone = $params["sld"] . "." . $params["tld"] . ".";

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
            $redirect = $prefix . "@ " . $redirect;
            $command["ADDRR"][] = "@ X-SMTP $redirect $target";
        }
    }

    $response = Ispapi::call($command, $params);

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

    $domain = $params["sld"] . "." . $params["tld"];
    $values = array();
    $command = array(
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain
    );
    $response = Ispapi::call($command, $params);

    if ($response["CODE"] == 200) {
        $values["Registrant"] = ispapi_get_contact_info($response["PROPERTY"]["OWNERCONTACT"][0], $params);
        $values["Admin"] = ispapi_get_contact_info($response["PROPERTY"]["ADMINCONTACT"][0], $params);
        $values["Technical"] = ispapi_get_contact_info($response["PROPERTY"]["TECHCONTACT"][0], $params);
        $values["Billing"] = ispapi_get_contact_info($response["PROPERTY"]["BILLINGCONTACT"][0], $params);
        if (preg_match("/\.(ca|it|ch|li|se|sg)$/i", $domain)) {
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
    if (!function_exists("convertStateToCode")) {
        require implode(DIRECTORY_SEPARATOR, [ROOTDIR, "includes", "clientfunctions.php"]);
    }
    // TODO:---------- EXCEPTION [BEGIN] --------
    // $params has invalid chars for idn domain names where $params["original"] is fine [kschwarz]
    // JIRA #HM-709
    // WHMCS #YOV-471189 (unconfirmed)
    $origparams = $params;
    $params = ispapi_get_utf8_params($params);
    //--------------- EXCEPTION [END] -----------

    $params = injectDomainObjectIfNecessary($params);
    $domain = $params["domainObj"]->getDomain();

    global $additionaldomainfields;
    $values = array();

    $status_response = Ispapi::call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain
    ], $origparams);
    if ($status_response["CODE"] != 200) {
        return [
            "error" => $status_response["DESCRIPTION"]
        ];
    }
    $isAffectedByIRTP = HXDomain::needsIRTPForRegistrantModification($params, $domain);

    $registrant = ispapi_get_contact_info($status_response["PROPERTY"]["OWNERCONTACT"][0], $params);
    if (isset($origparams["contactdetails"]["Registrant"])) {
        $new_registrant = $origparams["contactdetails"]["Registrant"];
    }

    //the following conditions must be true to trigger registrant change request (IRTP)
    if (
        preg_match("/Designated Agent/", $params["IRTP"]) &&
        $isAffectedByIRTP && (
            $registrant["First Name"] != $new_registrant["First Name"] ||
            $registrant["Last Name"] != $new_registrant["Last Name"] ||
            $registrant["Company Name"] != $new_registrant["Company Name"] ||
            $registrant["Email"] != $new_registrant["Email"]
        )
    ) {
        $command = array(
            "COMMAND" => "TradeDomain",
            "DOMAIN" => $domain,
            "OWNERCONTACT0" => $new_registrant,
            "X-CONFIRM-DA-OLD-REGISTRANT" => 1,
            "X-CONFIRM-DA-NEW-REGISTRANT" => 1,
        );

        //some of the AFNIC TLDs(.fr, .pm, .re, .pm, .tf, .yt) require local presence. eg: "X-FR-ACCEPT-TRUSTEE-TAC" => 1
        ispapi_query_additionalfields($params);
        ispapi_use_additionalfields($params, $command);

        //opt-out is not supported for AFNIC TLDs (eg: .FR)
        $queryDomainOptions_response = Ispapi::call([
            "COMMAND" => "QueryDomainOptions",
            "DOMAIN0" => $domain
        ], $origparams);
        //AFNIC TLDs => pm, tf, wf, yt, fr, re
        if (!preg_match("/AFNIC/i", $queryDomainOptions_response["PROPERTY"]["REPOSITORY"][0])) {
            if ($origparams["irtpOptOut"]) { //HM-735
                $command["X-REQUEST-OPT-OUT-TRANSFERLOCK"] = 1;
            } else {
                $command["X-REQUEST-OPT-OUT-TRANSFERLOCK"] = 0;
            }
        }
    } else {
        $command = array(
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain
        );
    }

    $map = array(
        "OWNERCONTACT0" => "Registrant",
        "ADMINCONTACT0" => "Admin",
        "TECHCONTACT0" => "Technical",
        "BILLINGCONTACT0" => "Billing",
    );

    //bug in WHMCS since 6.1, $params["original"] is completely stripped, we will take the $_POST array to have the unstipped version
    $unstrippedparams = $_POST;

    $isCA = preg_match("/\.ca$/i", $domain);
    foreach ($map as $ctype => $ptype) {
        //when using "Use Existing Contact" function in WHMCS, the $_POST array is empty, so we have to use the $params version.
        //in this case the special characters will be replaced due to the default transliteration hook. (https://docs.whmcs.com/Custom_Transliteration)
        //workarround for customers will be to deactivate the transliteration hook.
        //once this issue has been fixed on WHMCS side we will release a new version which will support special characters in each cases.
        if (array_key_exists("First Name", $unstrippedparams["contactdetails"][$ptype])) {
            $p = $unstrippedparams["contactdetails"][$ptype];
        } else {
            $p = $origparams["contactdetails"][$ptype];
        }

        $command[$ctype] = array(
            "FIRSTNAME" => html_entity_decode($p["First Name"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "LASTNAME" => html_entity_decode($p["Last Name"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "ORGANIZATION" => html_entity_decode($p["Company Name"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "STREET" => html_entity_decode($p["Address"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "CITY" => html_entity_decode($p["City"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "STATE" => html_entity_decode($p["State"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "ZIP" => html_entity_decode($p["Postcode"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "COUNTRY" => html_entity_decode($p["Country"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "PHONE" => html_entity_decode($p["Phone"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "FAX" => html_entity_decode($p["Fax"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "EMAIL" => html_entity_decode($p["Email"], ENT_QUOTES | ENT_XML1, "UTF-8"),
        );
        if (strlen($p["Address 2"])) {
            $command[$ctype]["STREET"] .= " , " . html_entity_decode($p["Address 2"], ENT_QUOTES | ENT_XML1, "UTF-8");
        }
        $command[$ctype]["STATE"] = convertStateToCode($command[$ctype]["STATE"], $command[$ctype]["COUNTRY"]);
        if ($isCA) {//converttociracode
            if ($command[$ctype]["STATE"] == "YT") {
                $command[$ctype]["STATE"] = "YK";
            }
        }
    }

    if (preg_match("/\.(it|ch|li|se|sg)$/i", $domain)) {
        unset($command["OWNERCONTACT0"]["FIRSTNAME"]);
        unset($command["OWNERCONTACT0"]["LASTNAME"]);
        unset($command["OWNERCONTACT0"]["ORGANIZATION"]);

        $status_command = array(
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain
        );
        $status_response = Ispapi::call($status_command, $origparams);

        if ($status_response["CODE"] != 200) {
            return [
                "error" => $status_response["DESCRIPTION"]
            ];
        }

        $registrant = ispapi_get_contact_info($status_response["PROPERTY"]["OWNERCONTACT"][0], $params);
        $command["OWNERCONTACT0"]["FIRSTNAME"] = $registrant["First Name"];
        $command["OWNERCONTACT0"]["LASTNAME"] = $registrant["Last Name"];
        $command["OWNERCONTACT0"]["ORGANIZATION"] = $registrant["Company Name"];
    }

    if ($isCA) {
        $registrant_command = $command["OWNERCONTACT0"];

        $status_command = array(
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain
        );
        $status_response = Ispapi::call($status_command, $origparams);

        if ($status_response["CODE"] != 200) {
            $values["error"] = $status_response["DESCRIPTION"];
            return $values;
        }

        $registrant_command["COMMAND"] = "ModifyContact";
        $registrant_command["CONTACT"] = $status_response["PROPERTY"]["OWNERCONTACT"][0];

        if (!preg_match("/^AUTO\-/i", $registrant_command["CONTACT"])) {
            unset($registrant_command["FIRSTNAME"]);
            unset($registrant_command["LASTNAME"]);
            unset($registrant_command["ORGANIZATION"]);
            $registrant_response = Ispapi::call($registrant_command, $origparams);

            if ($registrant_response["CODE"] != 200) {
                $values["error"] = $registrant_response["DESCRIPTION"];
                return $values;
            }
            unset($command["OWNERCONTACT0"]);
        }

        ispapi_query_additionalfields($params);
        ispapi_use_additionalfields($params, $command);
    }

    $response = Ispapi::call($command, $origparams);

    if ($response["CODE"] != 200) {
        return [
            "error" => $response["DESCRIPTION"]
        ];
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

    $command = array(
        "COMMAND" => "AddNameserver",
        "NAMESERVER" => $params["nameserver"],
        "IPADDRESS0" => $params["ipaddress"],
    );
    $response = Ispapi::call($command, $params);
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

    $command = array(
        "COMMAND" => "ModifyNameserver",
        "NAMESERVER" => $params["nameserver"],
        "DELIPADDRESS0" => $params["currentipaddress"],
        "ADDIPADDRESS0" => $params["newipaddress"],
    );
    $response = Ispapi::call($command, $params);
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

    $command = array(
        "COMMAND" => "DeleteNameserver",
        "NAMESERVER" => $params["nameserver"]
    );
    $response = Ispapi::call($command, $params);
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
    $domain = $params["sld"] . "." . $params["tld"];

    $command = array(
        "COMMAND" => "ModifyDomain",
        "DOMAIN" => $domain,
        "X-ACCEPT-WHOISTRUSTEE-TAC" => ($params["protectenable"]) ? "1" : "0"
    );
    $response = Ispapi::call($command, $params);
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

    $premiumDomainsEnabled = (bool) $params["premiumEnabled"];
    $premiumDomainsCost = $params["premiumCost"];

    $params = ispapi_get_utf8_params($params);

    $domain = $params["sld"] . "." . $params["tld"];

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
        $registrant["STREET"] .= " , " . $params["address2"];
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
        $admin["STREET"] .= " , " . $params["adminaddress2"];
    }

    $command = array(
        "COMMAND" => "AddDomain",
        "DOMAIN" => $domain,
        "PERIOD" => $params["regperiod"],
        "NAMESERVER" => Ispapi::castNameserversBE($params),
        "OWNERCONTACT0" => $registrant,
        "ADMINCONTACT0" => $admin,
        "TECHCONTACT0" => $admin,
        "BILLINGCONTACT0" => $admin
    );
    if ($params["TRANSFERLOCK"]) {
        $command["TRANSFERLOCK"] = 1;
    }
    if ($params["dnsmanagement"]) {
        $command["INTERNALDNS"] = 1;
    }
    if ($params["idprotection"]) {
        $command["X-ACCEPT-WHOISTRUSTEE-TAC"] = 1;
    }

    if (preg_match("/\.swiss$/i", $domain)) {
        $command["COMMAND"] = "AddDomainApplication";
        $command["CLASS"] = "GOLIVE";
        //INTERNALDNS, WHOIS privacy service, transferlock parameter is not supported in AddDomainApplication command
        //TODO: we need to sync transfer lock later
        unset($command["INTERNALDNS"]);
        unset($command["X-ACCEPT-WHOISTRUSTEE-TAC"]);
        unset($command["TRANSFERLOCK"]);
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
            $check = Ispapi::call($c, $origparams);
            if ($check["CODE"] == 200) {
                $registrar_premium_domain_price = $check["PROPERTY"]["PRICE"][0];
                $registrar_premium_domain_class = empty($check["PROPERTY"]["CLASS"][0]) ? "AFTERMARKET_PURCHASE_" . $check["PROPERTY"]["PREMIUMCHANNEL"][0] : $check["PROPERTY"]["CLASS"][0];
                $registrar_premium_domain_currency = $check["PROPERTY"]["CURRENCY"][0];

                if ($premiumDomainsCost == $registrar_premium_domain_price) { //check if the price displayed to the customer is equal to the real cost at the registar
                    $command["COMMAND"] = "AddDomainApplication";
                    $command["CLASS"] =  $registrar_premium_domain_class;
                    $command["PRICE"] =  $premiumDomainsCost;
                    $command["CURRENCY"] = $registrar_premium_domain_currency;
                    //INTERNALDNS, WHOIS privacy service, transferlock parameter is not supported in AddDomainApplication command
                    unset($command["INTERNALDNS"]);
                    unset($command["X-ACCEPT-WHOISTRUSTEE-TAC"]);
                    unset($command["TRANSFERLOCK"]);
                }
            }
        }
    }
    //#####################################################################
    $response = Ispapi::call($command, $origparams);

    if ($response["CODE"] != 200) {
        $values["error"] = $response["DESCRIPTION"];
    }

    if (preg_match("/\.swiss$/i", $domain)) {
        if ($response["CODE"] == 200) {
            $application_id = $response["PROPERTY"]["APPLICATION"][0];
            $values["error"] = "APPLICATION <#" . $application_id . "#> SUCCESSFULLY SUBMITTED. STATUS SET TO PENDING UNTIL THE SWISS REGISTRATION PROCESS IS COMPLETED";
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
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    $premiumDomainsEnabled = (bool) $params["premiumEnabled"];
    $premiumDomainsCost = $params["premiumCost"];

    //domain transfer pre-check
    $command = [
        "COMMAND" => "CheckDomainTransfer",
        "DOMAIN" => $domain->getDomain()
    ];
    if ($params["eppcode"]) {
        $command["AUTH"] = $params["eppcode"];
    }
    $r = Ispapi::call($command, $params);

    if ($r["CODE"] != 218) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }

    if (isset($r["PROPERTY"]["AUTHISVALID"]) && $r["PROPERTY"]["AUTHISVALID"][0] == "NO") {
        // return custom error message
        return [
            "error" => "Invaild Authorization Code"
        ];
    }

    if (isset($r["PROPERTY"]["TRANSFERLOCK"]) && $r["PROPERTY"]["TRANSFERLOCK"][0] == "1") {
        // return custom error message
        return [
            "error" => "Transferlock is active. Therefore the Domain cannot be transferred."
        ];
    }

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
        $registrant["STREET"] .= " , " . $params["address2"];
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
        $admin["STREET"] .= " , " . $params["adminaddress2"];
    }

    $command = [
        "COMMAND" => "TransferDomain",
        "DOMAIN" => $domain->getDomain(),
        "PERIOD" => $params["regperiod"],
        "NAMESERVER" => Ispapi::castNameserversBE($params),
        "OWNERCONTACT0" => $registrant,
        "ADMINCONTACT0" => $admin,
        "TECHCONTACT0" => $admin,
        "BILLINGCONTACT0" => $admin,
        "AUTH" => $params["eppcode"]
    ];
    if (isset($r["PROPERTY"]["USERTRANSFERREQUIRED"]) && $r["PROPERTY"]["USERTRANSFERREQUIRED"][0] == "1") {
        //auto-detect user-transfer
        $command["ACTION"] = "USERTRANSFER";
    }

    //1) don't send owner admin tech billing contact for .NU .DK .CA, .US, .PT, .NO, .SE, .ES domains
    //2) do not send contact information for gTLD (Including nTLDs)
    if (preg_match("/\.([a-z]{3,}|nu|dk|ca|us|pt|no|se|es)$/i", $domain->getDomain())) {
        unset($command["OWNERCONTACT0"]);
        unset($command["ADMINCONTACT0"]);
        unset($command["TECHCONTACT0"]);
        unset($command["BILLINGCONTACT0"]);
    }

    //don't send owner billing contact for .FR domains
    if (preg_match("/\.(fr|pm|re|tf|wf|yt)$/i", $domain->getDomain())) {
        unset($command["OWNERCONTACT0"]);
        unset($command["BILLINGCONTACT0"]);
    }

    // BEGIN------------------------------------------------------------------------
    // auto-detect default transfer period
    // for example, .NO, .NU tlds require period value as zero (free transfers).
    // in WHMCS the default value is 1 (1Y)
    $qr = Ispapi::call([
        "COMMAND" => "QueryDomainOptions",
        "DOMAIN0" => $domain->getDomain()
    ], $params);

    if ($qr["CODE"] == 200) {
        $period_array = explode(",", $qr["PROPERTY"]["ZONETRANSFERPERIODS"][0]);
        // if transfer for free is supported and regperiod not listed in supported periods
        if (!in_array($params["regperiod"] . "Y", $period_array) && in_array("0Y", $period_array)) {
                $command["PERIOD"] = "0Y";
                //TODO: in 0Y cases execute a regperiod renewal
        }
    }
    // END ------------------------------------------------------------------------

    //#####################################################################
    //##################### PREMIUM DOMAIN HANDLING #######################
    //######################################################################
    if ($premiumDomainsEnabled && !empty($premiumDomainsCost)) {
        //check if premium domain functionality is enabled by the admin
        //check if the domain has a premium price

        //checkdomaintransfer
        if ($r["CODE"] == 200 && !empty($r["PROPERTY"]["CLASS"][0])) {
            //check if the price displayed to the customer is equal to the real cost at the registar
            $price = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_" . $r["PROPERTY"]["CLASS"][0] . "_TRANSFER");
            if ($price !== false && $premiumDomainsCost == $price) {
                $command["CLASS"] = $r["PROPERTY"]["CLASS"][0];
            } else {
                return [
                    "error" => "Price mismatch. Got $premiumDomainsCost, but expected $price."
                ];
            }
        }
    }
    //#####################################################################
    if (preg_match("/\.ca$/", $domain->getDomain())) {
        ispapi_use_additionalfields($params, $command);
        unset($command["X-CA-DISCLOSE"]);//not supported for transfers
    }
    $response = Ispapi::call($command, $params);

    if ($response["CODE"] != 200) {
        return [
            "error" => $response["DESCRIPTION"]
        ];
    }
    return [
        "success" => true
    ];
}

/**
 * Renew (or restore) a Domain Name
 *
 * @param array $params common module parameters
 *
 * @return array
 */
function ispapi_RenewDomain($params)
{
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $domain = $params["sld"] . "." . $params["tld"];

    // --- Domain Restore
    if (isset($params["isInRedemptionGracePeriod"]) && $params["isInRedemptionGracePeriod"]) {
        $r = HXDomain::restore($params, $domain);
        logActivity($domain . ": " . (isset($r["error"]) ? $r["error"] : $r["message"]));
        if (!isset($r["periodLeft"])) {
            return $r;
        }
        // continue with renewal below based on renewal period difference
        $params["regperiod"] = $r["periodLeft"];
    }

    $r = HXDomain::renew($params, $domain);
    logActivity($domain . ": " . $r["message"]);
    return $r;
}

/**
 * Release a domain name
 * A domain name can be pushed to the registry or to another registrar.
 * This feature currently works for .DE domains (DENIC Transit), .UK domains (.UK detagging), .VE domains, .IS domains and .AT domains (.AT Billwithdraw).
 *
 * @param array $params common module parameters
 * @return array
 */
function ispapi_ReleaseDomain($params)
{
    $r = ispapi_GetRegistrarLock($params);
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $domain = $params["sld"] . "." . $params["tld"];

    if ($r === "locked") {
        $msg = "Releasing impossible. Please remove the Registrar Lock first.";
        logActivity($domain . ": " . $msg);
        return [
            "error" => $msg
        ];
    }

    $command = [
        "COMMAND" => "PushDomain",
        "DOMAIN" => $domain
    ];
    if (!empty($params["transfertag"])) {
        $command["TARGET"] = $params["transfertag"];
    }
    $r = Ispapi::call($command, $params);

    if ($r["CODE"] !== "200") {
        $msg = "Releasing failed. (" . $r["DESCRIPTION"] . ")";
        logActivity($domain . ": " . $msg);
        return [
            "error" => $msg
        ];
    }
    logActivity($domain . ": Releasing succeeded.");
    return [
        "success" => "success"
    ];
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
    $domain = $params["sld"] . "." . $params["tld"];

    $command = array(
        "COMMAND" => "DeleteDomain",
        "DOMAIN" => $domain
    );
    $response = Ispapi::call($command, $params);

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
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    // domain name conversion
    $r = HXDomain::convert($params, $domain->getDomain());
    $domain_pc = $r["punycode"];
    $domain_idn = $r["idn"];

    // check if the transfer is still pending
    $r = HXDomainTransfer::getStatus($params, $domain_pc);
    if ($r["success"] === true) {
        logActivity($domain_idn . ": Domain Transfer is still pending (Existing Request).");
        return [];//still pending
    }

    // get date of last transfer request
    $r = HXDomainTransfer::getRequestLog($params, $domain_pc);
    if ($r["success"] === false || $r["data"]["COUNT"][0] === "0") {
        logActivity($domain_idn . ": Domain Transfer is still pending (No Request Log found).");
        return [];//still pending
    }

    // existing transfer request
    // check for related failed entry
    $logdate = $r["data"]["LOGDATE"][0]; // 2019-11-15 12:25:05
    $logindex = $r["data"]["LOGINDEX"][0]; // 627992982

    // check if the domain is already on account
    $r = HXDomain::getStatus($params, $domain_pc);
    if ($r["success"] === true) {
        // AUTO-UPDATE ns after transfer
        if ($params["NSUpdTransfer"] === "on") {
            // load the ones submitted in transfer request
            $newns = HXDomainTransfer::getRequestNameservers($params, $domain_pc, $logindex);
            // load the current ones assigned
            $currentns = HXDomain::getNameservers($params, $domain_pc);
            if ($currentns["success"] && $newns["success"]) {
                sort($currentns["nameservers"]);
                sort($newns["nameservers"]);
                if ($currentns !== $newns && !empty($newns["nameservers"])) {
                    Ispapi::call([
                        "COMMAND" => "ModifyDomain",
                        "DOMAIN" => $domain_pc,
                        "NAMESERVER" => $newns["nameservers"]
                    ], $params);
                    logActivity($domain_idn . ": Nameserver update requested.");
                }
            }
        }
        // TODO:---------- EXCEPTION [BEGIN] --------
        // Missing/Empty contact handles after Transfer over THIN Registry [kschwarz]
        // Ticket#: 2020041508019251 OTRS
        if (HXDomain::needsContactUpdate($params, $domain_pc, $r)) {
            // load required registrant and admin data
            $d = HXDomain::getContactDetailsWHMCS($params["domainid"]);
            // --- AUTO-UPDATE PROCESSING
            // only run auto-update mechanism in case a non-empty email address is given
            // otherwise it would keep trying to update on each run
            if (!empty($d["registrant"]["EMAIL"])) {
                HXDomain::updateContactDetails($params, $domain_pc, $d);
                logActivity($domain_idn . ": Contact update requested.");
            }
            //--------------- EXCEPTION [END] -----------
        }

        $values = HXDomain::getExpiryData($params, $domain_pc, false, $r);
        $values["completed"] = true;
        logActivity($domain_idn . ": Domain Transfer finished. expirydate: " . $values["expirydate"]);
        return $values;
    }

    // in case neither domain nor transfer object are available in xirca
    // this is probably in progress atm or has failed

    // check for related failure entry
    $r = HXDomainTransfer::getFailureLog($params, $domain_pc, $logdate);
    if ($r["success"] && (int)$r["data"]["COUNT"][0] > 0) {
        $values = [
            "failed" => true,
            "reason" => "Transfer Failed"
        ];
        if (isset($r["data"]["LOGINDEX"])) {
            $r = HXDomainTransfer::getLogDetails($params, $r["data"]["LOGINDEX"][0]);
            if ($r["success"] && isset($r["data"]["OPERATIONINFO"])) {
                $values["reason"] .= PHP_EOL . implode(PHP_EOL, $r["data"]["OPERATIONINFO"]);
            }
        }
        logActivity($domain_idn . ": Domain Transfer failed.");
        return $values;
    }

    logActivity($domain_idn . ": Domain Transfer is still pending.");
    return [];// still pending
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
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];
    $domainstr = $domain->getDomain();

    $r = HXDomain::getStatus($params, $domainstr);
    if (!$r["success"] && $r["errorcode"] === "531") {
        logActivity($domainstr . ": Domain Sync finished. Status updated to `Transferred Away`");
        return [
            "transferredAway" => true
        ];
    }

    if (!$r["success"] && $r["errorcode"] === "545") {
        $rconv = HXDomain::convert($params, $domainstr);
        $domainstr = $rconv["punycode"];
        if (HXDomainTransfer::isTransferredAway($params, $domainstr)) {
            logActivity($domainstr . ": Domain Sync finished. Status updated to `Transferred Away`");
            return [
                "transferredAway" => true
            ];
        }

        $r = HXApplication::getStatus($params, $domainstr);
        if ($r["success"] && !empty($r["data"]["STATUS"][0])) {
            $values = ["active" => true]; // pending cast from app to domain or pending order
            switch ($r["data"]["STATUS"][0]) {
                case "FAILED":
                    logActivity($domainstr . ": Premium Domain Order failed.");
                    $values = [
                        "error" => "Premium Domain Order failed."
                    ];
                    break;
                case "ACTIVE":
                case "SUCCESSFUL":
                    logActivity($domainstr . ": Premium Domain Order succeeded. Waiting for completion.");
                    break;
                default:
                    logActivity($domainstr . ": Premium Domain Order is pending.");
                    break;
            }
            return $values;
        }
        return HXDomain::getExpiryData($params, $domainstr, true);
    }
    if (!$r["success"]) {
        logActivity($domainstr . ": Domain Sync failed. See Module Log.");
        return $r;
    }

    //activate the whoistrustee if set to 1 in WHMCS
    if ($params["idprotection"] && empty($r["data"]["X-ACCEPT-WHOISTRUSTEE-TAC"][0])) { // doesn't exist, "" or 0
        HXDomain::saveIdProtection($params, $domainstr, true);
    }

    //expirydate
    $values = HXDomain::getExpiryData($params, $domainstr, false, $r);
    logActivity($domainstr . ": Domain Sync finished. Updated expirydate: " . $values["expirydate"]);
    return $values;
}

/**
 * Return TLD & Pricing for sync (WHMCS 7.10)
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return \WHMCS\Results\ResultsList
 */
function ispapi_getTLDPricing($params)
{
    // fetch list of tlds offerable by reseller
    $tlds = WHMCS\Module\Registrar\Ispapi\Ispapi::getTLDs($params);
    if (isset($tlds["error"])) {
        return $tlds;
    }
    if (empty($tlds)) {
        return new \WHMCS\Results\ResultsList();
    }

    // fetch tld configurations for offerable tlds
    $cfgs = WHMCS\Module\Registrar\Ispapi\Ispapi::getTLDConfigurations($tlds, $params);
    if (isset($cfgs["error"])) {
        return $cfgs;
    }

    // fetch prices for offerable tlds
    $prices = WHMCS\Module\Registrar\Ispapi\Ispapi::getTLDPrices(array_flip($tlds), $cfgs);
    if (isset($prices["error"])) {
        return $prices;
    }

    $results = new \WHMCS\Results\ResultsList();
    //$tmp = "";
    foreach ($prices as $tld => $p) {
        $cfg = $cfgs[$tld];
        if (is_null($p["registration"])) {
            // there are of course TLDs in management which we no longer offer for registration in public
            // e.g. .ar.com, .hu.com, .kr.com, .md, .no.com, .qc.com, .se.com, .uy.com, .zone, .plc.uk, .ltd.uk
            // WHMCS doesn't offer the possibility to import registerPrice as null, therefore leaving out
            continue;
        }
        if (empty($cfg->periods["registration"])) {
            throw new \Exception("Missing entry for $tld. Contact support, we will release a new version immediately.");
        }
        // All the set methods can be chained and utilised together.
        $item = new \WHMCS\Domain\TopLevel\ImportItem();
        $item->setExtension($tld)
            ->setYears($cfg->periods["registration"])// 1st one is the minimum period also used for transfers
            ->setRegisterPrice($p["registration"])
            ->setRenewPrice($p["renewal"])
            ->setTransferPrice($p["transfer"])
            ->setGraceFeeDays($cfg->periods["gracedays"])
            ->setGraceFeePrice($p["grace"])
            ->setRedemptionFeeDays($cfg->periods["redemptiondays"])
            ->setRedemptionFeePrice($p["redemption"])
            ->setCurrency($p["currency"])
            ->setEppRequired($cfg->authRequired === 1);
        $results[] = $item;
        /*$r = Ispapi::call([
            "COMMAND" => "QueryDomainRepositoryInfo",
            "DOMAIN" => "example" . $tld
        ], $params);
        if ($r["PROPERTY"]["REGISTRYEXPLICITRENEWAL"][0] === "NO"){
            $pp = -1 * (int)$r["PROPERTY"]["ZONERENEWALPAYMENTPERIOD"][0];
            $tmp .= "\$DomainRenewalMinimums[\"" . $tld . "\"] = \"" . $pp . "\";\n";
        }*/
    }
    //mail("kschwarz@hexonet.net", "tlds", $tmp);
    return $results;
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

    $domain = $params["sld"] . "." . $params["tld"];

    $values = array();
    $command = array(
        "COMMAND" => "StatusContact",
        "CONTACT" => $contact
    );
    $response = Ispapi::call($command, $params);

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

        if ((count($response["PROPERTY"]["STREET"]) < 2) && preg_match("/^(.*) , (.*)/", $response["PROPERTY"]["STREET"][0], $m)) {
            $values["Address"] = $m[1];
            $values["Address 2"] = $m[2];
        }

        // handle imported .ca domains properly
        if (preg_match("/\.ca$/i", $domain) && isset($response["PROPERTY"]["X-CA-LEGALTYPE"])) {
            if (preg_match("/^(CCT|RES|ABO|LGR)$/i", $response["PROPERTY"]["X-CA-LEGALTYPE"][0])) {
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
    $data = [
        ":domainid" => $params["domainid"]
    ];
    $r = Helper::SQLCall("SELECT name, value FROM tbldomainsadditionalfields WHERE domainid=:domainid", $data, "fetchall");
    if ($r["success"]) {
        foreach ($r["result"] as $row) {
            $params["additionalfields"][$row["name"]] = $row["value"];
        }
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
    if (is_array($additionaldomainfields) && isset($additionaldomainfields["." . $params["tld"]])) {
        $myadditionalfields = $additionaldomainfields["." . $params["tld"]];
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
        $name = $field["Name"];
        if (isset($params["additionalfields"][$name])) {
            $value = $params["additionalfields"][$name];

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

                if (isset($field["Ispapi-Name"]) && strlen($value) > 0) {
                    $key = $field["Ispapi-Name"];

                    // Ticket#2020111708017183 - START
                    // + GH #167
                    if (preg_match("/^X-DK-(REGISTRANT|ADMIN)-CONTACT$/", $key)) {
                        $command[$key] = strtoupper($value);
                    } elseif (preg_match("/^X-DK-AGREEMENT-ACCEPTEDDATE$/", $key) && $value === "on") {
                        $command[$key] = gmdate("Y-m-d H:i:s");
                    } elseif (preg_match("/^X-DE-(GENERAL-REQUEST|ABUSE-CONTACT)$/", $key) && !preg_match("/^mailto:|https?:\/\//", $value)) {
                        $command[$key] = (preg_match("/@/", $value) ? "mailto:" : "https://") . $value;
                    } else {
                        $command[$key] = $value;
                    }

                    //Reflect these changes also in WHMCS DB but just for free-text inputs
                    if ($field["Type"] === "text" && $value !== $command[$key]) {
                        $result = DB::table("tbldomainsadditionalfields")
                            ->where([
                                [ "domainid", "=", $params["domainid"] ],
                                [ "name", "=", $name ]
                            ])
                            ->update(["value" => $command[$key]]);
                    }
                    // Ticket#2020111708017183 - END
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
    $config = [];
    $r = Helper::SQLCall("SELECT setting, value FROM tblconfiguration", null, "fetchall");
    if ($r["success"]) {
        foreach ($r["result"] as $row) {
            $config[strtolower($row["setting"])] = $row["value"];
        }
    }
    if (!preg_match("/^utf-?8$/i", $config["charset"])) {
        return $params;
    }

    $data = [
        ":id" => $params["domainid"]
    ];
    $r = Helper::SQLCall("SELECT orderid FROM tbldomains WHERE id=:id LIMIT 1", $data, "fetch");
    if (!$r["success"]) {
        return $params;
    }

    $data = [
        ":id" => $r["result"]["orderid"]
    ];
    $r = Helper::SQLCall("SELECT userid,contactid FROM tblorders WHERE id=:id LIMIT 1", $data, "fetch");
    if (!$r["success"]) {
        return $params;
    }

    if ($r["result"]["contactid"]) {
        $data = [
            ":id" => $r["result"]["contactid"]
        ];
        $r = Helper::SQLCall("SELECT firstname, lastname, companyname, email, address1, address2, city, state, postcode, country, phonenumber FROM tblcontacts WHERE id=:id LIMIT 1", $data, "fetch");
        if (!$r["success"]) {
            return $params;
        }
        foreach ($r["result"] as $key => $value) {
            $params[$key] = $value;
        }
    } elseif ($r["result"]["userid"]) {
        $data = [
            ":id" => $r["result"]["userid"]
        ];
        $r = Helper::SQLCall("SELECT firstname, lastname, companyname, email, address1, address2, city, state, postcode, country, phonenumber FROM tblclients WHERE id=:id LIMIT 1", $data, "fetch");
        if (!$r["success"]) {
            return $params;
        }
        foreach ($r["result"] as $key => $value) {
            $params[$key] = $value;
        }
    }

    if ($config["registraradminuseclientdetails"]) {
        $params["adminfirstname"] = $params["firstname"];
        $params["adminlastname"] = $params["lastname"];
        $params["admincompanyname"] = $params["companyname"];
        $params["adminemail"] = $params["email"];
        $params["adminaddress1"] = $params["address1"];
        $params["adminaddress2"] = $params["address2"];
        $params["admincity"] = $params["city"];
        $params["adminstate"] = $params["state"];
        $params["adminpostcode"] = $params["postcode"];
        $params["admincountry"] = $params["country"];
        $params["adminphonenumber"] = $params["phonenumber"];
    } else {
        $params["adminfirstname"] = $config["registraradminfirstname"];
        $params["adminlastname"] = $config["registraradminlastname"];
        $params["admincompanyname"] = $config["registraradmincompanyname"];
        $params["adminemail"] = $config["registraradminemailaddress"];
        $params["adminaddress1"] = $config["registraradminaddress1"];
        $params["adminaddress2"] = $config["registraradminaddress2"];
        $params["admincity"] = $config["registraradmincity"];
        $params["adminstate"] = $config["registraradminstateprovince"];
        $params["adminpostcode"] = $config["registraradminpostalcode"];
        $params["admincountry"] = $config["registraradmincountry"];
        $params["adminphonenumber"] = $config["registraradminphone"];
    }

    $data = [
        ":id" => $params["domainid"]
    ];
    $r = Helper::SQLCall("SELECT name, value FROM tbldomainsadditionalfields WHERE domainid=:id", $data, "fetchall");
    if ($r["success"]) {
        foreach ($r["result"] as $row) {
            $params["additionalfields"][$row["name"]] = $row["value"];
        }
    }
    return $params;
}
