<?php
## .ES DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "ID Form Type",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "ID Form Number",
    "Remove" => true
);

## add ispapi additional fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant Type",
    "Type" => "dropdown",
    "Options" => ",Otra; For non-spanish owner,NIF/NIE; For Spanish Individual or Organization,Alien registration card",
    "Required" => true,
    "Ispapi-Name" => "X-ES-REGISTRANT-TIPO-IDENTIFICACION",
    "Ispapi-Options" => ",0,1,3",
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant Identification Number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-ES-REGISTRANT-IDENTIFICACION"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Admin-Contact Type",
    "Type" => "dropdown",
    "Options" => ",Otra; For non-spanish owner,NIF/NIE; For Spanish Individual or Organization,Alien registration card",
    "Required" => true,
    "Ispapi-Name" => "X-ES-ADMIN-TIPO-IDENTIFICACION",
    "Ispapi-Options" => ",0,1,3",
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Admin-Contact Identification Number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-ES-ADMIN-IDENTIFICACION"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Agreement",
    "Type" => "dropdown",
    "Options" => ",I agree to the .ES registration TAC for individuals",
    "Description" => "<div><a href='https://www.dominios.es/dominios/en/todo-lo-que-necesitas-saber/sobre-registros-de-dominios/terms-and-conditions'>.ES registration TAC for individuals</a> (Only for individuals)</div>",
    "Required" => true,
    "Ispapi-Name" => "X-ES-ACCEPT-INDIVIDUAL-REGISTRATION-TAC",
    "Ispapi-Options" => "0,1",
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Legal Form",
    "Type" => "dropdown",
    "Options" => implode(",", array(
        "",
        "1 - Individual",
        "39 - Economic Interest Group",
        "47 - Association",
        "59 - Sports Association",
        "68 - Professional Association",
        "124 - Savings Bank",
        "150 - Community Property",
        "152 - Community of Owners",
        "164 - Order or Religious Institution",
        "181 - Consulate",
        "197 - Public Law Association",
        "203 - Embassy",
        "229 - Local Authority",
        "269 - Sports Federation",
        "286 - Foundation",
        "365 - Mutual Insurance Company",
        "434 - Regional Government Body",
        "436 - Central Government Body",
        "439 - Political Party",
        "476 - Trade Union",
        "510 - Farm Partnership",
        "524 - Public Limited Company",
        "525 - Sports Association",
        "554 - Civil Society",
        "560 - General Partnership",
        "562 - General and Limited Partnership",
        "566 - Cooperative",
        "608 - Worker-owned Company",
        "612 - Limited Company",
        "713 - Spanish Office",
        "717 - Temporary Alliance of Enterprises",
        "744 - Worker-owned Limited Company",
        "745 - Regional Public Entity",
        "746 - National Public Entity",
        "747 - Local Public Entity",
        "878 - Designation of Origin Supervisory Council",
        "879 - Entity Managing Natural Areas",
        "877 - Others"
    )),
    "Required" => false,
    "Description" => "(Optional)",
    "Ispapi-Name" => "X-ES-REGISTRANT-FORM-JURIDICA",
    "Ispapi-Options" => implode(",", array(
        "", "1", "39", "47", "59", "68", "124", "150",
        "152", "164", "181", "197", "203", "229", "269",
        "286", "365", "434", "436", "439", "476", "510",
        "524", "525", "554", "560", "562", "566", "608",
        "612", "713","717","744","745","746","747","878",
        "879", "877"
    ))
);
