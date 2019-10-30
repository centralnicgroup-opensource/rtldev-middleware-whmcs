<?php
## .NGO DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => "Tick to confirm that you agree to the <a href='https://thenew.org/org-people/about-pir/policies/ngo-ong-policies/' target='_blank'>Registry Terms and Conditions of Registration</a> upon new registration of .NGO domain names.",
    "Required" => true,
    "Ispapi-Name" => "X-NGO-ACCEPT-REGISTRATION-TAC"
);
