<?php
## .XXX DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];
include "_acceptregistrationtac.php";
$additionaldomainfields[$tld][] = [
    "Name" => "Resolving Domain",
    "Description" => "(Should this .XXX domain resolve?)",
    "Type" => "dropdown",
    "Ispapi-Name" => "X-XXX-NON-RESOLVING",
    "Options" => implode(",", [
        "0|Yes - Domain should resolve",
        "1|No  - Domain should not resolve"
    ]),
    "Default" => "0|Yes - Domain should resolve",
    "Required" => false
];
$additionaldomainfields[$tld][] = [
    "Name" => ".XXX Membership ID",
    "Type" => "text",
    "Description" => "(Required in order to make your .XXX domain resolving)",
    "Ispapi-Name" => "X-XXX-MEMBERSHIP-CONTACT",
    "Default" => "",
    "Required" => false
];
