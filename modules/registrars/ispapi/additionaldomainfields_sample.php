<?php

##
## THIS IS A SAMPLE FILE WITH PRECONFIGURED EXTENSIONS RUNNING WITH OUR SYSTEM
## THIS FILE WILL ASSIST YOU CONFIGURING YOUR WHMCS ADDITIONAL DOMAIN FIELDS
## DO NOT INCLUDE THIS FILE DIRECTLY
##

## TODO: THE FOLLOWING TLDS REQUIRE ADDITIONAL FIELDS
## IF YOU NEED ONE OF THEM LET US KNOW. WE'LL PROVIDE THIS ASAP!
## -- REGISTRATION --
## .MK, .MY, .RU, .XXX, .рф, .香港
## -- TRANSFER / TRADE -- (to cover when WHMCS' design is ready for it)

## .ABOGADO
$additionaldomainfields[".abogado"] = [];
$additionaldomainfields[".abogado"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is " .
        "true and accurate. Eligibility criteria may be viewed <a href='http://nic.law/eligibilitycriteria/' target='_blank'>here</a>."
    ),
    "Ispapi-Name" => "X-ABOGADO-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .AE
$additionaldomainfields[".ae"] = [];
$additionaldomainfields[".ae"][] = [
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => "Tick to confirm the <a href='https://www.nic.ae/content.jsp?action=termcond_ae' target='_blank'>Terms for Individuals</a>",
    "Required" => true,
    "Ispapi-Name" => "X-AE-ACCEPT-REGISTRATION-TAC"
];

## .AERO DOMAIN REQUIREMENTS ##
$additionaldomainfields['.aero'][] = ['Name' => '.AERO ID', "Remove" => true];
$additionaldomainfields['.aero'][] = ['Name' => '.AERO Key', "Remove" => true];
$additionaldomainfields[".aero"][] = [
    "Name" => ".aero ID",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-AERO-ENS-AUTH-ID",
];
$additionaldomainfields[".aero"][] = [
    "Name" => "Password",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-AERO-ENS-AUTH-KEY",
];

## .ATTORNEY
$additionaldomainfields[".attorney"] = [];
$additionaldomainfields[".attorney"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm the <b>Safeguards for Highly-regulated TLDs</b>:<br/>" .
        "<div style='text-align:justify'>You understand and agree that you will abide by and be compliant with these additional terms:" .
        "<ol><li>Administrative Contact Information. You agree to provide administrative contact information, which must be kept up-to-date, " .
        "for the notification of complaints or reports of registration abuse, as well as the contact details of the relevant regulatory, or " .
        "industry selfregulatory, bodies in their main place of business.</li>" .
        "<li>Representation. You confirm and represent that you possesses any necessary authorizations, charters, licenses and/or other related " .
        "credentials for participation in the sector associated with such Highly-Regulated TLD.</li>" .
        "<li>Report of Changes of Authorization, Charters, Licenses, Credentials. You agree to report any material changes to the validity of " .
        "your authorizations, charters, licenses and/or other related credentials for participation in the sector associated with the Highly-Regulated " .
        "TLD to ensure you continue to conform to the appropriate regulations and licensing requirements and generally conduct you activities in the " .
        "interests of the consumers you serve.</li></ol></div>"
    ),
    "Ispapi-Name" => "X-ATTORNEY-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .COM.AU DOMAIN REQUIREMENTS ##
$additionaldomainfields[".com.au"][] = ["Name" => "Registrant Name", "Remove" => true];
$additionaldomainfields[".com.au"][] = ["Name" => "Eligibility Name", "Remove" => true];
$additionaldomainfields[".com.au"][] = ["Name" => "Eligibility ID", "Remove" => true];
$additionaldomainfields[".com.au"][] = ["Name" => "Eligibility ID Type", "Remove" => true];
$additionaldomainfields[".com.au"][] = ["Name" => "Eligibility Type", "Remove" => true];
$additionaldomainfields[".com.au"][] = ["Name" => "Eligibility Reason", "Remove" => true];
$additionaldomainfields[".com.au"][] = [
    "Name" => "Registrant ID",
    "Type" => "text",
    "Size" => "20",
    "Default" => "",
    "Required" => true,
    "Ispapi-Name" => "X-AU-REGISTRANT-ID-NUMBER"
];
$additionaldomainfields[".com.au"][] = [
    "Name" => "Registrant ID Type",
    "Type" => "dropdown",
    "Options" => "Australian Business Number,Australian Company Number,Business Registration Number, Trademark Number",
    "Default" => "ABN",
    "Required" => false,
    "Ispapi-Name" => "X-AU-REGISTRANT-ID-TYPE",
    "Ispapi-Options" => "ABN,ACN,RBN,TM"
];
$additionaldomainfields[".asn.au"] = $additionaldomainfields[".com.au"];
$additionaldomainfields[".net.au"] = $additionaldomainfields[".com.au"];
$additionaldomainfields[".org.au"] = $additionaldomainfields[".com.au"];
$additionaldomainfields[".id.au"] = $additionaldomainfields[".com.au"];

## .BANK
$additionaldomainfields[".bank"] = [];
$additionaldomainfields[".bank"][] = [
    "Name" => "Registry's Allocation Token",
    "Type" => "text",
    "Required" => true,
    "Description" => (
        "To register a .BANK domain, you must provide the allocation token issued by the registry. " .
        "Please complete the registrant application <a href='https://www.register.bank/get-started/' target='_blank'>here</a> to obtain the token."
    ),
    "Ispapi-Name" => "X-ALLOCATIONTOKEN"
];

## .BARCELONA
$additionaldomainfields[".barcelona"] = [];
$additionaldomainfields[".barcelona"][] = [
    "Name" => "Intended Use",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-CORE-INTENDED-USE"
];

## .BAYERN DOMAIN REQUIREMENTS ##
## NOTE: Activate trustee service / local presence service just in case you have reflected the service costs
## in the TLD prices otherwise your customers do not pay for it. This is a missing Domain Add-On in WHMCS.
/*$additionaldomainfields[".bayern"] = [];
$additionaldomainfields[".bayern"][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",Registrant and/or Admin-C are domiciled in Bayern / Use Local Presence Service",
    "Ispapi-Name" => "X-BAYERN-ACCEPT-TRUSTEE-TAC",
    "Ispapi-Options" => ",1"
];*/

## .BERLIN DOMAIN REQUIREMENTS ##
## NOTE: Activate trustee service / local presence service just in case you have reflected the service costs
## in the TLD prices otherwise your customers do not pay for it. This is a missing Domain Add-On in WHMCS.
/*$additionaldomainfields[".berlin"] = [];
$additionaldomainfields[".berlin"][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",Registrant and/or Admin-C are domiciled in Berlin / Use Local Presence Service",
    "Ispapi-Name" => "X-BERLIN-ACCEPT-TRUSTEE-TAC",
    "Ispapi-Options" => ",1"
];*/

## .BOATS
$additionaldomainfields[".boats"] = [];
$additionaldomainfields[".boats"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is " .
        "true and accurate. Eligibility criteria may be viewed <a href='https://get.boats/policies/' target='_blank'>here</a>."
    ),
    "Ispapi-Name" => "X-BOATS-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .BROKER
$additionaldomainfields[".broker"] = [];
$additionaldomainfields[".broker"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is " .
        "true and accurate. Eligibility criteria may be viewed <a href='https://nic.broker/' target='_blank'>here</a>."
    ),
    "Ispapi-Name" => "X-BROKER-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .CA DOMAIN REQUIREMENTS ##
## add ispapi additional fields ##
$additionaldomainfields['.ca'][] = ['Name' => 'CIRA Agreement', "Remove" => true];
$additionaldomainfields[".ca"][] = [
    "Name" => "Legal Type",
    "LangVar" => "catldlegaltype",
    "Type" => "dropdown",
    "Options" => "Corporation,Canadian Citizen,Permanent Resident of Canada,Government,Canadian Educational Institution,Canadian Unincorporated Association,Canadian Hospital,Partnership Registered in Canada,Trade-mark registered in Canada,Canadian Trade Union,Canadian Political Party,Canadian Library Archive or Museum,Trust established in Canada,Aboriginal Peoples,Legal Representative of a Canadian Citizen,Official mark registered in Canada",
    "Default" => "Corporation",
    "Description" => "Legal type of registrant contact",
    "Required" => true,
    "Ispapi-Name" => "X-CA-LEGALTYPE",
    "Ispapi-Options" => "CCO,CCT,RES,GOV,EDU,ASS,HOP,PRT,TDM,TRD,PLT,LAM,TRS,ABO,LGR,OMK,MAJ"
];
$additionaldomainfields[".ca"][] = [
    "Name" => "Contact Language",
    "Type" => "dropdown",
    "Options" => "English,French",
    "Default" => "English",
    "Required" => true,
    "Ispapi-Name" => "X-CA-LANGUAGE",
    "Ispapi-Options" => "EN,FR"
];

