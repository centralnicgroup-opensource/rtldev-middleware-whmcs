<?php

namespace WHMCS\Module\Registrar\Ispapi;

use WHMCS\Module\Registrar\Ispapi\Ispapi;
use WHMCS\Module\Registrar\Ispapi\Contact as HXContact;
use WHMCS\Config\Setting as Setting;
use Illuminate\Database\Capsule\Manager as DB;

class Domain
{
    /**
     * get domain name variants (idn, punycode)
     * @param array $params common module parameters
     * @param string $domain domain name
     * @return array with keys idn and punycode
     */
    public static function convert($params, $domain)
    {
        $domain = strtolower($domain);
        $r = Ispapi::call([
            "COMMAND" => "ConvertIDN",
            "DOMAIN0" => $domain
        ], $params);
        if ($r["CODE"] === "200" && !empty($r["PROPERTY"]["ACE"][0])) {
            return [
                "idn" => strtolower($r["PROPERTY"]["IDN"][0]),
                "punycode" => strtolower($r["PROPERTY"]["ACE"][0])
            ];
        }
        return [
            "idn" => $domain,
            "punycode" => $domain
        ];
    }
    /**
     * get domain status
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @return array
     */
    public static function getStatus($params, $domain, $hosttypeattr = false)
    {
        $cmd = [
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain
        ];
        if ($hosttypeattr) {
            $cmd["HOSTTYPE"] = "ATTRIBUTE";
        }
        $r = Ispapi::call($cmd, $params);
        if ($r["CODE"] !== "200") {
            return [
                "success" => false,
                "error" => "Loading domain status failed. (" . $r["CODE"] . " " . $r["DESCRIPTION"] . ")",
                "errorcode" => $r["CODE"]
            ];
        }
        return [
            "success" => true,
            "data" => $r["PROPERTY"]
        ];
    }
    /**
     * Return WHMCS Status Data of an expired domain name
     * (StatusDomain returns 545 and no outbound transfer in Object Log)
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @param array $r optional API response, just in case we have it already,
     * @param bool $isSync optional Flag toggle Sync Debug output
     * @param int $sub #seconds to substract from calculated expirydate (0d = 0 by default); whmcs just deals with date portion
     * @return array
     */
    public static function getExpiredStatus($params, $domain, $r = null, $isSync = true, $sub = 0)
    {
        if (is_null($r)) {
            $r = Ispapi::call([
                "COMMAND" => "QueryObjectList",
                "OBJECTCLASS" => "DELETEDDOMAIN",
                "OBJECTID" => $domain
            ], $params);
        }
        if ($r["CODE"] === "545") {
            if ($isSync) {
                logActivity($domain . ": Domain Sync finished. Status updated to `Transferred Away`");
            }
            return [
                "transferredAway" => true
            ];
        }
        if ($r["CODE"] === "200" && $r["PROPERTY"]["COUNT"][0] > 0) {
            $expirationdate = Ispapi::castDate($r["PROPERTY"]["EXPIRATIONDATE"][0]);
            $ts = $expirationdate["ts"] - $sub;
            $values = [
                "expirydate" => date("Y-m-d", $ts),
                "expired" => strtotime("now") > $ts
            ];
            if ($isSync) {
                logActivity($domain . ": Domain Sync finished. Updated expirydate: " . $values["expirydate"]);
            }
            return $values;
        }
        if ($r["CODE"] === "200" && $r["PROPERTY"]["COUNT"][0] === "0") {
            // deleted, not restorable
            DB::table("tbldomains")
                ->where([
                    [ "id", "=", $params["domainid"] ]
                ])
                ->update(["status" => "Expired"]);
            if ($isSync) {
                logActivity($domain . ": Domain Sync finished. Status updated to `Expired` (not restorable).");
            }
            return [
                "expired" => true// this doesn't change anything that's why we update the status
            ];
        }
        if ($isSync) {
            logActivity($domain . ": Domain Sync finished. Status Detection failed - probably a temporary issue.");
        }
        return []; // whmcs should show a curl error
    }
    /**
     * Returns WHMCS Status Data for a given Domain
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @param string $isExpiredDomain optional flag identifying if this domain is already expired or not
     * @param array $r optional API response, just in case we have it already (StatusDomain or QueryObjectList)
     * @param array $needsCarbon optional flag, if Carbon instance is required (GetDomainInformation). false by default.
     * @param int $sub #seconds to substract from calculated expirydate (0d = 0 by default); whmcs just deals with date portion
     * @return array
     */
    public static function getExpiryData($params, $domain, $isExpiredDomain = false, $r = null, $needsCarbon = false, $sub = 0)
    {
        if ($isExpiredDomain) {
            return self::getExpiredStatus($params, $domain, $r);
        }
        if (is_null($r)) {
            $r = self::getStatus($params, $domain);
        }
        if (!$r["success"]) {
            return [];
        }
        $r = $r["data"];

        // cast our UTC API timestamp format to useful formats in local timezone
        $expirationdate = Ispapi::castDate($r["EXPIRATIONDATE"][0]);
        $finalizationdate = Ispapi::castDate($r["FINALIZATIONDATE"][0]);
        $paiduntildate = Ispapi::castDate($r["PAIDUNTILDATE"][0]);
        $failuredate = Ispapi::castDate($r["FAILUREDATE"][0]);

        //Example of using Carbon
        //$expirydate = \WHMCS\Carbon::createFromFormat("Y-m-d H:i:s", $expirydate["long"])->subDays(1);
        //$values["expirydate"] = $expirydate->toDateString();//YYYY-MM-DD
        //$values["expired"] = $expirydate->isPast();
        $format = "Y-m-d H:i:s";
        if ($failuredate["ts"] > $paiduntildate["ts"]) {
            $expirydate = Ispapi::castDate($r["FAILUREDATE"][0]);
            $ts = $paiduntildate["ts"] - $sub;
            $values = [
                "expirydate" => date("Y-m-d", $ts),
                "expired" => strtotime("now") > $ts,
                "active" => (bool)preg_match("/ACTIVE/i", $r["STATUS"][0])
            ];
            if ($needsCarbon) {
                $values["expirydate"] = \WHMCS\Carbon::createFromFormat($format, date($format, $ts));
            }
            return $values;
        }
        // https://github.com/hexonet/whmcs-ispapi-registrar/issues/82
        $ts = $finalizationdate["ts"] + ($paiduntildate["ts"] - $expirationdate["ts"]) - $sub;
        $values = [
            "expirydate" => date("Y-m-d", $ts),
            "expired" => strtotime("now") > $ts,
            "active" => (bool)preg_match("/ACTIVE/i", $r["STATUS"][0])
        ];
        if ($needsCarbon) {
            $values["expirydate"] = \WHMCS\Carbon::createFromFormat($format, date($format, $ts));
        }
        return $values;
    }
    /**
     * get nameservers of transfer request
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @return array
     */
    public static function getNameservers($params, $domain)
    {
        $r = self::getStatus($params, $domain);
        if (!$r["success"]) {
            return $r;
        }
        return [
            "success" => true,
            "nameservers" => $r["data"]["NAMESERVER"]
        ];
    }
    /**
     * Checks if a contact update is considered for the given domain name
     * Applies to .com / .net / .cc / .tv domain names with "broken" contact data
     * where we were not able to parse contact details out of whois data after transfer
     * because of active WHOIS / id protection service.
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @param array $r (optional) Domain::getStatus response
     * @return bool
     */
    public static function needsContactUpdate($params, $domain, $r = null)
    {
        if (
            $params["CHUpdTransfer"] !== "on"
            || !preg_match("/\.(com|net|cc|tv)$/", $domain)
        ) {
            return false;
        }
        if (is_null($r)) {
            $r = self::getStatus($params, $domain);
        }
        if (!$r["success"]) {
            return false;
        }
        $map = [
            "OWNERCONTACT",
            "ADMINCONTACT",
            "TECHCONTACT",
            "BILLINGCONTACT"
        ];
        foreach ($map as $ctype) {
            if (
                empty($r["data"][$ctype][0])
                || preg_match("/^AUTO-.+$/", $r["data"][$ctype][0])
            ) {
                return true;
            }
        }
        return false;
    }
    /**
     * Returns registrant and admin data related to the given domain
     * based on your settings in WHMCS.
     * @param int $domainid WHMCS domain id
     * @return array
     */
    public static function getContactDetailsWHMCS($domainid)
    {
        if (!function_exists("convertStateToCode") || !function_exists("getClientsDetails")) {
            require implode(DIRECTORY_SEPARATOR, [ROOTDIR, "includes", "clientfunctions.php"]);
            // TODO, ROOTDIR might not be working in Sync / TransferSync
        }
        // --- fetch client details of current domain
        $d = new \WHMCS\Domains();
        $domain_data = $d->getDomainsDatabyID($domainid);
        $p = getClientsDetails($domain_data["userid"]);
        $cmdparams = [
            "FIRSTNAME" => html_entity_decode($p["firstname"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "LASTNAME" => html_entity_decode($p["lastname"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "ORGANIZATION" => html_entity_decode($p["companyname"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "STREET" => html_entity_decode($p["address1"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "CITY" => html_entity_decode($p["city"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "STATE" => html_entity_decode($p["state"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "ZIP" => html_entity_decode($p["postcode"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "COUNTRY" => html_entity_decode($p["country"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "PHONE" => html_entity_decode($p["phonenumber"], ENT_QUOTES | ENT_XML1, "UTF-8"),
            "EMAIL" => html_entity_decode($p["email"], ENT_QUOTES | ENT_XML1, "UTF-8")
            //"FAX" => n/a in whmcs
        ];
        if (strlen($p["address2"])) {
            $cmdparams["STREET"] .= " , " . html_entity_decode($p["address2"], ENT_QUOTES | ENT_XML1, "UTF-8");
        }

        // --- fetch WHMCS' admin contact data
        $admindata = false;
        if (Setting::getValue("RegistrarAdminUseClientDetails") === "on") {
            $admindata = $cmdparams;
        } else {
            $admindata = [
                "FIRSTNAME" => html_entity_decode(Setting::getValue("RegistrarAdminFirstName"), ENT_QUOTES | ENT_XML1, "UTF-8"),
                "LASTNAME" => html_entity_decode(Setting::getValue("RegistrarAdminLastName"), ENT_QUOTES | ENT_XML1, "UTF-8"),
                "ORGANIZATION" => html_entity_decode(Setting::getValue("RegistrarAdminCompanyName"), ENT_QUOTES | ENT_XML1, "UTF-8"),
                "STREET" => html_entity_decode(Setting::getValue("RegistrarAdminAddress1"), ENT_QUOTES | ENT_XML1, "UTF-8"),
                "CITY" => html_entity_decode(Setting::getValue("RegistrarAdminCity"), ENT_QUOTES | ENT_XML1, "UTF-8"),
                "STATE" => html_entity_decode(convertStateToCode(
                    Setting::getValue("RegistrarAdminStateProvince"),
                    Setting::getValue("RegistrarAdminCountry")
                ), ENT_QUOTES | ENT_XML1, "UTF-8"),
                "ZIP" => html_entity_decode(Setting::getValue("RegistrarAdminPostalCode"), ENT_QUOTES | ENT_XML1, "UTF-8"),
                "COUNTRY" => html_entity_decode(Setting::getValue("RegistrarAdminCountry"), ENT_QUOTES | ENT_XML1, "UTF-8"),
                "PHONE" => html_entity_decode(Setting::getValue("RegistrarAdminPhone"), ENT_QUOTES | ENT_XML1, "UTF-8"),
                "EMAIL" => html_entity_decode(Setting::getValue("RegistrarAdminEmailAddress"), ENT_QUOTES | ENT_XML1, "UTF-8")
                //"FAX" => n/a in whmcs
            ];
            $street2 = Setting::getValue("RegistrarAdminAddress2");
            if (strlen($street2)) {
                $admindata["STREET"] .= " , " . html_entity_decode($street2, ENT_QUOTES | ENT_XML1, "UTF-8");
            }
        }
        return [
            "registrant" => $cmdparams,
            "admin" => $admindata
        ];
    }
    /**
     * Request contact update
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @param array $data data container
     * @param array $r Domain::getStatus response
     * @param null|bool
     */
    public static function updateContactDetails($params, $domain, $data, $r)
    {
        $command = [
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain
        ];
        $contacts = [];
        $map = [
            "OWNERCONTACT" => "registrant"
        ];
        // --- also auto-add admin/tech/billing-c in case whmcs admin data is present
        if ($data["admin"]) {
            $map["ADMINCONTACT"] = "admin";
            $map["TECHCONTACT"] = "admin";
            $map["BILLINGCONTACT"] = "admin";
        }
        // --- check if current registrant data is invalid/broken as of active ID Protection
        // --- and thus parsing data out of whois failed in transfer process
        foreach ($map as $apikey => $datakey) {
            if (empty($r["data"][$apikey][0])) {
                $command[$apikey . "0"] = $data[$datakey];
            } else {
                $contactid = $r["data"][$apikey][0];
                if (preg_match("/^AUTO-.+$/", $contactid)) {
                    if (!isset($contacts[$contactid])) {
                        $contacts[$contactid] = HXContact::getStatus($params, $contactid);
                    }
                    $rc = $contacts[$contactid];
                    if ($rc["success"] && empty($rc["data"]["EMAIL"][0])) {
                        $command[$apikey . "0"] = $data[$datakey];
                    }
                }
            }
        }
        //check if domain update is necessary, #parameters > COMMAND, DOMAIN
        if (count(array_keys($command)) > 2) {
            $r = Ispapi::call($command, $params);
            return [
                "success" => ($r["CODE"] === "200")
            ];
        }
        // no update necessary
        return null;
    }
    /**
     * Get the domain's assigned auth code.
     *
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @return array
     */
    public static function getAuthCode($params, $domain)
    {
        // Expiring Authorization Codes
        // https://confluence.centralnic.com/display/RSR/Expiring+Authcodes
        // pending cases:
        // - RSRBE-3774
        // - RSRBE-3753
        if (preg_match("/\.de$/i", $domain)) {
            $response = Ispapi::call([
                "COMMAND" => "DENIC_CreateAuthInfo1",
                "DOMAIN" => $domain
            ], $params);
        } elseif (preg_match("/\.(eu|be)$/i", $domain)) {
            $response = Ispapi::call([
                "COMMAND" => "RequestDomainAuthInfo",
                "DOMAIN" => $domain
            ], $params);
            // TODO -> PENDING = 1|0
        } else {
            // default case for all other tlds
            $response = Ispapi::call([
               "COMMAND" => "StatusDomain",
               "DOMAIN" => $domain
            ], $params);
            if (preg_match("/\.(fi|nz)$/i", $domain)) {
                if ($response["CODE"] === "200" && $response["PROPERTY"]["TRANSFERLOCK"][0] === "1") {
                    return [
                        "error" => "Failed loading the epp code. Please unlock this domain name first. A new epp code will then be generated and provided here."
                    ];
                }
            }
        }

        // check response
        if ($response["CODE"] === "200") {
            if (!isset($response["PROPERTY"]["AUTH"][0])) {
                return []; // send to registrant by email
            }
            if (!strlen($response["PROPERTY"]["AUTH"][0])) {
                return [
                    "error" => "Failed loading the epp code (No authcode assigned to this domain name. Contact Support)."
                ];
            }
            //htmlspecialchars -> fixed in (#5070 @ 6.2.0 GA) / (#4166 @ 5.3.0)
            return [
                "eppcode" => $response["PROPERTY"]["AUTH"][0]
            ];
        }
        return [
            "error" => "Failed loading the epp code (" . $response["DESCRIPTION"] . ")."
        ];
    }
    /**
     * Get current Lock Status of the given domain.
     *
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @return array
     */
    public static function getRegistrarLock($params, $domain)
    {
        $r = Ispapi::call([
            "COMMAND" => "QueryDomainList",
            "VERSION" => 2,
            "NOTOTAL" => 1,
            "DOMAIN" => $domain,
            "WIDE" => 1
        ], $params);

        // NOTE: returning an error still shows up as "unlocked"
        // Removing the menu entry by hook therefore ftw.
        if ($r["CODE"] !== "200") {
            return [
                "error" => $r["DESCRIPTION"]
            ];
        }
        $r = $r["PROPERTY"];
        // list command always returns 200, but maybe no data
        if (!isset($r["TRANSFERLOCK"])) {
            return [
                "error" => "Domain Name not found."
            ];
        }
        // return locking status
        if ($r["TRANSFERLOCK"][0] === "1") {
            return "locked";
        }
        if ($r["TRANSFERLOCK"][0] === "0") {
            return "unlocked";
        }
        // empty string
        return [
            "error" => "Registrar Lock unsupported for this TLD."
        ];
    }
    /**
     * Lock or Unlock the domain as requested.
     *
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @return array
     */
    public static function saveRegistrarLock($params, $domain)
    {
        $doLock = ($params["lockenabled"] === "locked");

        $cmd = [
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain,
            "TRANSFERLOCK" => $doLock ? "1" : "0"
        ];
        //Expiring Authcodes
        //https://confluence.centralnic.com/display/RSR/Expiring+Authcodes
        if (!$doLock && preg_match("/\.fi$/i", $domain)) {
            $cmd["AUTH"] = self::generateEPPCode();
        }
        $response = Ispapi::call($cmd, $params);

        if ($response["CODE"] !== "200") {
            return [
                "error" => $domain . ": Unable to " . ($doLock ? "set" : "remove")  . " registrar lock. [" . $response["DESCRIPTION"] . "]"
            ];
        }
        return [
            "success" => $domain . ": Successfully " . ($doLock ? "set" : "removed")  . " registrar lock."
        ];
    }
    /**
     * Function to toggle Id Protection Service
     *
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @param bool $idprotection id protection status in WHMCS
     * @return array
     */
    public static function saveIdProtection($params, $domain, $idprotection)
    {
        $r = Ispapi::call([
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain,
            "X-ACCEPT-WHOISTRUSTEE-TAC" => (int)$idprotection
        ], $params);
        if ($r["CODE"] !== "200") {
            return [
                "error" => $domain . ": Unable to " . ($idprotection ? "activate" : "deactivate")  . " id protection. [" . $response["DESCRIPTION"] . "]"
            ];
        }
        return [
            "success" => $domain . ": Successfully " . ($doLock ? "activated" : "deactivated")  . " id protection."
        ];
    }
    /**
     * Restore given Domain Name
     *
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @return array
     */
    public static function restore($params, $domain)
    {
        $response = Ispapi::call([
            "COMMAND" => "RestoreDomain",
            "DOMAIN" => $domain
        ], $params);
        if ($response["CODE"] !== "200") {
            return [
                "error" => "Domain Restore failed. (" . $response["CODE"] . " " . $response["DESCRIPTION"] . ")"
            ];
        }

        $msg = "Domain Restore succeeded. ";
        // compare WHMCS' regperiod with the default restore period
        $r = Ispapi::call([
            "COMMAND" => "QueryDomainOptions",
            "DOMAIN0" => $domain
        ], $params);
        // unable to fetch list of supported renewal periods
        if (!isset($r["PROPERTY"]["ZONERENEWALPERIODS"][0])) {
            return [
                "success" => true,
                "message" => $msg . "Not able to check for matching renewal period."
            ];
        }

        // compare periods
        $periods = explode(",", $r["PROPERTY"]["ZONERENEWALPERIODS"][0]);
        $perioddiff = $params["regperiod"] - intval($periods[0]);
        // no difference - should apply to the most cases
        if ($perioddiff === 0) {
            return [
                "success" => true,
                "message" => $msg
            ];
        }
        // difference detected. check if that diff period is supported as renewal period
        if (!in_array($perioddiff . "Y", $periods)) {
            return [
                "success" => true,
                "message" => $msg . "Not able to check for matching renewal period."
            ];
        }

        return [
            "success" => true,
            "message" => $msg . "Requires additional Renewal to fit Renewal Period provided.",
            "periodLeft" => $perioddiff
        ];
    }
    /**
     * Renew given Domain Name
     *
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @return array
     */
    public static function renew($params, $domain)
    {
        // --- Domain Renewal
        $command = [
            "COMMAND" => "RenewDomain",
            "DOMAIN" => $domain,
            "PERIOD" => $params["regperiod"]
        ];
        // renew premium domain
        $premiumDomainsEnabled = (bool) $params["premiumEnabled"];
        if ($premiumDomainsEnabled) { //check if premium domain functionality is enabled by the admin
            $premiumDomainsCost = $params["premiumCost"];
            if (!empty($premiumDomainsCost)) { //check if the domain has a premium price
                $statusResponse = self::getStatus($params, $domain);
                //"PROPERTIES" => "PRICES" //not an option as account currency is different
                if ($statusResponse["success"] && !empty($statusResponse["data"]["SUBCLASS"][0])) {
                    $prices = ispapi_GetPremiumPrice($params);
                    if ($premiumDomainsCost === $prices["renew"]) { //check if WHMCS' price fits to the API one
                        $command["CLASS"] = $statusResponse["data"]["SUBCLASS"][0];
                    }
                }
            }
        }
        $response = Ispapi::call($command, $params);

        // required explit renewal in our system
        if ($response["CODE"] === "510") {
            $command["COMMAND"] = "PayDomainRenewal";
            $response = Ispapi::call($command, $params);
        }

        if ($response["CODE"] !== "200") {
            return [
                "error" => "Renewal failed. (" . $response["CODE"] . " " . $response["DESCRIPTION"] . ")"
            ];
        }

        return [
            "success" => true,
            "message" => "Renewal succeeded."
        ];
    }
    /**
     * check if trade is necessary for registrant modification
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @return array
     */
    public static function needsTradeForRegistrantModification($params, $domain, $type = "TRADE")
    {
        $r = Ispapi::call([
            "COMMAND" => "QueryDomainOptions",
            "DOMAIN0" => $domain
        ], $params);
        return (
            $r["CODE"] == 200
            && isset($r["PROPERTY"]["ZONEPOLICYREGISTRANTNAMECHANGEBY"][0])
            && $type === $r["PROPERTY"]["ZONEPOLICYREGISTRANTNAMECHANGEBY"][0]
        );
    }
    /**
     * check if IRTP Trade is necessary for registrant modification
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @return array
     */
    public static function needsIRTPForRegistrantModification($params, $domain)
    {
        return self::needsTradeForRegistrantModification($params, $domain, "ICANN-TRADE");
    }
    /**
     * Generate a random auth code
     * @return string
     */
    private static function generateEPPCode()
    {
        $numbers = "0123456789";
        $small_letters = "abcdefghijklmnopqrstuvwxyz";
        $capital_letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $special_chars = "@#$*[]{}=+";
        $final_auth = substr(str_shuffle($numbers), 0, 3);
        $final_auth .= substr(str_shuffle($small_letters), 0, 3);
        $final_auth .= substr(str_shuffle($capital_letters), 0, 3);
        $final_auth .= substr(str_shuffle($special_chars), 0, 2);
        return str_shuffle($final_auth);
    }
}
