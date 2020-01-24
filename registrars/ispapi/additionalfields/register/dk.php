<?php
## .DK DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];
$additionaldomainfields[$tld][] = [
    "Name" => "Legal Type",
    "Type" => "dropdown",
    "Options" => "Individual,Organization",
    "Default" => "Individual",
    "Description" => "(Also choose `Individual` in case you're a company without VATID)"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant VAT ID",
    "Type" => "text",
    'Required' => [
        'Legal Type' => [
            'Organization'
        ]
    ],
    "Ispapi-Name" => "X-REGISTRANT-VATID"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Admin VAT ID",
    "Type" => "text",
        'Required' => [
        'Legal Type' => [
            'Organization'
        ]
    ],
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
