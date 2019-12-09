<?php
## .ES DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "ID Form Type",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "ID Form Number",
    "Remove" => true
];
# remove default whmcs fields (additional ones for .es 3rd level)
$additionaldomainfields[$tld][] = [
    'Name' => 'Entity Type',
    'Remove' => true
];

## add ispapi additional fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant Type",
    "Type" => "dropdown",
    "Options" => implode(",", [
        "0|Otra; For non-spanish owner",
        "1|NIF/NIE; For Spanish Individual or Organization",
        "3|Alien registration card"
    ]),
    "Default" => "0|Otra; For non-spanish owner",
    "Required" => true,
    "Ispapi-Name" => "X-ES-REGISTRANT-TIPO-IDENTIFICACION"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant Identification Number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-ES-REGISTRANT-IDENTIFICACION"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Admin-Contact Type",
    "Type" => "dropdown",
    "Options" => implode(",", [
        "0|Otra; For non-spanish owner",
        "1|NIF/NIE; For Spanish Individual or Organization",
        "3|Alien registration card"
    ]),
    "Default" => "0|Otra; For non-spanish owner",
    "Required" => true,
    "Ispapi-Name" => "X-ES-ADMIN-TIPO-IDENTIFICACION"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Admin-Contact Identification Number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-ES-ADMIN-IDENTIFICACION"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => "Tick to confirm the <a href='https://www.dominios.es/dominios/en/todo-lo-que-necesitas-saber/sobre-registros-de-dominios/terms-and-conditions' target='_blank'>.ES registration TAC for individuals</a> (Only for individuals)",
    "Required" => true,
    "Ispapi-Name" => "X-ES-ACCEPT-INDIVIDUAL-REGISTRATION-TAC"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Legal Form",
    "Options" => implode(",", [
        "",
        "1|Individual",
        "39|Economic Interest Group",
        "47|Association",
        "59|Sports Association",
        "68|Professional Association",
        "124|Savings Bank",
        "150|Community Property",
        "152|Community of Owners",
        "164|Order or Religious Institution",
        "181|Consulate",
        "197|Public Law Association",
        "203|Embassy",
        "229|Local Authority",
        "269|Sports Federation",
        "286|Foundation",
        "365|Mutual Insurance Company",
        "434|Regional Government Body",
        "436|Central Government Body",
        "439|Political Party",
        "476|Trade Union",
        "510|Farm Partnership",
        "524|Public Limited Company",
        "525|Sports Association",
        "554|Civil Society",
        "560|General Partnership",
        "562|General and Limited Partnership",
        "566|Cooperative",
        "608|Worker-owned Company",
        "612|Limited Company",
        "713|Spanish Office",
        "717|Temporary Alliance of Enterprises",
        "744|Worker-owned Limited Company",
        "745|Regional Public Entity",
        "746|National Public Entity",
        "747|Local Public Entity",
        "878|Designation of Origin Supervisory Council",
        "879|Entity Managing Natural Areas",
        "877|Others"
    ]),
    "Default" => "",
    "Required" => false,
    "Description" => "(Optional)",
    "Ispapi-Name" => "X-ES-REGISTRANT-FORM-JURIDICA"
];
