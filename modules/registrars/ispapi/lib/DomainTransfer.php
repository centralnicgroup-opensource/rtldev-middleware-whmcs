<?php

namespace WHMCS\Module\Registrar\Ispapi;

use WHMCS\Module\Registrar\Ispapi\Ispapi;

class DomainTransfer
{
    /**
     * get domain transfer status
     * REMEMBER: A Transfer can be INCOMING, OUTGOING, TRADE!
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @return array
     */
    public static function getStatus($params, $domain)
    {
        $r = Ispapi::call([
            "COMMAND" => "StatusDomainTransfer",
            "DOMAIN" => $domain
        ], $params);
        if ($r["CODE"] !== "200") {
            return [
                "success" => false,
                "error" => "Loading domain transfer status failed. (" . $r["CODE"] . " " . $r["DESCRIPTION"] . ")"
            ];
        }
        return [
            "success" => true,
            "data" => $r["PROPERTY"]
        ];
    }

    /**
     * get object log entry status details
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @param string $mindate minimum date to use
     * @return array
     */
    public static function getLogDetails($params, $logindex)
    {
        $r = Ispapi::call([
            "COMMAND" => "StatusObjectLog",
            "LOGINDEX" => $logindex
        ], $params);
        if ($r["CODE"] === "200") {
            return [
                "success" => true,
                "data" => $r["PROPERTY"]
            ];
        }
        return [
            "success" => false,
            "error" => $r["CODE"] . " " . $r["DESCRIPTION"]
        ];
    }

    /**
     * get transfer success event log entry
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @param string $mindate minimum date to use
     * @return array
     */
    public static function getSuccessLog($params, $domain, $mindate)
    {
        $r = Ispapi::call([
            "COMMAND" => "QueryObjectlogList",
            "OBJECTID" => $domain,
            "OBJECTCLASS" => "DOMAIN",
            "MINDATE" => $mindate,
            "OPERATIONTYPE" => "INBOUND_TRANSFER",
            "OPERATIONSTATUS" => "SUCCESSFUL",
            "ORDERBY" => "LOGDATEDESC",
            "LIMIT" => 1
        ], $params);
        if ($r["CODE"] === "200") {
            return [
                "success" => true,
                "data" => $r["PROPERTY"]
            ];
        }
        return [
            "success" => false,
            "error" => $r["CODE"] . " " . $r["DESCRIPTION"]
        ];
    }

    /**
     * get transfer success event log entry
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @param string $mindate minimum date to use
     * @return array
     */
    public static function getFailureLog($params, $domain, $mindate)
    {
        $r = Ispapi::call([
            "COMMAND" => "QueryObjectlogList",
            "OBJECTID" => $domain,
            "OBJECTCLASS" => "DOMAIN",
            "MINDATE" => $mindate,
            "OPERATIONTYPE" => "INBOUND_TRANSFER",
            "OPERATIONSTATUS" => "FAILED",
            "ORDERBY" => "LOGDATEDESC",
            "LIMIT" => 1
        ], $params);
        if ($r["CODE"] === "200") {
            return [
                "success" => true,
                "data" => $r["PROPERTY"]
            ];
        }
        return [
            "success" => false,
            "error" => $r["CODE"] . " " . $r["DESCRIPTION"]
        ];
    }

    /**
     * Check if last entry in object log is about a successful outbound transfer
     * Ensure to check Domain Status 1st. If Status Code = 545, use this method.
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @return array
     */
    public static function isTransferredAway($params, $domain)
    {
        $r = Ispapi::call([
            "COMMAND" => "QueryObjectLogList",
            "OBJECTCLASS" => "DOMAIN",
            "OBJECTID" => $domain,
            "ORDERBY" => "LOGDATEDESC",
            "USERDEPTH" => "SELF",
            "LIMIT" => 1
        ], $params);
        return (
            $r["CODE"] === "200"
            && $r["PROPERTY"]["OPERATIONTYPE"][0] === "OUTBOUND_TRANSFER"
            && $r["PROPERTY"]["OPERATIONSTATUS"][0] === "SUCCESSFUL"
        );
    }

    /**
     * get transfer request log entry
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @return array
     */
    public static function getRequestLog($params, $domain)
    {
        $r = Ispapi::call([
            "COMMAND" => "QueryObjectLogList",
            "OBJECTCLASS" => "DOMAIN",
            "OBJECTID" => $domain,
            "ORDERBY" => "LOGDATEDESC",
            "OPERATIONTYPE" => "TRANSFER",
            "OPERATIONSTATUS" => "REQUEST",
            "USERDEPTH" => "SELF",
            "LIMIT" => 1
        ], $params);
        if ($r["CODE"] === "200") {
            return [
                "success" => true,
                "data" => $r["PROPERTY"]
            ];
        }
        return [
            "success" => false,
            "error" => $r["CODE"] . " " . $r["DESCRIPTION"]
        ];
    }
    /**
     * get command of transfer request
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @param string $logindex optional logindex if entry is already known
     * @return array
     */
    public static function getRequestCommand($params, $domain, $logindex = null)
    {
        if (is_null($logindex)) {
            $r = self::getRequestLog($params, $domain);
            if (!$r["success"]) {
                return [
                    "success" => false,
                    "error" => "Loading Log List failed (" . $r["error"] . ")"
                ];
            }
            if ($r["data"]["COUNT"][0] === "0") {
                return [
                    "success" => false,
                    "error" => "No Transfer Request Entry found."
                ];
            }
            $logindex = $r["data"]["LOGINDEX"][0];
        }
        $r = self::getLogDetails($params, $logindex);
        if ($r["success"] === false) {
            return [
                "success" => false,
                "error" => "Loading Log Entry failed (" . $r["error"] . ")"
            ];
        }
        $cmd = implode("\r\n", $r["data"]["OPERATIONINFO"]);
        if (!preg_match("/\[COMMAND\]\r\n(.+)\r\nEOF\r\n/ms", $cmd, $m)) {
            return [
                "success" => false,
                "error" => "Loading Requested Transfer Command failed."
            ];
        }
        $tmp = explode("\r\n", $m[1]);
        $cmd = [];
        foreach ($tmp as $param) {
            $param = explode("=", $param);
            $cmd[array_shift($param)] = implode("=", $param);
        }
        return [
            "success" => true,
            "data" => $cmd
        ];
    }

    /**
     * get nameservers of transfer request
     * @param array $params common module parameters
     * @param string $domain puny code domain name
     * @param string $logindex optional logindex if entry is already known
     * @return array
     */
    public static function getRequestNameservers($params, $domain, $logindex = null)
    {
        $cmd = self::getRequestCommand($params, $domain, $logindex);
        if (!$cmd["success"]) {
            return $cmd;
        }
        $ns = [];
        foreach ($cmd["data"] as $key => $val) {
            if (preg_match("/^NAMESERVER[0-9]+$/i", $key)) {
                $ns[] = $val;
            }
        }
        return [
            "success" => true,
            "nameservers" => $ns
        ];
    }
}
