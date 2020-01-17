<?php
## .US DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld][] = [
    "Name" => "Application Purpose",
    "Ispapi-Name" => "X-US-NEXUS-APPPURPOSE",
    "Options" => implode(",", [
        "P1|Business use for profit",
        "P2|Non-profit business",
        "P2|Club",
        "P2|Association",
        "P2|Religious Organization",
        "P3|Personal Use",
        "P4|Educational purposes",
        "P5|Government purposes"
    ]),
    "Default" => "Business use for profit",
    "Required" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Nexus Category",
    "Description" => "A natural person who is ...",
    "Ispapi-Name" => "X-US-NEXUS-CATEGORY",
    "Required" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Nexus Country",
    "Description" => "<div>Specify the two-letter country-code of the registrant (if Nexus Category is either C31 or C32).</div>",
    "Ispapi-Name" => "X-US-NEXUS-VALIDATOR",
    "Required" => false,
    "Ispapi-Format" => 'UPPERCASE'
];
