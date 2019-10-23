<?php
## .PRO DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Profession",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "License Number",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Authority",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Authority Website",
    "Remove" => true
);

## add ispapi additional fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Profession",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-PRO-PROFESSION"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Authority",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-PRO-AUTHORITY"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Authority Website",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-PRO-AUTHORITYWEBSITE"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "License Number",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-PRO-LICENSENUMBER"
);
$additionaldomainfields[$tld][] = array(
    "Name" => ".PRO Terms",
    "Type" => "tickbox",
    "Description" => "Tick to confirm that you agree to the .PRO End User Terms Of Use at: <a href='http://www.registry.pro/legal/user-terms'>http://www.registry.pro/legal/user-terms</a>",
    "Required" => true,
    "Ispapi-Name" => "X-PRO-ACCEPT-TOU",
    "Ispapi-Eval" => 'if ( $value ) { $value = "1"; } else { $value = ""; }'
);
