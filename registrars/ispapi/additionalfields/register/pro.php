<?php
## .PRO DOMAIN REQUIREMENTS ##
## add ispapi additional fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "Profession",
    "Ispapi-Name" => "X-PRO-PROFESSION"
];
$additionaldomainfields[$tld][] = [
    "Name" => "License Number",
    "Ispapi-Name" => "X-PRO-LICENSENUMBER"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Authority",
    "Ispapi-Name" => "X-PRO-AUTHORITY"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Authority Website",
    "Ispapi-Name" => "X-PRO-AUTHORITYWEBSITE"
];
$additionaldomainfields[$tld][] = [
    "Name" => ".PRO Terms",
    "Type" => "tickbox",
    "Description" => "Tick to confirm that you agree to the .PRO End User Terms Of Use at: <a href='http://www.registry.pro/legal/user-terms'>http://www.registry.pro/legal/user-terms</a>",
    "Required" => true,
    "Ispapi-Name" => "X-PRO-ACCEPT-TOU"
];