## .CAT
$additionaldomainfields[".cat"] = [];
$additionaldomainfields[".cat"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is " .
        "true and accurate. Eligibility criteria may be viewed <a href='http://domini.cat/en/domini/rules-cat-domain' target='_blank'>here</a>."
    ),
    "Ispapi-Name" => "X-CAT-ACCEPT-HIGHLY-REGULATED-TAC"
];
$additionaldomainfields[".cat"][] = [
    "Name" => "Intended Use",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-CORE-INTENDED-USE"
];

## .CFD
$additionaldomainfields[".cfd"] = [];
$additionaldomainfields[".cfd"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is " .
        "true and accurate. Eligibility criteria may be viewed <a href='https://nic.cfd/' target='_blank'>here</a>."
    ),
    "Ispapi-Name" => "X-CFD-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .CN DOMAIN REQUIREMENTS ##
$additionaldomainfields[".cn"][] = ["Name" => "cnhosting", "Remove" => true];
$additionaldomainfields[".cn"][] = ["Name" => "cnhregisterclause", "Remove" => true];
$additionaldomainfields[".cn"][] = [
    "Name" => "Registrant ID Type",
    "Type" => "dropdown",
    "Options" => ",Chinese ID card,Chinese Passport,Chinese Officer Certificate,Chinese Organization Code Certificate,Chinese Business License,Others",
    "Description" => "",
    "Required" => true,
    "Ispapi-Name" => "X-CN-REGISTRANT-ID-TYPE",
    "Ispapi-Options" => ",SFZ,HZ,JGZ,ORG,YYZZ,QT",
];
$additionaldomainfields[".cn"][] = [
    "Name" => "Registrant ID Number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-CN-REGISTRANT-ID-NUMBER",
];
$additionaldomainfields[".com.cn"] = $additionaldomainfields[".cn"];
$additionaldomainfields[".net.cn"] = $additionaldomainfields[".cn"];
$additionaldomainfields[".org.cn"] = $additionaldomainfields[".cn"];

## .COM.BR DOMAIN REQUIREMENTS
$additionaldomainfields[".com.br"] = [];
$additionaldomainfields[".com.br"][] = [
    "Name" => "Identification Number",
    "Type" => "text",
    "Description" => "Please provide your CPF or CNPJ numbers which are issued by the Department of Federal Revenue of Brazil for tax purposes",
    "Required" => true,
    "Ispapi-Name" => "X-BR-REGISTER-NUMBER"
];

## .DE DOMAIN REQUIREMENTS ##
$additionaldomainfields[".de"][] = ["Name" => "Tax ID", "Remove" => true];
$additionaldomainfields[".de"][] = ["Name" => "Address Confirmation", "Remove" => true];
$additionaldomainfields[".de"][] = ["Name" => "Agree to DE Terms", "Remove" => true];
$additionaldomainfields[".de"][] = [
    "Name" => "General Request Contact",
    "Type" => "text",
    "Description" => "The registry will identify this as the general request contact information. You can provide an email address or a website url",
    "Ispapi-Name" => "X-DE-GENERAL-REQUEST"
];
$additionaldomainfields[".de"][] = [
    "Name" => "Abuse Team Contact",
    "Type" => "text",
    "Description" => "The registry will identify this as the abuse team contact information. You can provide an email address or a website url.",
    "Ispapi-Name" => "X-DE-ABUSE-CONTACT"
];

## .DENTIST
$additionaldomainfields[".dentist"] = [];
$additionaldomainfields[".dentist"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm the <b>Safeguards for Highly-regulated TLDs</b>:<br/>" .
        "<div style='text-align:justify'>You understand and agree that you will abide by and be compliant with these additional terms:" .
        "<ol><li>Administrative Contact Information. You agree to provide administrative contact information, which must be kept up-to-date, " .
        "for the notification of complaints or reports of registration abuse, as well as the contact details of the relevant regulatory, or " .
        "industry selfregulatory, bodies in their main place of business.</li>" .
        "<li>Representation. You confirm and represent that you possesses any necessary authorizations, charters, licenses and/or other related " .
        "credentials for participation in the sector associated with such Highly-Regulated TLD.</li>" .
        "<li>Report of Changes of Authorization, Charters, Licenses, Credentials. You agree to report any material changes to the validity of " .
        "your authorizations, charters, licenses and/or other related credentials for participation in the sector associated with the Highly-Regulated " .
        "TLD to ensure you continue to conform to the appropriate regulations and licensing requirements and generally conduct you activities in the " .
        "interests of the consumers you serve.</li></ol></div>"
    ),
    "Ispapi-Name" => "X-DENTIST-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .DK DOMAIN REQUIREMENTS ##
$additionaldomainfields[".dk"] = [];
/*
// START OF X-DK-AGREEMENT-ACCEPTEDDATE
// ++++++++++++++++++ NOTE ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// READ: https://wiki.hexonet.net/wiki/DK#Registrations_alternative_registration_method_with_registrants_entering_into_an_agreement_with_DK_hostmaster_on_a_resellers_website
// Follow Method 1 of https://www.dk-hostmaster.dk/en/implementation-guide-registration-dk
// If you use the below additional domain field, we will use an UTC timestamp in the domain registration command as required if the checkbox got checked
// CAUTION: WHMCS has right now no possibility to separate additional fields for registration and transfer
// This additional field below will result in transfer errors
// ++++++++++++++++++ NOTE ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$additionaldomainfields[".dk"][] = [
        "Name" => "Agreement",
        "Type" => "tickbox",
        "Description" => "I confirm that I have read and understood the <a href='https://www.dk-hostmaster.dk/en/terms' target='_blank' style='text-decoration:underline;'> DK Hostmaster's terms of use</a> for a .dk domain.",
        "Default" => "",
        "Required" => true,
        "Ispapi-Name" => "X-DK-AGREEMENT-ACCEPTEDDATE"
];
// END OF X-DK-AGREEMENT-ACCEPTEDDATE
*/
$additionaldomainfields[".dk"][] = [
    "Name" => "Registrant VAT ID",
    "Type" => "text",
    "Required" => false,
    "Description" => "(Only for Organization)",
    "Ispapi-Name" => "X-REGISTRANT-VATID",
];
$additionaldomainfields[".dk"][] = [
    "Name" => "Admin VAT ID",
    "Type" => "text",
    "Required" => false,
    "Description" => "(Only for Organization)",
    "Ispapi-Name" => "X-ADMIN-VATID",
];
$additionaldomainfields[".dk"][] = [
    "Name" => "Registrant contact",
    "Type" => "text",
    "Required" => false,
    "Description" => "(DK-HOSTMASTER User ID)",
    "Ispapi-Name" => "X-DK-REGISTRANT-CONTACT",
];
$additionaldomainfields[".dk"][] = [
    "Name" => "Admin contact",
    "Type" => "text",
    "Required" => false,
    "Description" => "(DK-HOSTMASTER User ID)",
    "Ispapi-Name" => "X-DK-ADMIN-CONTACT",
];

## .ECO DOMAIN REQUIREMENTS ##
$additionaldomainfields[".eco"] = [];
$additionaldomainfields[".eco"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "dropdown",
    "Description" => "<div>All .ECO domain names will be first registered with “server hold” status pending the completion of the minimum requirements of the Eco Profile, namely, the .ECO registrant 1) affirming their compliance with the .ECO Eligibility Policy and 2) pledging to support positive change for the planet and to be honest when sharing information on their environmental actions. The registrant will be emailed with instructions on how to create an Eco Profile. Once these steps have been completed, the .ECO domain will be immediately activated by the registry.</div>",
    "Options" => ",I accept",
    "Required" => true,
    "Ispapi-Name" => "X-ECO-ACCEPT-HIGHLY-REGULATED-TAC",
    "Ispapi-Options" => ",1"
];

## .ES DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[".es"][] = ["Name" => "ID Form Type", "Remove" => true];
$additionaldomainfields[".es"][] = ["Name" => "ID Form Number", "Remove" => true];

