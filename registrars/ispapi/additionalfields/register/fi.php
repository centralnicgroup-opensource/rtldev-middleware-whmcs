<?php
## .FI DOMAIN REQUIREMENTS ##
include "_acceptregistrationtac.php";
$additionaldomainfields[$tld][] = [
    "Name" => "ID Number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-FI-IDNUMBER"
];
