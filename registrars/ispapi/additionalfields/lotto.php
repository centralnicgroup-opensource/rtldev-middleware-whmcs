<?php
## .LOTTO DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];
$additionaldomainfields[$tld][] = [
    "Name" => "Membership Contact ID",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-ASSOCIATION-ID"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Verification Code",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-ASSOCIATION-AUTH"
];
