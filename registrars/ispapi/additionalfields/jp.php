<?php

## .JP DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];

## LOCAL PRESENCE / TRUSTEE SERVICE ##
## NOTE: if you want to offer local presence service, add the trustee service price to the domain registration AND transfer price ##
## for reference: https://requests.whmcs.com/topic/integrate-trustee-service-as-generic-domain-add-on
## TODO: we do not offer JP Trustee Service, this is just some relict out of the past and related on how our backend system covered
##       the .jp registrations internally. Obviously this part can be cleaned up.
/*
$additionaldomainfields[$tld][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",1|Registrant and/or Admin-C are domiciled in Japan / Use Local Presence Service",
    "Default" => "",
    "Ispapi-IgnoreForCountries" => ["JP"],
    "Ispapi-Name" => "X-JP-ACCEPT-TRUSTEE-TAC"
];
*/
