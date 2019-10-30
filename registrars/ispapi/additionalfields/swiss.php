<?php
## .SWISS DOMAIN REQUIREMENTS ##
# add ispapi fields
$fieldname = 'Core Intended Use';
include "_intendeduse.php";
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant Enterprise ID",
    "Description" => "(must start with CHE and followed by 9 digits)",
    "Ispapi-Name" => "X-SWISS-REGISTRANT-ENTERPRISE-ID"
];
