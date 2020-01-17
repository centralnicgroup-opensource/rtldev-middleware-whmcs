<?php
# .PL DOMAIN REQUIREMENT
# remove default whmcs fields
$additionaldomainfields[$tld][] = [
    'Name'  => 'Publish Contact in .PL WHOIS',
    'Remove' => true
];
