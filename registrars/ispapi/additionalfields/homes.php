<?php
## .HOMES DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Highly Regulated TLD",
    "Type" => "dropdown",
    "Description" => "<div>I certify that the Registrant is eligibile to register this domain and that all provided information is true and accurate. Eligibility criteria may be viewed <a href='https://domains.homes/Policies/' target='_blank'>here</a>.</div>",
    "Options" => ",I accept",
    "Required" => true,
    "Ispapi-Name" => "X-HOMES-ACCEPT-HIGHLY-REGULATED-TAC",
    "Ispapi-Options" => ",1"
);
