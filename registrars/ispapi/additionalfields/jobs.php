<?php
## .JOBS DOMAIN REQUIREMENTS ##
## add ispapi additional fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "Website",
    "Ispapi-Name" => "X-JOBS-COMPANYURL"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Industry Classification",
    "Type" => "dropdown",
    "Options" => implode(",", [
        "2|Accounting/Banking/Finance",
        "3|Agriculture/Farming",
        "21|Biotechnology/Science",
        "5|Computer/Information Technology",
        "4|Construction/Building Services",
        "12|Consulting",
        "6|Education/Training/Library",
        "7|Entertainment",
        "13|Environmental",
        "19|Hospitality",
        "10|Government/Civil Service",
        "11|Healthcare",
        "15|HR/Recruiting",
        "16|Insurance",
        "17|Legal",
        "18|Manufacturing",
        "20|Media/Advertising",
        "9|Parks & Recreation",
        "26|Pharmaceutical",
        "22|Real Estate",
        "14|Restaurant/Food Service",
        "23|Retail",
        "8|Telemarketing",
        "24|Transportation",
        "25|Other"
    ]),
    "Default" => "2|Accounting/Banking/Finance",
    "Required" => true,
    "Ispapi-Name" => "X-JOBS-INDUSTRYCLASSIFICATION"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Member of a Human Resources Association",
    "Type" => "dropdown",
    "Options" => "no|No,yes|Yes",
    "Default" => "no|No",
    "Ispapi-Name" => "X-JOBS-HRANAME"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Contact Job Title (e.g. CEO)",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-JOBS-TITLE"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Contact Type",
    "Type" => "dropdown",
    "Options" => "1|Administrative,0|Other",
    "Default" => "1|Administrative",
    "Ispapi-Name" => "X-JOBS-ADMINTYPE"
];
