<?php
## .BANK DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Registry's Allocation Token",
    "Type" => "text",
    "Required" => true,
    "Description" => "To register a .BANK domain, you must provide the allocation token issued by the registry. Please complete the registrant application <a href='https://www.register.bank/get-started/' target='_blank'>here</a> to obtain the token.",
    "Ispapi-Name" => "X-ALLOCATIONTOKEN"
);
