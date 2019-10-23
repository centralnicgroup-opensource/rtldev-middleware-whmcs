<?php
## .LV DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Vat ID",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-VATID"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "ID number",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-IDNUMBER"
);
