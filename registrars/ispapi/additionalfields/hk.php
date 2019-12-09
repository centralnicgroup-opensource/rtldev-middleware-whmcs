<?php
## .HK, .香港 (.xn--j6w193g) DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant Type",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    'Name' => 'Organizations Name in Chinese',
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    'Name' => 'Organizations Supporting Documentation',
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    'Name' => 'Organizations Document Number',
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    'Name' => 'Organizations Issuing Country',
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    'Name' => 'Organizations Industry Type',
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    'Name' => 'Individuals Supporting Documentation',
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    'Name' => 'Individuals Document Number',
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    'Name' => 'Individuals Issuing Country',
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    'Name' => 'Individuals Under 18',
    "Remove" => true
];

## add ispapi additional fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant Document Type",
    "Type" => "dropdown",
    "Options" => implode(",", [
        "HKID|Individual - Hong Kong Identity Number",
        "OTHID|Individual - Other's Country Identity Number",
        "PASSNO|Individual - Passport No.",
        "BIRTHCERT|Individual - Birth Certificate",
        "OTHIDV|Individual - Others Individual Document",
        "BR|Organization - Business Registration Certificate",
        "CI|Organization - Certificate of Incorporation",
        "CRS|Organization - Certificate of Registration of a School",
        "HKSARG|Organization - Hong Kong Special Administrative Region Government Department",
        "HKORDINANCE|Organization - Ordinance of Hong Kong",
        "OTHORG|Organization - Others Organization Document"
    ]),
    "Default" => "HKID|Individual - Hong Kong Identity Number",
    "Description" => "(NOTE: Additionally, you may need to send us a copy of the document via email. For .HK, this step is only required upon request by the registry. For .COM.HK, a copy of a business certificate is required before we can process the registration.)",
    "Required" => true,
    "Ispapi-Name" => "X-HK-REGISTRANT-DOCUMENT-TYPE"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant Other Document Type",
    "Type" => "text",
    "Required" => false,
    "Description" => "(required for document types `Others Individual/Organization Document`)",
    "Ispapi-Name" => "X-HK-REGISTRANT-OTHER-DOCUMENT-TYPE"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant Document Number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-HK-REGISTRANT-DOCUMENT-NUMBER"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant Document Origin Country",
    "Type" => "text",
    "Required" => true,
    "Description" => "(two-letter country code in format <a href='https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2' target='_blank'>ISO 3166-1 alpha-2</a>)",
    "Ispapi-Name" => "X-HK-REGISTRANT-DOCUMENT-ORIGIN-COUNTRY"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant Birth Date for individuals",
    "Type" => "text",
    "Required" => false,
    "Description" => "(mandatory for individuals, format YYYY-MM-DD)",
    "Ispapi-Name" => "X-HK-REGISTRANT-BIRTH-DATE"
];
$additionaldomainfields[$tld][] = [
    "Name" => "HK Terms for individuals",
    "Type" => "tickbox",
    "Description" => "Accept the .HK <a href='https://www.hkirc.hk/content.jsp?id=3#!/6' target='_blank'>Terms for individuals</a>. (mandatory, if the registrant is an individual)",
    "Required" => false,
    "Ispapi-Name" => "X-HK-ACCEPT-INDIVIDUAL-REGISTRATION-TAC"
];
