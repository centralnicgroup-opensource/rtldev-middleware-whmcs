<?php
##
## THIS IS A SAMPLE FILE WITH PRECONFIGURED EXTENSIONS RUNNING WITH OUR SYSTEM
## THIS FILE WILL ASSIST YOU CONFIGURING YOUR WHMCS ADDITIONAL DOMAIN FIELDS
## DO NOT INCLUDE THIS FILE DIRECTLY
## 

## .BERLIN DOMAIN REQUIREMENTS ##
$additionaldomainfields[".berlin"] = array();
$additionaldomainfields[".berlin"][] = array(
		"Name" => "Local Presence",
		"Type" => "dropdown",
		"Options" => ",Registrant and/or Admin-C are domiciled in Berlin / Use Local Presence Service",
		"Ispapi-Name" => "X-BERLIN-ACCEPT-TRUSTEE-TAC",
		"Ispapi-Options" => ",1"
);


## .RUHR DOMAIN REQUIREMENTS ##
$additionaldomainfields[".ruhr"] = array();
$additionaldomainfields[".ruhr"][] = array(
		"Name" => "Local Presence",
		"Type" => "dropdown",
		"Options" => ",Registrant and/or Admin-C are domiciled in Ruhr / Use Local Presence Service",
		"Ispapi-Name" => "X-RUHR-ACCEPT-TRUSTEE-TAC",
		"Ispapi-Options" => ",1"
);


## .HAMBURG DOMAIN REQUIREMENTS ##
$additionaldomainfields[".hamburg"] = array();
$additionaldomainfields[".hamburg"][] = array(
		"Name" => "Local Presence",
		"Type" => "dropdown",
		"Options" => ",Registrant and/or Admin-C are domiciled in Hamburg / Use Local Presence Service",
		"Ispapi-Name" => "X-HAMBURG-ACCEPT-TRUSTEE-TAC",
		"Ispapi-Options" => ",1"
);


## .BAYERN DOMAIN REQUIREMENTS ##
$additionaldomainfields[".bayern"] = array();
$additionaldomainfields[".bayern"][] = array(
		"Name" => "Local Presence",
		"Type" => "dropdown",
		"Options" => ",Registrant and/or Admin-C are domiciled in Bayern / Use Local Presence Service",
		"Ispapi-Name" => "X-BAYERN-ACCEPT-TRUSTEE-TAC",
		"Ispapi-Options" => ",1"
);

## .JP DOMAIN REQUIREMENTS ##
$additionaldomainfields[".jp"] = array();
$additionaldomainfields[".jp"][] = array(
		"Name" => "Local Presence",
		"Type" => "dropdown",
		"Options" => ",Registrant and/or Admin-C are domiciled in Japan / Use Local Presence Service",
		"Ispapi-IgnoreForCountries" => "JP",
		"Ispapi-Name" => "X-JP-ACCEPT-TRUSTEE-TAC",
		"Ispapi-Options" => ",1"
);


## .DE DOMAIN REQUIREMENTS ##
$additionaldomainfields[".de"] = array();
$additionaldomainfields[".de"][] = array(
		"Name" => "Local Presence",
		"Type" => "dropdown",
		"Options" => ",Registrant and/or Admin-C are domiciled in Germany / Use Local Presence Service",
		"Ispapi-IgnoreForCountries" => "DE",
		"Ispapi-Name" => "X-DE-ACCEPT-TRUSTEE-TAC",
		"Ispapi-Options" => ",1"
);


## .EU DOMAIN REQUIREMENTS ##
$additionaldomainfields[".eu"] = array();
$additionaldomainfields[".eu"][] = array(
		"Name" => "Local Presence",
		"Type" => "dropdown",
		"Options" => ",Registrant is domiciled in the EU / Use Local Presence Service",
		"Ispapi-IgnoreForCountries" => "AT,BE,BG,CZ,CY,DE,DK,ES,EE,FI,FR,GR,GB,HU,IE,IT,LT,LU,LV,MT,NL,PL,PT,RO,SE,SK,SI,AX,GF,GI,GP,MQ,RE",
		"Ispapi-Name" => "X-EU-ACCEPT-TRUSTEE-TAC",
		"Ispapi-Options" => ",1"
);


