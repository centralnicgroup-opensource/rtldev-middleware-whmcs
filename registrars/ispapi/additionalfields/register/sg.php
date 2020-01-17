<?php
## .SG DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant Type",
    "Remove" => true
];

## add ispapi additional fields ##

## LOCAL PRESENCE / TRUSTEE SERVICE ##
## NOTE: if you want to offer local presence service, add the trustee service price to the domain registration AND transfer price ##
## for reference: https://requests.whmcs.com/topic/integrate-trustee-service-as-generic-domain-add-on
/*
$additionaldomainfields[$tld][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",1|Registrant and/or Admin-C are domiciled in Singapore / Use Local Presence Service",
    "Default" => "",
    "Description" => "<div>If you are not domiciled in Singapore use the Local presence.<br>If you are domiciled in Singapore fill the dedicated fields below:</div>",
    "Default" => "",
    "Ispapi-IgnoreForCountries" => ["SG"],
    "Ispapi-Name" => "X-SG-ACCEPT-TRUSTEE-TAC"
];
*/
$additionaldomainfields[$tld][] = [
    "Name" => "RCB Singapore ID",
    "Required" => false,
    "Ispapi-Name" => "X-SG-RCBID"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Admin Personal ID",
    "Default" => "",
    "Required" => false,
    "Ispapi-Name" => "X-ADMIN-IDNUMBER"
];