## add ispapi additional fields ##
$additionaldomainfields[".es"][] = [
    "Name" => "Registrant Type",
    "Type" => "dropdown",
    "Options" => ",Otra; For non-spanish owner,NIF/NIE; For Spanish Individual or Organization,Alien registration card",
    "Required" => true,
    "Ispapi-Name" => "X-ES-REGISTRANT-TIPO-IDENTIFICACION",
    "Ispapi-Options" => ",0,1,3",
];
$additionaldomainfields[".es"][] = [
    "Name" => "Registrant Identification Number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-ES-REGISTRANT-IDENTIFICACION"
];
$additionaldomainfields[".es"][] = [
    "Name" => "Admin-Contact Type",
    "Type" => "dropdown",
    "Options" => ",Otra; For non-spanish owner,NIF/NIE; For Spanish Individual or Organization,Alien registration card",
    "Required" => true,
    "Ispapi-Name" => "X-ES-ADMIN-TIPO-IDENTIFICACION",
    "Ispapi-Options" => ",0,1,3",
];
$additionaldomainfields[".es"][] = [
    "Name" => "Admin-Contact Identification Number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-ES-ADMIN-IDENTIFICACION"
];
$additionaldomainfields[".es"][] = [
    "Name" => "Agreement",
    "Type" => "dropdown",
    "Options" => ",I agree to the .ES registration TAC for individuals",
    "Description" => "<div><a href='https://cp.hexonet.net/cp2/downloads/tac/ES_registration_TAC.pdf'>.ES registration TAC for individuals</a> (Only for individuals)</div>",
    "Required" => true,
    "Ispapi-Name" => "X-ES-ACCEPT-INDIVIDUAL-REGISTRATION-TAC",
    "Ispapi-Options" => "0,1",
];
$additionaldomainfields[".es"][] = [
    "Name" => "Legal Form",
    "Type" => "dropdown",
    "Options" => ",1 - Individual,39 - Economic Interest Group,47 - Association,59 - Sports Association,68 - Professional Association,124 - Savings Bank,150 - Community Property,152 - Community of Owners,164 - Order or Religious Institution,181 - Consulate,197 - Public Law Association,203 - Embassy,229 - Local Authority,269 - Sports Federation,286 - Foundation,365 - Mutual Insurance Company,434 - Regional Government Body,436 - Central Government Body,439 - Political Party,476 - Trade Union,510 - Farm Partnership,524 - Public Limited Company,525 - Sports Association,554 - Civil Society,560 - General Partnership,562 - General and Limited Partnership,566 - Cooperative,608 - Worker-owned Company,612 - Limited Company,713 - Spanish Office,717 - Temporary Alliance of Enterprises,744 - Worker-owned Limited Company,745 - Regional Public Entity,746 - National Public Entity,747 - Local Public Entity,877 - Others,878 - Designation of Origin Supervisory Council,879 - Entity Managing Natural Areas",
    "Required" => false,
    "Description" => "(Optional)",
    "Ispapi-Name" => "X-ES-REGISTRANT-FORM-JURIDICA",
    "Ispapi-Options" => ",1,39,47,59,68,124,150,152,164,181,197,203,229,269,286,365,434,436,439,476,510,524,525,554,560,562,566,608,612,713,717,744,745,746,747,877,878,879",
];

## .EU DOMAIN REQUIREMENTS ##
$additionaldomainfields[".eu"] = [];
$additionaldomainfields["eu"][] = [
    "Name" => "Registrant Citizenship",
    "Options" => ["", "AT", "BE", "BG", "CZ", "CY", "DE", "DK", "ES", "EE", "FI", "FR", "GR", "HU", "IE", "IT", "LT", "LU", "LV", "MT", "NL", "PL", "PT", "RO", "SE", "SK", "SI", "HR"],
    "Description" => "Required only if you're a European Citizen residing outside of the EU",
    "Ispapi-Name" => "X-EU-REGISTRANT-CITIZENSHIP",
    "Required" => false
];
## NOTE: Activate trustee service / local presence service just in case you have reflected the service costs
## in the TLD prices otherwise your customers do not pay for it. This is a missing Domain Add-On in WHMCS.
/*
$additionaldomainfields[".eu"][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",Registrant is domiciled in the EU / Use Local Presence Service",
    "Ispapi-IgnoreForCountries" => "AT,BE,BG,CZ,CY,DE,DK,ES,EE,FI,FR,GR,GB,HU,IE,IT,LT,LU,LV,MT,NL,PL,PT,RO,SE,SK,SI,AX,GF,GI,GP,MQ,RE",
    "Ispapi-Name" => "X-EU-ACCEPT-TRUSTEE-TAC",
    "Ispapi-Options" => ",1"
];*/

## .FI DOMAIN REQUIREMENTS ##
$additionaldomainfields[".fi"][] = [];
$additionaldomainfields[".fi"][] = [
    "Name" => "FICORA Agreement",
    "Type" => "tickbox",
    "Description" => "I Accept the <a target='_blank' href='https://domain.fi/info/en/index/hakeminen/kukavoihakea.html'>.FI Domain Name Agreement</a>.",
    "Required" => true,
    "Ispapi-Name" => "X-FI-ACCEPT-REGISTRATION-TAC",
    "Ispapi-Eval" => 'if ( $value ) { $value = "1"; } else { $value = ""; }'
];
$additionaldomainfields[".fi"][] = [
    "Name" => "ID Number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-FI-IDNUMBER"
];

## .FR DOMAIN REQUIREMENTS ##
$additionaldomainfields[".fr"][] = ["Name" => "Legal Type", "Remove" => true];
$additionaldomainfields[".fr"][] = ["Name" => "Info", "Remove" => true];
$additionaldomainfields[".fr"][] = ["Name" => "Birthdate","Remove" => true];
$additionaldomainfields[".fr"][] = ["Name" => "Birthplace City", "Remove" => true];
$additionaldomainfields[".fr"][] = ["Name" => "Birthplace Country", "Remove" => true];
$additionaldomainfields[".fr"][] = ["Name" => "Birthplace Postcode", "Remove" => true];
$additionaldomainfields[".fr"][] = ["Name" => "SIRET Number", "Remove" => true];
$additionaldomainfields[".fr"][] = ["Name" => "DUNS Number", "Remove" => true];
$additionaldomainfields[".fr"][] = ["Name" => "VAT Number", "Remove" => true];
$additionaldomainfields[".fr"][] = ["Name" => "Trademark Number", "Remove" => true];
## NOTE: Activate trustee service / local presence service just in case you have reflected the service costs
## in the TLD prices otherwise your customers do not pay for it. This is a missing Domain Add-On in WHMCS.
/*$additionaldomainfields[".fr"][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",Registrant and/or Admin-C are domiciled in France / Use Local Presence Service",
    "Description" => "<div>If you are not domiciled in France use the Local presence.<br>If you are domiciled in France fill the dedicated fields below:</div>",
    "Ispapi-IgnoreForCountries" => "FR",
    "Ispapi-Name" => "X-FR-ACCEPT-TRUSTEE-TAC",
    "Ispapi-Options" => ",1"
];*/
$additionaldomainfields[".fr"][] = [
    "Name" => "Date of Birth",
    "Type" => "text",
    "Ispapi-Name" => "X-FR-REGISTRANT-BIRTH-DATE",
    "Description" => "(Only for individuals)",
];
$additionaldomainfields[".fr"][] = [
    "Name" => "Place of Birth",
    "Type" => "text",
    "Ispapi-Name" => "X-FR-REGISTRANT-BIRTH-PLACE",
    "Description" => "(Only for individuals)",
];
$additionaldomainfields[".fr"][] = [
    "Name" => "VATID or SIREN/SIRET number",
    "Type" => "text",
    "Ispapi-Name" => "X-FR-REGISTRANT-LEGAL-ID",
    "Description" => "(Only for companies with VATID or SIREN/SIRET number)",
];
$additionaldomainfields[".fr"][] = [
    "Name" => "Trademark Number",
    "Type" => "text",
    "Ispapi-Name" => "X-FR-REGISTRANT-TRADEMARK-NUMBER",
    "Description" => "(Only for companies with a European trademark)",
];
$additionaldomainfields[".fr"][] = [
    "Name" => "DUNS number",
    "Type" => "text",
    "Ispapi-Name" => "X-FR-REGISTRANT-DUNS-NUMBER",
    "Description" => "(Only for companies with DUNS number)",
];
$additionaldomainfields[".fr"][] = [
    "Name" => "Local ID",
    "Type" => "text",
    "Ispapi-Name" => "X-FR-REGISTRANT-LOCAL-ID",
    "Description" => "(Only for companies with local identifier)",
];
$additionaldomainfields[".fr"][] = [
    "Name" => "Date of Declaration",
    "Type" => "text",
    "Ispapi-Name" => "X-FR-REGISTRANT-JO-DATE-DECLARATION",
    "Description" => "(Only for french association) <div>The date of declaration of the association in the form <b>YYYY-MM-DD</b></div>",
];
$additionaldomainfields[".fr"][] = [
    "Name" => "Number [JO]",
    "Type" => "text",
    "Ispapi-Name" => "X-FR-REGISTRANT-JO-NUMBER",
    "Description" => "(Only for french association) <div>The number of the Journal Officiel</div>",
];
$additionaldomainfields[".fr"][] = [
    "Name" => "Page of Announcement [JO]",
    "Type" => "text",
    "Ispapi-Name" => "X-FR-REGISTRANT-JO-PAGE",
    "Description" => "(Only for french association) <div>The page of the announcement in the Journal Officiel</div>",
];
$additionaldomainfields[".fr"][] = [
    "Name" => "Date of Publication [JO]",
    "Type" => "text",
    "Ispapi-Name" => "X-FR-REGISTRANT-JO-DATE-PUBLICATION",
    "Description" => "(Only for french association) <div>The date of publication in the Journal Officiel in the form <b>YYYY-MM-DD</b></div>",
];
$additionaldomainfields[".pm"] = $additionaldomainfields[".fr"];
$additionaldomainfields[".re"] = $additionaldomainfields[".fr"];
$additionaldomainfields[".tf"] = $additionaldomainfields[".fr"];
$additionaldomainfields[".wf"] = $additionaldomainfields[".fr"];
$additionaldomainfields[".yt"] = $additionaldomainfields[".fr"];

