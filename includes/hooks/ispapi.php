<?php

/**
 * Hook Function to transliterate Greek to Greeklish
 *
 * https://docs.whmcs.com/Custom_Transliteration
 * GH Issue #196
 *
 * @package    WHMCS/Modules/Registrar/Ispapi
 * @author     Kai Schwarz, HEXONET
 * @copyright  Copyright (c) CentralNic Group PLC
 * @license    MIT
 * @link       https://centralnic-reseller.github.io/centralnic-reseller/
 */

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

// if you need further transliterations
// cyrillic -> https://github.com/deflax/whmcs-cyrillic-transliteration

function hook_transliterate($string)
{
    if (
        (is_null($string) ||
        !(is_numeric($string) ||
        is_string($string))) ||
        !(
            function_exists("mb_internal_encoding") &&
            function_exists("mb_regex_encoding") &&
            function_exists("mb_ereg_replace")
        )
    ) {
        return $string;
    }

    static $charset;
    static $greeklish;
    static $whmcsCharset;
    static $accentsregex;

    if (!$charset) {
        $charset = "UTF-8";
        $charMap = [
            // greeklish
            "α" => "a", "ά" => "a", "Α" => "A", "Ά" => "A", "β" => "v", "Β" => "v",
            "α" => "a", "α" => "a", "Γ" => "G", "γ" => "g", "Δ" => "D", "δ" => "d",
            "ε" => "e", "Ε" => "E", "έ" => "e", "Έ" => "E", "Ζ" => "Z", "ζ" => "z",
            "Η" => "I", "η" => "i", "ή" => "i", "Ή" => "I", "Θ" => "Th", "θ" => "th",
            "Ι" => "I", "ι" => "i", "ί" => "i", "Ί" => "i", "Κ" => "K", "κ" => "k",
            "Λ" => "L", "λ" => "l", "Μ" => "M", "μ" => "m", "Ν" => "N", "ν" => "n",
            "Ξ" => "X", "ξ" => "x", "Ο" => "O", "ο" => "o", "Ό" => "O", "ό" => "o",
            "Π" => "P", "π" => "p", "Ρ" => "R", "ρ" => "r", "Σ" => "S", "σ" => "s",
            "ς" => "s", "Τ" => "T", "τ" => "t", "Υ" => "Y", "υ" => "y", "ύ" => "y",
            "Ύ" => "Y", "Φ" => "F", "φ" => "f", "Χ" => "Ch", "χ" => "ch", "Ψ" => "Ps",
            "ψ" => "ps", "Ω" => "O", "ω" => "o", "ώ" => "o", "Ώ" => "O"
        ];
        $whmcsCharset = WHMCS\Config\Setting::getValue("Charset");
        $accentsregex = "/&([A-Za-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml|caron);/i";
    }
    // Some useful common replacements
    // https://unicode-table.com/de/html-entities/
    // https://stackoverflow.com/questions/12697107/replace-accented-characters
    // -- replace accents --
    $string = htmlentities($string, ENT_QUOTES, $whmcsCharset);
    $string = preg_replace($accentsregex, "\$1", $string);
    $string = html_entity_decode($string, ENT_NOQUOTES, $whmcsCharset);

    // Transliteration - use multibyte functions
    mb_internal_encoding($charset);
    mb_regex_encoding($charset);
    foreach ($greeklish as $org => $new) {
        $string = mb_ereg_replace($org, $new, $string);
    }
    return $string;
}
