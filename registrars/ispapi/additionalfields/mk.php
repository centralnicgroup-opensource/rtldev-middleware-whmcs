<?php
## .MK DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();

## LOCAL PRESENCE / TRUSTEE SERVICE ##
## NOTE: if you want to offer local presence service, add the trustee service price to the domain registration AND transfer price ##
## for reference: https://requests.whmcs.com/topic/integrate-trustee-service-as-generic-domain-add-on
/*
$additionaldomainfields[$tld][] = array(
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",Registrant and/or Admin-C are domiciled in North Macedonia / Use Local Presence Service",
    "Description" => "<div>If you are not domiciled in North Macedonia use the Local presence.<br>If you are domiciled in North Macedonia fill the dedicated fields below:</div>",
    "Ispapi-IgnoreForCountries" => "MK",
    "Ispapi-Name" => "X-MK-ACCEPT-TRUSTEE-TAC",
    "Ispapi-Options" => ",1"
);
*/
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant VAT ID",
    "Type" => "text",
    "Required" => false,
    "Description" => "(Only for Organization)",
    "Ispapi-Name" => "X-REGISTRANT-VATID"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant ID number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-REGISTRANT-IDNUMBER"
);
