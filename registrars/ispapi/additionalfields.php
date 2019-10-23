<?php
use ISPAPI\Helper;

include "lib/Helper.class.php";

$r = Helper::SQLCall("SELECT LOWER(extension) as extension, LOWER(SUBSTRING(extension, 1)) as short FROM tbldomainpricing WHERE autoreg=:registrar", array(
    ":registrar" => "ispapi"
), "fetchall");
if ($r["success"]) {
    foreach ($r["result"] as $row) {
        $tld = $row["extension"];
        // check if an file exists for the extension (e.g. .sg, .com.sg, .de)
        $file = implode(DIRECTORY_SEPARATOR, "additionalfields", $row["short"] . ".php");//TODO sanitize, test if $tld is used
        if (file_exists($file)) {
            include $file;
        } else {
            // if not, fallback to 2nd lvl extension
            // note: in case 3rd lvl extension has NO xflags, but 2nd lvl extension has -> simply add an empty file for 3rd lvl extension
            $tldold = $tld;
            $tldshort = preg_replace("/^.+\./", "", $row["short"]);
            $tld = "." . $tldshort;
            $file = implode(DIRECTORY_SEPARATOR, "additionalfields", $tldshort . ".php");//TODO sanitize, test if $tld is used
            if (($tldold !== $tld) && file_exists($file)) {
                include $file;
            }
        }
    }
}
