<?php
## .CL, .HU, .KR, .SK DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant ID number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-REGISTRANT-IDNUMBER"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Admin-C ID number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-ADMIN-IDNUMBER"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Tech-C ID number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-TECH-IDNUMBER"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Billing-C ID number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-BILLING-IDNUMBER"
);
