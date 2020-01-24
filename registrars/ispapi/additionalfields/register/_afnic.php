<?php
## .FR, .RE, .PM, .TF, .YT, .WF DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "Legal Type",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Info",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Birthplace City",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Birthplace Country",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Birthplace Postcode",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "SIRET Number",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "VAT Number",
    "Remove" => true
];


## add ispapi additional fields ##

## LOCAL PRESENCE / TRUSTEE SERVICE ##
## NOTE: if you want to offer local presence service, add the trustee service price to the domain registration AND transfer price ##
## for reference: https://requests.whmcs.com/topic/integrate-trustee-service-as-generic-domain-add-on
/*
$tclass = strtoupper(preg_replace("/.+\./", "", $tld));
$additionaldomainfields[$tld][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",1|Registrant and/or Admin-C are domiciled in France / Use Local Presence Service",
    "Default" => "",
    "Description" => "<div>If you are not domiciled in France use the Local presence.<br>If you are domiciled in France fill the dedicated fields below:</div>",
    "Ispapi-IgnoreForCountries" => [$tclass],
    "Ispapi-Name" => "X-" . tclass . "-ACCEPT-TRUSTEE-TAC"
];
*/
$additionaldomainfields[$tld][] = [
    "Name" => "Legal Type",
    "Type" => "dropdown",
    "Options" => implode(",", [
        "INDIV|Individual",
        "ORG1|Company with VATID or SIREN/SIRET number",
        "ORG2|Company with EU Trademark",
        "ORG3|Company with DUNS Number",
        "ORG4|Company local identifier",
        "ASS|French Association"
    ]),
    "Default" => "INDIV"
];
$additionaldomainfields[$tld][] = [
    "Name" => "VATID or SIREN/SIRET number",
    "Type" => "text",
    "Ispapi-Name" => "X-FR-REGISTRANT-LEGAL-ID",
    "Required" => [
        "Legal Type" => [
            "ORG1"
        ]
    ],
    "Description" => "(Only for companies with VATID or SIREN/SIRET number)",
];
$additionaldomainfields[$tld][] = [
    "Name" => "Trademark Number",
    "Ispapi-Name" => "X-FR-REGISTRANT-TRADEMARK-NUMBER",
    "Required" => [
        "Legal Type" => [
            "ORG2"
        ]
    ],
    "Description" => "(Only for companies with a European trademark)",
];
$additionaldomainfields[$tld][] = [
    "Name" => "DUNS Number",
    "Ispapi-Name" => "X-FR-REGISTRANT-DUNS-NUMBER",
    "Required" => [
        "Legal Type" => [
            "ORG3"
        ]
    ],
    "Description" => "(Only for companies with DUNS number)",
];
$additionaldomainfields[$tld][] = [
    "Name" => "Local ID",
    "Type" => "text",
    "Ispapi-Name" => "X-FR-REGISTRANT-LOCAL-ID",
    "Required" => [
        "Legal Type" => [
            "ORG4"
        ]
    ],
    "Description" => "(Only for companies with local identifier)",
];
$additionaldomainfields[$tld][] = [
    "Name" => "Date of Declaration",
    "Type" => "text",
    "Ispapi-Name" => "X-FR-REGISTRANT-JO-DATE-DECLARATION",
    "Required" => [
        "Legal Type" => [
            "ASS"
        ]
    ],
    "Description" => "(Only for french association) <div>The date of declaration of the association in the form <b>YYYY-MM-DD</b></div>",
];
$additionaldomainfields[$tld][] = [
    "Name" => "Number [JO]",
    "Type" => "text",
    "Ispapi-Name" => "X-FR-REGISTRANT-JO-NUMBER",
    "Required" => [
        "Legal Type" => [
            "ASS"
        ]
    ],
    "Description" => "(Only for french association) <div>The number of the Journal Officiel</div>",
];
$additionaldomainfields[$tld][] = [
    "Name" => "Page of Announcement [JO]",
    "Type" => "text",
    "Ispapi-Name" => "X-FR-REGISTRANT-JO-PAGE",
    "Required" => [
        "Legal Type" => [
            "ASS"
        ]
    ],
    "Description" => "(Only for french association) <div>The page of the announcement in the Journal Officiel</div>",
];
$additionaldomainfields[$tld][] = [
    "Name" => "Date of Publication [JO]",
    "Type" => "text",
    "Ispapi-Name" => "X-FR-REGISTRANT-JO-DATE-PUBLICATION",
    "Required" => [
        "Legal Type" => [
            "ASS"
        ]
    ],
    "Description" => "(Only for french association) <div>The date of publication in the Journal Officiel in the form <b>YYYY-MM-DD</b></div>",
];
