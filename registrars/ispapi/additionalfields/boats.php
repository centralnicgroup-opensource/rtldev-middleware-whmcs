<?php
## .BOATS DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Highly Regulated TLD",
    "Type" => "dropdown",
    "Description" => "<div>I certify that the Registrant is eligibile to register this domain and that all provided information is true and accurate. Eligibility criteria may be viewed <a href='https://get.boats/policies/' target='_blank'>here</a>.</div>",
    "Options" => ",I accept",
    "Required" => true,
    "Ispapi-Name" => "X-BOATS-ACCEPT-HIGHLY-REGULATED-TAC",
    "Ispapi-Options" => ",1"
);
