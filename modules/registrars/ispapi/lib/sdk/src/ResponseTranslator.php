<?php

#declare(strict_types=1);

/**
 * HEXONET
 * Copyright © HEXONET
 */

namespace HEXONET;

use HEXONET\ResponseTemplateManager as RTM;

/**
 * HEXONET ResponseTranslator
 *
 * @package HEXONET
 */
class ResponseTranslator
{
    /**
     * hidden class var of API description regex mappings for translation
     * @var array
     */
    private static $descriptionRegexMap = [
       "Authorization failed; Operation forbidden by ACL" => "Authorization failed; Used Command `{COMMAND}` not white-listed by your Access Control List",
       "Request is not available; DOMAIN TRANSFER IS PROHIBITED BY STATUS (clientTransferProhibited)/WRONG AUTH" => "This Domain is locked and the given Authorization Code is wrong. Initiating a Transfer is therefore impossible.",
       "Request is not available; DOMAIN TRANSFER IS PROHIBITED BY STATUS (clientTransferProhibited)" => "This Domain is locked. Initiating a Transfer is therefore impossible.",
       "Request is not available; DOMAIN TRANSFER IS PROHIBITED BY STATUS (requested)" => "Registration of this Domain Name has not yet completed. Initiating a Transfer is therefore impossible.",
       "Request is not available; DOMAIN TRANSFER IS PROHIBITED BY STATUS (requestedcreate)" => "Registration of this Domain Name has not yet completed. Initiating a Transfer is therefore impossible.",
       "Request is not available; DOMAIN TRANSFER IS PROHIBITED BY STATUS (requesteddelete)" => "Deletion of this Domain Name has been requested. Initiating a Transfer is therefore impossible.",
       "Request is not available; DOMAIN TRANSFER IS PROHIBITED BY STATUS (pendingdelete)" => "Deletion of this Domain Name is pending. Initiating a Transfer is therefore impossible.",
       "Request is not available; DOMAIN TRANSFER IS PROHIBITED BY WRONG AUTH" => "The given Authorization Code is wrong. Initiating a Transfer is therefore impossible.",
       "Request is not available; DOMAIN TRANSFER IS PROHIBITED BY AGE OF THE DOMAIN" => "This Domain Name is within 60 days of initial registration. Initiating a Transfer is therefore impossible."
    ];

    /**
     * translate a raw api response
     * @param String $raw API raw response
     * @param Array $cmd requested API command
     * @param Array $ph list of place holder vars
     * @return String
     */
    public static function translate($raw, $cmd, $ph = [])
    {
        $newraw = empty($raw) ? "empty" : $raw;
       // Hint: Empty API Response (replace {CONNECTION_URL} later)

       // Explicit call for a static template
        if (RTM::hasTemplate($newraw)) {
            // don't use getTemplate as it leads to endless loop as of again
            // creating a response instance
            $newraw = RTM::$templates[$newraw];
        }

       // Missing CODE or DESCRIPTION in API Response
        if (
            (
                !stripos($newraw, "description=")
                || !stripos($newraw, "code=")
            )
            && RTM::hasTemplate("invalid")
        ) {
            $newraw = RTM::$templates["invalid"];
        }

        // generic API response description rewrite
        foreach (self::$descriptionRegexMap as $regex => $val) {
            // match the response for given description
            // NOTE: we match if the description starts with the given description
            // it would also match if it is followed by additional text
            $qregex = "/description=" . preg_quote($regex, "/") . "([^\r\n]+)?/i";
            if (preg_match($qregex, $newraw)) {
                // replace command place holder with API command name used
                if (isset($cmd["COMMAND"])) {
                    $val = str_replace("{COMMAND}", $cmd["COMMAND"], $val);
                }
                // switch to better readable response if matching
                $tmp = preg_replace($qregex, "description=" . $val, $newraw);
                if (strcmp($tmp, $newraw) !== 0) {
                    $newraw = $tmp;
                    break;
                }
            }
        }

       // generic replacing of place holder vars
        if (preg_match("/\{[^}]+\}/", $newraw)) {
            foreach ($ph as $key => $val) {
                $newraw = preg_replace("/\{" . preg_quote($key) . "\}/", $val, $newraw);
            }
            $newraw = preg_replace("/\{[^}]+\}/", "", $newraw);
        }
        return $newraw;
    }
}
