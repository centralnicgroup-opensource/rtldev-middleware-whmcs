<?php
## .QUEBEC DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Info",
    "Remove" => true
);

## add ispapi additional fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Intended Use",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-CORE-INTENDED-USE"
);
