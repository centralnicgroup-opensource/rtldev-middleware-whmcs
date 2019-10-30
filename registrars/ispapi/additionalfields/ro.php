<?php
## .RO DOMAIN REQUIREMENTS
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = [
    'Name' => 'CNPFiscalCode',
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    'Name' => 'Registrant Type',
    "Remove" => true
];

## add ispapi additional fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "Registration Number",
    "Description" => "(required for romanian registrants)",
    "Ispapi-Name" => "X-REGISTRANT-IDNUMBER"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant VAT ID",
    "Type" => "text",
    "Description" => "(required for EU countries AND for romanian registrants)",
    "Ispapi-Name" => "X-REGISTRANT-VATID"
];
