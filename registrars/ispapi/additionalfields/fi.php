<?php
## .FI DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld][] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "FICORA Agreement",
    "Type" => "tickbox",
    "Description" => "I Accept the <a target='_blank' href='https://domain.fi/info/en/index/hakeminen/kukavoihakea.html'>.FI Domain Name Agreement</a>.",
    "Required" => true,
    "Ispapi-Name" => "X-FI-ACCEPT-REGISTRATION-TAC"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "ID Number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-FI-IDNUMBER"
);
