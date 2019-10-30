<?php
## .FI DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld][] = [];
$additionaldomainfields[$tld][] = [
    "Name" => "FICORA Agreement",
    "Type" => "tickbox",
    "Description" => "I Accept the <a target='_blank' href='https://domain.fi/info/en/index/hakeminen/kukavoihakea.html'>.FI Domain Name Agreement</a>.",
    "Required" => true,
    "Ispapi-Name" => "X-FI-ACCEPT-REGISTRATION-TAC"
];
$additionaldomainfields[$tld][] = [
    "Name" => "ID Number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-FI-IDNUMBER"
];
