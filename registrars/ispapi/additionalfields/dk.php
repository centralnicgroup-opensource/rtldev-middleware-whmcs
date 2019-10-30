<?php
## .DK DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant VAT ID",
    "Type" => "text",
    "Required" => false,
    "Description" => "(Only for Organization)",
    "Ispapi-Name" => "X-REGISTRANT-VATID"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Admin VAT ID",
    "Type" => "text",
    "Required" => false,
    "Description" => "(Only for Organization)",
    "Ispapi-Name" => "X-ADMIN-VATID"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant contact",
    "Type" => "text",
    "Required" => false,
    "Description" => "(DK-HOSTMASTER User ID)",
    "Ispapi-Name" => "X-DK-REGISTRANT-CONTACT"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Admin contact",
    "Type" => "text",
    "Required" => false,
    "Description" => "(DK-HOSTMASTER User ID)",
    "Ispapi-Name" => "X-DK-ADMIN-CONTACT"
];
