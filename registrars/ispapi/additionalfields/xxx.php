<?php
## .XXX DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => "Tick to confirm that you agree to the <a href='http://www.icmregistry.com/about/policies/registry-registrant-agreement/' target='_blank'>Registry Terms and Conditions of Registration</a> upon new registration of .XXX domain names.",
    "Required" => true,
    "Ispapi-Name" => "X-XXX-ACCEPT-REGISTRATION-TAC",
    "Ispapi-Eval" => 'if ( $value ) { $value = "1"; } else { $value = ""; }'
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Resolving Domain",
    "Description" => "(Should this .XXX domain resolve?)",
    "Type" => "dropdown",
    "Ispapi-Name" => "X-XXX-NON-RESOLVING",
    "Ispapi-Options" => implode(",", array(
        "0",
        "1"
    )),
    "Options" => implode(",", array(
        "Yes - Domain should resolve",
        "No  - Domain should not resolve"
    )),
    "Default" => "0",
    "Required" => false
);
$additionaldomainfields[$tld][] = array(
    "Name" => ".XXX Membership ID",
    "Type" => "text",
    "Description" => "(Required in order to make your .XXX domain resolving)",
    "Ispapi-Name" => "X-XXX-MEMBERSHIP-CONTACT",
    "Default" => "",
    "Required" => false
);
