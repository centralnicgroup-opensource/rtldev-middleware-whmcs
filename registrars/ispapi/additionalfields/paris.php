<?php
## .PARIS DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => "Tick to confirm that you agree to the <a href='http://bienvenue.paris/registry-policies-paris/' target='_blank'>Registry Terms and Conditions of Registration</a> upon new registration of .PARIS domain names.",
    "Required" => true,
    "Ispapi-Name" => "X-PARIS-ACCEPT-REGISTRATION-TAC"
);
