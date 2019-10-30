<?php
## .RU DOMAIN REQUIREMENTS
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant's Birth Date",
    "Description" => "(required for individuals)",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-RU-REGISTRANT-BIRTH-DATE"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant's Passport Data",
    "Description" => "(required for individuals)",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-RU-REGISTRANT-PASSPORT-DATA"
);
include "_acceptregistrationtac.php";