## .SG DOMAIN REQUIREMENTS ##
$additionaldomainfields[".sg"] = array();
$additionaldomainfields[".sg"][] = array(
		"Name" => "Local Presence",
		"Type" => "dropdown",
		"Options" => ",Registrant and/or Admin-C are domiciled in Singapore / Use Local Presence Service",
		"Description" => "<div>If you are not domiciled in Singapore use the Local presence.<br>If you are domiciled in Singapore fill the dedicated fields below:</div>",
		"Default" => "",
		"Ispapi-IgnoreForCountries" => "SG",
		"Ispapi-Name" => "X-SG-ACCEPT-TRUSTEE-TAC",
		"Ispapi-Options" => ",1"
);
$additionaldomainfields[".sg"][] = array(
		"Name" => "RCB/Singapore ID",
		"Type" => "text",
		"Default" => "",
		"Required" => false,
		"Ispapi-Name" => "X-SG-RCBID"
);
$additionaldomainfields[".sg"][] = array(
		"Name" => "Admin ID number",
		"Type" => "text",
		"Default" => "",
		"Required" => false,
		"Ispapi-Name" => "X-ADMIN-IDNUMBER"
);
$additionaldomainfields[".com.sg"] = $additionaldomainfields[".sg"];
$additionaldomainfields[".edu.sg"] = $additionaldomainfields[".sg"];
$additionaldomainfields[".net.sg"] = $additionaldomainfields[".sg"];
$additionaldomainfields[".org.sg"] = $additionaldomainfields[".sg"];
$additionaldomainfields[".per.sg"] = $additionaldomainfields[".sg"];


## .CA DOMAIN REQUIREMENTS ##
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
		"Required" => true,
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


## .SE DOMAIN REQUIREMENTS ##
$additionaldomainfields[".se"] = array();
$additionaldomainfields[".se"][] = array(
		"Name" => "Registrant ID Number",
		"Type" => "text",
		"Required" => true,
		"Ispapi-Name" => "X-NICSE-IDNUMBER",
);
$additionaldomainfields[".se"][] = array(
		"Name" => "Registrant VAT ID",
		"Type" => "text",
		"Required" => false,
		"Ispapi-Name" => "X-NICSE-VATID",
);


## .AERO DOMAIN REQUIREMENTS ##
$additionaldomainfields[".aero"] = array();
$additionaldomainfields[".aero"][] = array(
		"Name" => ".aero ID",
		"Type" => "text",
		"Required" => true,
		"Ispapi-Name" => "X-AERO-ENS-AUTH-ID",
);

$additionaldomainfields[".aero"][] = array(
		"Name" => "Password",
		"Type" => "text",
		"Required" => true,
		"Ispapi-Name" => "X-AERO-ENS-AUTH-KEY",
);


## .TRAVEL DOMAIN REQUIREMENTS ##
$additionaldomainfields[".travel"] = array();
$additionaldomainfields[".travel"][] = array(
		"Name" => ".travel UIN",
		"Type" => "text",
		"Required" => true,
		"Ispapi-Name" => "X-TRAVEL-UIN",
);


## .US DOMAIN REQUIREMENTS ##
$additionaldomainfields[".us"] = array();
$additionaldomainfields[".us"][] = array(
		"Name" => "Application Purpose",
		"Type" => "dropdown",
		"Ispapi-Name" => "X-US-NEXUS-APPPURPOSE",
		"Ispapi-Options" => ",P1,P2,P3,P4,P5",
		"Options" => ",P1 - Business use for profit,P2 - Non-profit business; club; association; religious organization; etc.,P3 - Personal Use,P4 - Educational purposes,P5 - Government purposes",
		"Default" => "",
		"Required" => true
);

