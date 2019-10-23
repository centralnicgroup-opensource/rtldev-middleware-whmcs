<?php
## .NU DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Identification Number",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "VAT Number",
    "Remove" => true
);
## add ispapi additional fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant ID number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-REGISTRANT-IDNUMBER"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Vat ID",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-VATID"

);
$additionaldomainfields[$tld][] = array(
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => "Tick to confirm that you agree to the <a href='https://internetstiftelsen.se/app/uploads/2019/02/terms-and-conditions-nu.pdf' target='_blank'>Registry Terms and Conditions of Registration</a> upon new registration of .NU domain names.",
    "Required" => true,
    "Ispapi-Name" => "X-NU-ACCEPT-REGISTRATION-TAC",
    "Ispapi-Eval" => 'if ( $value ) { $value = "1"; } else { $value = ""; }'
);
