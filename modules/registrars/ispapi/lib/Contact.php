<?php

namespace WHMCS\Module\Registrar\Ispapi;

use WHMCS\Module\Registrar\Ispapi\Ispapi;
use WHMCS\Config\Setting as Setting;

class Contact
{
    private static $addressSeparator = " , ";
    private static $contactKeyMap = [
        "Registrant" => "OWNERCONTACT",
        "Admin" => "ADMINCONTACT",
        "Technical" => "TECHCONTACT",
        "Billing" => "BILLINGCONTACT"
    ];

    /**
     * get contact status
     * @param array $params common module parameters
     * @param string $contact API contact id
     * @return array
     */
    public static function getStatus($params, $contact)
    {
        $r = Ispapi::call([
            "COMMAND" => "StatusContact",
            "CONTACT" => $contact
        ], $params);
        if ($r["CODE"] !== "200") {
            return [
                "success" => false,
                "error" => "Loading contact status failed. (" . $r["CODE"] . " " . $r["DESCRIPTION"] . ")",
                "errorcode" => $r["CODE"]
            ];
        }
        return [
            "success" => true,
            "data" => $r["PROPERTY"]
        ];
    }
    /**
     * Get $params field names to API parameter name mapping
     * @return array
     */
    public static function getContactFieldsMap($is_params = false)
    {
        if (!$is_params) {
            // keep Address before Address 2
            return [
                "First Name" => "FIRSTNAME",
                "Last Name" => "LASTNAME",
                "Company Name" => "ORGANIZATION",
                "Address" => "STREET",
                "Address 2" => "STREET1",//identify special index
                "City" => "CITY",
                "State" => "STATE",
                "Postcode" => "ZIP",
                "Country" => "COUNTRY",
                "Phone" => "PHONE",
                "Fax" => "FAX",
                "Email" => "EMAIL"
            ];
        }
        return [
            "firstname" => "FIRSTNAME",
            "lastname" => "LASTNAME",
            "companyname" => "ORGANIZATION",
            "address1" => "STREET",
            "address2" => "STREET1",
            "city" => "CITY",
            "state" => "STATE",
            "postcode" => "ZIP",
            "country" => "COUNTRY",
            "phonenumber" => "PHONE",
            "email" => "EMAIL"
        ];
    }
    /**
     * Return an array with the contact information for all contacts
     * Uses the StatusContact command
     *
     * @param array $params - common module parameters
     * @param array $data - Domain getStatus response
     * @return array $values - an array with contact information
     */
    public static function getInfo($params, $data)
    {
        static $contactcache;
        if (!$contactcache) {
            $contactcache = [];
        }
        $tmp = [];
        $fmap = self::getContactFieldsMap();
        foreach (self::$contactKeyMap as $ptype => $ctype) {
            $values = array_fill_keys(array_keys($fmap), "");
            if (!empty($data["data"][$ctype][0])) {
                $contact = $data["data"][$ctype][0];
                if (isset($contactcache[$contact])) {
                    $tmp[$ptype] = $contactcache[$contact];
                    continue;
                }
                $r = self::getStatus($params, $contact);
                if ($r["success"]) {
                    foreach ($fmap as $pkey => $apikey) {
                        $values[$pkey] = $r["data"][$apikey][0];
                        if ("STREET1" === $apikey) {
                            $values[$pkey] = $r["data"]["STREET"][1];
                        }
                    }
                    if (
                        (count($r["data"]["STREET"]) < 2)
                        && preg_match("/^(.*)" . self::$addressSeparator . "(.*)$/", $r["data"]["STREET"][0], $m)
                    ) {
                        $values["Address"] = $m[1];
                        $values["Address 2"] = $m[2];
                    }
                }
                $contactcache[$contact] = $values;
            }
            $tmp[$ptype] = $values;
        }
        return $tmp;
    }
    /**
     * Add Contact Data to the given API Command
     * @param array $command API Command provided by reference
     * @param array $data contact data container with key "contactdetails"
     */
    public static function getFromPost(&$command, $data)
    {
        if (!function_exists("convertStateToCode")) {
            require implode(DIRECTORY_SEPARATOR, [ROOTDIR, "includes", "clientfunctions.php"]);
        }
        $fmap = self::getContactFieldsMap();
        foreach (self::$contactKeyMap as $ptype => $ctype) {
            if (isset($data["contactdetails"][$ptype])) {
                $p = $data["contactdetails"][$ptype];
                $apiParam = $ctype . "0";
                $command[$apiParam] = [];
                foreach ($fmap as $pkey => $apikey) {
                    if ("STREET1" === $apikey) {
                        if (!empty($p[$pkey])) {
                            $command[$apiParam]["STREET"] .= self::$addressSeparator . html_entity_decode($p[$pkey], ENT_QUOTES | ENT_XML1, "UTF-8");
                        }
                    } else {
                        $command[$apiParam][$apikey] = html_entity_decode($p[$pkey], ENT_QUOTES | ENT_XML1, "UTF-8");
                    }
                }
                $command[$apiParam]["STATE"] = convertStateToCode($p["State"], $p["Country"]);
                if (preg_match("/\.ca$/", $command["DOMAIN"])) {//converttociracode
                    if ($command[$apiParam]["STATE"] === "YT") {
                        $command[$apiParam]["STATE"] = "YK";
                    }
                }
            }
        }
    }
    /**
     * Fetch Contact Data from $params as Array
     * @param array $params
     * @param array $command API Command provided by reference
     * @return array
     */
    public static function getFromParams(&$command, $params)
    {
        // Registrant first, Admin 2nd
        $contacts = [];
        $prefixes = [""];
        $isOn = (Setting::getValue("RegistrarAdminUseClientDetails") === "on");
        if (!$isOn) {
            $prefixes[] = "admin";
        }
        foreach ($prefixes as $prefix) {
            $fmap = self::getContactFieldsMap(true);
            $contact = [];
            foreach ($fmap as $pkey => $apikey) {
                if ($apikey === "STREET1") {
                    if (!empty($params[$prefix . $pkey])) {
                        $contact["STREET"] .= self::$addressSeparator . $params[$prefix . $pkey];
                    }
                } else {
                    $contact[$apikey] = $params[ $prefix . $pkey];
                }
            }
            $contacts[$prefix] = $contact;
        }
        foreach (self::$contactKeyMap as $ctype) {
            $useAdmin = (!$isOn && ($ctype !== "OWNERCONTACT"));
            $command[$ctype . "0"] = $contacts[$useAdmin ? "admin" : ""];
        }
    }
}
