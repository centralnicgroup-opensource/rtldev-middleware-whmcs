<?php

## ISPAPI CONFIG SECTION

$ispapi_use_de_trustee_service = 1;
$ispapi_use_it_trustee_service = 0;
$ispapi_use_eu_trustee_service = 0;
$ispapi_use_fr_trustee_service = 0;
$ispapi_use_nl_trustee_service = 0;
$ispapi_use_jp_trustee_service = 1;
$ispapi_use_sg_trustee_service = 1;
$ispapi_use_asia_trustee_service = 1;

## .DE DOMAIN REQUIREMENTS ##

$additionaldomainfields[".de"] = array();

if ( $ispapi_use_de_trustee_service ) {

	$additionaldomainfields[".de"][] = array(
	"Name" => "Local Presence",
	"Type" => "dropdown",
	"Options" => ",Registrant and/or Admin-C are domiciled in Germany / Use Local Presence Service",
	"Default" => "",
	"Required" => "true",

	"Ispapi-IgnoreForCountries" => "DE",
	"Ispapi-Name" => "X-DE-ACCEPT-TRUSTEE-TAC",
	"Ispapi-Options" => ",1"
	);
}
else {

	$additionaldomainfields[".de"][] = array(
	"Name" => "Local Presence",
	"Type" => "dropdown",
	"Options" => ",Registrant and/or Admin-C are domiciled in Germany",
	"Default" => "",
	"Required" => "true",
	);
}


## .EU DOMAIN REQUIREMENTS ##

$additionaldomainfields[".eu"] = array();

if ( $ispapi_use_eu_trustee_service ) {

	$additionaldomainfields[".eu"][] = array(
	"Name" => "Local Presence",
	"Type" => "dropdown",
	"Options" => ",Registrant is domiciled in the EU / Use Local Presence Service",
	"Default" => "",
	"Required" => "true",

	"Ispapi-IgnoreForCountries" => "AT,BE,BG,CZ,CY,DE,DK,ES,EE,FI,FR,GR,GB,HU,IE,IT,LT,LU,LV,MT,NL,PL,PT,RO,SE,SK,SI,AX,GF,GI,GP,MQ,RE",
	"Ispapi-Name" => "X-EU-ACCEPT-TRUSTEE-TAC",
	"Ispapi-Options" => ",1"
	);
}
else {

	$additionaldomainfields[".eu"][] = array(
	"Name" => "Local Presence",
	"Type" => "dropdown",
	"Options" => ",Registrant is domiciled in the EU",
	"Default" => "",
	"Required" => "true",
	);
}


## .IT DOMAIN REQUIREMENTS ##

$additionaldomainfields[".it"] = array();

if ( $ispapi_use_it_trustee_service ) {

	$additionaldomainfields[".it"][] = array(
	"Name" => "Local Presence",
	"Type" => "dropdown",
	"Options" => ",Registrant is domiciled in the EU (PIN required),Use Local Presence Service",
	"Default" => "",
	"Required" => "true",

	"Ispapi-Name" => "X-IT-ACCEPT-TRUSTEE-TAC",
	"Ispapi-Options" => ",,1"
	);

	$additionaldomainfields[".it"][] = array(
	"Name" => "PIN",
	"Type" => "text",
	"Size" => "30",
	"Default" => "",
	"Required" => false,

	"Ispapi-Name" => "X-IT-PIN",
	);
}
else {

	$additionaldomainfields[".it"][] = array(
	"Name" => "Local Presence",
	"Type" => "dropdown",
	"Options" => ",Registrant is domiciled in the EU (PIN required)",
	"Default" => "",
	"Required" => "true",
	);

	$additionaldomainfields[".it"][] = array(
	"Name" => "PIN",
	"Type" => "text",
	"Size" => "30",
	"Default" => "",
	"Required" => true,

	"Ispapi-Name" => "X-IT-PIN",
	);
}

$additionaldomainfields[".it"][] = array(
"Name" => "Section 3 - Declarations and assumptions of liability",
"Type" => "dropdown",
"Options" => ",Accepted",
"Default" => "",
"Required" => "true",

"Ispapi-Name" => "X-IT-ACCEPT-LIABILITY-TAC",
"Ispapi-Options" => ",1"
);

$additionaldomainfields[".it"][] = array(
"Name" => "Section 5 - Consent to the processing of personal data for registration",
"Type" => "dropdown",
"Options" => ",Accepted",
"Default" => "",
"Required" => "true",

"Ispapi-Name" => "X-IT-ACCEPT-REGISTRATION-TAC",
"Ispapi-Options" => ",1"
);

