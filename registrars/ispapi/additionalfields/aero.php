<?php
## .AERO DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld][] = array(
    'Name' => '.AERO ID',
    'Required' => true,
    'Ispapi-Name' => "X-AERO-ENS-AUTH-ID"
);
$additionaldomainfields[$tld][] = array(
    'Name' => '.AERO Key',
    'Required' => true,
    'Ispapi-Name' => "X-AERO-ENS-AUTH-KEY"
);