$additionaldomainfields[".us"][] = array(
		"Name" => "Nexus Category",
		"Type" => "dropdown",
		"Ispapi-Name" => "X-US-NEXUS-CATEGORY",
		"Ispapi-Options" => "C11,C12,C21,C31,C32",
		"Options" => "C11,C12,C21,C31,C32",
		"Default" => "",
		"Required" => true
);

$additionaldomainfields[".us"][] = array(
		"Name" => "Nexus Country",
		"Type" => "text",
		"Description" => "<div>Specify the two-letter country-code of the registrant (if Nexus Category is either C31 or C32).</div>",
		"Ispapi-Name" => "X-US-NEXUS-VALIDATOR",
		"Default" => "",
		"Required" => false,
		"Ispapi-Eval" => '$value = strtoupper($value);',
);


## .FR DOMAIN REQUIREMENTS ##
$additionaldomainfields[".fr"] = array();
$additionaldomainfields[".fr"][] = array(
		"Name" => "Local Presence",
		"Type" => "dropdown",
		"Options" => ",Registrant and/or Admin-C are domiciled in France / Use Local Presence Service",
		"Description" => "<div>If you are not domiciled in France use the Local presence.<br>If you are domiciled in France fill the dedicated fields below:</div>",
		"Ispapi-IgnoreForCountries" => "FR",
		"Ispapi-Name" => "X-FR-ACCEPT-TRUSTEE-TAC",
		"Ispapi-Options" => ",1"
);
$additionaldomainfields[".fr"][] = array(
		"Name" => "Date of Birth",
		"Type" => "text",
		"Ispapi-Name" => "X-FR-REGISTRANT-BIRTH-DATE",
		"Description" => "(Only for individuals)",
);
$additionaldomainfields[".fr"][] = array(
		"Name" => "Place of Birth",
		"Type" => "text",
		"Ispapi-Name" => "X-FR-REGISTRANT-BIRTH-PLACE",
		"Description" => "(Only for individuals)",
);
$additionaldomainfields[".fr"][] = array(
		"Name" => "VATID or SIREN/SIRET number",
		"Type" => "text",
		"Ispapi-Name" => "X-FR-REGISTRANT-LEGAL-ID",
		"Description" => "(Only for companies with VATID or SIREN/SIRET number)",
);

$additionaldomainfields[".fr"][] = array(
		"Name" => "Trademark Number",
		"Type" => "text",
		"Ispapi-Name" => "X-FR-REGISTRANT-TRADEMARK-NUMBER",
		"Description" => "(Only for companies with a European trademark)",
);

$additionaldomainfields[".fr"][] = array(
		"Name" => "DUNS number",
		"Type" => "text",
		"Ispapi-Name" => "X-FR-REGISTRANT-DUNS-NUMBER",
		"Description" => "(Only for companies with DUNS number)",
);

$additionaldomainfields[".fr"][] = array(
		"Name" => "Local ID",
		"Type" => "text",
		"Ispapi-Name" => "X-FR-REGISTRANT-LOCAL-ID",
		"Description" => "(Only for companies with local identifier)",
);
$additionaldomainfields[".fr"][] = array(
		"Name" => "Date of Declaration",
		"Type" => "text",
		"Ispapi-Name" => "X-FR-REGISTRANT-JO-DATE-DECLARATION",
		"Description" => "(Only for french association) <div>The date of declaration of the association in the form <b>YYYY-MM-DD</b></div>",
);
$additionaldomainfields[".fr"][] = array(
		"Name" => "Number [JO]",
		"Type" => "text",
		"Ispapi-Name" => "X-FR-REGISTRANT-JO-NUMBER",
		"Description" => "(Only for french association) <div>The number of the Journal Officiel</div>",
);
$additionaldomainfields[".fr"][] = array(
		"Name" => "Page of Announcement [JO]",
		"Type" => "text",
		"Ispapi-Name" => "X-FR-REGISTRANT-JO-PAGE",
		"Description" => "(Only for french association) <div>The page of the announcement in the Journal Officiel</div>",
);
$additionaldomainfields[".fr"][] = array(
		"Name" => "Date of Publication [JO]",
		"Type" => "text",
		"Ispapi-Name" => "X-FR-REGISTRANT-JO-DATE-PUBLICATION",
		"Description" => "(Only for french association) <div>The date of publication in the Journal Officiel in the form <b>YYYY-MM-DD</b></div>",
);
$additionaldomainfields[".pm"] = $additionaldomainfields[".fr"];
$additionaldomainfields[".re"] = $additionaldomainfields[".fr"];
$additionaldomainfields[".tf"] = $additionaldomainfields[".fr"];
$additionaldomainfields[".wf"] = $additionaldomainfields[".fr"];
$additionaldomainfields[".yt"] = $additionaldomainfields[".fr"];


