<?php
## .CN DOMAIN REQUIREMENTS  (incl. .(com|net|org).cn)
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "cnhosting",
    "Remove" => true
);
$additionaldomainfields[$tld][] = array(
    "Name" => "cnhregisterclause",
    "Remove" => true
);

## add ispapi additional fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant ID Type",
    "Type" => "dropdown",
    "Options" => join(",", array(
        "",
        "Chinese ID card",
        "Foreign passport",
        "Exit-Entry Permit for Travelling to and from Hong Kong and Macao",
        "Travel passes for Taiwan Residents to Enter or Leave the Mainland",
        "Foreign Permanent Resident ID Card",
        "Residence permit for Hong Kong, Macao residents",
        "Residence permit for Taiwan residents",
        "Chinese officer certificate",
        "Chinese Organization Code Certificate",
        "Chinese business license",
        "Certificate for Uniform Social Credit Code",
        "Military Code Designation",
        "Military Paid External Service License",
        "Public Institution Legal Person Certificate",
        "Resident Representative Offices of Foreign Enterprises Registration Form",
        "Social Organization Legal Person Registration Certificate",
        "Religion Activity Site Registration Certificate",
        "Private Non-Enterprise Entity Registration Certificate",
        "Fund Legal Person Registration Certificate",
        "Practicing License of Law Firm",
        "Registration Certificate of Foreign Cultural Center in China",
        "Resident Representative Office of Tourism Departments of Foreign Government Approval Registration Certificate",
        "Judicial Expertise License",
        "Overseas Organization Certificate",
        "Social Service Agency Registration Certificate",
        "Private School Permit",
        "Medical Institution Practicing License",
        "Notary Organization Practicing License",
        "Beijing School for Children of Foreign Embassy Staff in China Permit",
        "Others"
    )),
    "Description" => "",
    "Required" => true,
    "Ispapi-Name" => "X-CN-REGISTRANT-ID-TYPE",
    "Ispapi-Options" => join(",", array(
        "",
        "SFZ",
        "HZ",
        "GAJMTX",
        "TWJMTX",
        "WJLSFZ",
        "GAJZZ",
        "TWJZZ",
        "JGZ",
        "ORG",
        "YYZZ",
        "TYDM",
        "BDDM",
        "JDDWFW",
        "SYDWFR",
        "WGCZJG",
        "SHTTFR",
        "ZJCS",
        "MBFQY",
        "JJHFR",
        "LSZY",
        "WGZHWH",
        "WLCZJG",
        "SFJD",
        "JWJG",
        "SHFWJG",
        "MBXXBX",
        "YLJGZY",
        "GZJGZY",
        "BJWSXX",
        "QT"
    ))
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant ID Number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-CN-REGISTRANT-ID-NUMBER"
);
