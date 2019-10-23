<?php
## .HK, .香港 DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant Type",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    'Name' => 'Organizations Name in Chinese',
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    'Name' => 'Organizations Supporting Documentation',
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    'Name' => 'Organizations Document Number',
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    'Name' => 'Organizations Issuing Country',
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    'Name' => 'Organizations Industry Type',
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    'Name' => 'Individuals Supporting Documentation',
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    'Name' => 'Individuals Document Number',
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    'Name' => 'Individuals Issuing Country',
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    'Name' => 'Individuals Under 18',
    "Remove" => true
);

## add ispapi additional fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant Document Type",
    "Type" => "dropdown",
    "Options" => implode(",", array(
        "Individual - Hong Kong Identity Number",
        "Individual - Other's Country Identity Number",
        "Individual - Passport No.",
        "Individual - Birth Certificate",
        "Individual - Others Individual Document",
        "Organization - Business Registration Certificate",
        "Organization - Certificate of Incorporation",
        "Organization - Certificate of Registration of a School",
        "Organization - Hong Kong Special Administrative Region Government Department",
        "Organization - Ordinance of Hong Kong",
        "Organization - Others Organization Document"
    )),
    "Description" => "",
    "Required" => true,
    "Ispapi-Name" => "X-HK-REGISTRANT-DOCUMENT-TYPE",
    "Ispapi-Options" => implode(",", array(
        "HKID", "OTHID","PASSNO","BIRTHCERT","OTHIDV",
        "BR", "CI","CRS","HKSARG","HKORDINANCE","OTHORG"
    ))
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant Other Document Type",
    "Type" => "text",
    "Required" => false,
    "Description" => "required for chosen document type: `Others Individual Document` or `Others Organization Document`",
    "Ispapi-Name" => "X-HK-REGISTRANT-OTHER-DOCUMENT-TYPE"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant Document Number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-HK-REGISTRANT-DOCUMENT-NUMBER"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant Document Origin Country",
    "Type" => "text",
    "Required" => true,
    "Description" => "two-letter country code (ISO 3166-1 alpha-2)",
    "Ispapi-Name" => "X-HK-REGISTRANT-DOCUMENT-ORIGIN-COUNTRY"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant Birth Date for individuals",
    "Type" => "text",
    "Required" => false,
    "Description" => "YYYY-MM-DD (mandatory, if the registrant is an individual)",
    "Ispapi-Name" => "X-HK-REGISTRANT-BIRTH-DATE"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "HK Terms for individuals",
    "Type" => "tickbox",
    "Description" => "Accept the .HK <a href='https://www.hkirc.hk/content.jsp?id=3#!/6' target='_blank'>Terms for individuals</a>. (mandatory, if the registrant is an individual)",
    "Required" => false,
    "Options" => "on",
    "Ispapi-Name" => "X-HK-ACCEPT-INDIVIDUAL-REGISTRATION-TAC",
    "Ispapi-Replacements" => array("on" => "1")
);
