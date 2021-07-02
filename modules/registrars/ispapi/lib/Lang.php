<?php

namespace WHMCS\Module\Registrar\Ispapi;

/**
 * Lang class
 *
 * Covering translation logics as necessary
 */
class Lang
{
    public static $translations = [];
    public static function trans($transkey)
    {
        $tl = \Lang::trans($transkey);
        if (strcmp($tl, $transkey) !== 0) {
            // translation found (standard WHMCS or override file)
            return $tl;
        }
        $loc = \Lang::getLocale();
        $fblocs = \Lang::getFallbackLocales();
        if (!in_array("english", $fblocs)) {
            $fblocs[] = "english";
        }
        foreach ($fblocs as $locale) {
            if (!isset(self::$translations[$loc])) {
                $path = implode(DIRECTORY_SEPARATOR, [ROOTDIR, "lang", "overrides", $locale . ".php"]);
                if (file_exists($path)) {
                    include($path);
                    self::$translations[$locale] = $_LANG;
                    $loc = $locale;
                    break;
                }
            }
        }
        $tl = $transkey;
        if (isset(self::$translations[$loc][$transkey])) {
            $tl = self::$translations[$loc][$transkey];
        }
        return $tl;
    }
}
