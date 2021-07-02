<?php

namespace WHMCS\Module\Registrar\Ispapi;

use WHMCS\Module\Registrar\Ispapi\Ispapi;

class DomainApplication
{
    /**
     * get domain status using QueryDomainList
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @param string $regexp subclass regexp filter by default pointing to premium domains
     * @return array
     */
    public static function getListStatus($params, $domain, $regexp = "^PREMIUM_.*$")
    {
        $r = Ispapi::call([
            "COMMAND" => "QueryDomainList",
            "DOMAIN" => $domain,
            "OBJECTCLASS" => "DOMAINAPPLICATION",
            "SUBCLASSREGEX" => $regexp,
            "VERSION" => 2,
            "NOTOTAL" => 1,
            "UNIQUE" => 1,
            "WIDE" => 1,
            "LIMIT" => 1,
            "USERDEPTH" => "SELF",
            "ORDERBY" => "CREATEDDATEDESC",
            "MINCREATEDDATE" => date("Y-m-d", strtotime("-30 days"))
        ], $params);
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
     * get domain status using QueryDomainList
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @param string $regexp subclass regexp filter by default pointing to premium domains
     * @return array
     */
    public static function getStatus($params, $appId)
    {
        $r = Ispapi::call([
            "COMMAND" => "StatusDomainApplication",
            "APPLICATION" => $appId
        ], $params);
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
}
