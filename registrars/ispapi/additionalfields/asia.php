<?php
# .ASIA REQUIREMENTS
# Remove default WHMCS fields
$additionaldomainfields[$tld][] = array(
    "Name" => "Legal Type",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Identity Form",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Identity Number",
    "Remove" => true
);
