<?php
## .ECO DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Highly Regulated TLD",
    "Type" => "dropdown",
    "Description" => "<div>All .ECO domain names will be first registered with “server hold” status pending the completion of the minimum requirements of the Eco Profile, namely, the .ECO registrant 1) affirming their compliance with the .ECO Eligibility Policy and 2) pledging to support positive change for the planet and to be honest when sharing information on their environmental actions. The registrant will be emailed with instructions on how to create an Eco Profile. Once these steps have been completed, the .ECO domain will be immediately activated by the registry.</div>",
    "Options" => ",I accept",
    "Required" => true,
    "Ispapi-Name" => "X-ECO-ACCEPT-HIGHLY-REGULATED-TAC",
    "Ispapi-Options" => ",1"
);
