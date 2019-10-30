<?php
## .NU DOMAIN REQUIREMENTS ##
## add ispapi additional fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "Identification Number",
    'Description' => '(Personal Identification Number (or Organization number), if you are an individual registrant (or organization) in/outside Sweden)',
    "Ispapi-Name" => "X-REGISTRANT-IDNUMBER"
];
$additionaldomainfields[$tld][] = [
    "Name" => "VAT Number",
    "Ispapi-Name" => "X-VATID",
    'Description' => '(for companies outside of Sweden but inside EU)',
];
include "_acceptregistrationtac.php";
