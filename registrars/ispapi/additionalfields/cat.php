<?php
## .CAT DOMAIN REQUIREMENTS ##
include "scot.php";
$additionaldomainfields[$tld][] = array(
    "Name" => "Highly Regulated TLD",
    "Type" => "dropdown",
    "Description" => "<div>I certify that the Registrant is eligibile to register this domain and that all provided information is true and accurate. Eligibility criteria may be viewed <a href='http://fundacio.cat/en/domini/rules-cat-domain' target='_blank'>here</a>.</div>",
    "Options" => ",I accept",
    "Required" => true,
    "Ispapi-Name" => "X-CAT-ACCEPT-HIGHLY-REGULATED-TAC",
    "Ispapi-Options" => ",1"
);