## .JOBS DOMAIN REQUIREMENTS ##
$additionaldomainfields[".jobs"] = array();
$additionaldomainfields[".jobs"][] = array(
		"Name" => "Company URL",
		"Type" => "text",
		"Required" => true,
		"Ispapi-Name" => "X-JOBS-COMPANYURL"
);
$additionaldomainfields[".jobs"][] = array(
		"Name" => "Industry Classification",
		"Type" => "dropdown",
		"Options" => ",Accounting/Banking/Finance,Agriculture/Farming,Biotechnology/Science,Computer/Information Technology,Construction/Building Services,Consulting,Education/Training/Library,Entertainment,Environmental,Hospitality,Government/Civil Service,Healthcare,HR/Recruiting,Insurance,Legal,Manufacturing,Media/Advertising,Parks & Recreation,Pharmaceutical,Real Estate,Restaurant/Food Service,Retail,Telemarketing,Transportation,Other",
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
		"Required" => true,
		"Ispapi-Name" => "X-PRO-PROFESSION"
);
$additionaldomainfields[".pro"][] = array(
		"Name" => "Authority",
		"Type" => "text",
		"Required" => false,
		"Ispapi-Name" => "X-PRO-AUTHORITY"
);
$additionaldomainfields[".pro"][] = array(
		"Name" => "Authority Website",
		"Type" => "text",
		"Required" => false,
		"Ispapi-Name" => "X-PRO-AUTHORITYWEBSITE"
);
$additionaldomainfields[".pro"][] = array(
		"Name" => "License Number",
		"Type" => "text",
		"Required" => false,
		"Ispapi-Name" => "X-PRO-LICENSENUMBER"
);
$additionaldomainfields[".pro"][] = array(
		"Name" => ".PRO Terms",
		"Type" => "tickbox",
		"Description" => "Tick to confirm that you agree to the .PRO End User Terms Of Use at: <a href='http://www.registry.pro/legal/user-terms'>http://www.registry.pro/legal/user-terms</a>",
		"Required" => true,
		"Ispapi-Name" => "X-PRO-ACCEPT-TOU",
		"Ispapi-Eval" => 'if ( $value ) { $value = "1"; } else { $value = ""; }'
);


## .HK DOMAIN REQUIREMENTS ##
$additionaldomainfields[".hk"] = array();
$additionaldomainfields[".hk"][] = array(
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
);
$additionaldomainfields[".hk"][] = array(
		"Name" => "Registrant Document Number",
		"Type" => "text",
		"Required" => true,
		"Ispapi-Name" => "X-HK-REGISTRANT-DOCUMENT-NUMBER",
);
$additionaldomainfields[".hk"][] = array(
		"Name" => "Registrant Document Origin Country",
		"Type" => "text",
		"Required" => true,
		"Description" => "two-letter country code (ISO 3166-1 alpha-2)",
		"Ispapi-Name" => "X-HK-REGISTRANT-DOCUMENT-ORIGIN-COUNTRY",
);
$additionaldomainfields[".hk"][] = array(
		"Name" => "Registrant Birth Date for individuals",
		"Required" => false,
		"Description" => "YYYY-MM-DD (mandatory, if the registrant is an individual)",
		"Ispapi-Name" => "X-HK-REGISTRANT-BIRTH-DATE",
);
$additionaldomainfields[".hk"][] = array(
		"Name" => "HK Terms for individuals",
		"Type" => "tickbox",
		"Description" => "Accept the .HK <a href='https://www.hkirc.hk/content.jsp?id=3#!/6'
		target='_blank'>Terms for individuals</a>. (mandatory, if the registrant is an
		individual)",
		"Required" => false,
		"Options" => "on",
		"Ispapi-Name" => "X-HK-ACCEPT-INDIVIDUAL-REGISTRATION-TAC",
		"Ispapi-Replacements" => array("on" => "1"),
);


