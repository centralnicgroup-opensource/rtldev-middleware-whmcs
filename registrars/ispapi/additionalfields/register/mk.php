<?php
## .MK DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];

## LOCAL PRESENCE / TRUSTEE SERVICE ##
## NOTE: if you want to offer local presence service, add the trustee service price to the domain registration AND transfer price ##
## for reference: https://requests.whmcs.com/topic/integrate-trustee-service-as-generic-domain-add-on
/*
$additionaldomainfields[$tld][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",1|Registrant and/or Admin-C are domiciled in North Macedonia / Use Local Presence Service",
    "Default" => "",
    "Description" => "<div>If you are not domiciled in North Macedonia use the Local presence.<br>If you are domiciled in North Macedonia fill the dedicated fields below:</div>",
    "Ispapi-IgnoreForCountries" => ["MK"],
    "Ispapi-Name" => "X-MK-ACCEPT-TRUSTEE-TAC"
];
*/
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant VAT ID",
    "Type" => "text",
    "Required" => false,
    "Description" => "(Only for Organization)",
    "Ispapi-Name" => "X-REGISTRANT-VATID"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant ID number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-REGISTRANT-IDNUMBER"
];
