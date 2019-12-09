<?php
## .AERO DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld][] = [
    'Name' => '.AERO ID',
    'Ispapi-Name' => "X-AERO-ENS-AUTH-ID"
];
$additionaldomainfields[$tld][] = [
    'Name' => '.AERO Key',
    'Required' => true,
    'Ispapi-Name' => "X-AERO-ENS-AUTH-KEY"
];
