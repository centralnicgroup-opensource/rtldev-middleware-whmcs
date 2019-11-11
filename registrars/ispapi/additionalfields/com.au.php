<?php
## .(COM|NET|ORG|ASN|ID).AU DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "Registrant Name",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Eligibility Name",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Eligibility ID",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Eligibility ID Type",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Eligibility Type",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Eligibility Reason",
    "Remove" => true
];

## edit whmcs default additional fields ##
$customopts =  implode(",", [
    "ABN|Australian Business Number",
    "ACN|Australian Company Number",
    "RBN|Business Registration Number",
    "TM|Trademark Number"
]);
include "_registrantid.php";
