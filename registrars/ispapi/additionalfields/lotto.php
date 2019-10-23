<?php
## .LOTTO DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Membership Contact ID",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-ASSOCIATION-ID"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Verification Code",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-ASSOCIATION-AUTH"
);
