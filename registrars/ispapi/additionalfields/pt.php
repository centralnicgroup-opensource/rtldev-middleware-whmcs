<?php
## .PT DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant Vat ID",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-PT-REGISTRANT-VATID"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Tech vat ID",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-PT-TECH-VATID"
);
