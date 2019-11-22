<?php
## .IT DOMAIN REQUIREMENTS ##
## remove default whmcs fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "Legal Type",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Tax ID",
    "Remove" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Publish Personal Data",
    "Remove" => true
];

## add ispapi additional fields ##

## LOCAL PRESENCE / TRUSTEE SERVICE ##
## NOTE: if you want to offer local presence service, add the trustee service price to the domain registration AND transfer price ##
## for reference: https://requests.whmcs.com/topic/integrate-trustee-service-as-generic-domain-add-on
##
## When you uncomment the Local Presence service:
## - mark X-IT-ACCEPT-LIABILITY-TAC as not required
## - mark X-IT-ACCEPT-DIFFUSION-AND-ACCESSIBILITY-TAC as not required
## - mark X-IT-ACCEPT-EXPLICIT-TAC as not required
/*
$additionaldomainfields[$tld][] = [
    "Name" => "Local Presence",
    "Type" => "dropdown",
    "Options" => ",1|Registrant is domiciled in the EU (PIN required) / Use Local Presence Service",
    "Default" => "",
    "Ispapi-Name" => "X-IT-ACCEPT-TRUSTEE-TAC"
);
*/

$additionaldomainfields[$tld][] = [
    "Name" => "Accept Section 3 of .IT registrar contract",
    "Description" => "<b>Section 3 - Declarations and assumptions of liability</b><br/><div style='text-align:justify;margin-bottom:10px;'>The Registrant of the domain name in question, declares under their own responsibility that they are:
<ul><li>in possession of the citizenship or resident in a country belonging to the European Union (in the case of registration for natural persons);</li>
<li>established in a country belonging to the European Union (in the case of registration for other organizations);</li>
<li>aware and accept that the registration and management of a domain name is subject to the 'Rules of assignment and management of domain names in ccTLD. it' and 'Regulations for the resolution of disputes in the ccTLD.it' and their subsequent amendments;</li>
<li>entitled to the use and/or legal availability of the domain name applied for, and that they do not prejudice, with the request for registration, the rights of others;</li>
<li>aware that for the inclusion of personal data in the Database of assigned domain names, and their possible dissemination and accessibility via the Internet, consent must be given explicitly by ticking the appropriate boxes in the information below. See 'The policy of the .it Registry in the Whois Database' on the website of the Registry (http://www.nic.it);</li>
<li>aware and agree that in the case of erroneous or false declarations in this request, the Registry shall immediately revoke the domain name, or proceed with other legal actions. In such case the revocation shall not in any way give rise to claims against the Registry;</li>
<li>release the Registry from any liability resulting from the assignment and use of the domain name by the natural person that has made the request;</li>
<li>accept Italian jurisdiction and laws of the Italian State.</li></ul></div>",
    "Type" => "tickbox",
    "Ispapi-Name" => "X-IT-ACCEPT-LIABILITY-TAC",
    "Required" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Accept Section 5 of .IT registrar contract",
    "Description" => "<b>Section 5 - Consent to the processing of personal data for registration</b><br/><div style='text-align:justify;margin-bottom:10px;'>
The interested party, after reading the above disclosure, gives consent to the processing of information required for registration, as defined in the above disclosure. Giving consent is optional, but if no consent is given, it will not be possible to finalize the registration, assignment and management of the domain name.</div>",
    "Type" => "tickbox",
    "Ispapi-Name" => "X-IT-ACCEPT-REGISTRATION-TAC"
];
$additionaldomainfields[$tld][] = [
    "Name" => "Accept Section 6 of .IT registrar contract",
    "Description" => "<b>Section 6 - Consent to the processing of personal data for diffusion and accessibility via the Internet</b><br/><div style='text-align:justify;margin-bottom:10px;'>
The interested party, after reading the above disclosure, gives consent to the dissemination and accessibility via the Internet, as defined in the disclosure above. Giving consent is optional, but absence of consent does not allow the dissemination and accessibility of Internet data.</div>",
    "Type" => "tickbox",
    "Ispapi-Name" => "X-IT-ACCEPT-DIFFUSION-AND-ACCESSIBILITY-TAC",
    "Required" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "Accept Section 7 of .IT registrar contract",
    "Description" => "<b>Section 7 - Explicit Acceptance of the following points</b><br/><div style='text-align:justify;margin-bottom:10px;'>
For explicit acceptance, the interested party declares that they:
<ul><li>d) are aware and agree that the registration and management of a domain name is subject to the 'Rules of assignment and management of domain names in ccTLD.it' and 'Regulations for the resolution of disputes in the ccTLD.it' and their subsequent amendments;</li>
<li>e) are aware and agree that in the case of erroneous or false declarations in this request, the Registry shall immediately revoke the domain name, or proceed with other legal actions. In such case the revocation shall not in any way give rise to claims against the Registry;</li>
<li>f) release the Registry from any liability resulting from the assignment and use of the domain name by the natural person that has made the request;</li>
<li>g) accept the Italian jurisdiction and laws of the Italian State.</li></ul></div>",
    "Type" => "tickbox",
    "Ispapi-Name" => "X-IT-ACCEPT-EXPLICIT-TAC",
    "Required" => true
];
$additionaldomainfields[$tld][] = [
    "Name" => "PIN",
    "Type" => "text",
    "Ispapi-Name" => "X-IT-PIN"
];