## .SE DOMAIN REQUIREMENTS ##
$additionaldomainfields[".fi"][] = array();
$additionaldomainfields[".fi"][] = array(
		"Name" => "FICORA Agreement",
		"Type" => "tickbox",
		"Description" => "I Accept the <a target='_blank' href='https://domain.fi/info/en/index/hakeminen/kukavoihakea.html'>.FI Domain Name Agreement</a>.",
		"Required" => true,
		"Ispapi-Name" => "X-FI-ACCEPT-REGISTRATION-TAC",
		"Ispapi-Eval" => 'if ( $value ) { $value = "1"; } else { $value = ""; }'
);
$additionaldomainfields[".fi"][] = array(
		"Name" => "ID Number",
		"Type" => "text",
		"Required" => true,
		"Ispapi-Name" => "X-FI-IDNUMBER"
);


## .SE DOMAIN REQUIREMENTS ##
$additionaldomainfields[".se"] = array();
$additionaldomainfields[".se"][] = array(
		"Name" => "Registrant ID Number",
		"Type" => "text",
		"Required" => true,
		"Description" => "<b>For individuals or companies located in Sweden</b> a valid Swedish
		personal or organizational number must be stated.
		<b>For individuals and companies outside of Sweden</b> the ID number (e.g. Civic
		registration number, company registration number, or the equivalent) must be stated.",
		"Ispapi-Name" => "X-NICSE-IDNUMBER",
);
$additionaldomainfields[".se"][] = array(
		"Name" => "Registrant VAT ID",
		"Type" => "text",
		"Required" => false,
		"Description" => "(Only required for companies that are located inside the European
		Union but outside Sweden)",
		"Ispapi-Name" => "X-NICSE-VATID",
);


## .DK DOMAIN REQUIREMENTS ##
$additionaldomainfields[".dk"] = array();
$additionaldomainfields[".dk"][] = array(
		"Name" => "Registrant VAT ID",
		"Type" => "text",
		"Required" => false,
		"Description" => "(Only for Organization)",
		"Ispapi-Name" => "X-REGISTRANT-VATID",
);
$additionaldomainfields[".dk"][] = array(
		"Name" => "Admin VAT ID",
		"Type" => "text",
		"Required" => false,
		"Description" => "(Only for Organization)",
		"Ispapi-Name" => "X-ADMIN-VATID",
);


