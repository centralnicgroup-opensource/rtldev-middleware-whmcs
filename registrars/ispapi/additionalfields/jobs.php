<?php
## .JOBS DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = array(
    'Name' => 'Website',
    "Remove" => true
);

## add ispapi additional fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Company URL",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-JOBS-COMPANYURL"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Industry Classification",
    "Type" => "dropdown",
    "Options" => ",Accounting/Banking/Finance,Agriculture/Farming,Biotechnology/Science,Computer/Information Technology,Construction/Building Services,Consulting,Education/Training/Library,Entertainment,Environmental,Hospitality,Government/Civil Service,Healthcare,HR/Recruiting,Insurance,Legal,Manufacturing,Media/Advertising,Parks & Recreation,Pharmaceutical,Real Estate,Restaurant/Food Service,Retail,Telemarketing,Transportation,Other",
    "Required" => true,
    "Ispapi-Name" => "X-JOBS-INDUSTRYCLASSIFICATION",
    "Ispapi-Options" => ",2,3,21,5,4,12,6,7,13,19,10,11,15,16,17,18,20,9,26,22,14,23,8,24,25"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Member of a Human Resources Association",
    "Type" => "dropdown",
    "Options" => "No,Yes",
    "Default" => "No",
    "Ispapi-Name" => "X-JOBS-HRANAME",
    "Ispapi-Options" => "no,yes"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Contact Job Title (e.g. CEO)",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-JOBS-TITLE"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Contact Type",
    "Type" => "dropdown",
    "Options" => "Administrative,Other",
    "Default" => "Administrative",
    "Ispapi-Name" => "X-JOBS-ADMINTYPE",
    "Ispapi-Options" => "1,0"
);
