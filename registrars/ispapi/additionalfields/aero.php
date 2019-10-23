<?php
## .AERO DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = array(
    'Name' => '.AERO ID',
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    'Name' => '.AERO Key',
    "Remove" => true
);

## add ispapi additional fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => ".AERO ID",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-AERO-ENS-AUTH-ID",
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Password",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-AERO-ENS-AUTH-KEY",
);