## .IT DOMAIN REQUIREMENTS ##
$additionaldomainfields[".it"] = array();
$additionaldomainfields[".it"][] = array(
		"Name" => "Local Presence",
		"Type" => "dropdown",
		"Options" => ",Registrant is domiciled in the EU (PIN required) / Use Local Presence Service",
		"Ispapi-Name" => "X-IT-ACCEPT-TRUSTEE-TAC",
		"Ispapi-Options" => ",1"
);
$additionaldomainfields[".it"][] = array(
		"Name" => "PIN",
		"Type" => "text",
		"Required" => false,
		"Ispapi-Name" => "X-IT-PIN",
);
$additionaldomainfields[".it"][] = array(
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
);
$additionaldomainfields[".it"][] = array(
		"Name" => "Section 5 Agreement",
		"Description" => "<div style='color:#666666;'><b>Section 5 - Consent to the processing of personal data for registration</b><br>
The interested party, after reading the above disclosure, gives consent to the processing of information required for registration, as defined in the above disclosure. Giving consent is optional, but if no consent is given, it will not be possible to finalize the registration, assignment and management of the domain name.</div>",
		"Type" => "dropdown",
		"Options" => ",I accept the Section 5 Agreement listed below",
		"Ispapi-Name" => "X-IT-ACCEPT-REGISTRATION-TAC",
		"Ispapi-Options" => ",1"
);
$additionaldomainfields[".it"][] = array(
		"Name" => "Section 6 Agreement",
		"Description" => "<div style='color:#666666;'><b>Section 6 - Consent to the processing of personal data for diffusion and accessibility via the Internet</b><br>
The interested party, after reading the above disclosure, gives consent to the dissemination and accessibility via the Internet, as defined in the disclosure above. Giving consent is optional, but absence of consent does not allow the dissemination and accessibility of Internet data.</div>",
		"Type" => "dropdown",
		"Options" => ",I accept the Section 6 Agreement listed below",
		"Ispapi-Name" => "X-IT-ACCEPT-DIFFUSION-AND-ACCESSIBILITY-TAC",
		"Ispapi-Options" => ",1"
);
$additionaldomainfields[".it"][] = array(
		"Name" => "Section 7 Agreement",
		"Description" => "<div style='color:#666666;'><b>Section 7 - Explicit Acceptance of the following points</b><br>
For explicit acceptance, the interested party declares that they:
<ul><li>d) are aware and agree that the registration and management of a domain name is subject to the 'Rules of assignment and management of domain names in ccTLD.it' and 'Regulations for the resolution of disputes in the ccTLD.it' and their subsequent amendments;</li>
<li>e) are aware and agree that in the case of erroneous or false declarations in this request, the Registry shall immediately revoke the domain name, or proceed with other legal actions. In such case the revocation shall not in any way give rise to claims against the Registry;</li>
<li>f) release the Registry from any liability resulting from the assignment and use of the domain name by the natural person that has made the request;</li>
<li>g) accept the Italian jurisdiction and laws of the Italian State.</li></ul>",
		"Type" => "dropdown",
		"Options" => ",I accept the Section 7 Agreement listed below",
		"Ispapi-Name" => "X-IT-ACCEPT-EXPLICIT-TAC",
		"Ispapi-Options" => ",1"
);


## .QUEBEC DOMAIN REQUIREMENTS ##
$additionaldomainfields[".quebec"] = array();
$additionaldomainfields[".quebec"][] = array(
		"Name" => "Intended Use",
		"Type" => "text",
		"Required" => true,
		"Ispapi-Name" => "X-CORE-INTENDED-USE"
);


## .SCOT DOMAIN REQUIREMENTS ##
$additionaldomainfields[".scot"] = array();
$additionaldomainfields[".scot"][] = array(
		"Name" => "Intended Use",
		"Type" => "text",
		"Required" => true,
		"Ispapi-Name" => "X-CORE-INTENDED-USE"
);


## .NYC DOMAIN REQUIREMENTS ##
$additionaldomainfields[".nyc"] = array();
$additionaldomainfields[".nyc"][] = array(
		"Name" => "NEXUS Category",
		"Type" => "dropdown",
		"Options" => ",Natural Person - primary domicile with physical address in NYC,Entity or organization - primary domicile with physical address in NYC",
		"Description" => "<div>P.O Boxes are prohibited, see <a href='http://www.ownit.nyc/policies/index.php'>.nyc Nexus Policies</a>.</div>",
		"Required" => true,
		"Ispapi-Name" => "X-NYC-REGISTRANT-NEXUS-CATEGORY",
		"Ispapi-Options" => ",1,2",
);


