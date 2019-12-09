<?php
## .PT DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant Vat ID",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-PT-REGISTRANT-VATID"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Tech vat ID",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-PT-TECH-VATID"
];
