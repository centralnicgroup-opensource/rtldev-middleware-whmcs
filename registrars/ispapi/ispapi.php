<?php
/**
 * ISPAPI Registrar Module
 *
 * @author HEXONET GmbH <support@hexonet.net>
 */

$module_version = "2.2.2";

require_once(implode(DIRECTORY_SEPARATOR, array(__DIR__, "lib", "AdditionalFields.class.php")));

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
            "Value"=> "The Official ISPAPI Registrar Module. <a target='blank_' href='https://www.hexonet.net'>www.hexonet.net</a>"
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
        "TestMode" => [
            "Type" => "yesno",
            "Description" => "Connect to OT&amp;E (Test Environment)"
        ],
        "ProxyServer" => [
            "Type" => "text",
            "Description" => "Optional (HTTP(S) Proxy Server)"
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

    if (!empty($params["Username"])) {
        $r = ispapi_call([
            "COMMAND" => "CheckAuthentication",
            "SUBUSER" => $params["Username"],
            "PASSWORD" => $params["Password"]
        ], ispapi_config($params));

        if ($r["CODE"] == 200) {
            $configarray[""] = [
                "Description" => "<div class='label label-success' style='padding:5px 50px;'><b>Connected ". (($params["TestMode"]=="on") ? "to OT&E environment" : "to PRODUCTION environment") . "</b></div>"
            ];
            ispapi_setStatsEnvironment($params);
        } else {
            $configarray[""] = [
                "Description" => "<div class='label label-success' style='padding:5px 50px;'><b>Disconnected (Verify Username and Password)<br/>".$r["CODE"]." " .$r["DESCRIPTION"]."</b></div>"
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

    $command = [
        "COMMAND" => "AddDomain",
        "DOMAIN" => $domain->getDomain(),
        "PERIOD" => $params["regperiod"]
    ];
    ispapi_applyNamserversCommand($params, $command);
    ispapi_applyContactsCommand($params, $command);
    
    if ($params["TRANSFERLOCK"]) {
        $command["TRANSFERLOCK"] = 1;
    }
    
    $isApplicationCase = preg_match("/\.swiss$/i", $domain->getDomain());
    if ($isApplicationCase) {
        $command["COMMAND"] = "AddDomainApplication";
        $command["CLASS"] = "GOLIVE";
    }

    ispapi_use_additionalfields($params, $command);//TODO: replace by new logic, check additionalfields branch

    //##################### PREMIUM DOMAIN HANDLING #######################
    if ($premiumDomainsEnabled && !empty($premiumDomainsCost)) {
        $check = ispapi_call([
            "COMMAND" => "CheckDomains",
            "DOMAIN0" => $domain->getDomain(),
            "PREMIUMCHANNELS" => "*"
        ], ispapi_config($params));

        if ($check["CODE"] == 200) {
            if ($premiumDomainsCost != $check["PROPERTY"]["PRICE"][0]) { //check if the price displayed to the customer is equal to the real cost at the registar
                return [
                    "error" => "Premium Domain Cost does not match!"
                ];
            }
            $isApplicationCase = true;
            $command["COMMAND"] = "AddDomainApplication";
            $command["CLASS"] =  empty($check["PROPERTY"]["CLASS"][0]) ? "AFTERMARKET_PURCHASE_".$check["PROPERTY"]["PREMIUMCHANNEL"][0] : $check["PROPERTY"]["CLASS"][0];
            $command["PRICE"] =  $premiumDomainsCost;
            $command["CURRENCY"] = $check["PROPERTY"]["CURRENCY"][0];
        }
    }
    //#####################################################################

    if (!$isApplicationCase) {//TODO auto-apply this AFTER successful registration
        //INTERNALDNS and idprotection parameters are not supported by AddDomainApplication command
        if ($params["dnsmanagement"]) {
            $command["INTERNALDNS"] = 1;
        }
        if ($params["idprotection"]) {
            $command["X-ACCEPT-WHOISTRUSTEE-TAC"] = 1;
        }
    }

    $response = ispapi_call($command, ispapi_config($params));
    if ($response["CODE"] != 200) {
        // return error info in error case
        return [
            "error" => $response["DESCRIPTION"]
        ];
    }
    if (preg_match("/\.swiss$/i", $domain->getDomain())) {
        // provide the Application ID and further information
        $application_id = $response['PROPERTY']['APPLICATION'][0];
        Capsule::table('tbldomains')
            ->where('id', '=', $params['domainid'])
            ->update(['additionalnotes' => "### DO NOT DELETE BELOW THIS LINE ### \nApplicationID:" . $application_id . "\n"]);
        return [
            "pending" => true,
            "pendingMessage" => (
                "Registration successfully requested (<strong>ID #".$application_id."</strong>). " .
                "Status is `Pending` until the .SWISS Registration Process completes." .
                (($params["dnsmanagement"] || $params["idprotection"]) ?
                    "<br/><small>NOTE: Available Domain Addons can be activated AFTER completion.</small>" :
                    "")
            )
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

    // ### domain transfer pre-check ###
    $r = ispapi_call([
        "COMMAND" => "CheckDomainTransfer",
        "DOMAIN" => $domain->getDomain(),
        "AUTH" => $params["eppcode"]
    ], ispapi_config($params));
    if ($r["CODE"] != 218) {// transfer request is not available
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    $r = $r["PROPERTY"];
    if (isset($r["AUTHISVALID"]) && $r["AUTHISVALID"][0] == "NO") {
        return [
            "error" => "Invaild Authorization Code"
        ];
    }
    if (isset($r["TRANSFERLOCK"]) && $r["TRANSFERLOCK"][0] == "1") {
        return [
            "error" => "Transferlock is active. Therefore the Domain cannot be transferred."
        ];
    }
    
    // ### Transfer Period Check
    // 1) check if whmcs default period is valid
    // 2) otherwise check if 0Y period is available which corresponds to transfer without renewal
    //    (probably for free) e.g. .es, .no, .nu
    // NOTE:
    // the default WHMCS period is the lowest configured period in domain pricing section,
    // so probably 1Y ... some of the 0Y TLDs don't even allow other periods.
    // This is a generic problem as WHMCS might charge for the transfer using the price defined for
    // the lowest transfer period.
    $period = $params["regperiod"] . "";
    $qr = ispapi_call([
        "COMMAND" => "QueryDomainOptions",
        "DOMAIN0" => $domain->getDomain()
    ], ispapi_config($params));
    if ($qr["CODE"] == 200) {
        $periods = explode(",", $qr['PROPERTY']['ZONETRANSFERPERIODS'][0]);
        // check if whmcs' regperiod can be used
        if (!in_array($params["regperiod"]."Y", $periods) && !in_array($params["regperiod"], $periods)) {
            // if not, check if 0Y transfer is possible
            if (!in_array("0Y", $periods) && !in_array("0", $periods)) {
                return [
                    "error" => "Transfer Period " . $period . " not available for " . $domain->getTLD() . ". Available ones for ISPAPI are: " . $qr['PROPERTY']['ZONETRANSFERPERIODS'][0] . ". Check your Domain Pricing configuration."
                ];
            } else {
                $period = "0Y";//TODO: execute regperiod renewal after successful transfer
            }
        }
    }

    // ### Initiate Domain Transfer
    $command = [
        "COMMAND" => "TransferDomain",
        "DOMAIN" => $domain->getDomain(),
        "PERIOD" => $period,
        "AUTH" => $params["eppcode"]
    ];
    if (!empty($r["USERTRANSFERREQUIRED"][0])) {
        $command["ACTION"] = "USERTRANSFER";// system internal transfer
    }
    //####################### CONTACT DATA SPECIFICS ######################
    //don't send owner admin tech billing contact for .NU .DK .CA, .US, .PT, .NO, .SE, .ES and n/gTLDs
    //IMPROVE by auto detection using querydomainoptions' category
    if (!preg_match('/\.([a-z]{3,}|nu|dk|ca|us|pt|no|se|es)$/i', $domain->getDomain())) {
        ispapi_applyContactsCommand($params, $command);
        //see: https://wiki.hexonet.net/wiki/FR#Domain_Transfer
        if (preg_match("/^(fr|pm|tf|re|wf|yt)$/i", $domain->getLastTLDSegment())) {
            unset($command["OWNERCONTACT0"]);
            unset($command["BILLINGCONTACT0"]);
        }
    }
    ispapi_applyNamserversCommand($params, $command);

    //##################### PREMIUM DOMAIN HANDLING #######################
    //check if premium domain functionality is enabled by the admin
    //check if the domain has a premium price
    //check if premium class is provided by domaintransfer
    if ((bool) $params['premiumEnabled'] && !empty($params['premiumCost']) && !empty($r['CLASS'][0])) {
        //check if the price displayed to the customer is equal to the real cost at the registar
        $currencycode = ispapi_getPremiumCurrency($params, $r["CLASS"][0]);
        $currency = \WHMCS\Billing\Currency::where("code", $currencycode)->first();
        if (!$currency) {
            throw new Exception("Missing currency configuration for: " . $currencycode);
        }
        $price = ispapi_getPremiumTransferPrice($params, $r['CLASS'][0], $currency->id);
        if ($price !== false && $params['premiumCost'] == $price) {
            $command["CLASS"] = $r['CLASS'][0];
        } else {
            return [
                "error" => "Price mismatch. Got " . $params['premiumCost'] . ", but expected " . $price
            ];
        }
    }
    
    //######################## consider additional fields ####################### TODO
    #$addflds = new \ISPAPI\AdditionalFields();
    #$addflds->setDomain($domain->getDomain())->setDomainType("Transfer");
    #$addflds->setFieldValues($params["additionalfields"]);
    #$addflds->addToCommand($command, $registrantcountry);
    
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

        if ($r["CODE"] == 200 &&
            !empty($r['PROPERTY']['SUBCLASS'][0]) &&
            $premiumDomainsCost == $r['PROPERTY']['RENEWALPRICE'][0]
        ) {
            // renewal price in whmcs is equal to the real cost at the registar
            $command["CLASS"] = $r['PROPERTY']['SUBCLASS'][0];
        }
    }

    $r = ispapi_call($command, ispapi_config($params));

    if ($r["CODE"] == 510) {//TODO can we detect this in advance to avoid unnecessary api calls?
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
        $values = ["error" => $r["DESCRIPTION"]];
        if ($r["CODE"] == 504 && preg_match("/TOO FEW.+CONTACTS/", $values["error"])) {
            $values["error"] = "Please update contact data first to be able to update nameserver data.";
        }
        return $values;
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
    
    // get registrant data
    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($params));

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
        ispapi_isAffectedByIRTP($domain->getDomain(), $params) && (
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
        //opt-out is not supported for AFNIC TLDs (eg: .FR)
        $r = ispapi_call([
            "COMMAND" => "QueryDomainOptions",
            "DOMAIN0" => $domain->getDomain()
        ], ispapi_config($params));
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
        ], ispapi_config($params));

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
            $r = ispapi_call($registrant_command, ispapi_config($params));
            if ($r["CODE"] != 200) {
                return [
                    "error" => $r["DESCRIPTION"]
                ];
            }
            unset($command["OWNERCONTACT0"]);
        }
        unset($command["X-CA-LEGALTYPE"]);
    } elseif (ispapi_needsTradeForRegistrantModification($domain, $params)) {
        // * below fields are not allowed to get modified, TradeDomain is required for it
        // * additional fields are not available in the default WHMCS contact information page
        // -> need for a specific registrant modification page
        // -> necessary to set the old data to get all the other changes processed
        // otherwise the API would complain about a required TradeDomain
        $r = ispapi_call([
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain->getDomain()
        ], ispapi_config($params));

        if ($r["CODE"] != 200) {
            return [
                "error" => $r["DESCRIPTION"]
            ];
        }
        $registrant = ispapi_get_contact_info($r["PROPERTY"]["OWNERCONTACT"][0], $params);
        
        $command["OWNERCONTACT0"]["FIRSTNAME"] = $registrant["First Name"];
        $command["OWNERCONTACT0"]["LASTNAME"] = $registrant["Last Name"];
        $command["OWNERCONTACT0"]["ORGANIZATION"] = $registrant["Company Name"];
        $command["OWNERCONTACT0"]["COUNTRY"] = $registrant["Country"];
    }

    ispapi_use_additionalfields($params, $command);
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
    if ($params['isIdnDomain']) {
        $label = empty($params['punyCodeSearchTerm']) ? strtolower($params['searchTerm']) : strtolower($params['punyCodeSearchTerm']);
    } else {
        $label = strtolower($params['searchTerm']);
    }

    $domainslist = ["all" => [], "list" => []];
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
    } else {
        $tldslist = $params['tldsToInclude'];
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
    }

    //TODO: chunk this as
    // * only ~250 are allowed at once and
    // * requesting all at once is probably quite slower
    $check = ispapi_call([
        "COMMAND" => "CheckDomains",
        "DOMAIN" => $domainslist["all"],
        "PREMIUMCHANNELS" => "*"
    ], ispapi_config($params));

    $results = new \WHMCS\Domains\DomainLookup\ResultsList();
    if ($check["CODE"] == 200) {
        $premiumEnabled = (bool) $params['premiumEnabled'];

        //GET AN ARRAY OF ALL TLDS CONFIGURED WITH HEXONET
        $pdo = \WHMCS\Database\Capsule::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT extension FROM tbldomainpricing WHERE autoreg REGEXP '^(ispapi|hexonet)$'");
        $stmt->execute();
        $ispapi_tlds = $stmt->fetchAll(\PDO::FETCH_COLUMN, 0);

        foreach ($domainslist["list"] as $index => $domain) {
            $registerprice = $renewprice = $currency = $status = "";
            $sr = new \WHMCS\Domains\DomainLookup\SearchResult($domain['sld'], $domain['tld']);
            $sr->setStatus($sr::STATUS_REGISTERED);
            if (preg_match('/^549 .+$/', $check["PROPERTY"]["DOMAINCHECK"][$index])) {
                //TLD NOT SUPPORTED AT HEXONET USE A FALLBACK TO THE WHOIS LOOKUP.
                $whois = localAPI("DomainWhois", array("domain" => $domain['sld'].$domain['tld']));
                if ($whois["status"] == "available") {
                    //DOMAIN AVAILABLE
                    $sr->setStatus($sr::STATUS_NOT_REGISTERED);
                }
            } elseif (preg_match('/^210 .+$/', $check["PROPERTY"]["DOMAINCHECK"][$index])) {
                //DOMAIN AVAILABLE
                $sr->setStatus($sr::STATUS_NOT_REGISTERED);
            } elseif (!empty($check["PROPERTY"]["PREMIUMCHANNEL"][$index]) || !empty($check["PROPERTY"]["CLASS"][$index])) {
                //IF PREMIUM DOMAIN ENABLED IN WHMCS - DISPLAY AVAILABLE + PRICE
                if (!$premiumEnabled) {
                    $sr->setStatus($sr::STATUS_RESERVED);
                } else {
                    $params["AvailabilityCheckResult"] = $check;
                    $params["AvailabilityCheckResultIndex"] = $index;
                    $prices = ispapi_GetPremiumPrice($params);
                    $sr->setPremiumDomain(true);
                    $sr->setPremiumCostPricing($prices);
                    if (empty($prices)) {
                        $sr->setStatus($sr::STATUS_RESERVED);
                    } elseif (isset($prices["register"])) {
                        $sr->setStatus($sr::STATUS_NOT_REGISTERED);
                    }
                }
            }

            if (!isset($params["suggestions"]) || $sr->getStatus() != $sr::STATUS_REGISTERED) {
                $results->append($sr);
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
        $marginleft = 60;
    } else {
        $marginleft = 220;
    }

    return [
        'information' => [
            'FriendlyName' => '<b>Don\'t have a HEXONET Account yet?</b>',
            'Description' => 'Get one here: <a target="_blank" href="https://www.hexonet.net/sign-up">https://www.hexonet.net/sign-up</a><br><br>
                                <b>The HEXONET Lookup Provider provides the following features:</b>
                                <ul style="text-align:left;margin-left:'.$marginleft.'px;margin-top:5px;">
                                <li>High Performance availability checks</li>
                                <li>Domain Name Suggestion Engine</li>
                                <li>Aftermarket and Registry Premium Domains support</li>
                                </ul>'
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
        return new \WHMCS\Domains\DomainLookup\ResultsList();
    }

    if ($params['isIdnDomain']) {
        $label = strtolower(empty($params['punyCodeSearchTerm']) ? $params['searchTerm'] : $params['punyCodeSearchTerm']);
    } else {
        $label = strtolower($params['searchTerm']);
    }

    $tldslist = $params['tldsToInclude'];
    $zones = [];
    foreach ($tldslist as $tld) {
        #IGNORE 3RD LEVEL TLDS - FTASKS-2876
        if (!preg_match("/\./", $tld)) {
            $zones[] = strtoupper($tld);
        }
    }

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

    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($params));

    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    if (isset($r["PROPERTY"]["TRANSFERLOCK"][0])) {
        return ($r["PROPERTY"]["TRANSFERLOCK"][0]=="1" ? "locked" : "unlocked");
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

    $r = ispapi_call([
        "COMMAND" => "ModifyDomain",
        "DOMAIN" => $domain->getDomain(),
        "TRANSFERLOCK" => ($params["lockenabled"] == "locked")? "1" : "0"
    ], ispapi_config($params));
    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }
    return [
        'success' => true
    ];
}

/**
 * Get DNS Zone of a domain name
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return array $hostrecords - an array with hostrecord of the domain name
 */
function ispapi_GetDNS($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    //convert the dnszone in idn
    $r = ispapi_call([
        "COMMAND" => "ConvertIDN",
        "DOMAIN" => $domain->getDomain()
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
        "EXTENDED" => 1,
        "SKIPIDNCONVERT" => 1
    ], ispapi_config($params));
    if ($r["CODE"] != 200) {
        return [
            "error" => $r["DESCRIPTION"]
        ];
    }

    //only for MX fields, they are note displayed in the "EXTENDED" version
    $r2 = ispapi_call([
        "COMMAND" => "QueryDNSZoneRRList",
        "DNSZONE" => $dnszone,
        "SHORT" => 1,
        "SKIPIDNCONVERT" => 1
    ], ispapi_config($params));
    if ($r2["CODE"] != 200) {
        return [
            "error" => $r2["DESCRIPTION"]
        ];
    }

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
                $hostrecords[] = [
                    "hostname" => $domain,
                    "type" => $rrtype,
                    "address" => $fields[0]
                ];
            }
        } elseif (preg_match("/^(AAAA|CNAME)$/", $rrtype)) {
            $hostrecords[] = [
               "hostname" => $domain,
               "type" => $rrtype,
               "address" => $fields[0]
            ];
        } elseif ($rrtype == "TXT") {
            $hostrecords[] = [
               "hostname" => $domain,
               "type" => $rrtype,
               "address" => implode(" ", $fields)
            ];
        } elseif ($rrtype == "SRV") {
            $priority = array_shift($fields);
            $hostrecords[] = [
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
            $hostrecords[] = [
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
                $hostrecords[] = [
                    "hostname" => $domain,
                    "type" => "MXE",
                    "address" => $m[1].".".$m[2].".".$m[3].".".$m[4]
                 ];
            } else {
                $hostrecords[] = [
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

    // TODO: review for .IE, .NZ etc. - needs probably backend-side review 1st
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
            //fall through to reuse .eu
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

    //-- sync domain additional field values
    $domain_data = (new \WHMCS\Domains())->getDomainsDatabyID((int) $params["domainid"]);
    $addflds = new \ISPAPI\AdditionalFields();
    $addflds->setDomain($domain_data["domain"])
            ->setDomainType($domain_data["type"]);
    $addflds->setFieldValuesFromAPI($r);
    $addflds->saveToDatabase();
    //-- done sync domain additional field values

    return [
        "active" => preg_match("/ACTIVE/i", $r["PROPERTY"]["STATUS"][0]),
        "expirydate" => ispapi_getExpiryDate($r),
        // domain expired (if EXPIRATIONDATE is in the past)
        // TODO: shouldn't we use the expirydate logic for the below too?
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
    
    $domain_pc = $domain_idn = $domain->getDomain();
    $r = ispapi_call([
        "COMMAND" => "ConvertIDN",
        "DOMAIN0" => $domain->getDomain(),
    ], ispapi_config($params));

    if ($r["CODE"]==200 && isset($r["PROPERTY"]["ACE"][0])) {
        $domain_pc = strtolower($r["PROPERTY"]["ACE"][0]);
        $domain_idn = strtolower($r["PROPERTY"]["IDN"][0]);
    }

    $r = ispapi_call([
        "COMMAND" => "QueryEventList",
        "CLASS" => "DOMAIN_TRANSFER",
        "MINDATE" => date("Y-m-d H:i:s", strtotime("first day of previous month")),
        "ORDERBY" => "EVENTDATEDESC",
        "WIDE" => 1
    ], ispapi_config($params));

    if ($r["CODE"] != 200 || !isset($r["PROPERTY"]["EVENTDATA0"])) {
        return [];
    }

    $rows = [];
    $r = $r["PROPERTY"];
    foreach ($r["EVENTDATA0"] as $idx => &$d) {
        $tmp = strtolower($d);
        if ("domain:" . $domain_pc == $tmp || "domain:" . $domain_idn == $tmp) {
            $rows[$r["EVENTSUBCLASS"][$idx]] = $r["EVENTDATE"][$idx];
            if ($r["EVENTSUBCLASS"][$idx]=="TRANSFER_PENDING") {
                break;
            }
        }
    }
    
    if (isset($rows["TRANSFER_SUCCESSFUL"])) {
        $r = $r = ispapi_call([
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain_pc,
            "SKIPIDNCONVERT" => 1
        ], ispapi_config($params));

        if ($r["CODE"]=="200") {
            $r = $r["PROPERTY"];
            $command = [
                "COMMAND" => "ModifyDomain",
                "DOMAIN" => $domain_pc,
                "SKIPIDNCONVERT" => 1
            ];
            // TODO:---------- EXCEPTION [BEGIN] --------
            // Missing/Empty contact handles after Transfer over THIN Registry [kschwarz]
            // Ticket#: 485677 DeskPro
            if (preg_match("/^(com|net|cc|tv)$/", $domain->getTLD())) {
                $domain_data = (new \WHMCS\Domains())->getDomainsDatabyID($params["domainid"]);
                $p = getClientsDetails($domain_data["userid"]);
                $cmdparams = [
                    "FIRSTNAME" => html_entity_decode($p["firstname"], ENT_QUOTES),
                    "LASTNAME" => html_entity_decode($p["lastname"], ENT_QUOTES),
                    "ORGANIZATION" => html_entity_decode($p["companyname"], ENT_QUOTES),
                    "STREET" => html_entity_decode($p["address1"], ENT_QUOTES),
                    "CITY" => html_entity_decode($p["city"], ENT_QUOTES),
                    "STATE" => html_entity_decode($p["state"], ENT_QUOTES),
                    "ZIP" => html_entity_decode($p["postcode"], ENT_QUOTES),
                    "COUNTRY" => html_entity_decode($p["country"], ENT_QUOTES),
                    "PHONE" => html_entity_decode($p["phonenumber"], ENT_QUOTES),
                    //"FAX" => html_entity_decode($p["Fax"], ENT_QUOTES), n/a in whmcs
                    "EMAIL" => html_entity_decode($p["email"], ENT_QUOTES),
                ];
                if (strlen($p["address2"])) {
                    $cmdparams["STREET"] .= " , ".html_entity_decode($p["address2"], ENT_QUOTES);
                }
                if (!empty($r["OWNERCONTACT0"][0]) && preg_match("/^AUTO-.+$/", $r["OWNERCONTACT0"][0])) {
                    $rc = ispapi_call([
                        "COMMAND" => "StatusContact",
                        "CONTACT" => $r["OWNERCONTACT0"][0]
                    ], ispapi_config($params));
                    if ($rc["CODE"] == 200) {
                        if (empty($rc["PROPERTY"]["NAME"][0]) &&
                            empty($rc["PROPERTY"]["EMAIL"][0]) &&
                            //empty($rc["PROPERTY"]["ORGANIZATION"][0]) && // with data
                            empty($rc["PROPERTY"]["PHONE"][0]) &&
                            //empty($rc["PROPERTY"]["COUNTRY"][0]) && // with data
                            empty($rc["PROPERTY"]["CITY"][0]) &&
                            empty($rc["PROPERTY"]["STREET"][0]) &&
                            empty($rc["PROPERTY"]["ZIP"][0])
                        ) {
                            $command["OWNERCONTACT0"] = $cmdparams;
                        }
                    }
                }
                $map = [
                    "OWNERCONTACT0",
                    "ADMINCONTACT0",
                    "TECHCONTACT0",
                    "BILLINGCONTACT0"
                ];
                foreach ($map as $ctype) {
                    if (empty($r[$ctype][0])) {
                        $command[$ctype] = $cmdparams;
                    }
                }
            }
            //--------------- EXCEPTION [END] -----------

            //activate the whoistrustee if set to 1 in WHMCS
            if (($params["idprotection"] == "1" || $params["idprotection"] == "on") &&
                empty($r["X-ACCEPT-WHOISTRUSTEE-TAC"][0]) // doesn't exist, "" or 0
            ) {
                $command["X-ACCEPT-WHOISTRUSTEE-TAC"] = 1;
            }
            //check if domain update is necessary
            if (count(array_keys($command))>3) {
                ispapi_call($command, ispapi_config($params));
            }
            $date = ($r["FAILUREDATE"][0] > $r["PAIDUNTILDATE"][0]) ? $r["PAIDUNTILDATE"][0] : $r["ACCOUNTINGDATE"][0];
            return [
                'completed' => true,
                'expirydate' => preg_replace('/ .*$/', '', $date)
            ];
        }
        //hint: not returning expirydate leads to auto-fallback to _Sync method
        return [
            'completed' => true
        ];
    }

    if (isset($rows["TRANSFER_FAILED"])) {
        return [
            'failed' => true,
            'reason' => "Transfer Failed" . ispapi_getInboundTransferLog($params, $domain_pc)
        ];
    }
    
    return [];
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
    $result = select_query('tbldomains', 'idprotection', ['id' => $domainid]);
    $data = mysql_fetch_array($result);
    $buttonarray = [];
    if ($params["DNSSEC"] == "on") {
        $buttonarray["DNSSEC Management"] = "dnssec";
    }
    if ($data) {
        if ($data["idprotection"]) {
            $buttonarray["WHOIS Privacy"] = "whoisprivacy";
        }
        if (preg_match('/\.ca$/i', $domain->getDomain())) {
            //TODO: - no longer contact related, but domain related
            //      - can't we output that information on default page?
            $buttonarray[".CA Registrant WHOIS Privacy"] = "whoisprivacy_ca";
        }
        $tld = "." . strtoupper($domain->getTLD());
        if (ispapi_needsTradeForRegistrantModification($domain, $params)) {
            $buttonarray[$tld . " Change of Registrant"] = "registrantmodificationtrade";
        } else {
            $addflds = new \ISPAPI\AdditionalFields();
            $addflds->setDomain($domain->getDomain())
                    ->setDomainType("Register");
            if ($addflds->isMissingRequiredFields()) {
                //in case we have additional required domain fields for registration
                $buttonarray[$tld . " Change of Registrant"] = "registrantmodification";
            }
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
            $smarty->assign("statusdomain", $r["PROPERTY"]);
        }
        return [
            'templatefile' => 'clientarea_premium'
        ];
    }
    //TODO: return nothing otherwise???
    //TODO: is it deprecated???
}

/**
 * Get Premium Price for given domain,
 * @see call of this method in \WHMCS\DOMAINS\DOMAIN::getPremiumPricing
 * $pricing = $registrarModule->call("GetPremiumPrice", array(
 *      "domain" => $this,
 *      "sld" => $this->getSecondLevel(),
 *      "tld" => $this->getDotTopLevel(),
 *      "type" => $type
 * ));
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
        $r = ispapi_call([
            "COMMAND" => "CheckDomains",
            "DOMAIN0" => $params["domain"],
            "PREMIUMCHANNELS" => "*"
        ], ispapi_config($params));
    }
    if (($r["CODE"] != 200) ||
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
            $racc = ispapi_call([ // worst case fallback
                "COMMAND" => "StatusAccount"
            ], ispapi_config($params));
            if ($racc["CODE"]!="200" || empty($racc["PROPERTY"]["CURRENCY"][0])) {
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
    if (!preg_match('/\:/', $class)) {
        //REGISTRY PREMIUM DOMAIN (e.g. PREMIUM_DATE_F)
        return  ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_".$class."_CURRENCY");
    }
    //VARIABLE FEE PREMIUM DOMAINS (e.g. PREMIUM_TOP_CNY:24:2976)
    return preg_replace("/(^.+_|:.+$)", "", $class);
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
    if (!preg_match('/\:/', $class)) {
        //REGISTRY PREMIUM DOMAIN (e.g. PREMIUM_DATE_F)
        return $registerprice;// looking up relations not necessary API provided the prices
    }
    //VARIABLE FEE PREMIUM DOMAINS (e.g. PREMIUM_TOP_CNY:24:2976)
    $p = preg_split("/\:/", $class);
    $cl = preg_split("/_/", $p[0]);
    $premiummarkupfix_value = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_".$cl[0]."_".$cl[1]."_*_SETUP_MARKUP_FIX");
    $premiummarkupvar_value = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_".$cl[0]."_".$cl[1]."_*_SETUP_MARKUP_VAR");
    if ($premiummarkupfix_value && $premiummarkupvar_value) {
        $currency = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_".$cl[0]."_".$cl[1]."_*_CURRENCY");
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
        return $p[2] * (1 + $premiummarkupvar_value/100) + $premiummarkupfix_value;
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
    if (!preg_match('/\:/', $class)) {
        //REGISTRY PREMIUM DOMAIN (e.g. PREMIUM_DATE_F)
        $currency = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_".$class."_CURRENCY");
        if ($currency === false) {
            return false;
        }
        $currency = \WHMCS\Billing\Currency::where("code", $currency)->first();
        if (!$currency) {
            return false;
        }
        $transfer = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_".$class."_TRANSFER");
        // premium period is in general 1Y, no need to reflect period in calculations
        if ($transfer !== false && ($currency->id != $cur_id)) {
            return convertCurrency($transfer, $currency->id, $cur_id);
        }
        return  $transfer;
    }
    //VARIABLE FEE PREMIUM DOMAINS (e.g. PREMIUM_TOP_CNY:24:2976)
    $p = preg_split("/\:/", $class);
    $cl = preg_split("/_/", $p[0]);
    $premiummarkupfix_value = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_".$cl[0]."_".$cl[1]."_*_TRANSFER_MARKUP_FIX");
    $premiummarkupvar_value = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_".$cl[0]."_".$cl[1]."_*_TRANSFER_MARKUP_VAR");
    if ($premiummarkupfix_value && $premiummarkupvar_value) {
        $currency = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_".$cl[0]."_".$cl[1]."_*_CURRENCY");
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
        return $p[1] * (1 + $premiummarkupvar_value/100) + $premiummarkupfix_value;
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
    if (!preg_match('/\:/', $class)) {
        //REGISTRY PREMIUM DOMAIN (e.g. PREMIUM_DATE_F)
        $currency = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_".$class."_CURRENCY");
        if ($currency === false) {
            return false;
        }
        $currency = \WHMCS\Billing\Currency::where("code", $currency)->first();
        if (!$currency) {
            return false;
        }
        $renewprice = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_".$class."_ANNUAL");
        if ($renewprice && ($currency->id != $cur_id)) {
            $renewprice = convertCurrency($renewprice, $cur_id2->id, $cur_id);
        }
        return $renewprice;
    }
    //VARIABLE FEE PREMIUM DOMAINS (e.g. PREMIUM_TOP_CNY:24:2976)
    $p = preg_split("/\:/", $class);
    $cl = preg_split("/_/", $p[0]);
    $premiummarkupfix_value = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_".$cl[0]."_".$cl[1]."_*_ANNUAL_MARKUP_FIX");
    $premiummarkupvar_value = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_".$cl[0]."_".$cl[1]."_*_ANNUAL_MARKUP_VAR");
    if ($premiummarkupfix_value && $premiummarkupvar_value) {
        $currency = ispapi_getUserRelationValue($params, "PRICE_CLASS_DOMAIN_".$cl[0]."_".$cl[1]."_*_CURRENCY");
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
        return $p[1] * (1 + $premiummarkupvar_value/100) + $premiummarkupfix_value;
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
        $stmt->execute(array(".".$tld, $cur_id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($data) && !in_array($data["msetupfee"], array("-1", "0"))) {
            return $data["msetupfee"];
        }
        return false;
        //API COMMAND GetTLDPricing IS TRIGERING JS ERROR AND IS UNUSABLE.
        // $gettldpricing_res = localAPI('GetTLDPricing', array('currencyid' => $cur_id));
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
 * @return array/bool the user relations, false if not found
 */
function ispapi_getUserRelations($params)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $date = new DateTime();
    $sessdatafound = isset($_SESSION["ISPAPICACHE"]);
    if (!$sessdatafound || ($_SESSION["ISPAPICACHE"]["TIMESTAMP"] + 600 < $date->getTimestamp())) {
        $r = ispapi_call([
            "COMMAND" => "StatusUser"
        ], ispapi_config($params));
        if ($r["CODE"] == 200) {
            $_SESSION["ISPAPICACHE"] = [
                "TIMESTAMP" => $date->getTimestamp() ,
                "RELATIONS" => $r["PROPERTY"]
            ];
            return $_SESSION["ISPAPICACHE"]["RELATIONS"];
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
 * @return array an array with a template name
 */
function ispapi_dnssec($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

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
 * Return a special page for the registrant modification of a domain requiring TRADE
 *
 * @param array $params common module parameters
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 * @return array an array with a template name and some variables
 */
function ispapi_registrantmodificationtrade($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    $domain_data = (new \WHMCS\Domains())->getDomainsDatabyID((int) $params["domainid"]);
    $addflds = new \ISPAPI\AdditionalFields();
    $addflds->setDomain($domain_data["domain"])
            ->setDomainType($domain_data["type"]);
    
    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($params));

    $values = [];
    if ($r["CODE"] == 200) {
        $values["Registrant"] = ispapi_get_contact_info($r["PROPERTY"]["OWNERCONTACT"][0], $params);
    }
    
    $error = false;
    $successful = false;
    $missingfields = [];
    $needsAdminC = ispapi_needsAdminContactInTrade($domain->getLastTLDSegment());

    if (isset($_POST["submit"])) {
        $addflds->setFieldValues($_POST["domainfield"]);
        if ($addflds->isMissingRequiredFields()) {
            $error = Lang::trans("carterrordomainconfigskipped");
            $missingfields = $addflds->getMissingRequiredFields();
        } else {
            $values["Registrant"] = $_POST["contactdetails"]["Registrant"];

            $command = [
                "COMMAND" => "TradeDomain",
                "DOMAIN" => $domain->getDomain()
            ];
            $map = [
                "OWNERCONTACT0" => "Registrant"
            ];
            if ($needsAdminC) {
                $map["ADMINCONTACT0"] = "Registrant";
            }
            ispapi_get_contact_info2($command, $_POST, $map);

            $addflds->addToCommand($command, $params["country"]);
            $response = ispapi_call($command, ispapi_config($params));
            if ($response["CODE"] == 200) {
                $addflds->saveToDatabase();
                $successful = $response["DESCRIPTION"];
            } else {
                $error = $response["DESCRIPTION"];
            }
        }
    } else {
        $addflds->getFieldValuesFromDatabase($domain_data["id"]);
    }

    return [
        'templatefile' => "registrantmodification",
        'vars' => [
            'tld' => $domain->getLastTLDSegment(),
            'needsAdminC' => $needsAdminC,
            'furtherDocsURL' => ispapi_getTradeFurtherDocsURL($domain->getDomain(), $domain->getLastTLDSegment()),
            'error' => $error,
            'successful' => $successful,
            'values' => $values,
            'additionalfields' => $addflds,
            'missingfields' => $missingfields,
            'type' => 'trade'
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
function ispapi_registrantmodification($params)
{
    $params = injectDomainObjectIfNecessary($params);
    /** @var \WHMCS\Domains\Domain $domain */
    $domain = $params["domainObj"];

    $domain_data = (new \WHMCS\Domains())->getDomainsDatabyID((int) $params["domainid"]);
    $addflds = new \ISPAPI\AdditionalFields();
    $addflds->setDomain($domain_data["domain"])
            ->setDomainType($domain_data["type"]);
    
    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($params));

    $values = [];
    if ($r["CODE"] == 200) {
        $values["Registrant"] = ispapi_get_contact_info($r["PROPERTY"]["OWNERCONTACT"][0], $params);
    }
    
    $error = false;
    $successful = false;
    $missingfields = [];

    if (isset($_POST["submit"])) {
        $addflds->setFieldValues($_POST["domainfield"]);
        if ($addflds->isMissingRequiredFields()) {
            $error = Lang::trans("carterrordomainconfigskipped");
            $missingfields = $addflds->getMissingRequiredFields();
        } else {
            $values["Registrant"] = $_POST["contactdetails"]["Registrant"];

            $command = [
                "COMMAND" => "ModifyDomain",
                "DOMAIN" => $domain->getDomain()
            ];

            ispapi_get_contact_info2($command, $_POST, [
                "OWNERCONTACT0" => "Registrant"
            ]);

            $addflds->addToCommand($command, $params["country"]);
            $r = ispapi_call($command, ispapi_config($params));

            if ($r["CODE"] == 200) {
                $addflds->saveToDatabase();
                $successful = $r["DESCRIPTION"];
            } else {
                $error = $r["DESCRIPTION"];
            }
        }
    } else {
        $addflds->getFieldValuesFromDatabase($domain_data["id"]);
    }

    return array(
        'templatefile' => "registrantmodification",
        'vars' => array(
            'tld' => $domain->getLastTLDSegment(),
            'needsAdminC' => false,
            'furtherDocsURL' => "",
            'error' => $error,
            'successful' => $successful,
            'values' => $values,
            'additionalfields' => $addflds,
            'missingfields' => $missingfields,
            'type' => ''
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
    
    $r = ispapi_call([
        "COMMAND" => "StatusDomain",
        "DOMAIN" => $domain->getDomain()
    ], ispapi_config($params));

    $protectable = 0;
    $protected = 1;
    $legaltype = "";
    $error = false;

    if ($r["CODE"] == 200) {
        $protected = (isset($r["PROPERTY"]["X-CA-DISCLOSE"]) && $r["PROPERTY"]["X-CA-DISCLOSE"][0])?0:1;
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
            "X-CA-DISCLOSE" => ($_REQUEST["idprotection"] == 'enable')? '0' : '1'
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
 * @return array $values - returns true
 */
function ispapi_isAffectedByIRTP($domain, $params)
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

function ispapi_get_contact_info2(&$command, $data, $map)
{
    foreach ($map as $ctype => $ptype) {
        if (isset($data["contactdetails"][$ptype])) {
            $p = $data["contactdetails"][$ptype];
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
}

/**
 * Load additional domain fields and apply appropriate parameters to the backend system API command
 * @param array $params input parameters
 * @return array additional domain fields in ISPAPI format
 */
function ispapi_use_additionalfields($params, &$command)
{
    $myadditionaldomainfields = $params["additionalfields"];
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
}

function ispapi_config($params)
{
    $config = [
        "registrar" => $params["registrar"],
        "entity"    => ($params["TestMode"] == 1 || $params["TestMode"] == "on") ? "1234" : "54cd",
        "url"       => "https://api.ispapi.net/api/call.cgi",
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
        $addon = new \WHMCS\Module\Addon();
        foreach ($addon->getList() as $module) {
            if (in_array($module, $activemodules) && preg_match("/^ispapi/i", $module) && !preg_match("/\_addon$/i", $module)) {
                $d = \WHMCS\Module\Addon\Setting::module($module)->pluck("value", "setting");
                $values[$module] = $d["version"];
            }
        }

        // get server module versions
        $server = new \WHMCS\Module\Server();
        foreach ($server->getList() as $module) {
            if (preg_match("/^ispapi/i", $module)) {
                $server->load($module);
                $v = $server->getMetaDataValue("MODULEVersion");
                $values[$module] = empty($v) ? "old" : $v;
            }
        }

        // get widget module versions
        $widget = new \WHMCS\Module\Widget();
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
function ispapi_getInboundTransferLog($params, $domain_pc)
{
    $log = "";
    $r = ispapi_call([
        "COMMAND" => "QueryObjectLogList",
        "OBJECTCLASS" => "DOMAIN",
        "OBJECTID" => $domain_pc,
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
 * Check if providing Admin-C in Trade is necessary
 * @param string $tld last segment of the tld
 * @return bool
 */
function ispapi_needsAdminContactInTrade($tld)
{
    //see https://wiki.hexonet.net/wiki/IT "Ownerchange"
    //see https://wiki.hexonet.net/wiki/ES "Ownerchange"
    //if the new registrant is an individual then the admin contact is required and has to match the new registrant contact
    return in_array($tld, ["it", "es"]);
}

/**
 * Check if providing Admin-C in Trade is necessary
 * @param string $domain domain name
 * @param string $tld last segment of the tld
 * @return string
 */
function ispapi_getTradeFurtherDocsURL($domain, $tld)
{
    return preg_match("/^(au|no|nu|pt|ru|se)$/i", $tld) ?
        "https://www.domainform.net/form/" . $tld . "?type=ownerchange&domain=" . $domain . "&language=en" :
        "";
}

ispapi_InitModule($module_version);
