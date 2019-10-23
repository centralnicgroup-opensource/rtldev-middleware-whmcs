<?php
## .TEL DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "WHOIS Type",
    "Type" => "dropdown",
    "Ispapi-Name" => "X-TEL-WHOISTYPE",
    "Options" => implode(",", array(
        "Legal",
        "Natural"
    )),
    "Required" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Publish Full Data in WHOIS",
    "Description" => "(available for WHOIS Type `Natural`. Choose `No` to get WHOIS data limited to registrant name.)",
    "Type" => "dropdown",
    "Ispapi-Name" => "X-TEL-PUBLISH",
    "Options" => implode(",", array(
        "Yes",
        "No"
    )),
    "Ispapi-Options" => implode(",", array(
        "Y",
        "N"
    )),
    "Default" => "Y",
    "Required" => false
);