$additionaldomainfields[".it"][] = array(
"Name" => "Section 6 - Consent to the processing of personal data for diffusion and accessibility via the internet",
"Type" => "dropdown",
"Options" => ",Accepted",
"Default" => "",
"Required" => "true",

"Ispapi-Name" => "X-IT-ACCEPT-DIFFUSION-AND-ACCESSIBILITY-TAC",
"Ispapi-Options" => ",1"
);

$additionaldomainfields[".it"][] = array(
"Name" => "Section 7 - Explicit acceptance of the following points",
"Type" => "dropdown",
"Options" => ",Accepted",
"Default" => "",
"Required" => "true",

"Ispapi-Name" => "X-IT-ACCEPT-EXPLICIT-TAC",
"Ispapi-Options" => ",1"
);


$additionaldomainfields[".it"][] = array(
"Name" => "Registrant is Admin-C",
"Type" => "dropdown",
"Options" => "Accepted",
"Default" => "Accepted",
"Required" => "true",
"Ispapi-Eval" => 'unset($command["ADMINCONTACT0"]); $command["ADMINCONTACT0COPY"] = "OWNERCONTACT0";'
);


## .ASIA DOMAIN REQUIREMENTS ##

$additionaldomainfields[".asia"] = array();

if ( $ispapi_use_asia_trustee_service ) {

	$additionaldomainfields[".asia"][] = array(
	"Name" => "Local Presence",
	"Type" => "dropdown",
	"Options" => ",Use Trustee Service for .asia CED Contact",
	"Default" => "",
	"Required" => "true",

	"Ispapi-Name" => "X-ASIA-CED-ACCEPT-TRUSTEE-TAC",
	"Ispapi-Options" => ",1"
	);
}



## .NL DOMAIN REQUIREMENTS ##

$additionaldomainfields[".nl"] = array();

if ( 0 ) {
}
elseif ( $ispapi_use_nl_trustee_service ) {

	$additionaldomainfields[".nl"][] = array(
	"Name" => "Local Presence Service",
	"Type" => "dropdown",
	"Options" => ",Registrant is domiciled in the Netherlands / Use Local Presence Service",
	"Default" => "",
	"Required" => "true",

	"Ispapi-Name" => "X-NL-ACCEPT-TRUSTEE-TAC",
	"Ispapi-Options" => ",1",
	"Ispapi-IgnoreForCountries" => "NL"
	);
}
else {

	$additionaldomainfields[".nl"][] = array(
	"Name" => "Local Presence",
	"Type" => "dropdown",
	"Options" => ",Registrant is domiciled in the Netherlands",
	"Default" => "",
	"Required" => "true",
	);
}


## .US DOMAIN REQUIREMENTS ##

$additionaldomainfields[".us"] = array();

$additionaldomainfields[".us"][] = array(
"Name" => "Nexus Category",
"Type" => "dropdown",
"Options" => "C11,C12,C21,C31,C32",
"Default" => "C11",

"Ispapi-Name" => "X-US-NEXUS-CATEGORY"
);

$additionaldomainfields[".us"][] = array(
"Name" => "Nexus Country",
"Type" => "text",
"Size" => "2",
"Default" => "",
"Required" => true,

"Ispapi-Name" => "X-US-NEXUS-VALIDATOR"
);

$additionaldomainfields[".us"][] = array(
"Name" => "Application Purpose",
"Type" => "dropdown",
"Options" => "Business use for profit,Non-profit business,Club,Association,Religious Organization,Personal Use,Educational purposes,Government purposes",
"Default" => "Business use for profit",

"Ispapi-Name" => "X-US-NEXUS-APPPURPOSE",
"Ispapi-Options" => "P1,P2,P2,P2,P2,P3,P4,P5",
);



## .SG DOMAIN REQUIREMENTS ##

$additionaldomainfields[".sg"] = array();

