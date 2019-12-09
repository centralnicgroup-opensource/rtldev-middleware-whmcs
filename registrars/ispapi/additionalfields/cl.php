<?php
## .CL, .HU, .KR, .SK DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant ID number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-REGISTRANT-IDNUMBER"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Admin-C ID number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-ADMIN-IDNUMBER"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Tech-C ID number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-TECH-IDNUMBER"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Billing-C ID number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-BILLING-IDNUMBER"
];
