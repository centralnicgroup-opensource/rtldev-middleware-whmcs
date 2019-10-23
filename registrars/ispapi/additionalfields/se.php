<?php
## .SE DOMAIN REQUIREMENTS ##
## remove default whmcs fields #
$additionaldomainfields[$tld][] = array(
    'Name' => 'Identification Number',
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    'Name' => 'VAT',
    "Remove" => true
);

## add ispapi additional fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant ID Number",
    "Type" => "text",
    "Required" => true,
    "Description" => "<b>For individuals or companies located in Sweden</b> a valid Swedish
		personal or organizational number must be stated.
		<b>For individuals and companies outside of Sweden</b> the ID number (e.g. Civic
		registration number, company registration number, or the equivalent) must be stated.",
    "Ispapi-Name" => "X-NICSE-IDNUMBER",
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant VAT ID",
    "Type" => "text",
    "Required" => false,
    "Description" => "(Only required for companies that are located inside the European
		Union but outside Sweden)",
    "Ispapi-Name" => "X-NICSE-VATID",
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => "Tick to confirm that you agree to the Registry Terms and Conditions of Registration (link below) upon new registration of .SE domain names.
    <br><a href='https://internetstiftelsen.se/app/uploads/2019/02/registreringsvillkor-se-eng.pdf' target=\"_blank\">Registry Terms and Conditions</a>",
    "Required" => true,
    "Ispapi-Name" => "X-SE-ACCEPT-REGISTRATION-TAC",
    "Ispapi-Eval" => 'if ( $value ) { $value = "1"; } else { $value = ""; }'
);
