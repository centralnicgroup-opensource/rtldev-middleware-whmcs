<?php

namespace WHMCS\Module\Registrar\Ispapi;

use WHMCS\Module\Registrar\Ispapi\Ispapi;

class Dns
{
    public static function parseRecordA($data)
    {
        if (!preg_match("/^([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)?$/", $rr, $m)) {
            return false;
        }
        list($rr, $name, $ttl, $class, $type, $rdlength, $address) = $m;
        if (!empty($address)) {
            return [
                "name" => $name,
                "ttl" => $ttl,
                "class" => $class,
                "type" => $type,
                "rdlength" => $rdlength,
                "address" => $address
            ];
        }
        return [
            "name" => $name,
            "ttl" => $ttl,
            "class" => $class,
            "type" => $type,
            "address" => $rdlength
        ];
    }
    public static function parseRecordAAAA($rr)
    {
        if (!preg_match("/^([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)$/", $rr, $m)) {
            return false;
        }
        list($rr, $name, $ttl, $class, $type, $data) = $m;
        return [
            "name" => $name,
            "ttl" => $ttl,
            "class" => $class,
            "type" => $type,
            "address" => $data
        ];
    }
    public static function parseRecordTXT($rr)
    {
        if (!preg_match("/^([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)$/", $rr, $m)) {
            return false;
        }
        list($rr, $name, $ttl, $class, $type, $text) = $m;
        return [
            "name" => $name,
            "ttl" => $ttl,
            "class" => $class,
            "type" => $type,
            "text" => "\"" . $data . "\"" // TODO really necessary, our API should do that
        ];
    }
    public static function parseRecordPRT($rr)
    {
        if (!preg_match("/^([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)$/", $rr, $m)) {
            return false;
        }
        list($rr, $address, $ttl, $class, $type, $name) = $m;
        return [
            "address" => $address,
            "ttl" => $ttl,
            "class" => $class,
            "type" => $type,
            "name" => $name
        ];
    }
    public static function parseRecordCNAME($rr)
    {
        if (!preg_match("/^([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)$/", $rr, $m)) {
            return false;
        }
        list($rr, $name, $ttl, $class, $type, $target) = $m;
        return [
            "name" => $name,
            "ttl" => $ttl, // TODO: TTL really existing?
            "class" => $class,
            "type" => $type,
            "target" => $target
        ];
    }
    public static function parseRecordMX($rr)
    {
        if (!preg_match("/^([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s])$/", $rr, $m)) {
            return false;
        }
        list($rr, $name, $ttl, $class, $type, $priority, $target) = $m;
        return [
            "name" => $name,
            "ttl" => $ttl, // TODO: TTL really existing?
            "class" => $class,
            "type" => $type,
            "priority" => $priority,
            "target" => $target
        ];
    }
    public static function parseRecordNS($rr)
    {
        //matches CNAME
        if (!preg_match("/^([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)$/", $rr, $m)) {
            return false;
        }
        list($rr, $name, $ttl, $class, $type, $target) = $m;
        return [
            "name" => $name,
            "ttl" => $ttl,
            "class" => $class,
            "type" => $type,
            "target" => $target
        ];
    }
    public static function parseRecordSPF($rr)
    {
        //matches TXT
        if (!preg_match("/^([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)$/", $rr, $m)) {
            return false;
        }
        list($rr, $name, $ttl, $class, $type, $text) = $m;
        return [
            "name" => $name,
            "ttl" => $ttl,
            "class" => $class,
            "type" => $type,
            "text" => "\"" . $text . "\"" // TODO quoting maybe superfluous
        ];
    }
    public static function parseRecordSOA($rr)
    {
        if (!preg_match("/^([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)\s([^\s]+)$/", $rr, $m)) {
            return false;
        }
        list($rr, $name, $class, $type, $mname, $rname, $serial, $refresh, $retry, $expire, $ttl) = $m;
        return [
            "name" => $name,
            "class" => $class,
            "type" => $type,
            "mname" => $mname,//TODO multiple ones supported?
            "rname" => $rname,
            "serial" => $serial,
            "refresh" => $refresh,
            "retry" => $retry,
            "expire" => $expire,
            "ttl" => $ttl
        ];
    }
    public static function getRRs($params, $dnszone)
    {
        $rrlist = Ispapi::call([
            "COMMAND" => "QueryDNSZoneRRList",
            "DNSZONE" => $dnszone,
            "SHORT" => 1
        ], $params);
        if ($rrlist["CODE"] !== "200") {
            return [
                "success" => false,
                "error" => "Loading Resource Records List failed. (" . $rrlist["CODE"] . " " . $rrlist["DESCRIPTION"] . ")",
                "errorcode" => $rrlist["CODE"]
            ];
        }
        $rrs = [];
        $unmatched = [];
        foreach ($rrlist["PROPERTY"]["RR"] as $rr) {
            $matched = preg_match("/^[^\s]+\s[^\s]+\s[^\s]+\s([^\s]+)\s.+$/", $rr, $m);
            if ($matched) {
                $fn = "parseRecord" . strtoupper($m[1]);
                if (is_callable(["\WHMCS\Module\Registrar\Ispapi\Ispapi\Dns", $fn])) {
                    $rec = \WHMCS\Module\Registrar\Ispapi\Dns::$fn($rr);
                    if ($rec) {
                        $rrs[] = $rr;
                        continue;
                    }
                }
            }
            $unmatched[] = $rr;
        }
        return [
            "success" => true,
            "records" => $rrs,
            "unmatched" => $unmatched
        ];
    }
}