## .FOREX
$additionaldomainfields[".forex"] = [];
$additionaldomainfields[".forex"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is " .
        "true and accurate. Eligibility criteria may be viewed <a href='https://nic.forex/' target='_blank'>here</a>."
    ),
    "Ispapi-Name" => "X-FOREX-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .GAY DOMAIN REQUIREMENTS ##
$additionaldomainfields['.gay'][] = [
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => "I agree I will not use the domain to incite violence, harassment, threats or hate speech on LGBTQ individuals or groups. 
            I understand that DotGay donates 20% from each new domain registered to their partners, GLAAD and CenterLink.",
    "Required" => true,
    "Ispapi-Name" => "X-GAY-ACCEPT-REQUIREMENTS",
    "Ispapi-Eval" => 'if ( $value ) { $value = "1"; } else { $value = ""; }'
];

## .HAMBURG DOMAIN REQUIREMENTS ##
## NOTE: Activate trustee service / local presence service just in case you have reflected the service costs
## in the TLD prices otherwise your customers do not pay for it. This is a missing Domain Add-On in WHMCS.
/*$additionaldomainfields[".hamburg"] = [];
$additionaldomainfields[".hamburg"][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",Registrant and/or Admin-C are domiciled in Hamburg / Use Local Presence Service",
    "Ispapi-Name" => "X-HAMBURG-ACCEPT-TRUSTEE-TAC",
    "Ispapi-Options" => ",1"
];*/

## .HEALTH
$additionaldomainfields[".health"] = [];
$additionaldomainfields[".health"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is " .
        "true and accurate. Eligibility criteria may be viewed <a href='https://get.health/registration-policies' target='_blank'>here</a>."
    ),
    "Ispapi-Name" => "X-HEALTH-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .HK DOMAIN REQUIREMENTS ##
$additionaldomainfields[".hk"][] = ["Name" => "Registrant Type", "Remove" => true];
$additionaldomainfields[".hk"][] = ['Name' => 'Organizations Name in Chinese', "Remove" => true];
$additionaldomainfields[".hk"][] = ['Name' => 'Organizations Supporting Documentation', "Remove" => true];
$additionaldomainfields[".hk"][] = ['Name' => 'Organizations Document Number', "Remove" => true];
$additionaldomainfields[".hk"][] = ['Name' => 'Organizations Issuing Country', "Remove" => true];
$additionaldomainfields[".hk"][] = ['Name' => 'Organizations Industry Type', "Remove" => true];
$additionaldomainfields[".hk"][] = ['Name' => 'Individuals Supporting Documentation', "Remove" => true];
$additionaldomainfields[".hk"][] = ['Name' => 'Individuals Document Number', "Remove" => true];
$additionaldomainfields[".hk"][] = ['Name' => 'Individuals Issuing Country', "Remove" => true];
$additionaldomainfields[".hk"][] = ['Name' => 'Individuals Under 18', "Remove" => true];
$additionaldomainfields[".hk"][] = [
    "Name" => "Registrant Document Type",
    "Type" => "dropdown",
    "Options" => "Individual - Hong Kong Identity Number,Individual - Other's Country
		Identity Number,Individual - Passport No.,Individual - Birth Certificate,Individual -
		Others Individual Document,Organization - Business Registration Certificate,Organization -
		Certificate of Incorporation,Organization - Certificate of Registration of a
		School,Organization - Hong Kong Special Administrative Region Government
		Department,Organization - Ordinance of Hong Kong,Organization - Others Organization
		Document",
    "Description" => "",
    "Required" => true,
    "Ispapi-Name" => "X-HK-REGISTRANT-DOCUMENT-TYPE",
    "Ispapi-Options" => "HKID,OTHID,PASSNO,BIRTHCERT,OTHIDV,BR,CI,CRS,HKSARG,HKORDINANCE,OTHORG",
];
$additionaldomainfields[".hk"][] = [
    "Name" => "Registrant Document Number",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-HK-REGISTRANT-DOCUMENT-NUMBER",
];
$additionaldomainfields[".hk"][] = [
    "Name" => "Registrant Document Origin Country",
    "Type" => "text",
    "Required" => true,
    "Description" => "two-letter country code (ISO 3166-1 alpha-2)",
    "Ispapi-Name" => "X-HK-REGISTRANT-DOCUMENT-ORIGIN-COUNTRY",
];
$additionaldomainfields[".hk"][] = [
    "Name" => "Registrant Birth Date for individuals",
    "Type" => "text",
    "Required" => false,
    "Description" => "YYYY-MM-DD (mandatory, if the registrant is an individual)",
    "Ispapi-Name" => "X-HK-REGISTRANT-BIRTH-DATE",
];
$additionaldomainfields[".hk"][] = [
    "Name" => "HK Terms for individuals",
    "Type" => "tickbox",
    "Description" => "Accept the .HK <a href='https://www.hkirc.hk/content.jsp?id=3#!/6'
		target='_blank'>Terms for individuals</a>. (mandatory, if the registrant is an
		individual)",
    "Required" => false,
    "Options" => "on",
    "Ispapi-Name" => "X-HK-ACCEPT-INDIVIDUAL-REGISTRATION-TAC",
    "Ispapi-Replacements" => ["on" => "1"],
];

## .HOMES
$additionaldomainfields[".homes"] = [];
$additionaldomainfields[".homes"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is " .
        "true and accurate. Eligibility criteria may be viewed <a href='https://domains.homes/Policies/' target='_blank'>here</a>."
    ),
    "Ispapi-Name" => "X-HOMES-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .ID
$additionaldomainfields[".id"] = [];
$additionaldomainfields[".id"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is " .
        "true and accurate. Eligibility criteria may be viewed <a href='https://pandi.id/regulasi/' target='_blank'>here</a>."
    ),
    "Ispapi-Name" => "X-ID-ACCEPT-HIGHLY-REGULATED-TAC"
];


## .IE DOMAIN REQUIREMENTS ##
$additionaldomainfields[".ie"][] = [
    "Name" => "Registrant Class",
    "Type" => "dropdown",
    "Options" => ",Company,Business Owner,Club/Band/Local Group,School/College,State Agency,Charity,Blogger/Other",
    "Description" => "",
    "Required" => true,
    "Ispapi-Name" => "X-IE-REGISTRANT-CLASS",
    "Ispapi-Options" => ",Company,Business Owner,Club/Band/Local Group,School/College,State Agency,Charity,Blogger/Other",
];
$additionaldomainfields[".ie"][] = [
    "Name" => "Proof of connection to Ireland",
    "Type" => "text",
    "Description" => "Provide any information supporting your registration request, such as proof of eligibility (e.g. VAT, RBN, CRO, CHY, NIC, or Trademark number; school roll number; link to social media page) or a brief explanation of why you want this domain and what you will use it for.",
    "Required" => true,
    "Ispapi-Name" => "X-IE-REGISTRANT-REMARKS",
];

