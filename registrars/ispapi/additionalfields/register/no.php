<?php
## .NO DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant ID number",
    "Type" => "text",
    "Default" => "",
    "Required" => true,
    "Ispapi-Name" => "X-NO-REGISTRANT-IDENTITY"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Fax required",
    "Type" => "tickbox",
    "Description" => "I confirm I will send the following form back to complete the registration process: <a href='http://www.domainform.net/form/no/search?view=registration'>http://www.domainform.net/form/no/search?view=registration</a>",
    "Default" => "",
    "Required" => true,
];
