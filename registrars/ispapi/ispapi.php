<?php
/**
 * ISPAPI Registrar Module
 *
 * @author HEXONET GmbH <support@hexonet.net>
 */

$module_version = "1.12.2";

use WHMCS\Domains;
use WHMCS\Domains\AdditionalFields;
use WHMCS\Domains\DomainLookup\ResultsList;
use WHMCS\Domains\DomainLookup\SearchResult;
use WHMCS\Module\Server;
use WHMCS\Module\Addon;
use WHMCS\Module\Widget;
use WHMCS\Module\Addon\Setting;
use WHMCS\Database\Capsule;
use WHMCS\Carbon;

/**
 * Return module related metadata
 *
 * Provide some module information including the display name and API Version to
 * determine the method of decoding the input values.
 *
 * @return array
 */
function ispapi_MetaData()
{
    return [
        "DisplayName" => "ISPAPI v" . ispapi_GetISPAPIModuleVersion()
    ];
}

/**
 * Return the configuration array of the module (Setup > Products / Services > Domain Registrars > ISPAPI > Configure)
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_getConfigArray($params)
{
    $configarray = [
        "FriendlyName" => [
            "Type" => "System",
            "Value"=>"ISPAPI v" . ispapi_GetISPAPIModuleVersion()
        ],
        "Description" => [
            "Type" => "System",
            "Value"=>"The Official ISPAPI Registrar Module. <a target='blank_' href='https://www.hexonet.net'>www.hexonet.net</a>"
        ],
        "Username" => [
            "Type" => "text",
            "Size" => "20",
            "Description" => "Enter your ISPAPI Login ID"
        ],
        "Password" => [
            "Type" => "password",
            "Size" => "20",
            "Description" => "Enter your ISPAPI Password ",
        ],
        "UseSSL" => [
            "Type" => "yesno",
            "Description" => "Use HTTPS for API Connections"
        ],
        "TestMode" => [
            "Type" => "yesno",
            "Description" => "Connect to OT&amp;E (Test Environment)"
        ],
        "ProxyServer" => [
            "Type" => "text",
            "Description" => "Optional (HTTP(S) Proxy Server)"
        ],
        "ConvertIDNs" => [
            "Type" => "dropdown",
            "Options" => "API,PHP",
            "Default" => "API",
            "Description" => "Use API or PHP function (idn_to_ascii)"
        ],
        "DNSSEC" => [
            "Type" => "yesno",
            "Description" => "Display the DNSSEC Management functionality in the domain details"
        ],
        "TRANSFERLOCK" => [
            "Type" => "yesno",
            "Description" => "Locks automatically a domain after a new registration"
        ],
        "IRTP" => [
            "Type" => "radio",
            "Options" => "Check to use IRTP feature from our API., Check to act as Designated Agent for all contact changes. Ensure you understand your role and responsibilities before checking this option.",
            "Default" => "Check to use IRTP feature from our API.",
            "Description" => "General info about IRTP can be found <a target='blank_' href='https://wiki.hexonet.net/wiki/IRTP' style='border-bottom: 1px solid blue; color: blue'>here</a>. Documentation about option one can be found <a target='blank_' href='https://github.com/hexonet/whmcs-ispapi-registrar/wiki/Usage-Guide#option-one' style='border-bottom: 1px solid blue; color: blue'>here</a> and option two <a target='blank_' href='https://github.com/hexonet/whmcs-ispapi-registrar/wiki/Usage-Guide#option-two' style='border-bottom: 1px solid blue; color: blue'>here</a>"
        ]
    ];
    if (!function_exists('idn_to_ascii')) {
        $configarray["ConvertIDNs"] = [
            "Type" => "dropdown",
            "Options" => "API",
            "Default" => "API",
            "Description" => "Use API (PHP function idn_to_ascii not available)"
        ];
    }

    if (!empty($params["Username"])) {
        $r = ispapi_call([
            "COMMAND" => "CheckAuthentication",
            "SUBUSER" => $params["Username"],
            "PASSWORD" => $params["Password"]
        ], ispapi_config($params));

        if ($r["CODE"] == 200) {
            $configarray[""] = [
                "Description" => "<div style='color:white;font-weight:bold;background-color:green;padding:3px;width:400px;text-align:center;'>Connected ". (($params["TestMode"]=="on") ? "to OT&E environment" : "to PRODUCTION environment") . "</div>"
            ];
            ispapi_setStatsEnvironment($params);
        } else {
            $configarray[""] = [
                "Description" => "<div style='color:white;font-weight:bold;background-color:red;padding:3px;width:400px;text-align:center;'>Disconnected (Verify Username and Password)<br/>".$r["CODE"]." " .$r["DESCRIPTION"]."</div>"
            ];
        }
    }
    return $configarray;
}

/**
 * Register a domain name - Premium support
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_RegisterDomain($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];
    
    $premiumDomainsEnabled = (bool) $params['premiumEnabled'];
    $premiumDomainsCost = $params['premiumCost'];

    $origparams = $params;
    $params = ispapi_get_utf8_params($params);

    $command = [
        "COMMAND" => "AddDomain",
        "DOMAIN" => $domain->getDomain(),
        "PERIOD" => $params["regperiod"]
    ];
    ispapi_applyNamserversCommand($params, $command);
    ispapi_applyContactsCommand($params, $command);
    
    if ($origparams["TRANSFERLOCK"]) {
        $command["TRANSFERLOCK"] = 1;
    }
    
    $isApplicationCase = preg_match("/\.swiss$/i", $domain->getDomain());
    if ($isApplicationCase) {
        $command["COMMAND"] = "AddDomainApplication";
        $command["CLASS"] = "GOLIVE";
    }

    ispapi_use_additionalfields($params, $command);

    //##################### PREMIUM DOMAIN HANDLING #######################
    if ($premiumDomainsEnabled && !empty($premiumDomainsCost)) {
        $check = ispapi_call([
            "COMMAND" => "CheckDomains",
            "DOMAIN0" => $domain->getDomain(),
            "PREMIUMCHANNELS" => "*"
        ], ispapi_config($origparams));

        if ($check["CODE"] == 200) {
            if ($premiumDomainsCost == $check["PROPERTY"]["PRICE"][0]) { //check if the price displayed to the customer is equal to the real cost at the registar
                $isApplicationCase = true;
                $command["COMMAND"] = "AddDomainApplication";
                $command["CLASS"] =  empty($check["PROPERTY"]["CLASS"][0]) ? "AFTERMARKET_PURCHASE_".$check["PROPERTY"]["PREMIUMCHANNEL"][0] : $check["PROPERTY"]["CLASS"][0];
                $command["PRICE"] =  $premiumDomainsCost;
                $command["CURRENCY"] = $check["PROPERTY"]["CURRENCY"][0];
            }
        }
    }
    //#####################################################################

    if (!$isApplicationCase) {
        //INTERNALDNS and idprotection parameters are not supported by AddDomainApplication command
        if ($params["dnsmanagement"]) {
            $command["INTERNALDNS"] = 1;
        }
        if ($params["idprotection"]) {
            $command["X-ACCEPT-WHOISTRUSTEE-TAC"] = 1;
        }
    }

    $response = ispapi_call($command, ispapi_config($origparams));
    if ($response["CODE"] != 200) {
        // return error info in error case
        return [
            "error" => $response["DESCRIPTION"]
        ];
    }
    if ($isApplicationCase) {
        // provide the Application ID and further information
        $application_id = $response['PROPERTY']['APPLICATION'][0];
        $appResponse = "APPLICATION <strong>#".$application_id."</strong> SUCCESSFULLY SUBMITTED. " .
                        "STATUS IS PENDING UNTIL REGISTRATION PROCESS COMPLETES." .
                        (($params["dnsmanagement"] || $params["idprotection"]) ?
                        "<br/>Note: ID Protection and DNS Management can be activated AFTER completion." :
                        "");
        Capsule::table('tbldomains')
            ->where('id', '=', $params['domainid'])
            ->update(['additionalnotes' => "### DO NOT DELETE BELOW THIS LINE ### \nApplicationID: " . $application_id . "\n"]);
        return [
            "pending" => true,
            "pendingMessage" => $appResponse
        ];
    }
    return [
        "success" => true
    ];
}

/**
 * Transfer a domain name
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_TransferDomain($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    $origparams = $params;
    $params = ispapi_get_utf8_params($params);

    // ### domain transfer pre-check ###
    $command = [
        "COMMAND" => "CheckDomainTransfer",
        "DOMAIN" => $domain->getDomain(),
        "AUTH" => $origparams["transfersecret"]
    ];
    $r = ispapi_call($command, ispapi_config($origparams));
    // transfer request is not available
    if ($r["CODE"] != 218) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    $r = $r["PROPERTY"];
    // provided auth code is invalid
    if (isset($r["AUTHISVALID"]) && $r["AUTHISVALID"][0] == "NO") {
        return [
            "error" => "Invaild Authorization Code"
        ];
    }
    // transferlock is active, transfer impossible
    if (isset($r["TRANSFERLOCK"]) && $r["TRANSFERLOCK"][0] == "1") {
        return [
            "error" => "Transferlock is active. Therefore the Domain cannot be transferred."
        ];
    }
    // auto-detect user-transfer (system internal transfer)
    $isUserTransfer = (isset($r["USERTRANSFERREQUIRED"]) && $r["USERTRANSFERREQUIRED"][0] == "1");

    // ### Transfer Period Check
    // 1) check if whmcs default period is valid
    // 2) otherwise check if 0Y period is available which corresponds to transfer without renewal
    //    (probably for free) e.g. .es, .no, .nu
    // NOTE:
    // the default WHMCS period is the lowest configured period in domain pricing section,
    // so probably 1Y ... some of the 0Y TLDs don't even allow other periods.
    // This is a generic problem as WHMCS might charge for the transfer using the price defined for
    // the lowest transfer period.
    $period = $params["regperiod"];
    $r = ispapi_call([
        "COMMAND" => "QueryDomainOptions",
        "DOMAIN0" => $domain->getDomain()
    ], ispapi_config($origparams));
    if ($r["CODE"] == 200) {
        $periods = explode(",", $r['PROPERTY']['ZONETRANSFERPERIODS'][0]);
        // check if whmcs' regperiod can be used
        if (!in_array($params["regperiod"]."Y", $periods) && !in_array($params["regperiod"], $periods)) {
            // if not, check if 0Y transfer is possible
            if (!in_array("0Y", $periods) && !in_array("0", $periods)) {
                return [
                    "error" => "Transfer Period " . $period . " not available for " . $domain->getTLD() . ". Available ones for ISPAPI are: " . $r['PROPERTY']['ZONETRANSFERPERIODS'][0] . ". Check your Domain Pricing configuration."
                ];
            } else {
                $period = "0Y";
            }
        }
    }

    // ### Initiate Domain Transfer
    $command = [
        "COMMAND" => "TransferDomain",
        "DOMAIN" => $domain->getDomain(),
        "PERIOD" => $period,
        "AUTH" => $origparams["transfersecret"]
    ];
    if ($isUserTransfer) {
        $command["ACTION"] = "USERTRANSFER";
    }
    ispapi_applyContactsCommand($params, $command);
    ispapi_applyNamserversCommand($params, $command);
    // TODO: add support for premium domain transfers (CLASS parameter)

    // TODO: we need to figure out the reasons for the below exceptions... such cases have to be covered by API
    //1) don't send owner admin tech billing contact for .NU .DK .CA, .US, .PT, .NO, .SE, .ES domains
    //2) do not send contact information for gTLD (Including nTLDs)
    if (preg_match('/\.([a-z]{3,}|nu|dk|ca|us|pt|no|se|es)$/i', $domain->getDomain())) {
        unset($command["OWNERCONTACT0"]);
        unset($command["ADMINCONTACT0"]);
        unset($command["TECHCONTACT0"]);
        unset($command["BILLINGCONTACT0"]);
    }
    //TODO: why don't send owner billing contact for .FR domains
    if (preg_match('/\.fr$/i', $domain->getDomain())) {
        unset($command["OWNERCONTACT0"]);
        unset($command["BILLINGCONTACT0"]);
    }

    $r = ispapi_call($command, ispapi_config($origparams));

    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    return [
        "success" => true
    ];
}

/**
 * Renew a domain name
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_RenewDomain($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $premiumDomainsEnabled = (bool) $params['premiumEnabled'];
    $premiumDomainsCost = $params['premiumCost'];

    $command = [
        "COMMAND" => "RenewDomain",
        "DOMAIN" => $domain->getDomain(),
        "PERIOD" => $params["regperiod"]
    ];
    
    // renew premium domain
    // check if premium domain functionality is enabled by the admin
    // check if the domain has a premium price
    if ($premiumDomainsEnabled && !empty($premiumDomainsCost)) {
        $r = ispapi_call([
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain->getDomain(),
            "PROPERTIES" => "PRICE"
        ], ispapi_config($params));

        if ($r["CODE"] == 200 && !empty($r['PROPERTY']['SUBCLASS'][0])) {
             // check if the renewal price displayed to the customer is equal to the real cost at the registar
            if ($premiumDomainsCost == $r['PROPERTY']['RENEWALPRICE'][0]) {
                $command["CLASS"] = $r['PROPERTY']['SUBCLASS'][0];
            }
        }
    }

    $r = ispapi_call($command, ispapi_config($params));

    if ($r["CODE"] == 510) {
        $command["COMMAND"] = "PayDomainRenewal";
        $r = ispapi_call($command, ispapi_config($params));
    }

    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    return [
        "success" => true
    ];
}

/**
 * Return Nameservers of a domain name
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_GetNameservers($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" =>  $domain->getDomain()
    ], ispapi_config($params));
    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    $values = [];
    foreach ($r["PROPERTY"]["NAMESERVER"] as $idx => $val) {
        $values["ns1".($idx+1)] = $val;
    }
    return $values;
}

/**
 * Modify and save Nameservers of a domain name
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_SaveNameservers($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $r = ispapi_call([
        "COMMAND" => "ModifyDomain",
        "DOMAIN" => $domain->getDomain(),
        "NAMESERVER" => [
            $params["ns1"],
            $params["ns2"],
            $params["ns3"],
            $params["ns4"],
            $params["ns5"]
        ],
        "INTERNALDNS" => 1
    ], ispapi_config($params));

    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    return [
        "success" => true
    ];
}

/**
 * Contact data of a domain name
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_GetContactDetails($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($params));

    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }

    $values = [
        "Registrant" => ispapi_get_contact_info($r["PROPERTY"]["OWNERCONTACT"][0], $params),
        "Admin" => ispapi_get_contact_info($r["PROPERTY"]["ADMINCONTACT"][0], $params),
        "Technical" => ispapi_get_contact_info($r["PROPERTY"]["TECHCONTACT"][0], $params),
        "Billing" => ispapi_get_contact_info($r["PROPERTY"]["BILLINGCONTACT"][0], $params)
    ];
    // Remove input fields for Registrant's COUNTRY|NAME|ORGANIZATION in case a Trade is required
    // For these cases we have pre-defined registrant modification pages
    //if (preg_match('/\.(ca|it|ch|li|se|sg)$/i', $domain->getDomain())) {
    if (ispapi_needsTradeForRegistrantModification($domain, $params)) {
        unset($values["Registrant"]["First Name"]);
        unset($values["Registrant"]["Last Name"]);
        unset($values["Registrant"]["Company Name"]);
        unset($values["Registrant"]["Country"]);
    }
    return $values;
}

/**
 * Modify and save contact data of a domain name
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_SaveContactDetails($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    $origparams = $params;
    $params = ispapi_get_utf8_params($params);
    
    // get registrant data
    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($origparams));

    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    $registrant = ispapi_get_contact_info($r["PROPERTY"]["OWNERCONTACT"][0], $params);
    if (isset($params["contactdetails"]["Registrant"])) {
        $new_registrant = $params["contactdetails"]["Registrant"];
    }

    //the following conditions must be true to trigger registrant change request (IRTP)
    if (preg_match('/Designated Agent/', $params["IRTP"]) &&
        ispapi_IsAffectedByIRTP($domain->getDomain(), $params) && (
            $registrant['First Name'] != $new_registrant['First Name'] ||
            $registrant['Last Name'] != $new_registrant['Last Name'] ||
            $registrant['Company Name'] != $new_registrant['Company Name'] ||
            $registrant['Email'] != $new_registrant['Email']
        )
    ) {
        $command = [
            "COMMAND" => "TradeDomain",
            "DOMAIN" => $domain->getDomain(),
            "OWNERCONTACT0" => $new_registrant,
            "X-CONFIRM-DA-OLD-REGISTRANT" => 1,
            "X-CONFIRM-DA-NEW-REGISTRANT" => 1
        ];
        // some extensions have special requirements e.g. AFNIC TLDs(.fr, ...)
        ispapi_query_additionalfields($params);
        ispapi_use_additionalfields($params, $command);

        //opt-out is not supported for AFNIC TLDs (eg: .FR)
        $r = ispapi_call([
            "COMMAND" => "QueryDomainOptions",
            "DOMAIN0" => $domain->getDomain()
        ], ispapi_config($origparams));
        if ($r["CODE"] == 200) {
            if (!preg_match("/AFNIC/i", $r["PROPERTY"]["REPOSITORY"][0])) {
                $command["X-REQUEST-OPT-OUT-TRANSFERLOCK"] = ($params["irtpOptOut"]) ? 1 : 0;
            }
        }
    } else {
        // even if we are here also in IRTP case and if reseller has not configured DA status,
        // he could have configured the API with IRTP specific user environment settings.
        // ModifyDomain will do an auto-fallback to TradeDomain on API-side then.
        $command = [
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain->getDomain()
        ];
    }
    // set new contact details
    $map = [
        "OWNERCONTACT0" => "Registrant",
        "ADMINCONTACT0" => "Admin",
        "TECHCONTACT0" => "Technical",
        "BILLINGCONTACT0" => "Billing",
    ];
    $contactDetails = $params["contactdetails"];
    foreach ($map as $ctype => $ptype) {
        $p = $contactDetails[$ptype];
        $command[$ctype] = [
            "FIRSTNAME" => $p["First Name"],
            "LASTNAME" => $p["Last Name"],
            "ORGANIZATION" => $p["Company Name"],
            "STREET" => $p["Address"],
            "CITY" => $p["City"],
            "STATE" => $p["State"],
            "ZIP" => $p["Postcode"],
            "COUNTRY" => $p["Country"],
            "PHONE" => $p["Phone"],
            "FAX" => $p["Fax"],
            "EMAIL" => $p["Email"]
        ];
        if (strlen($p["Address 2"])) {
            $command[$ctype]["STREET"] .= " , ". $p["Address 2"];
        }
    }

    // .CA specific registrant modification process
    // TODO ... looks deprecated, check if this is still required
    if (preg_match('/\.ca$/i', $domain->getDomain())) {
        $r = ispapi_call([
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain->getDomain()
        ], ispapi_config($origparams));

        if ($r["CODE"] != 200) {
            return [
                "error" => $r["DESCRIPTION"]
            ];
        }

        if (!preg_match('/^AUTO\-/i', $r["PROPERTY"]["OWNERCONTACT"][0])) {
            $registrant_command = $command["OWNERCONTACT0"];
            $registrant_command["COMMAND"] = "ModifyContact";
            $registrant_command["CONTACT"] = $r["PROPERTY"]["OWNERCONTACT"][0];
            unset($registrant_command["FIRSTNAME"]);
            unset($registrant_command["LASTNAME"]);
            unset($registrant_command["ORGANIZATION"]);
            $r = ispapi_call($registrant_command, ispapi_config($origparams));
            if ($r["CODE"] != 200) {
                return [
                    "error" => $r["DESCRIPTION"]
                ];
            }
            unset($command["OWNERCONTACT0"]);
        }

        ispapi_query_additionalfields($params);
        ispapi_use_additionalfields($params, $command);
        unset($command["X-CA-LEGALTYPE"]);
    } elseif (ispapi_needsTradeForRegistrantModification($domain, $origparams)) {
        // * below fields are not allowed to get modified, TradeDomain is required for it
        // * additional fields are not available in the default WHMCS contact information page
        // -> need for a specific registrant modification page
        // -> necessary to set the old data to get all the other changes processed
        // otherwise the API would complain about a required TradeDomain
        $r = ispapi_call([
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain->getDomain()
        ], ispapi_config($origparams));

        if ($r["CODE"] != 200) {
            return [
                "error" => $r["DESCRIPTION"]
            ];
        }
        $registrant = ispapi_get_contact_info($r["PROPERTY"]["OWNERCONTACT"][0], $params);

        unset($command["OWNERCONTACT0"]["FIRSTNAME"]);//TODO: can it be cleaned up?
        unset($command["OWNERCONTACT0"]["LASTNAME"]);//TODO: can it be cleaned up?
        unset($command["OWNERCONTACT0"]["ORGANIZATION"]);//TODO: it can be cleaned up?
        unset($command["OWNERCONTACT0"]["COUNTRY"]);//TODO: can it be cleaned up?
        
        $command["OWNERCONTACT0"]["FIRSTNAME"] = $registrant["First Name"];
        $command["OWNERCONTACT0"]["LASTNAME"] = $registrant["Last Name"];
        $command["OWNERCONTACT0"]["ORGANIZATION"] = $registrant["Company Name"];
        $command["OWNERCONTACT0"]["COUNTRY"] = $registrant["Country"];
    }

    $r = ispapi_call($command, ispapi_config($origparams));
    
    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    return [
        "success" => true
    ];
}

/**
 * Check the availability of domains using HEXONET's fast API
 *
 * @param array $params common module parameters
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @see \WHMCS\Domains\DomainLookup\SearchResult
 * @see \WHMCS\Domains\DomainLookup\ResultsList
 *
 * @return \WHMCS\Domains\DomainLookup\ResultsList An ArrayObject based collection of \WHMCS\Domains\DomainLookup\SearchResult results
 */
