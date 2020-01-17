<?php
## .LT DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];
$additionaldomainfields[$tld][] = [
    "Name" => "Legal Entity Identification Code",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-LT-REGISTRANT-LEGAL-ID"
];
