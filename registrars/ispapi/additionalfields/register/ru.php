<?php
## .RU DOMAIN REQUIREMENTS
# remove whmcs default fields
$additionaldomainfields[$tld][] = [
    'Name'  => 'Registrant Type',
    'Remove' => true
];
$additionaldomainfields[$tld][] = [
    'Name'  => 'Individuals Passport Number',
    'Remove' => true
];
$additionaldomainfields[$tld][] = [
    'Name' => 'Individuals Passport Issuer',
    'Remove' => true
];
$additionaldomainfields[$tld][] = [
    'Name'  => 'Individuals Passport Issue Date',
    'Remove' => true
];
$additionaldomainfields[$tld][] = [
    'Name'  => 'Individuals: Whois Privacy',
    'Remove' => true
];
$additionaldomainfields[$tld][] = [
    'Name'  => 'Russian Organizations Taxpayer Number 1',
    'Remove' => true
];
$additionaldomainfields[$tld][] = [
    'Name'  => 'Russian Organizations Territory-Linked Taxpayer Number 2',
    'Remove' => true
];

# add ispapi fields
$additionaldomainfields[$tld][] = [
    "Name" => "Legal Type",
    "Type" => "dropdown",
    "Options" => "Individual,Organization",
    "Default" => "Individual"
];
$additionaldomainfields[$tld][] = [
    'Name'  => 'Individuals Birthday',
    "Description" => "(required for individuals)",
    "Required" => [
        "Legal Type" => [
            "Individual"
        ]
    ],
    "Ispapi-Name" => "X-RU-REGISTRANT-BIRTH-DATE"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Individual's Passport Data",
    "Description" => "(required for individuals; including passport number, issue date, and place of issue)<br/><br/>",
    "Type" => "text",
    "Required" => [
        "Legal Type" => [
            "Individual"
        ]
    ],
    "Ispapi-Name" => "X-RU-REGISTRANT-PASSPORT-DATA"
];
include "_acceptregistrationtac.php";
