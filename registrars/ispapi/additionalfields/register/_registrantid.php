<?php
## .(COM|NET|ORG|ASN|ID).AU, CN DOMAIN REQUIREMENTS ##
$tclass = strtoupper(preg_replace("/\./", "", $tld));
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant ID",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-" . $tclass . "-REGISTRANT-ID-NUMBER"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant ID Type",
    "Type" => "dropdown",
    "Options" => $customopts,
    "Default" => $customopts[0],
    "Required" => true,
    "Ispapi-Name" => "X-" . $tclass . "-REGISTRANT-ID-TYPE"
];
