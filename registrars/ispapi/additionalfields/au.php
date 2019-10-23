<?php
## .COM.AU DOMAIN REQUIREMENTS (incl. .(net|org|id).au) ##
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

## add ispapi additional fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant ID",
    "Type" => "text",
    "Size" => "20",
    "Default" => "",
    "Required" => true,
    "Ispapi-Name" => "X-AU-REGISTRANT-ID-NUMBER"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant ID Type",
    "Type" => "dropdown",
    "Options" => "Australian Business Number,Australian Company Number,Business Registration Number,Trademark Number",
    "Default" => "ABN",
    "Required" => false,
    "Ispapi-Name" => "X-AU-REGISTRANT-ID-TYPE",
    "Ispapi-Options" => "ABN,ACN,RBN,TM"
);
