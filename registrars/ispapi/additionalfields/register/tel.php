<?php
## .TEL DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld][] = [
    "Name" => "Legal Type",
    "Ispapi-Name" => "X-TEL-WHOISTYPE",
    "Options" => implode(",", [
        "Natural|Natural Person",
        "Legal|Legal Person"
    ]),
    "Default" => "Natural|Natural Person",
    "Required" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "WHOIS Opt-out",
    "Description" => "(available for Legal Type `Natural`. Choose `No` to get WHOIS data limited to registrant name.)",
    "Type" => "dropdown",
    "Ispapi-Name" => "X-TEL-PUBLISH",
    "Options" => implode(",", [
        "Y|Yes",
        "N|No"
    ]),
    "Default" => "Y|Yes",
    "Required" => false
];
