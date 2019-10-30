<?php
## .RU DOMAIN REQUIREMENTS
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant's Birth Date",
    "Description" => "(required for individuals)",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-RU-REGISTRANT-BIRTH-DATE"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant's Passport Data",
    "Description" => "(required for individuals)",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-RU-REGISTRANT-PASSPORT-DATA"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => "Tick to confirm that you agree to the <a href='http://www.cctld.ru/en/docs/rules.php' target='_blank'>Registry Terms and Conditions of Registration</a><u>for Individuals</u> upon new registration of .RU domain names.",
    "Required" => true,
    "Ispapi-Name" => "X-RU-INDIVIDUAL-ACCEPT-REGISTRATION-TAC"
);
