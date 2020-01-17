<?php
## .TRAVEL DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = [
    'Name' => 'Trustee Service',
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    'Name' => '.TRAVEL UIN Code',
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    'Name' => 'Trustee Service Agreement ',
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    'Name' => '.TRAVEL Usage Agreement',
    "Remove" => true
];

## add ispapi whmcs fields ##
$additionaldomainfields[$tld][] = [
    "Name" => ".TRAVEL Industry",
    "Description" => "(We acknowledge a relationship to the travel industry and that we are engaged in or plan to engage in activities related to travel.)",
    "Type" => "dropdown",
    "Ispapi-Name" => "X-TRAVEL-INDUSTRY",
    "Default" => "1|Yes",
    "Options" => implode(",", [
        "1|Yes",
        "0|No"
    ]),
    "Required" => true
];
