<?php
# .VOTE, .VOTO DOMAIN REQUIREMENTS
# remove default whmcs fields
$additionaldomainfields[$tld] = [
    'Name' => 'Agreement',
    'Remove' => true
];