## .INSURANCE
$additionaldomainfields[".insurance"] = [];
$additionaldomainfields[".insurance"][] = [
    "Name" => "Registry's Allocation Token",
    "Type" => "text",
    "Required" => true,
    "Description" => (
        "To register a .INSURANCE domain, you must provide the allocation token issued by the registry. " .
        "Please complete the registrant application <a href='https://www.register.insurance/get-started/' target='_blank'>here</a> to obtain the token."
    ),
    "Ispapi-Name" => "X-ALLOCATIONTOKEN"
];

## .IT DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[".it"][] = ["Name" => "Legal Type", "Remove" => true];
$additionaldomainfields[".it"][] = ["Name" => "Tax ID", "Remove" => true];
$additionaldomainfields[".it"][] = ["Name" => "Publish Personal Data", "Remove" => true];
$additionaldomainfields[".it"][] = ["Name" => "Accept Section 3 of .IT registrar contract", "Remove" => true];
$additionaldomainfields[".it"][] = ["Name" => "Accept Section 5 of .IT registrar contract", "Remove" => true];
$additionaldomainfields[".it"][] = ["Name" => "Accept Section 6 of .IT registrar contract", "Remove" => true];
$additionaldomainfields[".it"][] = ["Name" => "Accept Section 7 of .IT registrar contract", "Remove" => true];

## add ispapi additional fields ##
## NOTE: Activate trustee service / local presence service just in case you have reflected the service costs
## in the TLD prices otherwise your customers do not pay for it. This is a missing Domain Add-On in WHMCS.
/*$additionaldomainfields[".it"][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",Registrant is domiciled in the EU (PIN required) / Use Local Presence Service",
    "Ispapi-Name" => "X-IT-ACCEPT-TRUSTEE-TAC",
    "Ispapi-Options" => ",1"
];*/
$additionaldomainfields[".it"][] = [
    "Name" => "PIN",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-IT-PIN",
];
$additionaldomainfields[".it"][] = [
    "Name" => "Section 3 Agreement",
    "Description" => "<div style='color:#666666;'><b>Section 3 - Declarations and assumptions of liability</b><br>The Registrant of the domain name in question, declares under their own responsibility that they are:
<ul><li>in possession of the citizenship or resident in a country belonging to the European Union (in the case of registration for natural persons);</li>
<li>established in a country belonging to the European Union (in the case of registration for other organizations);</li>
<li>aware and accept that the registration and management of a domain name is subject to the 'Rules of assignment and management of domain names in ccTLD. it' and 'Regulations for the resolution of disputes in the ccTLD.it' and their subsequent amendments;</li>
<li>entitled to the use and/or legal availability of the domain name applied for, and that they do not prejudice, with the request for registration, the rights of others;</li>
<li>aware that for the inclusion of personal data in the Database of assigned domain names, and their possible dissemination and accessibility via the Internet, consent must be given explicitly by ticking the appropriate boxes in the information below. See 'The policy of the .it Registry in the Whois Database' on the website of the Registry (http://www.nic.it);</li>
<li>aware and agree that in the case of erroneous or false declarations in this request, the Registry shall immediately revoke the domain name, or proceed with other legal actions. In such case the revocation shall not in any way give rise to claims against the Registry;</li>
<li>release the Registry from any liability resulting from the assignment and use of the domain name by the natural person that has made the request;</li>
<li>accept Italian jurisdiction and laws of the Italian State.</li></ul></div>",
    "Type" => "dropdown",
    "Options" => ",I accept the Section 3 Agreement listed below",
    "Ispapi-Name" => "X-IT-ACCEPT-LIABILITY-TAC",
    "Ispapi-Options" => ",1"
];
$additionaldomainfields[".it"][] = [
    "Name" => "Section 5 Agreement",
    "Description" => "<div style='color:#666666;'><b>Section 5 - Consent to the processing of personal data for registration</b><br>
The interested party, after reading the above disclosure, gives consent to the processing of information required for registration, as defined in the above disclosure. Giving consent is optional, but if no consent is given, it will not be possible to finalize the registration, assignment and management of the domain name.</div>",
    "Type" => "dropdown",
    "Options" => ",I accept the Section 5 Agreement listed below",
    "Ispapi-Name" => "X-IT-ACCEPT-REGISTRATION-TAC",
    "Ispapi-Options" => ",1"
];
$additionaldomainfields[".it"][] = [
    "Name" => "Section 6 Agreement",
    "Description" => "<div style='color:#666666;'><b>Section 6 - Consent to the processing of personal data for diffusion and accessibility via the Internet</b><br>
The interested party, after reading the above disclosure, gives consent to the dissemination and accessibility via the Internet, as defined in the disclosure above. Giving consent is optional, but absence of consent does not allow the dissemination and accessibility of Internet data.</div>",
    "Type" => "dropdown",
    "Options" => ",I accept the Section 6 Agreement listed below",
    "Ispapi-Name" => "X-IT-ACCEPT-DIFFUSION-AND-ACCESSIBILITY-TAC",
    "Ispapi-Options" => ",1"
];
$additionaldomainfields[".it"][] = [
    "Name" => "Section 7 Agreement",
    "Description" => "<div style='color:#666666;'><b>Section 7 - Explicit Acceptance of the following points</b><br>
For explicit acceptance, the interested party declares that they:
<ul><li>d) are aware and agree that the registration and management of a domain name is subject to the 'Rules of assignment and management of domain names in ccTLD.it' and 'Regulations for the resolution of disputes in the ccTLD.it' and their subsequent amendments;</li>
<li>e) are aware and agree that in the case of erroneous or false declarations in this request, the Registry shall immediately revoke the domain name, or proceed with other legal actions. In such case the revocation shall not in any way give rise to claims against the Registry;</li>
<li>f) release the Registry from any liability resulting from the assignment and use of the domain name by the natural person that has made the request;</li>
<li>g) accept the Italian jurisdiction and laws of the Italian State.</li></ul></div>",
    "Type" => "dropdown",
    "Options" => ",I accept the Section 7 Agreement listed below",
    "Ispapi-Name" => "X-IT-ACCEPT-EXPLICIT-TAC",
    "Ispapi-Options" => ",1"
];

## .JOBS DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields['.jobs'][] = ['Name' => 'Website', "Remove" => true];

## add ispapi additional fields ##
$additionaldomainfields[".jobs"][] = [
    "Name" => "Company URL",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-JOBS-COMPANYURL"
];
$additionaldomainfields[".jobs"][] = [
    "Name" => "Industry Classification",
    "Type" => "dropdown",
    "Options" => ",Accounting/Banking/Finance,Agriculture/Farming,Biotechnology/Science,Computer/Information Technology,Construction/Building Services,Consulting,Education/Training/Library,Entertainment,Environmental,Hospitality,Government/Civil Service,Healthcare,HR/Recruiting,Insurance,Legal,Manufacturing,Media/Advertising,Parks & Recreation,Pharmaceutical,Real Estate,Restaurant/Food Service,Retail,Telemarketing,Transportation,Other",
    "Required" => true,
    "Ispapi-Name" => "X-JOBS-INDUSTRYCLASSIFICATION",
    "Ispapi-Options" => ",2,3,21,5,4,12,6,7,13,19,10,11,15,16,17,18,20,9,26,22,14,23,8,24,25"
];
$additionaldomainfields[".jobs"][] = [
    "Name" => "Member of a Human Resources Association",
    "Type" => "dropdown",
    "Options" => "No,Yes",
    "Default" => "No",
    "Ispapi-Name" => "X-JOBS-HRANAME",
    "Ispapi-Options" => "no,yes"
];
$additionaldomainfields[".jobs"][] = [
    "Name" => "Contact Job Title (e.g. CEO)",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-JOBS-TITLE"
];
$additionaldomainfields[".jobs"][] = [
    "Name" => "Contact Type",
    "Type" => "dropdown",
    "Options" => "Administrative,Other",
    "Default" => "Administrative",
    "Ispapi-Name" => "X-JOBS-ADMINTYPE",
    "Ispapi-Options" => "1,0"
];

