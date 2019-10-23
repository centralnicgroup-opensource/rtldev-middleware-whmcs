<?php
## .DK DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant VAT ID",
    "Type" => "text",
    "Required" => false,
    "Description" => "(Only for Organization)",
    "Ispapi-Name" => "X-REGISTRANT-VATID"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Admin VAT ID",
    "Type" => "text",
    "Required" => false,
    "Description" => "(Only for Organization)",
    "Ispapi-Name" => "X-ADMIN-VATID"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant contact",
    "Type" => "text",
    "Required" => false,
    "Description" => "(DK-HOSTMASTER User ID)",
    "Ispapi-Name" => "X-DK-REGISTRANT-CONTACT"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Admin contact",
    "Type" => "text",
    "Required" => false,
    "Description" => "(DK-HOSTMASTER User ID)",
    "Ispapi-Name" => "X-DK-ADMIN-CONTACT"
);
