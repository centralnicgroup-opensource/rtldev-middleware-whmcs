<?php
## .NU DOMAIN REQUIREMENTS ##
## add ispapi additional fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "Identification Number",
    "Description" => "",
    "Ispapi-Name" => "X-REGISTRANT-IDNUMBER"
];
$additionaldomainfields[$tld][] = [
    "Name" => "VAT Number",
    "Ispapi-Name" => "X-VATID"
];
include "_acceptregistrationtac.php";
