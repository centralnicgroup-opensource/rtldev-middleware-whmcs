<?php
## .NYC DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "NEXUS Category",
    "Type" => "dropdown",
    "Options" => ",Natural Person - primary domicile with physical address in NYC,Entity or organization - primary domicile with physical address in NYC",
    "Description" => "<div>P.O Boxes are prohibited, see <a href='http://www.ownit.nyc/policies/index.php'>.nyc Nexus Policies</a>.</div>",
    "Required" => true,
    "Ispapi-Name" => "X-NYC-REGISTRANT-NEXUS-CATEGORY",
    "Ispapi-Options" => ",1,2",
);
