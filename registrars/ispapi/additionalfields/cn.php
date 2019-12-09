<?php
## .CN DOMAIN REQUIREMENTS  (incl. .(com|net|org).cn)
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "cnhosting",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "cnhregisterclause",
    "Remove" => true
];

## add ispapi additional fields ##
$customopts = implode(",", [
    "SFZ|Chinese ID card",
    "HZ|Foreign passport",
    "GAJMTX|Exit-Entry Permit for Travelling to and from Hong Kong and Macao",
    "TWJMTX|Travel passes for Taiwan Residents to Enter or Leave the Mainland",
    "WJLSFZ|Foreign Permanent Resident ID Card",
    "GAJZZ|Residence permit for Hong Kong, Macao residents",
    "TWJZZ|Residence permit for Taiwan residents",
    "JGZ|Chinese officer certificate",
    "ORG|Chinese Organization Code Certificate",
    "YYZZ|Chinese business license",
    "TYDM|Certificate for Uniform Social Credit Code",
    "BDDM|Military Code Designation",
    "JDDWFW|Military Paid External Service License",
    "SYDWFR|Public Institution Legal Person Certificate",
    "WGCZJG|Resident Representative Offices of Foreign Enterprises Registration Form",
    "SHTTFR|Social Organization Legal Person Registration Certificate",
    "ZJCS|Religion Activity Site Registration Certificate",
    "MBFQY|Private Non-Enterprise Entity Registration Certificate",
    "JJHFR|Fund Legal Person Registration Certificate",
    "LSZY|Practicing License of Law Firm",
    "WGZHWH|Registration Certificate of Foreign Cultural Center in China",
    "WLCZJG|Resident Representative Office of Tourism Departments of Foreign Government Approval Registration Certificate",
    "SFJD|Judicial Expertise License",
    "JWJG|Overseas Organization Certificate",
    "SHFWJG|Social Service Agency Registration Certificate",
    "MBXXBX|Private School Permit",
    "YLJGZY|Medical Institution Practicing License",
    "GZJGZY|Notary Organization Practicing License",
    "BJWSXX|Beijing School for Children of Foreign Embassy Staff in China Permit",
    "QT|Others"
]);
include "_registrantid.php";
