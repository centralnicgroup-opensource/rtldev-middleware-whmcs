<?php
## .TRAVEL DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = array(
    'Name' => 'Trustee Service',
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    'Name' => '.TRAVEL UIN Code',
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    'Name' => 'Trustee Service Agreement ',
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    'Name' => '.TRAVEL Usage Agreement',
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => ".TRAVEL Industry",
    "Description" => "(We acknowledge a relationship to the travel industry and that we are engaged in or plan to engage in activities related to travel.)",
    "Type" => "dropdown",
    "Ispapi-Name" => "X-TRAVEL-INDUSTRY",
    "Default" => "1",
    "Ispapi-Options" => "1,0",
    "Options" => implode(",", array(
        "Yes",
        "No"
    )),
    "Required" => true
);