if ( $ispapi_use_sg_trustee_service ) {

	$additionaldomainfields[".sg"][] = array(
	"Name" => "Local Presence",
	"Type" => "dropdown",
	"Options" => ",Registrant and/or Admin-C are domiciled in Singapore / Use Local Presence Service",
	"Default" => "",
	"Required" => "true",

	"Ispapi-IgnoreForCountries" => "SG",
	"Ispapi-Name" => "X-SG-ACCEPT-TRUSTEE-TAC",
	"Ispapi-Options" => ",1"
	);
}
else {

	$additionaldomainfields[".sg"][] = array(
	"Name" => "Local Presence",
	"Type" => "dropdown",
	"Options" => ",Registrant and/or Admin-C are domiciled in Singapore",
	"Default" => "",
	"Required" => "true",
	);
}

$additionaldomainfields[".sg"][] = array(
"Name" => "RCB/Singapore ID",
"Type" => "text",
"Size" => "30",
"Default" => "",
"Required" => false,

"Ispapi-Name" => "X-SG-RCBID"
);

$additionaldomainfields[".sg"][] = array(
"Name" => "Registrant Type",
"Type" => "dropdown",
"Options" => "Individual,Organisation",
"Default" => "Individual",

"Ispapi-Eval" => 'if ( $value == "Individual" ) { unset($command["OWNERCONTACT0"]["ORGANIZATION"]); }'
);

$additionaldomainfields[".com.sg"] = $additionaldomainfields[".sg"];
$additionaldomainfields[".edu.sg"] = $additionaldomainfields[".sg"];
$additionaldomainfields[".net.sg"] = $additionaldomainfields[".sg"];
$additionaldomainfields[".org.sg"] = $additionaldomainfields[".sg"];
$additionaldomainfields[".per.sg"] = $additionaldomainfields[".sg"];



## .JP DOMAIN REQUIREMENTS ##

$additionaldomainfields[".jp"] = array();

if ( $ispapi_use_jp_trustee_service ) {

	$additionaldomainfields[".jp"][] = array(
	"Name" => "Local Presence",
	"Type" => "dropdown",
	"Options" => ",Registrant and/or Admin-C are domiciled in Japan / Use Local Presence Service",
	"Default" => "",
	"Required" => "true",

	"Ispapi-IgnoreForCountries" => "JP",
	"Ispapi-Name" => "X-JP-ACCEPT-TRUSTEE-TAC",
	"Ispapi-Options" => ",1"
	);
}
else {

	$additionaldomainfields[".jp"][] = array(
	"Name" => "Local Presence",
	"Type" => "dropdown",
	"Options" => ",Registrant and/or Admin-C are domiciled in Japan",
	"Default" => "",
	"Required" => "true",
	);
}



## .AERO DOMAIN REQUIREMENTS ##
# http://www.information.aero/registration/manage_your_aero_id/apply

$additionaldomainfields[".aero"] = array();

$additionaldomainfields[".aero"][] = array(
"Name" => ".aero ID",
"Type" => "text",
"Size" => "16",
"Default" => "",
"Required" => true,

"Ispapi-Name" => "X-AERO-ENS-AUTH-ID",
);

$additionaldomainfields[".aero"][] = array(
"Name" => "Password",
"Type" => "text",
"Size" => "16",
"Default" => "",
"Required" => true,

"Ispapi-Name" => "X-AERO-ENS-AUTH-KEY",
);



## .TRAVEL DOMAIN REQUIREMENTS ##
# http://www.travel.travel/index.php/authenticate-register/

$additionaldomainfields[".travel"] = array();

$additionaldomainfields[".travel"][] = array(
"Name" => ".travel UIN",
"Type" => "text",
"Size" => "16",
"Default" => "",
"Required" => true,

"Ispapi-Name" => "X-TRAVEL-UIN",
);


## .DK DOMAIN REQUIREMENTS ##

$additionaldomainfields[".dk"] = array();

$additionaldomainfields[".dk"][] = array(
"Name" => "Registrant VAT ID",
"Type" => "text",
"Size" => "16",
"Default" => "",
"Required" => true,

"Ispapi-Name" => "X-DK-VATID",
"Ispapi-Eval" => 'unset($command["ADMINCONTACT0"]); $command["ADMINCONTACT0COPY"] = "OWNERCONTACT0";'
);


## .DK DOMAIN REQUIREMENTS ##

$additionaldomainfields[".dk"] = array();

$additionaldomainfields[".dk"][] = array(
"Name" => "Registrant VAT ID",
"Type" => "text",
"Size" => "16",
"Default" => "",
"Required" => false,

"Ispapi-Name" => "X-DK-VATID",
"Ispapi-Eval" => 'unset($command["ADMINCONTACT0"]); $command["ADMINCONTACT0COPY"] = "OWNERCONTACT0";
    if ( !strlen($value) ) { $value = $params["customfields1"]; };
'
);



