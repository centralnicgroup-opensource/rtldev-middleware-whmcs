<?php
## .SYDNEY DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];
$additionaldomainfields[$tld][] = [
    "Name" => "Nexus Category",
    "Type" => "dropdown",
    "Ispapi-Name" => "X-SYDNEY-NEXUS-CATEGORY",
    "Options" => implode(",", [
        "A|Criteria A - New South Wales Entities",
        "B|Criteria B - New South Wales Residents",
        "C|Criteria C - Associated Entities"
    ]),
    "Default" => "A|Criteria A - New South Wales Entities",
    "Required" => true
];
