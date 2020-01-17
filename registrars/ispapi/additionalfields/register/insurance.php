<?php
## .INSURANCE DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];
$additionaldomainfields[$tld][] = [
    "Name" => "Registry's Allocation Token",
    "Type" => "text",
    "Required" => true,
    "Description" => "To register a .INSURANCE domain, you must provide the allocation token issued by the registry. Please complete the registrant application <a href='https://www.register.insurance/get-started/' target='_blank'>here</a> to obtain the token.",
    "Ispapi-Name" => "X-ALLOCATIONTOKEN"
];
