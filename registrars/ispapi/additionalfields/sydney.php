<?php
## .SYDNEY DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Nexus Category",
    "Type" => "dropdown",
    "Ispapi-Name" => "X-SYDNEY-NEXUS-CATEGORY",
    "Ispapi-Options" => "A,B,C",
    "Options" => implode(",", array(
        "Criteria A - New South Wales Entities",
        "Criteria B - New South Wales Residents",
        "Criteria C - Associated Entities"
    )),
    "Required" => true
);
