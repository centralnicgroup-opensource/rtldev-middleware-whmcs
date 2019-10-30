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
include "_acceptregistrationtac.php";