## .ES DOMAIN REQUIREMENTS ##
$additionaldomainfields[".es"] = array();
$additionaldomainfields[".es"][] = array(
		"Name" => "Registrant Type",
		"Type" => "dropdown",
		"Options" => ",Otra; For non-spanish owner,NIF/NIE; For Spanish Individual or Organization,Alien registration card",
		"Required" => true,
		"Ispapi-Name" => "X-ES-REGISTRANT-TIPO-IDENTIFICACION",
		"Ispapi-Options" => ",0,1,3",
);
$additionaldomainfields[".es"][] = array(
		"Name" => "Registrant Identification Number",
		"Type" => "text",
		"Required" => true,
		"Ispapi-Name" => "X-ES-REGISTRANT-IDENTIFICACION"
);
$additionaldomainfields[".es"][] = array(
		"Name" => "Admin-Contact Type",
		"Type" => "dropdown",
		"Options" => ",Otra; For non-spanish owner,NIF/NIE; For Spanish Individual or Organization,Alien registration card",
		"Required" => true,
		"Ispapi-Name" => "X-ES-ADMIN-TIPO-IDENTIFICACION",
		"Ispapi-Options" => ",0,1,3",
);
$additionaldomainfields[".es"][] = array(
		"Name" => "Admin-Contact Identification Number",
		"Type" => "text",
		"Required" => true,
		"Ispapi-Name" => "X-ES-ADMIN-IDENTIFICACION"
);
$additionaldomainfields[".es"][] = array(
		"Name" => "Agreement",
		"Type" => "dropdown",
		"Options" => ",I agree to the .ES registration TAC for individuals",
		"Description" => "<div><a href='https://cp.hexonet.net/cp2/downloads/tac/ES_registration_TAC.pdf'>.ES registration TAC for individuals</a> (Only for individuals)</div>",
		"Required" => true,
		"Ispapi-Name" => "X-ES-ACCEPT-INDIVIDUAL-REGISTRATION-TAC",
		"Ispapi-Options" => "0,1",
);
$additionaldomainfields[".es"][] = array(
		"Name" => "Legal Form",
		"Type" => "dropdown",
		"Options" => ",1 - Individual,39 - Economic Interest Group,47 - Association,59 - Sports Association,68 - Professional Association,124 - Savings Bank,150 - Community Property,152 - Community of Owners,164 - Order or Religious Institution,181 - Consulate,197 - Public Law Association,203 - Embassy,229 - Local Authority,269 - Sports Federation,286 - Foundation,365 - Mutual Insurance Company,434 - Regional Government Body,436 - Central Government Body,439 - Political Party,476 - Trade Union,510 - Farm Partnership,524 - Public Limited Company,525 - Sports Association,554 - Civil Society,560 - General Partnership,562 - General and Limited Partnership,566 - Cooperative,608 - Worker-owned Company,612 - Limited Company,713 - Spanish Office,717 - Temporary Alliance of Enterprises,744 - Worker-owned Limited Company,745 - Regional Public Entity,746 - National Public Entity,747 - Local Public Entity,877 - Others,878 - Designation of Origin Supervisory Council,879 - Entity Managing Natural Areas",
		"Required" => false,
		"Description" => "(Optional)",
		"Ispapi-Name" => "X-ES-REGISTRANT-FORM-JURIDICA",
		"Ispapi-Options" => ",1,39,47,59,68,124,150,152,164,181,197,203,229,269,286,365,434,436,439,476,510,524,525,554,560,562,566,608,612,713,717,744,745,746,747,877,878,879",
);

## .IE DOMAIN REQUIREMENTS ## - DON'T FORGET TO REPLACE THE EMAIL ADDRESS WITH YOURS
$additionaldomainfields[".ie"][] = array();
$additionaldomainfields[".ie"][] = array(
		"Name" => "Additional Documents required",
		"Type" => "tickbox",
		"Description" => "<b>To complete the registration process, I will send a Proof of
		business relationship with Ireland (Bills etc.) and a excerpt from the commercial register
		to ###YOUR EMAIL ADDRESS###.</b>",
);

?>