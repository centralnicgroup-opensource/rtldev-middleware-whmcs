<?php
## .SWISS DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Enterprise ID",
    "Type" => "text",
    "Required" => true,
    "Description" => "(must be CHE followed by 9 digits)",
    "Ispapi-Name" => "X-SWISS-REGISTRANT-ENTERPRISE-ID",
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Intended use",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-CORE-INTENDED-USE",
);
