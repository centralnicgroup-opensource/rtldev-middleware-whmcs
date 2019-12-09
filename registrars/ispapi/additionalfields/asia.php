<?php
# .ASIA REQUIREMENTS
# Remove default WHMCS fields
$additionaldomainfields[$tld][] = [
    "Name" => "Legal Type",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Identity Form",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Identity Number",
    "Remove" => true
];