## .JP DOMAIN REQUIREMENTS ##
## NOTE: Activate trustee service / local presence service just in case you have reflected the service costs
## in the TLD prices otherwise your customers do not pay for it. This is a missing Domain Add-On in WHMCS.
/*$additionaldomainfields[".jp"] = [];
$additionaldomainfields[".jp"][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",Registrant and/or Admin-C are domiciled in Japan / Use Local Presence Service",
    "Ispapi-IgnoreForCountries" => "JP",
    "Ispapi-Name" => "X-JP-ACCEPT-TRUSTEE-TAC",
    "Ispapi-Options" => ",1"
];*/

## .LAW
$additionaldomainfields[".law"] = [];
$additionaldomainfields[".law"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is " .
        "true and accurate. Eligibility criteria may be viewed <a href='http://nic.law/eligibilitycriteria/' target='_blank'>here</a>."
    ),
    "Ispapi-Name" => "X-LAW-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .LAWYER
$additionaldomainfields[".lawyer"] = [];
$additionaldomainfields[".lawyer"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm the <b>Safeguards for Highly-regulated TLDs</b>:<br/>" .
        "<div style='text-align:justify'>You understand and agree that you will abide by and be compliant with these additional terms:" .
        "<ol><li>Administrative Contact Information. You agree to provide administrative contact information, which must be kept up-to-date, " .
        "for the notification of complaints or reports of registration abuse, as well as the contact details of the relevant regulatory, or " .
        "industry selfregulatory, bodies in their main place of business.</li>" .
        "<li>Representation. You confirm and represent that you possesses any necessary authorizations, charters, licenses and/or other related " .
        "credentials for participation in the sector associated with such Highly-Regulated TLD.</li>" .
        "<li>Report of Changes of Authorization, Charters, Licenses, Credentials. You agree to report any material changes to the validity of " .
        "your authorizations, charters, licenses and/or other related credentials for participation in the sector associated with the Highly-Regulated " .
        "TLD to ensure you continue to conform to the appropriate regulations and licensing requirements and generally conduct you activities in the " .
        "interests of the consumers you serve.</li></ol></div>"
    ),
    "Ispapi-Name" => "X-LAWYER-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .LOTTO
$additionaldomainfields[".lotto"] = [];
$additionaldomainfields[".lotto"][] = [
    "Name" => "Membership Contact ID",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-ASSOCIATION-ID"
];
$additionaldomainfields[".lotto"][] = [
    "Name" => "Verification Code",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-ASSOCIATION-AUTH"
];

## .LT
$additionaldomainfields[".lt"] = [];
$additionaldomainfields[".lt"][] = [
    "Name" => "Legal Entity Identification Code",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-LT-REGISTRANT-LEGAL-ID"
];

## .LV DOMAIN REQUIREMENTS ##
$additionaldomainfields[".lv"] = [];
$additionaldomainfields[".lv"][] = [
    "Name" => "Vat ID",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-VATID"
];
$additionaldomainfields[".lv"][] = [
    "Name" => "ID number",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-IDNUMBER"
];

## .MADRID
$additionaldomainfields[".madrid"] = [];
$additionaldomainfields[".madrid"][] = [
    "Name" => "Intended Use",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-CORE-INTENDED-USE"
];

## .MAKEUP
$additionaldomainfields[".makeup"] = [];
$additionaldomainfields[".makeup"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm the <b>Safeguards for Highly-regulated TLDs</b>:<br/>" .
        "<div style='text-align:justify'>You understand and agree that you will abide by and be compliant with these additional terms:" .
        "<ol><li>Administrative Contact Information. You agree to provide administrative contact information, which must be kept up-to-date, " .
        "for the notification of complaints or reports of registration abuse, as well as the contact details of the relevant regulatory, or " .
        "industry selfregulatory, bodies in their main place of business.</li>" .
        "<li>Representation. You confirm and represent that you possesses any necessary authorizations, charters, licenses and/or other related " .
        "credentials for participation in the sector associated with such Highly-Regulated TLD.</li>" .
        "<li>Report of Changes of Authorization, Charters, Licenses, Credentials. You agree to report any material changes to the validity of " .
        "your authorizations, charters, licenses and/or other related credentials for participation in the sector associated with the Highly-Regulated " .
        "TLD to ensure you continue to conform to the appropriate regulations and licensing requirements and generally conduct you activities in the " .
        "interests of the consumers you serve.</li></ol></div>"
    ),
    "Ispapi-Name" => "X-MAKEUP-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .MARKETS
$additionaldomainfields[".markets"] = [];
$additionaldomainfields[".markets"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is " .
        "true and accurate. Eligibility criteria may be viewed <a href='https://nic.markets/' target='_blank'>here</a>."
    ),
    "Ispapi-Name" => "X-MARKETS-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .MELBOURNE
$additionaldomainfields[".melbourne"] = [];
$additionaldomainfields[".melbourne"][] = [
    "Name" => "Nexus Category",
    "Type" => "dropdown",
    "Required" => true,
    "Options" =>  "A|Victorian Entities,B|Victorian Residents,C|Associated Entities",
    "Default" => "A",
    "Ispapi-Name" => "X-MELBOURNE-NEXUS-CATEGORY",
    "Description" => (
        "<div style='padding:10px 0px;text-align:justify'><b>Registration Eligibility</b><br/>In order to register or " .
        "renew a domain name the Applicant or Registrant must satisfy one of the following Criteria A, B or C below:<br/><br/>" .
        "<b>Criteria A – Victorian Entities</b><br/>The Applicant must be an entity registered with the `<a href='https://asic.gov.au/' target='_blank'>Australian Securities " .
        "and Investments Commission</a>` or the `<a href='https://register.business.gov.au/' target='_blank'>Australian Business Register</a>` that:<ul>" .
        "<li>has an address in the State of Victoria associated with its ABN, ACN, RBN or ARBN; or</li><li>has a valid corporate address in the State of Victoria.</li></ul><br/>" .
        "<b>Criteria B – Victorian Residents</b><br/>The Applicant must be an Australian citizen or resident with a valid address in the State of Victoria.<br/><br/>" .
        "<b>Criteria C – Associated Entities</b><br/>The Applicant must be an Associated Entity. The Applicant may only apply for a domain name that is an Exact Match " .
        "or Partial Match to, or an Abbreviation, or an Acronym of:" .
        "<ul><li>the business name of the Applicant, or name by which the Applicant is commonly known ( i.e. a nickname) and the business name must be registered with the " .
        "appropriate authority in the jurisdiction in which that business is domiciled; or</li>" .
        "<li>a product that the Associated Entity manufactures or sells to entities or individuals residing in the State of Victoria;</li>" .
        "<li>a service that the Associated Entity provides to residents of the State of Victoria;</li>" .
        "<li>an event that the Associated Entity organises or sponsors in the State of Victoria;</li>" .
        "<li>an activity that the Associated Entity facilitates in the State of Victoria; or</li>" .
        "<li>a course or training program that the Associated Entity provides to residents of the State of Victoria.</li></div>"
    )
];

## .NEW
$additionaldomainfields[".new"] = [];
$additionaldomainfields[".new"][] = [
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => (
        "You acknowledge that .NEW is a secured namespace, meaning that " .
        ".NEW domain names require an SSL certificate to work. Websites " .
        "using a .NEW domain name can only be accessed by web browsers " .
        "using HTTPS through an encrypted and secured connection."
    ),
    "Required" => true,
    "Ispapi-Name" => "X-ACCEPT-SSL-REQUIREMENT"
];


## .NGO
$additionaldomainfields[".ngo"] = [];
$additionaldomainfields[".ngo"][] = [
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => (
        "Tick to confirm that you agree to the <a href='https://thenew.org/org-people/about-pir/policies/policies-ngo-ong/' target='_blank'>Registry Terms and Conditions of Registration</a> upon new registration of .NGO domain names." .
        "<div style='padding:10px 0px;'>The registration of a .NGO domain name is bundled with an .ONG domain name without additional costs. " .
        "Changes on the .NGO Domain will be auto-applied to the .ONG Domain. You won't find the .ONG domain therefore listed in your domain inventory.</div>"
    ),
    "Required" => true,
    "Ispapi-Name" => "X-NGO-ACCEPT-REGISTRATION-TAC"
];

## .NO DOMAIN REQUIREMENTS ##
$additionaldomainfields[".no"] = [];
$additionaldomainfields[".no"][] = [
    "Name" => "Registrant ID number",
    "Type" => "text",
    "Default" => "",
    "Required" => true,
    "Ispapi-Name" => "X-NO-REGISTRANT-IDENTITY"
];
$additionaldomainfields[".no"][] = [
    "Name" => "Fax required",
    "Type" => "tickbox",
    "Description" => "I confirm I will send the following form back to complete the registration process: <a href='http://www.domainform.net/form/no/search?view=registration'>http://www.domainform.net/form/no/search?view=registration</a>",
    "Default" => "",
    "Required" => true,
];

