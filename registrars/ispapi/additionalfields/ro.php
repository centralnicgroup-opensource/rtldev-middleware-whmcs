<?php
## .RO DOMAIN REQUIREMENTS
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = array(
    'Name' => 'CNPFiscalCode',
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    'Name' => 'Registration Number',
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    'Name' => 'Registrant Type',
    "Remove" => true
);

## add ispapi additional fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant ID Number",
    "Description" => "ONLY REQUIRED FOR ROMANIAN REGISTRANTS",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-REGISTRANT-IDNUMBER",
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant VAT ID",
    "Type" => "text",
    "Description" => "ONLY REQUIRED FOR EU COUNTRIES AND FOR INDIVIDUALS FROM ROMANIA",
    "Required" => false,
    "Ispapi-Name" => "X-REGISTRANT-VATID",
);