function ispapi_CheckAvailability($params)
{
    $label = strtolower($params['searchTerm']);
    if ($params['isIdnDomain'] && !empty($params['punyCodeSearchTerm'])) {
        $label = strtolower($params['punyCodeSearchTerm']);
    }
    
    $domainslist = ["all" => [], "list" => []];
    //ONLY FOR SUGGESTIONS
    if (isset($params["suggestions"]) && !empty($params["suggestions"])) {
        foreach ($params["suggestions"] as $suggestion) {
            if (!in_array($suggestion, $domainslist["all"])) {
                $domainslist["all"][] = $suggestion;
                $suggested_domain = preg_split("/\./", $suggestion, 2);
                $domainslist["list"][] = ["sld" => $suggested_domain[0], "tld" => ".".$suggested_domain[1]];
            }
        }
    } //NORMAL MODE
    else {
        foreach ($params['tldsToInclude'] as $tld) {
            if (!empty($tld[0])) {
                $domain = $label . $tld;
                if ($tld[0] != '.') {
                    $tld = ".".$tld;
                }
                $domain = $label.$tld;
                if (!in_array($domain, $domainslist["all"])) {
                    $domainslist["all"][] = $domain;
                    $domainslist["list"][] = ["sld" => $label, "tld" => $tld];
                }
            }
        }
    }

    $check = ispapi_call([
        "COMMAND" => "CheckDomains",
        "DOMAIN" => $domainslist["all"],
        "PREMIUMCHANNELS" => "*"
    ], ispapi_config($params));

    $results = new ResultsList();
    if ($check["CODE"] == 200) {
        //GET ALL CURRENCIES EXISTING IN WHMCS
        $whmcs_existing_currencies = localAPI('GetCurrencies', []);
        $currency_list = [];
        foreach ($whmcs_existing_currencies["currencies"]["currency"] as $cur) {
            $currency_list[$cur["code"]] = $cur["id"];
        }
        $premiumEnabled = (bool) $params['premiumEnabled'];

        //GET AN ARRAY OF ALL TLDS CONFIGURED WITH HEXONET
        $pdo = Capsule::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT extension FROM tbldomainpricing WHERE autoreg REGEXP '^(ispapi|hexonet)$'");
        $stmt->execute();
        $ispapi_tlds = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        $index=0;
        foreach ($domainslist["list"] as $domain) {
            $registerprice = $renewprice = $currency = $status = "";
            $searchResult = new SearchResult($domain['sld'], $domain['tld']);
            if (preg_match('/549/', $check["PROPERTY"]["DOMAINCHECK"][$index])) {
                //TLD NOT SUPPORTED AT HEXONET USE A FALLBACK TO THE WHOIS LOOKUP.
                $whois = localAPI("DomainWhois", ["domain" => $domain['sld'].$domain['tld']]);
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

                        //GET CURRENCY ID IN WHMCS FOR API-SIDE CURRENCY CODE OF PREMIUM DOMAIN PRICE
                        //TODO: Should be a USD to USD mapping (API returns USD and WHMCS uses by default USD)
                        //      What if the API-side currency is not defined in WHMCS?
                        //      What if $currency is not defined?
                        $currency_id = 0;
                        if (isset($currency_list[$currency])) {
                             $currency_id = $currency_list[$currency];
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
                                $premiuminformation = [
                                    'register' => $registerprice,
                                    'renew' => $renewprice,
                                    'CurrencyCode' => $currency
                                ];
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
 * Domain Suggestion Settings.
 *
 * Defines the settings relating to domain suggestions (optional).
 * It follows the same convention as `getConfigArray`.
 *
 * @see https://developers.whmcs.com/domain-registrars/availability-checks/
 *
 * @return array of Configuration Options
 */
function ispapi_DomainSuggestionOptions($params)
{
    if ($params['whmcsVersion'] < 7.6) {
        $marginleft = '60px';
    } else {
        $marginleft = '220px';
    }

    return [
        'information' => [
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
        ],
        'suggestions' => [
            'FriendlyName' => '<b style="color:#FF6600;">Suggestion Engine based on search term:</b>',
            'Type' => 'yesno',
            'Description' => 'Tick to activate (recommended)',
        ]
    ];
}


/**
 * Get Domain Suggestions.
 *
 * Provide domain suggestions based on the domain lookup term provided.
 *
 * @param array $params common module parameters
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @see \WHMCS\Domains\DomainLookup\SearchResult
 * @see \WHMCS\Domains\DomainLookup\ResultsList
 *
 * @return \WHMCS\Domains\DomainLookup\ResultsList An ArrayObject based collection of \WHMCS\Domains\DomainLookup\SearchResult results
 */
function ispapi_GetDomainSuggestions($params)
{
    //RETURN EMPTY ResultsList OBJECT WHEN SUGGESTIONS ARE DEACTIVATED
    if (empty($params['suggestionSettings']['suggestions'])) {
        return new ResultsList();
    }

    //GET THE TLD OF THE SEARCHED VALUE
    if (isset($_REQUEST["domain"]) && preg_match('/\./', $_REQUEST["domain"])) {
        $search = preg_split("/\./", $_REQUEST["domain"], 2);
        $searched_zone = $search[1];
    }

    $label = strtolower($params['searchTerm']);
    if ($params['isIdnDomain'] && !empty($params['punyCodeSearchTerm'])) {
           $label = strtolower($params['punyCodeSearchTerm']);
    }

    $tldslist = $params['tldsToInclude'];
    $zones = [];
    foreach ($tldslist as $tld) {
        // IGNORE 3RD LEVEL TLDS - FTASKS-2876
        if (!preg_match("/\./", $tld)) {
            $zones[] = strtoupper($tld);
        }
    }

    //IF SEARCHED VALUE CONTAINS TLD THEN ONLY DISPLAY SUGGESTIONS WITH THIS TLD
    $r = ispapi_call([
        "COMMAND" => "QueryDomainSuggestionList",
        "KEYWORD" => $label,
        "ZONE" => $zones,
        "SOURCE" => "ISPAPI-SUGGESTIONS",
    ], ispapi_config($params));

    $params["suggestions"] = ($r["CODE"] == 200) ? $r["PROPERTY"]["DOMAIN"] : [];

    return ispapi_CheckAvailability($params);
}

/**
 * Get Registrar/Domain/Transfer Lock status of a domain name
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return string|array Lock status or error message
 */
function ispapi_GetRegistrarLock($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($params));

    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    if (isset($r["PROPERTY"]["TRANSFERLOCK"])) {
        if ($r["PROPERTY"]["TRANSFERLOCK"][0] == "1") {
            return "locked";
        } elseif ($r["PROPERTY"]["TRANSFERLOCK"][0] == "0") {
            return "unlocked";
        }
    }
    return "";
}

/**
 * Set Registrar/Domain/Transfer Lock status of a domain name
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_SaveRegistrarLock($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $r = ispapi_call([
        "COMMAND" => "ModifyDomain",
        "DOMAIN" => $domain->getDomain(),
        "TRANSFERLOCK" => ($params["lockenabled"] == "locked")? "1" : "0"
    ], ispapi_config($params));
    if ($r["CODE"] != 200) {
        return [
            "error" => $response["DESCRIPTION"]
        ];
    }
    return [
        'success' => 'success'
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
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */

    if (isset($params["original"])) {
        $params = $params["original"];
    }

    //convert the dnszone in punycode
    $r = ispapi_call([
        "COMMAND" => "ConvertIDN",
        "DOMAIN" => $params["domainObj"]->getDomain()
    ], ispapi_config($params));
    if ($r["CODE"]!=200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    $dnszone = $r["PROPERTY"]["ACE"][0].".";

    $r = ispapi_call([
        "COMMAND" => "QueryDNSZoneRRList",
        "DNSZONE" => $dnszone,
        "EXTENDED" => 1
    ], ispapi_config($params));

    //only for MX fields, they are note displayed in the "EXTENDED" version
    $r2 = ispapi_call([
        "COMMAND" => "QueryDNSZoneRRList",
        "DNSZONE" => $dnszone,
        "SHORT" => 1,
    ], ispapi_config($params));
    
    if ($r["CODE"] != 200 || $r2["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }

    $i = 0;
    $hostrecords = [];
    foreach ($r["PROPERTY"]["RR"] as $rr) {
        $fields = explode(" ", $rr);
        $domain = array_shift($fields);
        $ttl = array_shift($fields);
        $class = array_shift($fields);
        $rrtype = array_shift($fields);

        if ($domain == $dnszone) {
            $domain = "@";
        }
        $domain = str_replace(".".$dnszone, "", $domain);
        
        if ($rrtype == "A") {
            if (!preg_match('/^mxe-host-for-ip-(\d+)-(\d+)-(\d+)-(\d+)$/i', $domain, $m)) {
                $hostrecords[$i++] = [
                    "hostname" => $domain,
                    "type" => $rrtype,
                    "address" => $fields[0]
                ];
            }
        } elseif (preg_match("/^(AAAA|CNAME)$/", $rrtype)) {
            $hostrecords[$i++] = [
                "hostname" => $domain,
                "type" => $rrtype,
                "address" => $fields[0]
            ];
        } elseif ($rrtype == "TXT") {
            $hostrecords[$i++] = [
                "hostname" => $domain,
                "type" => $rrtype,
                "address" => implode(" ", $fields)
            ];
        } elseif ($rrtype == "SRV") {
            $priority = array_shift($fields);
            $hostrecords[$i++] = [
                "hostname" => $domain,
                "type" => $rrtype,
                "address" => implode(" ", $fields),
                "priority" => $priority
            ];
        } elseif ($rrtype == "X-HTTP") {
            if (preg_match('/^\//', $fields[0])) {
                $domain .= array_shift($fields);
            }
            $url_type = array_shift($fields);
            if ($url_type == "REDIRECT") {
                $url_type = "URL";
            }
            $hostrecords[$i++] = [
                "hostname" => $domain,
                "type" => $url_type,
                "address" => implode(" ", $fields)
            ];
        }
    }

    foreach ($r2["PROPERTY"]["RR"] as $rr) {
        $fields = explode(" ", $rr);
        $domain = array_shift($fields);
        $ttl = array_shift($fields);
        $class = array_shift($fields);
        $rrtype = array_shift($fields);

        if ($rrtype == "MX") {
            if (preg_match('/^mxe-host-for-ip-(\d+)-(\d+)-(\d+)-(\d+)($|\.)/i', $fields[1], $m)) {
                $hostrecords[$i++] = [
                    "hostname" => $domain,
                    "type" => "MXE",
                    "address" => $m[1].".".$m[2].".".$m[3].".".$m[4]
                ];
            } else {
                $hostrecords[$i++] = [
                    "hostname" => $domain,
                    "type" => $rrtype,
                    "address" => $fields[1],
                    "priority" => $fields[0]
                ];
            }
        }
    }
    return $hostrecords;
}

/**
 * Update DNS Host Records.
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_SaveDNS($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */

    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $domain = $params["domainObj"]->getDomain();
    $dnszone = $domain . ".";

    $command = [
        "COMMAND" => "UpdateDNSZone",
        "DNSZONE" => $dnszone,
        "RESOLVETTLCONFLICTS" => 1,
        "INCSERIAL" => 1,
        "EXTENDED" => 1,
        "DELRR" => ["% A", "% AAAA", "% CNAME", "% TXT", "% MX", "% X-HTTP", "% X-SMTP", "% SRV"],
        "ADDRR" => [],
    ];

    $mxe_hosts = [];
    foreach ($params["dnsrecords"] as $key => $values) {
        $hostname = $values["hostname"];
        $type = strtoupper($values["type"]);
        $address = $values["address"];
        $priority = $values["priority"];

        if (strlen($hostname) && strlen($address)) {
            if (preg_match("/^(A|AAAA|CNAME|TXT)$/", $type)) {
                $command["ADDRR"][] = "$hostname $type $address";
            } elseif ($type == "SRV") {
                if (empty($priority)) {
                    $priority=0;
                }
                array_push($command["DELRR"], "% SRV");
                $command["ADDRR"][] = "$hostname $type $priority $address";
            } elseif ($type == "MXE") {
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
                    // CHANGE RRTYPE TO MX
                    $address = "$mxpref $address";
                    $type = "MX";
                }
            } elseif ($type == "FRAME") {
                $redirect = "FRAME";
                if (preg_match('/^([^\/]+)(.*)$/', $hostname, $m)) {
                    $hostname = $m[1];
                    $redirect = $m[2]." ".$redirect;
                }
                $command["ADDRR"][] = "$hostname X-HTTP $redirect $address";
            } elseif ($type == "URL") {
                $redirect = "REDIRECT";
                if (preg_match('/^([^\/]+)(.*)$/', $hostname, $m)) {
                    $hostname = $m[1];
                    $redirect = $m[2]." ".$redirect;
                }
                $command["ADDRR"][] = "$hostname X-HTTP $redirect $address";
            }
            // DO NOT PUT ELSEIF HERE (see MXE block)
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
        }
    }
    foreach ($mxe_hosts as $address => $hostname) {
        $command["ADDRR"][] = "$hostname A $address";
    }

    //add X-SMTP to the list
    $r = ispapi_call([
        "COMMAND" => "QueryDNSZoneRRList",
        "DNSZONE" => $dnszone,
        "EXTENDED" => 1
    ], ispapi_config($params));

    if ($r["CODE"] == 200) {
        foreach ($r["PROPERTY"]["RR"] as $rr) {
            $fields = explode(" ", $rr);
            array_shift($fields);
            array_shift($fields);
            array_shift($fields);
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
    $r = ispapi_call($command, ispapi_config($params));

    //if DNS Zone not existing, create one automatically
    //TODO: precheck if a dnszone exists in advance
    //545 - OBJECT NOT FOUND
    if ($r["CODE"] == 545) {
        $cr = ispapi_call([
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain,
            "INTERNALDNS" => 1
        ], ispapi_config($params));
        if ($cr["CODE"] == 200) {
            //resend command to update DNS Zone
            $r = ispapi_call($command, ispapi_config($params));
        }
    }
    if ($r["CODE"] != 200) {
        return [
            "error" => $response["DESCRIPTION"]
        ];
    }
    return [
        "success" => true
    ];
}

/**
 * Enable/Disable ID Protection.
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_IDProtectToggle($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $r = ispapi_call([
        "COMMAND" => "ModifyDomain",
        "DOMAIN" => $domain->getDomain(),
        "X-ACCEPT-WHOISTRUSTEE-TAC" => ($params["protectenable"])? "1" : "0"
    ], ispapi_config($params));
    if ($r["CODE"] != 200) {
        return [
            "error" => $response["DESCRIPTION"]
        ];
    }
    return [
        "success" => true
    ];
}

/**
 * Request EEP Code.
 *
 * Supports both displaying the EPP Code directly to a user or indicating
 * that the EPP Code will be emailed to the registrant.
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_GetEPPCode($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    if (isset($params["original"])) {
        $params = $params["original"];
    }

    return ispapi_requestAuthCode($params);
}

/**
 * Release a Domain.
 *
 * Used to initiate a transfer out such as an IPSTAG change for .UK
 * domain names.
 *
 * A domain name can be pushed to the registry or to another registrar.
 * This feature currently works for .DE domains (DENIC Transit), .UK
 * domains (.UK detagging), .VE domains, .IS domains and .AT domains
 * (.AT Billwithdraw).
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 * @see https://github.com/hexonet/hexonet-api-documentation/blob/master/API/DOMAIN/PUSHDOMAIN.md
 *
 * @return array
 */
function ispapi_ReleaseDomain($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $cmd = [
        "COMMAND" => "PushDomain",
        "DOMAIN" => $domain
    ];
    if (!empty($params["transfertag"])) {//API DEFAULT -> "TRANSIT"
        $cmd["TARGET"] = $params["transfertag"];
    }
    $r = ispapi_call($cmd, ispapi_config($params));

    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    return [
        "success" => true
    ];
}

/**
 * Delete Domain.
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_RequestDelete($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $r = ispapi_call([
        "COMMAND" => "DeleteDomain",
        "DOMAIN" => $domain
    ], ispapi_config($params));

    if ($r["CODE"] != 200) {
        return [
            "error" => $response["DESCRIPTION"]
        ];
    }
    return [
        "success" => true
    ];
}

/**
 * Register a Nameserver (Add a new Private NS => GLUE RECORD)
 * A glue record is simply the association of a hostname (ns) with an
 * IP address at the registry
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_RegisterNameserver($params)
{
    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $r = ispapi_call([
        "COMMAND" => "AddNameserver",
        "NAMESERVER" => $params["nameserver"],
        "IPADDRESS0" => $params["ipaddress"]
    ], ispapi_config($params));

    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    return [
        "success" => true
    ];
}

/**
 * Modify a Private Nameserver. (GLUE RECORD)
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_ModifyNameserver($params)
{
    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $r = ispapi_call([
        "COMMAND" => "ModifyNameserver",
        "NAMESERVER" => $params["nameserver"],
        "DELIPADDRESS0" => $params["currentipaddress"],
        "ADDIPADDRESS0" => $params["newipaddress"],
    ], ispapi_config($params));

    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    return [
        "success" => true
    ];
}

/**
 * Delete a Private Nameserver.
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_DeleteNameserver($params)
{
    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $r = ispapi_call([
        "COMMAND" => "DeleteNameserver",
        "NAMESERVER" => $params["nameserver"]
    ], ispapi_config($params));
    
    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    return [
        "success" => true
    ];
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

    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($params));

    if (in_array($r["CODE"], [531, 545])) {
        return [
            "transferredAway" => true
        ];
    }
    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }

    return [
        "active" => preg_match("/ACTIVE/i", $r["PROPERTY"]["STATUS"][0]),
        "expirydate" => ispapi_getExpiryDate($r),
        // domain expired (if EXPIRATIONDATE is in the past)
        // TODO: shouldn't we use the expirydate logic for this too?
        'expired' => gmmktime() > strtotime($r["PROPERTY"]["EXPIRATIONDATE"][0])
    ];
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

    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($params));
    
    if (in_array($r["CODE"], [531, 545])) {
        $r = ispapi_call([
            "COMMAND" => "StatusDomainTransfer",
            "DOMAIN" => $domain->getDomain()
        ], ispapi_config($params));
        if (($r["CODE"] == 545) || ($r["CODE"] == 531)) {
            return [
                'failed' => true,
                'reason' => "Transfer Failed" . ispapi_getInboundTransferLog($params)
            ];
        }
        if ($r["CODE"] == 200) {
            return [
                "pendingtransfer" => true,
                "reason" => implode("\n", $r["PROPERTY"]["TRANSFERLOG"])
            ];
        }
    }
    if ($r["CODE"] != 200) {//reuse this for StatusDomainTransfer error too
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }

    // Transfer completed
    // activate the whoistrustee if set to 1 in WHMCS
    if ($params["idprotection"] == "1" || $params["idprotection"] == "on") {
        ispapi_call([
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain->getDomain(),
            "X-ACCEPT-WHOISTRUSTEE-TAC" => "1"
        ], ispapi_config($params));
    }

    return [
        'completed' => true,
        'expirydate' => ispapi_getExpiryDate($r)
    ];
}

/**
 * Provide custom buttons (whoisprivacy, DNSSEC Management) for domains and change of registrant button for certain domain names on client area
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_ClientAreaCustomButtonArray($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    if (isset($params["domainid"])) {
        $domainid = $params["domainid"];
    } elseif (!isset($_REQUEST["id"])) {
        $params = $GLOBALS["params"];
        $domainid = $params["domainid"];
    } else {
        $domainid = $_REQUEST["id"];
    }

    // TODO: use PDO instead or WHMCS\Domains class
    $result = select_query('tbldomains', 'idprotection,domain', ['id' => $domainid]);
    $data = mysql_fetch_array($result);
    $buttonarray = [];
    if ($params["DNSSEC"] == "on") {
        $buttonarray["DNSSEC Management"] = "dnssec";
    }
    if ($data) {
        if ($data["idprotection"]) {
            $buttonarray["WHOIS Privacy"] = "whoisprivacy";
        }
        if (preg_match('/\.ca$/i', $data["domain"])) {
            //TODO: - no longer contact related, but domain related
            //      - can't we output that information on default page?
            $buttonarray[".CA Registrant WHOIS Privacy"] = "whoisprivacy_ca";

            $buttonarray[".CA Change of Registrant"] = "registrantmodification_ca";
        } elseif (preg_match('/\.it$/i', $data["domain"])) {
            $buttonarray[".IT Change of Registrant"] = "registrantmodification_it";
        } elseif (preg_match('/\.(ch|li|se|sg)$/i', $data["domain"], $m)) {
            $buttonarray["." . strtoupper($m[1]) . " Change of Registrant"] = "registrantmodification_tld";
        }
    }
    return $buttonarray;
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
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    if (isset($params["original"])) {
        $params = $params["original"];
    }

    // TODO: use pdo or a better replacement
    $result = mysql_query("select g.name from tblproductgroups g, tblproducts p, tblhosting h where p.id = h.packageid and p.gid = g.id and h.domain = '".$domain->getDomain()."'");
    $data = mysql_fetch_array($result);
    if (!empty($data) && $data["name"]=="PREMIUM DOMAIN") {
        $r = ispapi_call([
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain->getDomain()
        ], ispapi_config($params));

        if ($r["CODE"] == 200) {
            global $smarty;
            $smarty->assign("statusdomain", $response["PROPERTY"]);
        }
        return [
            'templatefile' => 'clientarea_premium'
        ];
    }
    //TODO: return nothing otherwise???
    //TODO: is it deprecated???
}

/**
 * Request EPP Code from API
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 * @see https://confluence.hexonet.net/display/HB/Expiring+Authcodes
 *
 * @return array api response
 */
function ispapi_requestAuthCode($params)
{
    // TODO: review for .IE, .NZ etc. - needs probably backend-side review 1st
    $domain = $params["domainObj"];
    $tld = $domain->getLastTLDSegment();
    $target = "PROPERTY";
    switch ($tld) {
        case "de":
            $r = ispapi_call([
                "COMMAND" => "DENIC_CreateAuthInfo1",
                "DOMAIN" => $domain->getDomain()
            ], ispapi_config($params));
            break;
        case "be":
            $target = "REGISTRANT";
        case "eu":
            $r = ispapi_call([
                "COMMAND" => "RequestDomainAuthInfo",
                "DOMAIN" => $domain->getDomain()
            ], ispapi_config($params));
            break;
        default:
            $r = ispapi_call([
                "COMMAND" => "StatusDomain",
                "DOMAIN" => $domain->getDomain()
            ], ispapi_config($params));
            break;
    }

    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    if ($target == "REGISTRANT") {
        //email sent to registrant
        //shows success message: `domaingeteppcodeemailconfirmation`
        //see clientdomains.php RegGetEPPCode() Handling
        return [];
    }
    if (!strlen($r["PROPERTY"]["AUTH"][0])) {
        return [
            "error" => "No AuthInfo code assigned to this domain!"
        ];
    }
    return [
        "eppcode" => $r["PROPERTY"]["AUTH"][0]
    ];
}

/**
 * Get expirydate for WHMCS' Sync
 * NOTE: check for API error before calling this method
 *
 * @param array $r API response of StatusDomain
 *
 * @return string
 */
function ispapi_getExpiryDate($r)
{
    $r = $r["PROPERTY"];
    if (preg_match("/DELETE/i", $r["STATUS"][0])) {
        $expirydate = preg_replace("/ .*$/", "", $r["EXPIRATIONDATE"][0]);
    }
    if ($r["FAILUREDATE"][0] > $r["PAIDUNTILDATE"][0]) {
        $expirydate = preg_replace("/ .*$/", "", $r["PAIDUNTILDATE"][0]);
    } else {
        // https://github.com/hexonet/whmcs-ispapi-registrar/issues/82
        $finalizationts = strtotime($r["FINALIZATIONDATE"][0]);
        $paiduntilts = strtotime($r["PAIDUNTILDATE"][0]);
        $expirationts = strtotime($r["EXPIRATIONDATE"][0]);
        $expirydate = date("Y-m-d", $finalizationts + ($paiduntilts - $expirationts));
    }
    return $expirydate;
}

/**
 * Request Transfer Log for given domain name
 *
 * @param string $domain Domain Name
 */
function ispapi_getInboundTransferLog($params)
{
    $log = "";
    $r = ispapi_call([
        "COMMAND" => "QueryObjectLogList",
        "OBJECTCLASS" => "DOMAIN",
        "OBJECTID" => $params["domainObj"]->getDomain(),
        "ORDERBY" => "LOGDATEDESC",
        "LIMIT" => 1
    ], ispapi_config($params));
    if ($r["CODE"] == 200 && isset($r["PROPERTY"]["LOGINDEX"])) {
        foreach ($r["PROPERTY"]["LOGINDEX"] as $index => $logindex) {
            if (($r["PROPERTY"]["OPERATIONTYPE"][$index] == "INBOUND_TRANSFER") &&
                ($r["PROPERTY"]["OPERATIONSTATUS"][$index] == "FAILED")
            ) {
                $logr = ispapi_call([
                    "COMMAND" => "StatusObjectLog",
                    "LOGINDEX" => $logindex
                ], ispapi_config($params));
                if ($logr["CODE"] == 200) {
                    $log .= "\n" . implode("\n", $logr["PROPERTY"]["OPERATIONINFO"]);
                }
            }
        }
    }
    return $log;
}

/**
 * Detect if Ownerchange by Trade is required for given domain name

 * @param WHMCS\Domains\Domain $domain
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return bool
 */
function ispapi_needsTradeForRegistrantModification($domain, $params)
{
    $r = ispapi_call([
        "COMMAND" => "QueryDomainOptions",
        "DOMAIN0" => $domain->getDomain()
    ], ispapi_config($params));
    return ($r["CODE"] == 200 && $r["PROPERTY"]["ZONEPOLICYREGISTRANTNAMECHANGEBY"][0] == "TRADE");
}

/**
 * Add NAMESERVER# parameter to API command
 *
 * @param array $params common module parameters
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 * @param array &$command api command to update with nameservers
 */
function ispapi_applyNamserversCommand($params, &$command)
{
    for ($i=1; $i<=5; $i++) {
        $k = "ns" . $i;
        if (isset($params[$k])) {
            $v = trim($params[$k]);
            if (!empty($v)) {
                $command["NAMESERVER" . ($i - 1)] = $v;
            }
        }
    }
}

/**
 * Add (OWNER|ADMIN|TECH|BILLING)CONTACT0 parameters to API command
 *
 * @param array $params common module parameters
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 * @param array &$command api command to update with contact parameters
 */
function ispapi_applyContactsCommand($params, &$command)
{
    $admin = [
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
    ];
    if (strlen($params["adminaddress2"])) {
        $admin["STREET"] .= " , ".$params["adminaddress2"];
    }
    $command["OWNERCONTACT0"] = [
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
    ];
    if (strlen($params["address2"])) {
        $command["OWNERCONTACT0"]["STREET"] .= " , ".$params["address2"];
    }
    $command["ADMINCONTACT0"] = $admin;
    $command["TECHCONTACT0"] = $admin;
    $command["BILLINGCONTACT0"] = $admin;
}

/**
 * Write version data of ispapi modules to user environment
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 */
function ispapi_setStatsEnvironment($params)
{
    //Save information about module versions in the environment
    //workarround to call that only 1 time.
    static $included = false;
    global $CONFIG;

    if (!$included) {
        $included = true;
        $values = [
            "whmcs" => $params["whmcsVersion"],
            "updated_date" =>  (new DateTime("now", new DateTimeZone('UTC')))->format('Y-m-d H:i:s')." (UTC)",
            "ispapiwhmcs" => ispapi_GetISPAPIModuleVersion(),
            "phpversion" => phpversion(),
            "os" => php_uname("s")
        ];

        // get addon module versions
        $activemodules = array_filter(explode(",", $CONFIG["ActiveAddonModules"]));
        $addon = new WHMCS\Module\Addon();
        foreach ($addon->getList() as $module) {
            if (in_array($module, $activemodules) && preg_match("/^ispapi/i", $module) && !preg_match("/\_addon$/i", $module)) {
                $d = WHMCS\Module\Addon\Setting::module($module)->pluck("value", "setting");
                $values[$module] = $d["version"];
            }
        }

        // get server module versions
        $server = new WHMCS\Module\Server();
        foreach ($server->getList() as $module) {
            if (preg_match("/^ispapi/i", $module)) {
                $server->load($module);
                $v = $server->getMetaDataValue("MODULEVersion");
                $values[$module] = empty($v) ? "old" : $v;
            }
        }

        // get widget module versions
        $widget = new WHMCS\Module\Widget();
        foreach ($widget->getList() as $module) {
            if (preg_match("/^ispapi/i", $module)) {
                $widget->load($module);
                $tmp = explode("_", $module);
                $widgetClass = "\\ISPAPI\\" . ucfirst($tmp[0]) . ucfirst($tmp[1]) . "Widget";
                $mname=$tmp[0]."widget".$tmp[1];
                if (class_exists($widgetClass) && defined("$widgetClass::VERSION")) {
                    $values[$mname] = $widgetClass::VERSION;
                } else {
                    $values[$mname] = "n/a";
                }
            }
        }

        $command = [
            "COMMAND" => "SetEnvironment",
        ];
        $i=0;
        foreach ($values as $key => $value) {
            $command["ENVIRONMENTKEY$i"] = "middleware/whmcs/".$_SERVER["HTTP_HOST"];
            $command["ENVIRONMENTNAME$i"] = $key;
            $command["ENVIRONMENTVALUE$i"] = $value;
            $i++;
        }
        ispapi_call($command, ispapi_config($params));
    }
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
        $stmt->execute([".".$tld, $cur_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($data) && !in_array($data["msetupfee"], ["-1", "0"])) {
            return $data["msetupfee"];
        } else {
            return false;
        }
        //API COMMAND GetTLDPricing IS TRIGERING JS ERROR AND IS UNUSABLE.
        // $gettldpricing_res = localAPI('GetTLDPricing', ['currencyid' => $cur_id]);
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
    foreach ($relations["RELATIONTYPE"] as $idx => $relation) {
        if ($relation == $relationtype) {
            return $relations["RELATIONVALUE"][$idx];
        }
    }
    return false;
}

/**
 * Generate and return the user relations (StatusUser)
 * The user relations are stored in a session ($_SESSION["ISPAPICACHE"]["RELATIONS"]) and are regenerated after 600 seconds.
 *
 * @param array $params common module parameters
 *
 * @return array the user relations, return empty array in error case
 */
function ispapi_getUserRelations($params)
{
    $date = new DateTime();
    $sessdatafound = isset($_SESSION["ISPAPICACHE"]);
    if (!$sessdatafound || ($_SESSION["ISPAPICACHE"]["TIMESTAMP"] + 600 < $date->getTimestamp() )) {
        $r = ispapi_call([
            "COMMAND" => "StatusUser"
        ], ispapi_config($params));
        if ($r["CODE"] == 200) {
            $_SESSION["ISPAPICACHE"] = [
                "TIMESTAMP" => $date->getTimestamp(),
                "RELATIONS" => $r["PROPERTY"]
            ];
        } elseif (!$sessdatafound) {
            return [];
        }
    }
    return $_SESSION["ISPAPICACHE"]["RELATIONS"];
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
 * Handle the DNSSEC management page of a domain
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array
 */
function ispapi_dnssec($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];
    
    $origparams = $params;
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $error = false;
    $successful = false;

    if (isset($_POST["submit"])) {
        $command = [
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain->getDomain(),
            "SECDNS-MAXSIGLIFE" => $_POST["MAXSIGLIFE"],
            //"SECDNS-URGENT" => $_POST["URGENT"]
        ];

        //add DS records
        if (isset($_POST["SECDNS-DS"])) {
            $secdnsds = [];
            foreach ($_POST["SECDNS-DS"] as $dnssecrecord) {
                $everything_empty = true;//TODO: find out why!
                foreach ($dnssecrecord as $attribute) {
                    if (!empty($attribute)) {
                        $everything_empty = false;
                    }
                }
                if (!$everything_empty) {
                    $secdnsds[] = implode(" ", $dnssecrecord);
                }
            }
            if (!empty($secdnsds)) {
                $command["SECDNS-DS"] = $secdnsds;
            }
        }

        //remove existing DS records
        if (!isset($command["SECDNS-DS"])) {
            $r = ispapi_call([
                "COMMAND" => "StatusDomain",
                "DOMAIN" => $domain->getDomain()
            ], ispapi_config($params));
            if ($r["CODE"] == 200 && isset($r["PROPERTY"]["SECDNS-DS"])) {
                $command["DELSECDNS-DS"] = $r["PROPERTY"]["SECDNS-DS"];
            }
        }

        //add KEY records
        if (isset($_POST["SECDNS-KEY"])) {
            $secdnskey = [];
            foreach ($_POST["SECDNS-KEY"] as $dnssecrecord) {
                $everything_empty = true;//TODO: find out why!
                foreach ($dnssecrecord as $attribute) {
                    if (!empty($attribute)) {
                        $everything_empty = false;
                    }
                }
                if (!$everything_empty) {
                    $secdnskey[] = implode(" ", $dnssecrecord);
                }
            }
            if (!empty($secdnskey)) {
                $command["SECDNS-KEY"] = $secdnskey;
            }
        }
        $r = ispapi_call($command, ispapi_config($params));
        $successful = ($r["CODE"] == 200);
        if (!$successful) {
            $error = $r["DESCRIPTION"];
        }
    }

    $secdnsds = [];
    $secdnskey = [];
    $maxsiglife = "";
    
    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain
    ], ispapi_config($params));

    if ($r["CODE"] == 200) {
        $maxsiglife = (isset($r["PROPERTY"]["SECDNS-MAXSIGLIFE"])) ? $r["PROPERTY"]["SECDNS-MAXSIGLIFE"][0] : "";
        $secdnsds = (isset($r["PROPERTY"]["SECDNS-DS"])) ? $r["PROPERTY"]["SECDNS-DS"] : [];
        $secdnskey = (isset($r["PROPERTY"]["SECDNS-KEY"])) ? $r["PROPERTY"]["SECDNS-KEY"] : [];
        //delete empty KEY records
        $secdnskeynew = [];
        foreach ($secdnskey as $k) {
            if (!empty($k)) {//TODO: is this maybe because of how DS RRs got added?
                $secdnskeynew[] = $k;
            }
        }
        $secdnskey = $secdnskeynew;
    } else {
        $error = $r["DESCRIPTION"];
    }

    //split in different fields
    $secdnsds_newformat = [];
    foreach ($secdnsds as $ds) {
        list($keytag, $alg, $digesttype, $digest) = preg_split('/\s+/', $ds);
        $secdnsds_newformat[] = ["keytag" => $keytag, "alg" => $alg, "digesttype" => $digesttype, "digest" => $digest];
    }

    $secdnskey_newformat = [];
    foreach ($secdnskey as $key) {
        list($flags, $protocol, $alg, $pubkey) = preg_split('/\s+/', $key);
        $secdnskey_newformat[] = ["flags" => $flags, "protocol" => $protocol, "alg" => $alg, "pubkey" => $pubkey];
    }

    return [
        'templatefile' => "dnssec",
        'vars' => [
            'error' => $error,
            'successful' => $successful,
            'secdnsds' => $secdnsds_newformat,
            'secdnskey' => $secdnskey_newformat,
            'maxsiglife' => $maxsiglife
        ]
    ];
}

/**
 * Return a special page for the registrant modification of a .IT domain
 *
 * @param array $params common module parameters
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 * @return array an array with a template name and some variables
 */
function ispapi_registrantmodification_it($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    $origparams = $params;
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $error = false;
    $successful = false;
    $values = [];

    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($params));

    if ($r["CODE"] == 200) {
        $values["Registrant"] = ispapi_get_contact_info($r["PROPERTY"]["OWNERCONTACT"][0], $params);
    }

    //handle additionaldomainfields
    //------------------------------------------------------------------------------
    $myadditionaldomainfields = ispapi_include_additionalfields($params);
    //------------------------------------------------------------------------------

    if (isset($_POST["submit"])) {
        if (empty($_POST["additionalfields"]["Section 3 Agreement"]) ||
            empty($_POST["additionalfields"]["Section 5 Agreement"]) ||
            empty($_POST["additionalfields"]["Section 6 Agreement"]) ||
            empty($_POST["additionalfields"]["Section 7 Agreement"])
        ) {
            $error = "You have to accept the agreement section 3, 5, 6 and 7.";
        } else {
            $newvalues["Registrant"] = $_POST["contactdetails"]["Registrant"];
            $values = $newvalues;

            $command = [
                "COMMAND" => "TradeDomain",
                "DOMAIN" => $domain->getDomain()
            ];
            $map = [
                "OWNERCONTACT0" => "Registrant",
                "ADMINCONTACT0" => "Registrant",
            ];

            foreach ($map as $ctype => $ptype) {
                if (isset($_POST["contactdetails"][$ptype])) {
                    $p = $_POST["contactdetails"][$ptype];
                    $command[$ctype] = [
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
                        "EMAIL" => html_entity_decode($p["Email"], ENT_QUOTES)
                    ];
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
            ispapi_use_additionalfields($params, $command, $myadditionaldomainfields);
            $response = ispapi_call($command, ispapi_config($origparams));

            if ($response["CODE"] == 200) {
                $successful = $response["DESCRIPTION"];
            } else {
                $error = $response["DESCRIPTION"];
            }
        }
    }

    return [
        'templatefile' => "registrantmodification_it",
        'vars' => [
            'error' => $error,
            'successful' => $successful,
            'values' => $values,
            'additionalfields' => $myadditionaldomainfields
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
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    $origparams = $params;
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $error = false;
    $successful = false;
    

    $values = [];

    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($params));

    if ($r["CODE"] == 200) {
        $values["Registrant"] = ispapi_get_contact_info($r["PROPERTY"]["OWNERCONTACT"][0], $params);
    }

    if (isset($_POST["submit"])) {
        $newvalues["Registrant"] = $_POST["contactdetails"]["Registrant"];
        $values = $newvalues;

        $command = [
            "COMMAND" => "TradeDomain",
            "DOMAIN" => $domain->getDomain()
        ];
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
                    "EMAIL" => html_entity_decode($p["Email"], ENT_QUOTES)
                );
                if (strlen($p["Address 2"])) {
                    $command[$ctype]["STREET"] .= " , ".html_entity_decode($p["Address 2"], ENT_QUOTES);
                }
            }
        }

        if (preg_match('/\.se$/i', $domain)) {
            //check if the checkbox has been checked.
            if (!$_POST['se-checkbox'] == "on") {
                $error = "Please confirm that you will send the form back to complete the process";
            }
        }
        if (!$error) {
            ispapi_use_additionalfields($params, $command);
            $r = ispapi_call($command, ispapi_config($origparams));

            if ($r["CODE"] == 200) {
                $successful = $r["DESCRIPTION"];
            } else {
                $error = $r["DESCRIPTION"];
            }
        }
    }

    return [
        'templatefile' => "registrantmodification_tld",
        'vars' => [
            'error' => $error,
            'successful' => $successful,
            'values' => $values,
            'additionalfields' => $myadditionaldomainfields
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
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];
    
    $origparams = $params;
    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $error = false;
    $successful = false;

    $values = [];

    //handle additionaldomainfields
    //------------------------------------------------------------------------------
    $myadditionaldomainfields = ispapi_include_additionalfields($params);

    //delete "Contact Language" and "Trademark Number"
    $i = 0;
    foreach ($myadditionaldomainfields as $item) {
        if (in_array($item["Name"], array("Contact Language", "Trademark Number"))) {
            unset($myadditionaldomainfields[$i]);
        }
        $i++;
    }
    //------------------------------------------------------------------------------

    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($params));

    if ($r["CODE"] == 200) {
        $values["Registrant"] = ispapi_get_contact_info($r["PROPERTY"]["OWNERCONTACT"][0], $params);

        foreach ($myadditionaldomainfields as $item) {
            if ($item["Ispapi-Name"] == "X-CA-LEGALTYPE") {
                $options = explode(",", $item["Options"]);
                $options = preg_replace("/\|.+$/", "", $options);
                $index = array_search($r["PROPERTY"]["X-CA-LEGALTYPE"][0], $options);
                $values["Legal Type"] = $options[$index];
            }
        }
    }

    if (isset($_POST["submit"])) {
        //save
        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        $command = [
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain->getDomain()
        ];
        $map = array(
            "OWNERCONTACT0" => "Registrant",
        );

        foreach ($map as $ctype => $ptype) {
            if (isset($_POST["contactdetails"][$ptype])) {
                $p = $_POST["contactdetails"][$ptype];
                $command[$ctype] = [
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
                    "EMAIL" => html_entity_decode($p["Email"], ENT_QUOTES)
                ];
                if (strlen($p["Address 2"])) {
                    $command[$ctype]["STREET"] .= " , ".html_entity_decode($p["Address 2"], ENT_QUOTES);
                }
            }
        }
        $params["additionalfields"]["Legal Type"] = $_POST["additionalfields"]["Legal Type"];
        $params["additionalfields"]["WHOIS Opt-out"] = $_POST["additionalfields"]["WHOIS Opt-out"];

        ispapi_use_additionalfields($params, $command, $myadditionaldomainfields);

        $r = ispapi_call($command, ispapi_config($origparams));

        if ($r["CODE"] == 200) {
            $successful = $r["DESCRIPTION"];
        } else {
            $error = $r["DESCRIPTION"];
        }
    }

    // replace values with post values
    if (isset($_POST["submit"])) {
        $newvalues["Registrant"] = $_POST["contactdetails"]["Registrant"];
        $newvalues["Legal Type"] = $_POST["additionalfields"]["Legal Type"];
        $newvalues["WHOIS Opt-out"] = $_POST["additionalfields"]["WHOIS Opt-out"];
        $values = $newvalues;
    }

    return array(
        'templatefile' => "registrantmodification_ca",
        'vars' => array(
            'error' => $error,
            'successful' => $successful,
            'values' => $values,
            'additionalfields' => $myadditionaldomainfields
        )
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
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    if (isset($params["original"])) {
        $params = $params["original"];
    }
    $error = false;
    $values = [];

    if (isset($_REQUEST["idprotection"])) {
        $r = ispapi_call([
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain->getDomain(),
            "X-ACCEPT-WHOISTRUSTEE-TAC" => ($_REQUEST["idprotection"] == 'enable')? '1' : '0'
        ], ispapi_config($params));
        if ($r["CODE"] == 200) {
            return false;
        } else {
            $error = $r["DESCRIPTION"];
        }
    }

    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($params));

    $protected = 0;
    if ($r["CODE"] == 200 && isset($r["PROPERTY"]["X-ACCEPT-WHOISTRUSTEE-TAC"]) && $r["PROPERTY"]["X-ACCEPT-WHOISTRUSTEE-TAC"][0]) {
        $protected = 1;
    } elseif (!$error && $r["CODE"] != 200) {
        $error = $r["DESCRIPTION"];
    }

    return [
        'templatefile' => "whoisprivacy",
        'vars' => [
            'error' => $error,
            'protected' => $protected
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
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    if (isset($params["original"])) {
        $params = $params["original"];
    }
    
    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($params));

    $protectable = 0;
    $protected = 1;
    $legaltype = "";
    $error = false;

    if ($r["CODE"] == 200) {
        $protected = (isset($r["PROPERTY"]["X-CA-DISCLOSE"]) && $r["PROPERTY"]["X-CA-DISCLOSE"][0])?0:1;//TODO: inverse logic???
        $registrant = $r["PROPERTY"]["OWNERCONTACT"][0];
        if (isset($r["PROPERTY"]["X-CA-LEGALTYPE"])) {
            $legaltype = $r["PROPERTY"]["X-CA-LEGALTYPE"][0];
            if (preg_match('/^(CCT|RES|ABO|LGR)$/i', $legaltype)) {
                $protectable = 1;
            }
        }
    } else {
        $error = $r["DESCRIPTION"];
    }
    
    if (isset($_REQUEST["idprotection"])) {
        $r = ispapi_call([
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain->getDomain(),
            "X-CA-DISCLOSE" => ($_REQUEST["idprotection"] == 'enable')? '0' : '1'//TODO: inverse logic???
        ], ispapi_config($params));
        
        if ($r["CODE"] == 200) {
            return false;
        } else {
            $error = $r["DESCRIPTION"];
        }
    }
    return [
        'templatefile' => "whoisprivacy_ca",
        'vars' => [
            'error' => $error,
            'protected' => $protected,
            'protectable' => $protectable,
            'legaltype' => $legaltype
        ]
    ];
}

/**
 * Return true if the TLD is affected by the IRTP
 *
 * @param array $params common module parameters
 *
 * @return array
 */
function ispapi_IsAffectedByIRTP($domain, $params)
{
    $r = ispapi_call([
        "COMMAND" => "QueryDomainOptions",
        "DOMAIN0" => $domain
    ], ispapi_config($params));

    return ($r['PROPERTY']['ZONEPOLICYREGISTRANTNAMECHANGEBY'] && $r['PROPERTY']['ZONEPOLICYREGISTRANTNAMECHANGEBY'][0] === 'ICANN-TRADE');
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
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    $values = [];
    $origparams = $params;
    $params = ispapi_get_utf8_params($params);
    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($params));

    if ($r["CODE"] == 200) {
        //setIrtpTransferLock
        if (isset($r["PROPERTY"]["TRADE-TRANSFERLOCK-EXPIRATIONDATE"]) && isset($r["PROPERTY"]["TRADE-TRANSFERLOCK-EXPIRATIONDATE"][0])) {
            $values['setIrtpTransferLock'] = true;
        }

        //code optimization on getting nameservers and transferLock setting (applicable since WHMCS 7.6)
        //we kept the GetNameservers() GetRegistrarLock() for the users with < WHMCS 7.6
        //nameservers
        //no findings for htmlspecialchars in other registrar modules, looks like this got fixed
        for ($i = 1; $i <= 5; $i++) {
            $values['nameservers']['ns'.$i] = $r["PROPERTY"]["NAMESERVER"][$i-1];
        }
        
        //transferlock settings
        $values['transferlock'] = "";
        if (isset($r["PROPERTY"]["TRANSFERLOCK"]) && $r["PROPERTY"]["TRANSFERLOCK"][0] == "1") {
            $values['transferlock'] = "locked";
        }
    }

    //IRTP handling
    $isAfectedByIRTP = ispapi_IsAffectedByIRTP($domain->getDomain(), $params);
    if (preg_match('/Designated Agent/', $params['IRTP']) && $isAfectedByIRTP) {
        //setIsIrtpEnabled
        $values['setIsIrtpEnabled'] = true;

        //setDomainContactChangePending
        $r = ispapi_call([
            "COMMAND" => "QueryDomainPendingRegistrantVerificationList",
            "DOMAIN" => $domain->getDomain()
        ], ispapi_config($params));
        
        if ($r["CODE"] == 200) {
            //check if registrant change has been requested
            $statusDomainTrade_response = ispapi_call([
                "COMMAND" => "StatusDomainTrade",
                "DOMAIN" => $domain->getDomain()
            ], ispapi_config($params));

            if ($statusDomainTrade_response["CODE"] == 200) {
                if (isset($r["PROPERTY"]["X-REGISTRANT-VERIFICATION-STATUS"]) && (
                        $r["PROPERTY"]["X-REGISTRANT-VERIFICATION-STATUS"][0] == 'PENDING' ||
                        $r["PROPERTY"]["X-REGISTRANT-VERIFICATION-STATUS"][0] == 'OVERDUE'
                    )
                ) {
                    $values['setDomainContactChangePending'] = true;
                    //setPendingSuspension
                    $values['setPendingSuspension'] = true;
                }
            }
            //setDomainContactChangeExpiryDate
            if (isset($r["PROPERTY"]["X-REGISTRANT-VERIFICATION-DUEDATE"]) &&
                isset($r["PROPERTY"]["X-REGISTRANT-VERIFICATION-DUEDATE"][0])
            ) {
                $values['setDomainContactChangeExpiryDate'] = trim(preg_replace('/ .*/', '', $r["PROPERTY"]["X-REGISTRANT-VERIFICATION-DUEDATE"][0]));
            }
        }
    }
    
    return (new WHMCS\Domain\Registrar\Domain())
        ->setNameservers($values['nameservers'])
        ->setTransferLock($values['transferlock'])
        ->setIsIrtpEnabled($values['setIsIrtpEnabled'])
        ->setIrtpTransferLock($values['setIrtpTransferLock'])
        ->setDomainContactChangePending($values['setDomainContactChangePending'])
        ->setPendingSuspension($values['setPendingSuspension'])
        ->setDomainContactChangeExpiryDate($values['setDomainContactChangeExpiryDate'] ? Carbon::createFromFormat('!Y-m-d', $values['setDomainContactChangeExpiryDate']) : null)
        ->setIrtpVerificationTriggerFields([
            'Registrant' => [
                'First Name',
                'Last Name',
                'Organization Name',
                'Email'
            ]
        ]);
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
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    //perform API call to initiate resending of the IRTP Verification Email
    $r = ispapi_call([
        "COMMAND" => "ResendDomainTransferConfirmationEmails",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($params));
    
    if ($r["CODE"] != 200) {
        return [
            'error' => $r["DESCRIPTION"]
        ];
    }
    return [
        'success' => true
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
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    if (isset($params["original"])) {
        $params = $params["original"];
    }

    $r = ispapi_call([
        "COMMAND" => "QueryDNSZoneRRList",
        "DNSZONE" => $domain->getDomain() . ".",
        "SHORT" => 1,
        "EXTENDED" => 1
    ], ispapi_config($params));


    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }

    $result = [];
    foreach ($r["PROPERTY"]["RR"] as $rr) {
        $fields = explode(" ", $rr);
        array_shift($fields);
        array_shift($fields);
        array_shift($fields);
        $rrtype = array_shift($fields);

        if (($rrtype == "X-SMTP") && ($fields[1] == "MAILFORWARD")) {
            if (preg_match('/^(.*)\@$/', $fields[0], $m)) {
                $address = $m[1];
                if (!strlen($address)) {
                    $address = "*";
                }
            }
            $result[] = [
                "prefix" => $address,
                "forwardto" => $fields[2]
            ];
        }
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
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    if (isset($params["original"])) {
        $params = $params["original"];
    }
    //Bug fix - Issue WHMCS (TODO: affecting which version, which issue exactly?)
    //###########
    if (is_array($params["prefix"][0])) {
        $params["prefix"][0] = $params["prefix"][0][0];
    }
    if (is_array($params["forwardto"][0])) {
        $params["forwardto"][0] = $params["forwardto"][0][0];
    }
    //###########

    $command = [
        "COMMAND" => "UpdateDNSZone",
        "DNSZONE" => $domain->getDomain() . ".",
        "RESOLVETTLCONFLICTS" => 1,
        "INCSERIAL" => 1,
        "EXTENDED" => 1,
        "DELRR" => ["@ X-SMTP"],
        "ADDRR" => [],
    ];
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
    $r = ispapi_call($command, ispapi_config($params));

    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    return [
        "success" => true
    ];
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
    if (!isset($params["_contact_hash"][$contact])) {
        $r = ispapi_call([
            "COMMAND" => "StatusContact",
            "CONTACT" => $contact
        ], ispapi_config($params));

        $values = [];
        if ($r["CODE"] == 200) {
            $values["First Name"] = $r["PROPERTY"]["FIRSTNAME"][0];
            $values["Last Name"] = $r["PROPERTY"]["LASTNAME"][0];
            $values["Company Name"] = $r["PROPERTY"]["ORGANIZATION"][0];
            $values["Address"] = $r["PROPERTY"]["STREET"][0];
            $values["Address 2"] = $r["PROPERTY"]["STREET"][1];
            $values["City"] = $r["PROPERTY"]["CITY"][0];
            $values["State"] = $r["PROPERTY"]["STATE"][0];
            $values["Postcode"] = $r["PROPERTY"]["ZIP"][0];
            $values["Country"] = $r["PROPERTY"]["COUNTRY"][0];
            $values["Phone"] = $r["PROPERTY"]["PHONE"][0];
            $values["Fax"] = $r["PROPERTY"]["FAX"][0];
            $values["Email"] = $r["PROPERTY"]["EMAIL"][0];

            if ((count($r["PROPERTY"]["STREET"]) < 2) && preg_match('/^(.*) , (.*)/', $r["PROPERTY"]["STREET"][0], $m)) {
                $values["Address"] = $m[1];
                $values["Address 2"] = $m[2];
            }
        }
        $params["_contact_hash"][$contact] = $values;
    }
    return $params["_contact_hash"][$contact];
}



// ------------------------------------------------------------------------------
// ------- Helper functions and functions required to connect the API ----------
// ------------------------------------------------------------------------------
function ispapi_query_additionalfields(&$params)
{
    // TODO: use PDO or another way
    $result = mysql_query("SELECT name,value FROM tbldomainsadditionalfields
		WHERE domainid='".mysql_real_escape_string($params["domainid"])."'");
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $params['additionalfields'][$row['name']] = $row['value'];
    }
}

/**
 * Includes the correct additionl fields path based on the WHMCS version.
 * More information here: https://docs.whmcs.com/Additional_Domain_Fields
 * @param array $params input parameters
 * @return array additional domain fields in ISPAPI format
 */
function ispapi_include_additionalfields($params)
{
    $data = (new WHMCS\Domains())->getDomainsDatabyID($params["domainid"]);
    return (new WHMCS\Domains\AdditionalFields())
        ->setDomain($data["domain"])
        ->setDomainType($data["type"]) //can be "register" or "transfer"
        ->getFields();
}

/**
 * Load additional domain fields and apply appropriate parameters to the backend system API command
 * @param array $params input parameters
 * @return array additional domain fields in ISPAPI format
 */
 
function ispapi_use_additionalfields($params, &$command, $myadditionaldomainfields = null)
{
    if (is_null($myadditionaldomainfields)) {
        $myadditionaldomainfields = ispapi_include_additionalfields($params);
    }
    $ucCountry = strtoupper($params["country"]);
    foreach ($myadditionaldomainfields as $field) {
        if (isset($params['additionalfields'][$field["Name"]])) {
            $value = $params['additionalfields'][$field["Name"]];
            if (isset($field["Ispapi-Name"]) && !in_array($ucCountry, $field["Ispapi-IgnoreForCountries"])) {
                if (isset($field["Type"]) && $field["Type"]=="tickbox") {
                    $value = ( $value ) ? "1" : "0";//value is "on" or empty string in DB
                } elseif (isset($field["Ispapi-Format"]) && $field["Ispapi-Format"]=="UPPERCASE") {
                    $value = strtoupper($value);
                }
                if (strlen($value)) {
                    $command[$field["Ispapi-Name"]] = $value;
                }
            }
        }
    }
    //die( "<pre>" . print_r($params, true) . "</pre>" .
    //    "<pre>" . print_r($myadditionaldomainfields, true) . "</pre>" .
    //    "<pre>" . print_r($command, true) . "</pre>" );
}

function ispapi_get_utf8_params($params)
{
    if (isset($params["original"])) {
        return $params["original"];
    }
    $config = [];
    $result = mysql_query("SELECT setting, value FROM tblconfiguration;");//TODO: use PDO or ,,,
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
    $config = [
        "registrar" => $params["registrar"],
        "entity"    => ($params["TestMode"] == 1 || $params["TestMode"] == "on") ? "1234" : "54cd",
        "url"       => "http" . (($params["UseSSL"] == 1 || $params["UseSSL"] == "on") ? "s" : "") . "://api.ispapi.net/api/call.cgi",
        "idns"      => $params["ConvertIDNs"],
        "login"     => $params["Username"],
        "password"  => $params["Password"]
    ];
    if (strlen($params["ProxyServer"])) {
        $config["proxy"] = $params["ProxyServer"];
    }
    return $config;
}

function ispapi_call($command, $config)
{
    return ispapi_parse_response(ispapi_call_raw($command, $config));
}

function ispapi_call_raw($command, $config)
{
    global $ispapi_module_version;
    $args = [];
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
    //new domainchecker exceptional code
    //to skip below code for idn conversion as incoming DOMAIN# parameter is already in punycode
    //necessary to not break the above _CheckAvailability method
    //when we have reviewed all our modules we can move that integrated auto-idn-conversion below
    //to the _CheckAvailability method probably
    //--- BEGIN EXCEPTIONAL CODE ---
    $donotidnconvert = false;
    if (isset($command["SKIPIDNCONVERT"])) {
        if ($command["SKIPIDNCONVERT"]==1) {
            $donotidnconvert = true;
        }
        unset($command["SKIPIDNCONVERT"]);
    }
    $args["s_command"] = ispapi_encode_command($command);
    //--- END EXCEPTIONAL CODE ---

    # Convert IDNs via API (if applicable)
    if (!$donotidnconvert) {
        $new_command = [];
        foreach (explode("\n", $args["s_command"]) as $line) {
            if (preg_match('/^([^\=]+)\=(.*)/', $line, $m)) {
                $new_command[strtoupper(trim($m[1]))] = trim($m[2]);
            }
        }
        
        if (strtoupper($new_command["COMMAND"]) != "CONVERTIDN") {
            $replace = [];
            $domains = [];
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
                    $r = ispapi_call([
                        "COMMAND" => "ConvertIDN",
                        "DOMAIN" => $domains
                    ], $config);
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
    $postfields = [];
    foreach ($args as $key => $value) {
        $postfields[] = urlencode($key)."=".urlencode($value);
    }
    $postfields = implode('&', $postfields);
    curl_setopt_array($config["curl"], [
        CURLOPT_POST            =>  1,
        CURLOPT_POSTFIELDS      =>  $postfields,
        CURLOPT_HEADER          =>  0,
        CURLOPT_RETURNTRANSFER  =>  1,
        CURLOPT_PROXY           => $config["proxy"],
        CURLOPT_USERAGENT       => "ISPAPI/$ispapi_module_version WHMCS/".$GLOBALS["CONFIG"]["Version"]." PHP/".phpversion()." (".php_uname("s").")",
        CURLOPT_REFERER         => $GLOBALS["CONFIG"]["SystemURL"],
        CURLOPT_HTTPHEADER      => [
            'Expect:',
            'Content-type: text/html; charset=UTF-8'
        ]
    ]);
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
    $hash = [
        "PROPERTY" => [],
        "CODE" => "423",
        "DESCRIPTION" => "Empty response from API. Possibly a connection error as of unreachable API end point."
    ];
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
                    $hash["PROPERTY"][$prop][] = $value;
                } else {
                     $hash["PROPERTY"][$prop] = array($value);
                }
            } else {
                $hash[strtoupper($attr)] = $value;
            }
        }
    }
    if ((!$hash["CODE"]) || (!$hash["DESCRIPTION"])) {
        $hash = [
            "PROPERTY" => [],
            "CODE" => "423",
            "DESCRIPTION" => "Invalid response from API"
        ];
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