## .NU DOMAIN REQUIREMENTS ##
$additionaldomainfields['.nu'][] = ['Name' => 'Identification Number', "Remove" => true];
$additionaldomainfields['.nu'][] = ['Name' => 'VAT Number', "Remove" => true];
$additionaldomainfields[".nu"][] = [
    "Name" => "Registrant ID Number",
    "Type" => "text",
    "Required" => true,
    "Description" => "<b>For individuals or companies located in Sweden</b> a valid Swedish
            personal or organizational number must be stated.
            <b>For individuals and companies outside of Sweden</b> the ID number (e.g. Civic
            registration number, company registration number, or the equivalent) must be stated.",
    "Ispapi-Name" => "X-REGISTRANT-IDNUMBER",
];
$additionaldomainfields[".nu"][] = [
    "Name" => "Registrant VAT ID",
    "Type" => "text",
    "Required" => false,
    "Description" => "(Only required for companies that are located inside the European
            Union but outside Sweden)",
    "Ispapi-Name" => "X-VATID",
];
$additionaldomainfields[".nu"][] = [
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => "Tick to confirm that you agree to the Registry Terms and Conditions of Registration (link below) upon new registration of .NU domain names.
    <br><a href='https://internetstiftelsen.se/app/uploads/2019/02/terms-and-conditions-nu.pdf' target=\"_blank\">Registry Terms and Conditions</a>",
    "Required" => true,
    "Ispapi-Name" => "X-NU-ACCEPT-REGISTRATION-TAC",
    "Ispapi-Eval" => 'if ( $value ) { $value = "1"; } else { $value = ""; }'
];

## .NYC DOMAIN REQUIREMENTS ##
$additionaldomainfields[".nyc"] = [];
$additionaldomainfields[".nyc"][] = [
    "Name" => "NEXUS Category",
    "Type" => "dropdown",
    "Options" => ",Natural Person - primary domicile with physical address in NYC,Entity or organization - primary domicile with physical address in NYC",
    "Description" => "<div>P.O Boxes are prohibited, see <a href='http://www.ownit.nyc/policies/index.php'>.nyc Nexus Policies</a>.</div>",
    "Required" => true,
    "Ispapi-Name" => "X-NYC-REGISTRANT-NEXUS-CATEGORY",
    "Ispapi-Options" => ",1,2",
];

## .PARIS
$additionaldomainfields[".paris"] = [];
$additionaldomainfields[".paris"] = [
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => "Tick to confirm that you agree to the <a href='http://bienvenue.paris/registry-policies-paris/' target='_blank'>Registry Terms and Conditions of Registration</a> upon new registration of .PARIS domain names.",
    "Required" => true,
    "Ispapi-Name" => "X-PARIS-ACCEPT-REGISTRATION-TAC"
];

## .PRO DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[".pro"][] = ["Name" => "Profession", "Remove" => true];
$additionaldomainfields[".pro"][] = ["Name" => "License Number", "Remove" => true];
$additionaldomainfields[".pro"][] = ["Name" => "Authority", "Remove" => true];
$additionaldomainfields[".pro"][] = ["Name" => "Authority Website", "Remove" => true];

## add ispapi additional fields ##
$additionaldomainfields[".pro"][] = [
    "Name" => "Profession",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-PRO-PROFESSION"
];
$additionaldomainfields[".pro"][] = [
    "Name" => "Authority",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-PRO-AUTHORITY"
];
$additionaldomainfields[".pro"][] = [
    "Name" => "Authority Website",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-PRO-AUTHORITYWEBSITE"
];
$additionaldomainfields[".pro"][] = [
    "Name" => "License Number",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-PRO-LICENSENUMBER"
];
$additionaldomainfields[".pro"][] = [
    "Name" => ".PRO Terms",
    "Type" => "tickbox",
    "Description" => "Tick to confirm that you agree to the .PRO End User Terms Of Use at: <a href='http://www.registry.pro/legal/user-terms'>http://www.registry.pro/legal/user-terms</a>",
    "Required" => true,
    "Ispapi-Name" => "X-PRO-ACCEPT-TOU",
    "Ispapi-Eval" => 'if ( $value ) { $value = "1"; } else { $value = ""; }'
];

## .PT DOMAIN REQUIREMENTS ##
$additionaldomainfields[".pt"] = [];
$additionaldomainfields[".pt"][] = [
    "Name" => "Registrant Vat ID",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-PT-REGISTRANT-VATID"
];
$additionaldomainfields[".pt"][] = [
    "Name" => "Tech vat ID",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-PT-TECH-VATID"
];

## .QUEBEC DOMAIN REQUIREMENTS ##
$additionaldomainfields[".quebec"][] = ["Name" => "Info", "Remove" => true];
$additionaldomainfields[".quebec"][] = [
    "Name" => "Intended Use",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-CORE-INTENDED-USE"
];

## .RO DOMAIN REQUIREMENTS
## remove default whmcs fields ##
$additionaldomainfields['.ro'][] = ['Name' => 'CNPFiscalCode', "Remove" => true];
$additionaldomainfields['.ro'][] = ['Name' => 'Registration Number', "Remove" => true];
$additionaldomainfields['.ro'][] = ['Name' => 'Registrant Type',"Remove" => true];

## add ispapi additional fields ##
$additionaldomainfields[".ro"][] = [
    "Name" => "Registrant ID Number",
    "Description" => "ONLY REQUIRED FOR ROMANIAN REGISTRANTS",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-REGISTRANT-IDNUMBER",
];
$additionaldomainfields[".ro"][] = [
    "Name" => "Registrant VAT ID",
    "Type" => "text",
    "Description" => "ONLY REQUIRED FOR EU COUNTRIES AND FOR INDIVIDUALS FROM ROMANIA",
    "Required" => false,
    "Ispapi-Name" => "X-REGISTRANT-VATID",
];

## .RUHR DOMAIN REQUIREMENTS ##
## NOTE: Activate trustee service / local presence service just in case you have reflected the service costs
## in the TLD prices otherwise your customers do not pay for it. This is a missing Domain Add-On in WHMCS.
/*$additionaldomainfields[".ruhr"] = [];
$additionaldomainfields[".ruhr"][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",Registrant and/or Admin-C are domiciled in Ruhr / Use Local Presence Service",
    "Ispapi-Name" => "X-RUHR-ACCEPT-TRUSTEE-TAC",
    "Ispapi-Options" => ",1"
];*/

## .SCOT DOMAIN REQUIREMENTS ##
$additionaldomainfields[".scot"] = [];
$additionaldomainfields[".scot"][] = [
    "Name" => "Intended Use",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-CORE-INTENDED-USE"
];

## .SE DOMAIN REQUIREMENTS ##
## remove default whmcs fields #
$additionaldomainfields['.se'][] = ['Name' => 'Identification Number', "Remove" => true];
$additionaldomainfields['.se'][] = ['Name' => 'VAT', "Remove" => true];

## add ispapi additional fields ##
$additionaldomainfields[".se"][] = [
    "Name" => "Registrant ID Number",
    "Type" => "text",
    "Required" => true,
    "Description" => "<b>For individuals or companies located in Sweden</b> a valid Swedish
		personal or organizational number must be stated.
		<b>For individuals and companies outside of Sweden</b> the ID number (e.g. Civic
		registration number, company registration number, or the equivalent) must be stated.",
    "Ispapi-Name" => "X-NICSE-IDNUMBER",
];
$additionaldomainfields[".se"][] = [
    "Name" => "Registrant VAT ID",
    "Type" => "text",
    "Required" => false,
    "Description" => "(Only required for companies that are located inside the European
		Union but outside Sweden)",
    "Ispapi-Name" => "X-NICSE-VATID",
];
$additionaldomainfields[".se"][] = [
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => "Tick to confirm that you agree to the Registry Terms and Conditions of Registration (link below) upon new registration of .SE domain names.
    <br><a href='https://internetstiftelsen.se/app/uploads/2019/02/registreringsvillkor-se-eng.pdf' target=\"_blank\">Registry Terms and Conditions</a>",
    "Required" => true,
    "Ispapi-Name" => "X-SE-ACCEPT-REGISTRATION-TAC",
    "Ispapi-Eval" => 'if ( $value ) { $value = "1"; } else { $value = ""; }'
];

