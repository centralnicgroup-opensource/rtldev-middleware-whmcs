<?php

namespace WHMCS\Module\Registrar\Ispapi;

use WHMCS\Module\Registrar\Ispapi\Ispapi;
use WHMCS\Module\Registrar\Ispapi\UserRelationModel as RM;

class DomainTrade
{
    /**
     * get domain trade status
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @return array
     */
    public static function getStatus($params, $domain)
    {
        $r = Ispapi::call([
            "COMMAND" => "StatusDomainTrade",
            "DOMAIN" => $domain
        ], $params);
        if ($r["CODE"] !== "200") {
            return [
                "success" => false,
                "error" => "Loading domain trade status failed. (" . $r["CODE"] . " " . $r["DESCRIPTION"] . ")"
            ];
        }
        return [
            "success" => true,
            "data" => $r["PROPERTY"]
        ];
    }
    /**
     * Get the fields that trigger a Trade Case
     * @return array
     */
    public static function getTradeTriggerFields()
    {
        return [
            "First Name",
            "Last Name",
            "Organization Name",
            "Email"
        ];
    }
    /**
     * check if trade is necessary for registrant modification
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @param array $type trade types to match
     * @return bool|string
     */
    public static function affectsRegistrantModification($params, $domain, $type = ["TRADE"])
    {
        $r = Ispapi::call([
            "COMMAND" => "QueryDomainOptions",
            "DOMAIN0" => $domain
        ], $params);
        if (
            $r["CODE"] === "200"
            && isset($r["PROPERTY"]["ZONEPOLICYREGISTRANTNAMECHANGEBY"][0])
            && in_array($r["PROPERTY"]["ZONEPOLICYREGISTRANTNAMECHANGEBY"][0], $type)
        ) {
            return $r["PROPERTY"]["ZONEPOLICYREGISTRANTNAMECHANGEBY"][0];
        }
        return false;
    }
    /**
     * check if IRTP Trade is necessary for registrant modification
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @return bool|string
     */
    public static function affectsRegistrantModificationIRTP($params, $domain)
    {
        return self::affectsRegistrantModification($params, $domain, ["ICANN-TRADE"]);
    }
    /**
     * return trade price if trade is not for free
     * @param array $params common module parameters
     * @param string $tld puny code domain extension (no dot)
     * @return bool|array
     */
    public static function getPrice($params, $tld)
    {
        $tldclass = str_replace(".", "", strtoupper($tld));
        $rows = json_decode(RM::getDomainPriceRelations(
            "^(TRADE|CURRENCY)[0-9]*$",
            null,
            $tldclass
        )->toJSON(), true);
        $p = [];
        if (count($rows) < 2) {
            return false;
        }
        foreach ($rows as $row) {
            $key = strtolower($row["relation_subcategory"]);
            if ($key === "trade") {
                $p["price"] = floatval($row["relation_value"]);
            } else {
                $p[$key] = $row["relation_value"];
            }
        }
        if ($p["price"] === 0) {
            return false;
        }
        return $p;
    }
}