## .SE DOMAIN REQUIREMENTS ##

$additionaldomainfields[".se"] = array();

$additionaldomainfields[".se"][] = array(
"Name" => "Registrant ID Number",
"Type" => "text",
"Size" => "16",
"Default" => "",
"Required" => true,

"Ispapi-Name" => "X-NICSE-IDNUMBER",
);

$additionaldomainfields[".se"][] = array(
"Name" => "Registrant VAT ID",
"Type" => "text",
"Size" => "16",
"Default" => "",
"Required" => false,

"Ispapi-Name" => "X-NICSE-VATID",
);



## CA DOMAIN REQUIREMENTS ##

$additionaldomainfields[".ca"] = array();

$additionaldomainfields[".ca"][] = array(
	"Name" => "Legal Type",
	"LangVar" => "catldlegaltype",
	"Type" => "dropdown",
	"Options" => "Corporation,Canadian Citizen,Permanent Resident of Canada,Government,Canadian Educational Institution,Canadian Unincorporated Association,Canadian Hospital,Partnership Registered in Canada,Trade-mark registered in Canada,Canadian Trade Union,Canadian Political Party,Canadian Library Archive or Museum,Trust established in Canada,Aboriginal Peoples,Legal Representative of a Canadian Citizen,Official mark registered in Canada",
	"Default" => "Corporation",
	"Description" => "Legal type of registrant contact",

	"Ispapi-Name" => "X-CA-LEGALTYPE",
	"Ispapi-Options" => "CCO,CCT,RES,GOV,EDU,ASS,HOP,PRT,TDM,TRD,PLT,LAM,TRS,ABO,LGR,OMK"
);


$additionaldomainfields[".ca"][] = array(
	"Name" => "CIRA Agreement",
	"LangVar" => "catldciraagreement",
	"Type" => "tickbox",
	"Description" => "Tick to confirm you agree to the CIRA Registration Agreement shown below<br /><blockquote>You have read, understood and agree to the terms and conditions of the Registrant Agreement, and that CIRA may, from time to time and at its discretion, amend any or all of the terms and conditions of the Registrant Agreement, as CIRA deems appropriate, by posting a notice of the changes on the CIRA website and by sending a notice of any material changes to Registrant. You meet all the requirements of the Registrant Agreement to be a Registrant, to apply for the registration of a Domain Name Registration, and to hold and maintain a Domain Name Registration, including without limitation CIRA's Canadian Presence Requirements for Registrants, at: www.cira.ca/assets/Documents/Legal/Registrants/CPR.pdf. CIRA will collect, use and disclose your personal information, as set out in CIRA's Privacy Policy, at: www.cira.ca/assets/Documents/Legal/Registrants/privacy.pdf</blockquote>",

	"Required" => "true",

	"Ispapi-Name" => "X-CA-ACCEPT-AGREEMENT-VERSION",
	"Ispapi-Eval" => 'if ( $value ) { $value = "2.0"; } else { $value = ""; }'
);


$additionaldomainfields[".ca"][] = array(
	"Name" => "WHOIS Opt-out",
	"LangVar" => "catldwhoisoptout",
	"Type" => "tickbox",
	"Description" => "Tick to hide your contact information in CIRA WHOIS (only available to individuals)",

	"Ispapi-Name" => "OWNERCONTACT0X-CA-DISCLOSE",
	"Ispapi-Eval" => 'if ( $value ) { $value = "0"; } else { $value = "1"; }'
);


$additionaldomainfields[".ca"][] = array(
"Name" => "Trademark Number",
"Type" => "text",
"Size" => "50",
"Default" => "",
"Required" => false,

"Ispapi-Name" => "X-CA-DOMAIN-TRADEMARK",
"Ispapi-Eval" => 'if ( $value ) { $value = "Y"; } else { $value = "N"; }'
);

$additionaldomainfields[".ca"][] = array(
"Name" => "Contact Language",
"Type" => "dropdown",
"Options" => "English,French",
"Default" => "English",

"Ispapi-Name" => "X-CA-LANGUAGE",
"Ispapi-Options" => "EN,FR"
);





## .FR DOMAIN REQUIREMENTS ##

$additionaldomainfields[".fr"] = array();

