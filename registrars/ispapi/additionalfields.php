<?php
use \ISPAPI\Helper;

require_once "lib/Helper.class.php";

$r = \ISPAPI\Helper::SQLCall("SELECT LOWER(extension) as extension, LOWER(SUBSTRING(extension, 2)) as short FROM tbldomainpricing WHERE autoreg=:registrar", array(
    ":registrar" => "Ispapi"
), "fetchall");
if ($r["success"]) {
    foreach ($r["result"] as $row) {
        $tld = $row["extension"];
        // check if an file exists for the extension (e.g. .sg, .com.sg, .de)
        $file = implode(DIRECTORY_SEPARATOR, array(ROOTDIR, "modules", "registrars", "ispapi", "additionalfields", $row["short"] . ".php"));//TODO sanitize, test if $tld is used
        if (file_exists($file)) {
            include $file;
        } else {
            // if not, fallback to 2nd lvl extension
            // note: in case 3rd lvl extension has NO xflags, but 2nd lvl extension has -> simply add an empty file for 3rd lvl extension
            $tldold = $tld;
            $tldshort = preg_replace("/^.+\./", "", $row["short"]);
            $tld = "." . $tldshort;
            $file = implode(DIRECTORY_SEPARATOR, array(ROOTDIR, "modules", "registrars", "ispapi", "additionalfields", $tldshort . ".php"));
            if (($tldold !== $tld) && file_exists($file)) {
                include $file;
            }
        }
    }
}
