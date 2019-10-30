<?php
## .NU DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Identification Number",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "VAT Number",
    "Remove" => true
);
## add ispapi additional fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant ID number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-REGISTRANT-IDNUMBER"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Vat ID",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-VATID"

);
include "_acceptregistrationtac.php";