if ( $ispapi_use_fr_trustee_service ) {

	$additionaldomainfields[".fr"][] = array(
	"Name" => "Local Presence",
	"Type" => "dropdown",
	"Options" => ",Registrant and/or Admin-C are domiciled in France / Use Local Presence Service",
	"Default" => "",
	"Required" => "true",

	"Ispapi-IgnoreForCountries" => "FR",
	"Ispapi-Name" => "X-FR-ACCEPT-TRUSTEE-TAC",
	"Ispapi-Options" => ",1"
	);
}
else {

	$additionaldomainfields[".fr"][] = array(
	"Name" => "Local Presence",
	"Type" => "dropdown",
	"Options" => ",Registrant and/or Admin-C are domiciled in France",
	"Default" => "",
	"Required" => "true",
	);
}



## .JOBS DOMAIN REQUIREMENTS ##

$additionaldomainfields[".jobs"] = array();

$additionaldomainfields[".jobs"][] = array(
"Name" => "Company URL",
"Type" => "text",
"Size" => "30",
"Default" => "",
"Required" => true,
"Ispapi-Name" => "X-JOBS-COMPANYURL"
);

$additionaldomainfields[".jobs"][] = array(
"Name" => "Industry Classification",
"Type" => "dropdown",
"Options" => ",Accounting/Banking/Finance,Agriculture/Farming,Biotechnology/Science,Computer/Information Technology,Construction/Building Services,Consulting,Education/Training/Library,Entertainment,Environmental,Hospitality,Government/Civil Service,Healthcare,HR/Recruiting,Insurance,Legal,Manufacturing,Media/Advertising,Parks & Recreation,Pharmaceutical,Real Estate,Restaurant/Food Service,Retail,Telemarketing,Transportation,Other",
"Default" => "",
"Required" => true,
"Ispapi-Name" => "X-JOBS-INDUSTRYCLASSIFICATION",
"Ispapi-Options" => ",2,3,21,5,4,12,6,7,13,19,10,11,15,16,17,18,20,9,26,22,14,23,8,24,25"
);

$additionaldomainfields[".jobs"][] = array(
"Name" => "Member of a Human Resources Association",
"Type" => "dropdown",
"Options" => "No,Yes",
"Default" => "No",
"Ispapi-Name" => "X-JOBS-HRANAME",
"Ispapi-Options" => "no,yes"
);

$additionaldomainfields[".jobs"][] = array(
"Name" => "Contact Job Title (e.g. CEO)",
"Type" => "text",
"Size" => "30",
"Default" => "",
"Required" => true,
"Ispapi-Name" => "X-JOBS-TITLE"
);

$additionaldomainfields[".jobs"][] = array(
"Name" => "Contact Type",
"Type" => "dropdown",
"Options" => "Administrative,Other",
"Default" => "Administrative",
"Ispapi-Name" => "X-JOBS-ADMINTYPE",
"Ispapi-Options" => "1,0"
);



## .PRO DOMAIN REQUIREMENTS ##

$additionaldomainfields[".pro"] = array();

$additionaldomainfields[".pro"][] = array(
"Name" => "Profession",
"Type" => "text",
"Size" => "30",
"Default" => "",
"Required" => true,
"Ispapi-Name" => "X-PRO-PROFESSION"
);

$additionaldomainfields[".pro"][] = array(
"Name" => "Authority",
"Type" => "text",
"Size" => "30",
"Default" => "",
"Required" => false,
"Ispapi-Name" => "X-PRO-AUTHORITY"
);

$additionaldomainfields[".pro"][] = array(
"Name" => "Authority Website",
"Type" => "text",
"Size" => "30",
"Default" => "",
"Required" => false,
"Ispapi-Name" => "X-PRO-AUTHORITYWEBSITE"
);

$additionaldomainfields[".pro"][] = array(
"Name" => "License Number",
"Type" => "text",
"Size" => "30",
"Default" => "",
"Required" => false,
"Ispapi-Name" => "X-PRO-LICENSENUMBER"
);

$additionaldomainfields[".pro"][] = array(
"Name" => ".PRO Terms",
"Type" => "tickbox",
"Description" => "Tick to confirm that you agree to the .PRO End User Terms Of Use at: <a href='http://www.registry.pro/legal/user-terms'>http://www.registry.pro/legal/user-terms</a>",
"Required" => "true",
"Ispapi-Name" => "X-PRO-ACCEPT-TOU",
"Ispapi-Eval" => 'if ( $value ) { $value = "1"; } else { $value = ""; }'
);

?>
