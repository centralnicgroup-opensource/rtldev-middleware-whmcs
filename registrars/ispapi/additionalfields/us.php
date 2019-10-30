<?php
## .US DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Application Purpose",
    "Type" => "dropdown",
    "Ispapi-Name" => "X-US-NEXUS-APPPURPOSE",
    "Ispapi-Options" => implode(",", array(
        "",
        "P1",
        "P2",
        "P3",
        "P4",
        "P5"
    )),
    "Options" => implode(",", array(
        "",
        "P1 - Business use for profit",
        "P2 - Non-profit business; club; association; religious organization; etc.",
        "P3 - Personal Use",
        "P4 - Educational purposes",
        "P5 - Government purposes"
    )),
    "Default" => "",
    "Required" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Nexus Category",
    "Description" => "A natural person who is ...",
    "Type" => "dropdown",
    "Ispapi-Name" => "X-US-NEXUS-CATEGORY",
    "Ispapi-Options" => implode(",", array(
        "C11",
        "C12",
        "C21",
        "C31",
        "C32"
    )),
    "Options" => implode(",", array(
        "C11",
        "C12",
        "C21",
        "C31",
        "C32"
    )),
    "Default" => "C11",
    "Required" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Nexus Country",
    "Type" => "text",
    "Description" => "<div>Specify the two-letter country-code of the registrant (if Nexus Category is either C31 or C32).</div>",
    "Ispapi-Name" => "X-US-NEXUS-VALIDATOR",
    "Default" => "",
    "Required" => false,
    "Ispapi-Format" => 'UPPERCASE'
);
