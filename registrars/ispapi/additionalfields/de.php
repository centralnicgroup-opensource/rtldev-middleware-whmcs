<?php
## .DE DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Tax ID",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Address Confirmation",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Agree to DE Terms",
    "Remove" => true
);

## add ispapi additional fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "General Request Contact",
    "Type" => "text",
    "Description" => "The registry will identify this as the general request contact information. You can use an email address (contact@example.com) or a website (https://mycontactform.example)",
    "Required" => false,
    "Ispapi-Name" => "X-DE-GENERAL-REQUEST"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Abuse Team Contact",
    "Type" => "text",
    "Description" => "The registry will identify this as the abuse team contact information. You can use an email address (contact@example.com) or a website (https://mycontactform.example)",
    "Required" => false,
    "Ispapi-Name" => "X-DE-ABUSE-CONTACT"
);
## LOCAL PRESENCE / TRUSTEE SERVICE ##
## NOTE: if you want to offer local presence service, add the trustee service price to the domain registration AND transfer price ##
## for reference: https://requests.whmcs.com/topic/integrate-trustee-service-as-generic-domain-add-on
/*
$additionaldomainfields[$tld][] = array(
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",Registrant and/or Admin-C are domiciled in Germany / Use Local Presence Service",
    "Ispapi-IgnoreForCountries" => "DE",
    "Ispapi-Name" => "X-DE-ACCEPT-TRUSTEE-TAC",
    "Ispapi-Options" => ",1"
);*/
