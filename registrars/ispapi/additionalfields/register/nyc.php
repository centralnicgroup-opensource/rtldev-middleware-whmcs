<?php
## .NYC DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];
$additionaldomainfields[$tld][] = [
    "Name" => "NEXUS Category",
    "Type" => "dropdown",
    "Options" => implode(",", [
        "1|Natural Person - primary domicile with physical address in NYC",
        "2|Entity or organization - primary domicile with physical address in NYC"
    ]),
    "Default" => "1|Natural Person - primary domicile with physical address in NYC",
    "Description" => "(P.O Boxes are prohibited, see <a href='http://www.ownit.nyc/policies/index.php'>.nyc Nexus Policies</a>.)",
    "Required" => true,
    "Ispapi-Name" => "X-NYC-REGISTRANT-NEXUS-CATEGORY"
];
