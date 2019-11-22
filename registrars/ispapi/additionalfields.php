<?php
use \ISPAPI\Helper;
use \WHMCS\Domains\Idna;

require_once "lib/Helper.class.php";

$r = \ISPAPI\Helper::SQLCall("SELECT LOWER(SUBSTRING(extension, 2)) as short FROM tbldomainpricing WHERE autoreg=:registrar", [
    ":registrar" => "Ispapi"
], "fetchall");
if ($r["success"]) {
    $idnConvert = new \WHMCS\Domains\Idna();
    foreach ($r["result"] as $row) {
        // in tbldomainpricing they want IDN format, but for additional fields they still use punycode?
        $tld = "." . $idnConvert->encode($row["short"]);

        // check if an file exists for the extension (e.g. .sg, .com.sg, .de)
        $tldsecured = basename(realpath($row["short"]));
        $file = implode(DIRECTORY_SEPARATOR, [ROOTDIR, "modules", "registrars", "ispapi", "additionalfields", $row["short"] . ".php"]);
        if (file_exists($file)) {
            include $file;
        } else {
            // if not, fallback to 2nd lvl extension
            // note: in case 3rd lvl extension has NO xflags, but 2nd lvl extension has -> simply add an empty file for 3rd lvl extension
            $tldshort = preg_replace("/^.+\./", "", $row["short"]);
            $tldnew = "." . $tldshort;
            $file = implode(DIRECTORY_SEPARATOR, [ROOTDIR, "modules", "registrars", "ispapi", "additionalfields", $tldshort . ".php"]);
            if (($tld !== $tldnew) && file_exists($file)) {
                include $file;
            }
        }
    }
}