## .SG DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[".sg"][] = ["Name" => "RCB Singapore ID", "Remove" => true];
$additionaldomainfields[".sg"][] = ["Name" => "Registrant Type",  "Remove" => true];

## add ispapi additional fields ##
## NOTE: Activate trustee service / local presence service just in case you have reflected the service costs
## in the TLD prices otherwise your customers do not pay for it. This is a missing Domain Add-On in WHMCS.
/*$additionaldomainfields[".sg"][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",Registrant and/or Admin-C are domiciled in Singapore / Use Local Presence Service",
    "Description" => "<div>If you are not domiciled in Singapore use the Local presence.<br>If you are domiciled in Singapore fill the dedicated fields below:</div>",
    "Default" => "",
    "Ispapi-IgnoreForCountries" => "SG",
    "Ispapi-Name" => "X-SG-ACCEPT-TRUSTEE-TAC",
    "Ispapi-Options" => ",1"
];*/
$additionaldomainfields[".sg"][] = [
    "Name" => "RCB/Singapore ID",
    "Type" => "text",
    "Default" => "",
    "Required" => false,
    "Ispapi-Name" => "X-SG-RCBID"
];
$additionaldomainfields[".sg"][] = [
    "Name" => "Admin ID number",
    "Type" => "text",
    "Default" => "",
    "Required" => false,
    "Ispapi-Name" => "X-ADMIN-IDNUMBER"
];
$additionaldomainfields[".com.sg"] = $additionaldomainfields[".sg"];
$additionaldomainfields[".edu.sg"] = $additionaldomainfields[".sg"];
$additionaldomainfields[".net.sg"] = $additionaldomainfields[".sg"];
$additionaldomainfields[".org.sg"] = $additionaldomainfields[".sg"];
$additionaldomainfields[".per.sg"] = $additionaldomainfields[".sg"];

## .SPORT
$additionaldomainfields[".sport"] = [];
$additionaldomainfields[".sport"][] = [
    "Name" => "Intended Use",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-CORE-INTENDED-USE"
];

## .SPREADBETTING
$additionaldomainfields[".spreadbetting"] = [];
$additionaldomainfields[".spreadbetting"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is " .
        "true and accurate. Eligibility criteria may be viewed <a href='https://nic.spreadbetting/' target='_blank'>here</a>."
    ),
    "Ispapi-Name" => "X-SPREADBETTING-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .SWISS DOMAIN REQUIREMENTS ##
$additionaldomainfields[".swiss"] = [];
$additionaldomainfields[".swiss"][] = [
    "Name" => "Enterprise ID",
    "Type" => "text",
    "Required" => true,
    "Description" => "(must be CHE followed by 9 digits)",
    "Ispapi-Name" => "X-SWISS-REGISTRANT-ENTERPRISE-ID",
];
$additionaldomainfields[".swiss"][] = [
    "Name" => "Intended use",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-CORE-INTENDED-USE",
];

## .SYDNEY
$additionaldomainfields[".sydney"] = [];
$additionaldomainfields[".sydney"][] = [
    "Name" => "Nexus Category",
    "Type" => "dropdown",
    "Required" => true,
    "Options" =>  "A|New South Wales Entities,B|New South Wales Residents,C|Associated Entities",
    "Default" => "A",
    "Ispapi-Name" => "X-SYDNEY-NEXUS-CATEGORY",
    "Description" => (
        "In order to register or renew a .SYDNEY domain name the Applicant or Registrant must satisfy one of the following Criteria A, B or C below:<br/><br/>" .
        "<b>Criteria A – New South Wales Entities</b><br/>" .
        "The Applicant must be an entity registered with the Australian Securities and Investments Commission or the Australian Business Register that:<br/>" .
        "has an address in the State of New South Wales associated with its ABN, ACN, RBN or ARBN; or has a valid corporate address in the State of New South Wales.<br/>" .
        "<b>Criteria B – New South Wales Residents</b><br/>" .
        "The Applicant must be an Australian citizen or resident with a valid address in the State of New South Wales.<br/>" .
        "<b>Criteria C – Associated Entities</b><br/>" .
        "The Applicant must be an Associated Entity. The Applicant may only apply for a domain name that is an Exact Match or Partial Match to, or an Abbreviation, or an Acronym of:<br/>" .
        "the business name of the Applicant, or name by which the Applicant is commonly known ( i.e. a nickname) and the business name must be registered with the appropriate authority in " .
        "the jurisdiction in which that business is domiciled; or a product that the Associated Entity manufactures or sells to entities or individuals residing in the State of New South Wales;" .
        "a service that the Associated Entity provides to residents of the State of New South Wales; an event that the Associated Entity organises or sponsors in the State of New South Wales;" .
        "an activity that the Associated Entity facilitates in the State of New South Wales; or a course or training program that the Associated Entity provides to residents of the State of New South Wales."
    )
];

## .TRADING
$additionaldomainfields[".trading"] = [];
$additionaldomainfields[".trading"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is " .
        "true and accurate. Eligibility criteria may be viewed <a href='https://nic.trading/' target='_blank'>here</a>."
    ),
    "Ispapi-Name" => "X-TRADING-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .TRAVEL DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields['.travel'][] = ['Name' => 'Trustee Service', "Remove" => true];
$additionaldomainfields['.travel'][] = ['Name' => '.TRAVEL UIN Code', "Remove" => true];
$additionaldomainfields['.travel'][] = ['Name' => 'Trustee Service Agreement ', "Remove" => true];
$additionaldomainfields['.travel'][] = ['Name' => '.TRAVEL Usage Agreement', "Remove" => true];
$additionaldomainfields[".travel"][] = [
    "Name" => ".travel Industry",
    "Type" => "text",
    "Default" => "1",
    "Required" => true,
    "Ispapi-Name" => "X-TRAVEL-INDUSTRY",
];

## .US DOMAIN REQUIREMENTS ##
$additionaldomainfields[".us"][] = [
    "Name" => "Application Purpose",
    "Type" => "dropdown",
    "Ispapi-Name" => "X-US-NEXUS-APPPURPOSE",
    "Ispapi-Options" => ",P1,P2,P3,P4,P5",
    "Options" => ",P1 - Business use for profit,P2 - Non-profit business; club; association; religious organization; etc.,P3 - Personal Use,P4 - Educational purposes,P5 - Government purposes",
    "Default" => "",
    "Required" => true
];
$additionaldomainfields[".us"][] = [
    "Name" => "Nexus Category",
    "Type" => "dropdown",
    "Ispapi-Name" => "X-US-NEXUS-CATEGORY",
    "Ispapi-Options" => "C11,C12,C21,C31,C32",
    "Options" => "C11,C12,C21,C31,C32",
    "Default" => "",
    "Required" => true
];
$additionaldomainfields[".us"][] = [
    "Name" => "Nexus Country",
    "Type" => "text",
    "Description" => "<div>Specify the two-letter country-code of the registrant (if Nexus Category is either C31 or C32).</div>",
    "Ispapi-Name" => "X-US-NEXUS-VALIDATOR",
    "Default" => "",
    "Required" => false,
    "Ispapi-Eval" => '$value = strtoupper($value);',
];

## .VOTE DOMAIN REQUIREMENTS
$additionaldomainfields[".vote"] = [];
$additionaldomainfields[".vote"] = [
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => "I confirm bona fide use of this domain name for a relevant election cycle with a clearly identified political/democratic process.",
    "Required" => true,
    "Ispapi-Name" => "X-VOTE-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .VOTO DOMAIN REQUIREMENTS
$additionaldomainfields[".voto"] = [];
$additionaldomainfields[".voto"] = [
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => "I confirm bona fide use of this domain name for a relevant election cycle with a clearly identified political/democratic process.",
    "Required" => true,
    "Ispapi-Name" => "X-VOTO-ACCEPT-HIGHLY-REGULATED-TAC"
];

## .ZA (.NET.ZA, .ORG.ZA)
$additionaldomainfields[".net.za"] = [];
$additionaldomainfields[".net.za"][] = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Description" => (
        "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is " .
        "true and accurate. Eligibility criteria may be viewed <a href='https://www.zadna.org.za/' target='_blank'>here</a>."
    ),
    "Ispapi-Name" => "X-ZA-ACCEPT-HIGHLY-REGULATED-TAC"
];
$additionaldomainfields[".org.za"] = $additionaldomainfields[".net.za"];
