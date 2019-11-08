<?php
## .DE DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "Tax ID",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Address Confirmation",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Agree to DE Terms",
    "Remove" => true
];

## add ispapi additional fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "General Request Contact",
    "Type" => "text",
    "Description" => "The registry will identify this as the general request contact information. You can provide an email address or a website url",
    "Required" => false,
    "Ispapi-Name" => "X-DE-GENERAL-REQUEST"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Abuse Team Contact",
    "Type" => "text",
    "Description" => "The registry will identify this as the abuse team contact information. You can provide an email address or a website url",
    "Required" => false,
    "Ispapi-Name" => "X-DE-ABUSE-CONTACT"
];
## LOCAL PRESENCE / TRUSTEE SERVICE ##
## NOTE: if you want to offer local presence service, add the trustee service price to the domain registration AND transfer price ##
## for reference: https://requests.whmcs.com/topic/integrate-trustee-service-as-generic-domain-add-on
/*
$additionaldomainfields[$tld][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",1|Registrant and/or Admin-C are domiciled in Germany / Use Local Presence Service",
    "Default" => "",
    "Ispapi-IgnoreForCountries" => ["DE"],
    "Ispapi-Name" => "X-DE-ACCEPT-TRUSTEE-TAC"
];*/
