<?php
## .EU DOMAIN REQUIREMENTS ##
## remove default whmcs fields
$additionaldomainfields[$tld][] = [
    'Name' => 'Entity Type',
    'Remove' => true
];

$additionaldomainfields[$tld][] = [
    "Name" => "Registrant Citizenship",
    "Options" => implode(",", ["", "AT", "BE", "BG", "CZ", "CY", "DE", "DK", "ES", "EE", "FI", "FR", "GR", "HU", "IE", "IT", "LT", "LU", "LV", "MT", "NL", "PL", "PT", "RO", "SE", "SK", "SI", "HR"]),
    "Default" => "",
    "Description" => "Required only if you're a European citizen residing outside of the EU",
    "Ispapi-Name" => "X-EU-REGISTRANT-CITIZENSHIP",
    "Type" => "dropdown",
    "Required" => false
];

## add ispapi fields
## LOCAL PRESENCE / TRUSTEE SERVICE ##
## NOTE: if you want to offer local presence service, add the trustee service price to the domain registration AND transfer price ##
## for reference: https://requests.whmcs.com/topic/integrate-trustee-service-as-generic-domain-add-on
/*
$additionaldomainfields[$tld][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",1|Registrant is domiciled in the EU / Use Local Presence Service",
    "Default" => "",
    "Ispapi-IgnoreForCountries" => ["AT","BE","BG","CZ","CY","DE","DK","ES","EE","FI","FR","GR","HU","IE","IT","LT","LU","LV","MT","NL","PL","PT","RO","SE","SK","SI","HR"],
    "Ispapi-Name" => "X-EU-ACCEPT-TRUSTEE-TAC"
];
*/
