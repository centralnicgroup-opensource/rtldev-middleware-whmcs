<?php
## .LV DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];
$additionaldomainfields[$tld][] = [
    "Name" => "Vat ID",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-VATID"
];
$additionaldomainfields[$tld][] = [
    "Name" => "ID number",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-IDNUMBER"
];
