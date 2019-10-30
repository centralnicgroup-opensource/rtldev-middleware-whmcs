<?php
## .COM.AU DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant Name",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Eligibility Name",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Eligibility ID",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Eligibility ID Type",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Eligibility Type",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Eligibility Reason",
    "Remove" => true
);

## edit whmcs default additional fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant ID",
    "Ispapi-Name" => "X-AU-REGISTRANT-ID-NUMBER"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant ID Type",
    "Options" => "Australian Business Number,Australian Company Number,Business Registration Number,Trademark Number",
    "Ispapi-Name" => "X-AU-REGISTRANT-ID-TYPE",
    "Ispapi-Options" => "ABN,ACN,RBN,TM"
);
