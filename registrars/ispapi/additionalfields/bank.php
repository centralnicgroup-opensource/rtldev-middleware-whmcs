<?php
## .BANK DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];
$additionaldomainfields[$tld][] = [
    "Name" => "Registry's Allocation Token",
    "Type" => "text",
    "Required" => true,
    "Description" => "<div>To register a .BANK domain, you must provide the allocation token issued by the registry. Please complete the registrant application <a href='https://www.register.bank/get-started/' target='_blank'>here</a> to obtain the token.</div>",
    "Ispapi-Name" => "X-ALLOCATIONTOKEN",
    "Default" => ""
];
