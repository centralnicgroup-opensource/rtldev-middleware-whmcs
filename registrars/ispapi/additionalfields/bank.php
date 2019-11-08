<?php
## .BANK DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];
$additionaldomainfields[$tld][] = [
    "Name" => "Registry's Allocation Token",
    "Type" => "text",
    "Required" => true,
    "Description" => "(Issued by the registry. Obtain it by completing <a href='https://www.register.bank/get-started/' target='_blank'>the registrant application</a>.)",
    "Ispapi-Name" => "X-ALLOCATIONTOKEN",
    "Default" => ""
];
