<?php
## .XXX DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
include "_acceptregistrationtac.php";
$additionaldomainfields[$tld][] = array(
    "Name" => "Resolving Domain",
    "Description" => "(Should this .XXX domain resolve?)",
    "Type" => "dropdown",
    "Ispapi-Name" => "X-XXX-NON-RESOLVING",
    "Ispapi-Options" => implode(",", array(
        "0",
        "1"
    )),
    "Options" => implode(",", array(
        "Yes - Domain should resolve",
        "No  - Domain should not resolve"
    )),
    "Default" => "0",
    "Required" => false
);
$additionaldomainfields[$tld][] = array(
    "Name" => ".XXX Membership ID",
    "Type" => "text",
    "Description" => "(Required in order to make your .XXX domain resolving)",
    "Ispapi-Name" => "X-XXX-MEMBERSHIP-CONTACT",
    "Default" => "",
    "Required" => false
);
