<?php
// #########################################################################
// # Add translations for ISPAPI registrar module additional domain fields #
// #########################################################################

// Terms and Conditions Fields, prefixed with hxflagstac
$_LANG["hxflagstacagreement"] = "Agreement";
$_LANG["hxflagstacagreementindiv"] = "Terms for Individuals";
$_LANG["hxflagstactrustee"] = "Local Presence Service";
$_LANG["hxflagstachighlyregulated"] = "Highly Regulated TLD";
$_LANG["hxflagstachighlyregulateddescrdefault"] = (
    "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is " .
    "true and accurate. Eligibility criteria may be viewed <a href='####TAC####' target='_blank'>here</a>."
);
$_LANG["hxflagstachighlyregulateddescreco"] = (
    $_LANG["hxflagstachighlyregulateddescrdefault"] .
    "<br/>All .ECO domain names will be first registered with \"server hold\" status pending the completion of the minimum requirements of the Eco Profile, namely, " .
    "the .ECO registrant 1) affirming their compliance with the .ECO Eligibility Policy and 2) pledging to support positive change for " .
    "the planet and to be honest when sharing information on their environmental actions. The registrant will be emailed with instructions " .
    "on how to create an Eco Profile. Once these steps have been completed, the .ECO domain will be immediately activated by the registry."
);
$_LANG["hxflagstachighlyregulateddescrnotac"] = (
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
    "interests of the consumers you serve..</li></ol></div>"
);
$_LANG["hxflagstacindividualregulateddescrdefault"] = "Tick to confirm the <a href='####TAC####' target='_blank'>Terms for Individuals</a>";
$_LANG["hxflagstacregulateddescrdefault"] = "Tick to confirm that you agree to the <a href='####TAC####' target='_blank'>Registry Terms and Conditions of Registration</a> upon new registration of ####TLD#### domain names.";
$_LANG["hxflagstacregulateddescrngo"] = (
    $_LANG["hxflagstacregulateddescrdefault"] .
    "<div style='padding:10px 0px;'>The registration of a ####TLD#### domain name is bundled with an .ONG domain name without additional costs. " .
    "Changes on the ####TLD#### Domain will be auto-applied to the .ONG Domain. You won't find the .ONG domain therefore listed in your domain inventory.</div>"
);
$_LANG["hxflagstacregulateddescritsection3"] = (
    "Tick to confirm that you agree to <b><a href='####TAC####' target='_blank'>Section 3 - Declarations and Assumptions of Liability</a></b>.<br/>" .
    "<div style='text-align:justify;margin-bottom:10px;'>" .
    "The Registrant of the domain name in question, declares under their own responsibility that they are:" .
    "<ul><li>in possession of the citizenship or resident in a country belonging to the European Union (in the case of registration for natural persons);</li>" .
    "<li>established in a country belonging to the European Union (in the case of registration for other organizations);</li>" .
    "<li>aware and accept that the registration and management of a domain name is subject to the <a href='####TAC####' target='_blank'>'Management of synchronous operations on domain names of the ccTLD ####TLD#### - Guidelines'</a> " .
    "and <a href='####TAC####' target='_blank'>'Dispute resolution in the ccTLD ####TLD#### - Regulations & Guidelines'</a> and their subsequent amendments;</li>" .
    "<li>entitled to the use and/or legal availability of the domain name applied for, and that they do not prejudice, with the request for registration, the rights of others;</li>" .
    "<li>aware that for the inclusion of personal data in the Database of assigned domain names, and their possible dissemination and accessibility via the Internet, consent must be " .
    "given explicitly by ticking the appropriate boxes in the information below. See the <a href='####TAC####' target='_blank'>'DBNA and WHOIS Policy'</a>;</li>" .
    "<li>aware and agree that in the case of erroneous or false declarations in this request, the Registry shall immediately revoke the domain name, or proceed with other legal actions. " .
    "In such case the revocation shall not in any way give rise to claims against the Registry;</li>" .
    "<li>release the Registry from any liability resulting from the assignment and use of the domain name by the natural person that has made the request;</li>" .
    "<li>accept Italian jurisdiction and laws of the Italian State.</li></ul>" .
    "</div>"
);
$_LANG["hxflagstacregulateddescritsection5"] = (
    "Tick to confirm that you agree to <b><a href='####TAC####' target='_blank'>Section 5 - Consent to the processing of personal data for registration</b></a><br/>" .
    "<div style='text-align:justify;margin-bottom:10px;'>" .
    "The interested party, after reading the above disclosure, gives consent to the processing of information required for registration, as defined " .
    "in the above disclosure. Giving consent is optional, but if no consent is given, it will not be possible to finalize the registration, assignment and management of the domain name.</div>"
);
$_LANG["hxflagstacregulateddescritsection6"] = (
    "Tick to confirm that you agree to <b><a href='####TAC####' target='_blank'>Section 6 - Consent to the processing of personal data for diffusion and accessibility via the Internet</b></a><br/>" .
    "<div style='text-align:justify;margin-bottom:10px;'>" .
    "The interested party, after reading the above disclosure, gives consent to the dissemination and accessibility via the Internet, as defined in the disclosure above. " .
    "Giving consent is optional, but absence of consent does not allow the dissemination and accessibility of Internet data.</div>"
);
$_LANG["hxflagstacregulateddescritsection7"] = (
    "Tick to confirm that you agree to <b><a href='####TAC####' target='_blank'>Section 7 - Explicit Acceptance of the following points</b></a><br/>" .
    "<div style='text-align:justify;margin-bottom:10px;'>" .
    "For explicit acceptance, the interested party declares that they:" .
    "<ul><li>d) are aware and agree that the registration and management of a domain name is subject to the <a href='####TAC####' target='_blank'>Rules of assignment and management of domain names " .
    "in ccTLD ####TLD####'</a> and <a href='####TAC####' target='_blank'>Regulations for the resolution of disputes in the ccTLD ####TLD####'</a> and their subsequent amendments;</li>" .
    "<li>e) are aware and agree that in the case of erroneous or false declarations in this request, the Registry shall immediately revoke the domain name, or " .
    "proceed with other legal actions. In such case the revocation shall not in any way give rise to claims against the Registry;</li>" .
    "<li>f) release the Registry from any liability resulting from the assignment and use of the domain name by the natural person that has made the request;</li>" .
    "<li>g) accept the Italian jurisdiction and laws of the Italian State.</li></ul>" .
    "</div>"
);

// Generic Fields, prefixed with hxflags
$_LANG["hxflagsyesnoyes"] = "Yes";
$_LANG["hxflagsyesnono"] = "No";
$_LANG["hxflagsyesnoy"] = "Yes";
$_LANG["hxflagsyesnon"] = "No";
$_LANG["hxflagsyesno1"] = "Yes";
$_LANG["hxflagsyesno0"] = "No";

$_LANG["hxflagslegaltype"] = "Legal Type";
$_LANG["hxflagslegaltypeindiv"] = "Individual";
$_LANG["hxflagslegaltypeorg"] = "Organization";
$_LANG["hxflagsintendeduse"] = "Intended Use";
$_LANG["hxflagsregistrantidnumber"] = "Registrant ID Number";
$_LANG["hxflagsregistrantvatid"] = "Registrant VAT ID";
$_LANG["hxflagsadminidnumber"] = "Admin-C ID Number";
$_LANG["hxflagsadminvatid"] = "Admin-C VAT ID";
$_LANG["hxflagstechidnumber"] = "Tech-C ID Number";
$_LANG["hxflagstechvatid"] = "Tech-C VAT ID";
$_LANG["hxflagsbillingidnumber"] = "Billing-C ID Number";
$_LANG["hxflagsregistrantidtype"] = "Registrant ID Type";
$_LANG["hxflagsallocationtoken"] = "Registry's Allocation Token";
$_LANG["hxflagsallocationtokendescr"] = (
    "To register a ####TLD#### domain, you must provide the allocation token issued by the registry. " .
    "Please complete the registrant application <a href='####TAC####' target='_blank'>here</a> to obtain the token."
);
$_LANG["hxflagsnexuscategory"] = "Nexus Category";
$_LANG["hxflagsnexuscountry"] = "Nexus Country";
$_LANG["hxflagsfax"] = "Fax Required";
$_LANG["hxflagsfaxregistrationdescr"] = "I confirm that after this registration request I will send <a href='####FAXFORM####'>this form</a> back to complete the process.";
$_LANG["hxflagsfaxtransferdescr"] = "I confirm that after this transfer request I will send <a href='####FAXFORM####'>this form</a> back to complete the process.";
$_LANG["hxflagsfaxownerchangedescr"] = "I confirm that after this owner change request I will send <a href='####FAXFORM####'>this form</a> back to complete the process.";
$_LANG["hxflagsidentificationnumber"] = "Identification Number";
$_LANG["hxflagswhoisoptout"] = "WHOIS Opt-out";
$_LANG["hxflagsregistrantbirthdate"] = "Registrant Birthdate";

// AFNIC TLDs, prefixed with hxflagsafnic
$_LANG["hxflagsafnictldvatid"] = "VATID or SIREN/SIRET number";
$_LANG["hxflagsafnictldvatiddescr"] = "(Only for companies with VATID or SIREN/SIRET number)";
$_LANG["hxflagsafnictldtrademark"] = "Trademark Number";
$_LANG["hxflagsafnictldtrademarkdescr"] = "(Only for companies with a European trademark)";
$_LANG["hxflagsafnictldduns"] = "DUNS Number";
$_LANG["hxflagsafnictlddunsdescr"] = "(Only for companies with DUNS number)";
$_LANG["hxflagsafnictldlocalid"] = "Local ID";
$_LANG["hxflagsafnictldlocaliddescr"] = "(Only for companies with local identifier)";
// French Association, Data from Journal officiel [JO]
$_LANG["hxflagsafnictldjodod"] = "Date of Declaration [JO]";
$_LANG["hxflagsafnictldjododdescr"] = "(Only for french association, form: <b>YYYY-MM-DD</b>)";
$_LANG["hxflagsafnictldjonumber"] = "Number [JO]";
$_LANG["hxflagsafnictldjonumberdescr"] = "(Only for french association, The number of the Journal Officiel)";
$_LANG["hxflagsafnictldjopage"] = "Page of Announcement [JO]";
$_LANG["hxflagsafnictldjopagedescr"] = "(Only for french association, The page of the announcement in the Journal Officiel)";
$_LANG["hxflagsafnictldjodop"] = "Date of Publication [JO]";
$_LANG["hxflagsafnictldjodopdescr"] = "(Only for french association, The date of publication in the Journal Officiel in the form <b>YYYY-MM-DD</b>)";
// Options, Legal Type
$_LANG["hxflagsafnictldlegaltypeindiv"] = "Individual";
$_LANG["hxflagsafnictldlegaltypeorg1"] = "Company with VATID or SIREN/SIRET number";
$_LANG["hxflagsafnictldlegaltypeorg2"] = "Company with European Trademark";
$_LANG["hxflagsafnictldlegaltypeorg3"] = "Company with DUNS Number";
$_LANG["hxflagsafnictldlegaltypeorg4"] = "Company local identifier";
$_LANG["hxflagsafnictldlegaltypeass"] = "French Association";

// .AERO
$_LANG["hxflagsaerotldaeroid"] = ".AERO ID <sup style='cursor:help;' title='Obtain from https://www.information.aero/'>what's this?</sup>";
$_LANG["hxflagsaerotldaerokey"] = ".AERO Key <sup style='cursor:help;' title='Obtain from https://www.information.aero/'>what's this?</sup>";

// .CA
$_LANG["hxflagscatldcontactlanguage"] = "Contact Language";
$_LANG["hxflagscatldwhoisoptoutdescr"] = "Tick to hide your contact information in registry WHOIS (only available to individuals)";
$_LANG["hxflagscatldregistryinformation"] = "Registry Information";
$_LANG["hxflagscatldregistryinformationdescr"] = (
    "Whenever you register a ####TLD#### domain for a new registrant (or change the registrant to a new one), this new registrant has to agree to the " .
    "registrant agreement within 7 days so that the domain becomes active. Otherwise the domain is getting deleted by the registry without any refund. ".
    "<br/><b>Only in such a case, a confirmation email will be send out to the new registrant covering the necessary steps to accept this agreement.</b><br/>" .
    "If the same (already confirmed) registrant contact is used to register another ####TLD#### domain then the domain will be registered in real-time."
);
// Options, Legal Type
$_LANG["hxflagscatldlegaltypecco"] = "Corporation";
$_LANG["hxflagscatldlegaltypecct"] = "Canadian Citizen";
$_LANG["hxflagscatldlegaltyperes"] = "Permanent Resident of Canada";
$_LANG["hxflagscatldlegaltypegov"] = "Government or government entity in Canada";
$_LANG["hxflagscatldlegaltypeedu"] = "Canadian Educational Institution";
$_LANG["hxflagscatldlegaltypeass"] = "Canadian Unincorporated Association";
$_LANG["hxflagscatldlegaltypehos"] = "Canadian Hospital";
$_LANG["hxflagscatldlegaltypeprt"] = "Partnership Registered in Canada";
$_LANG["hxflagscatldlegaltypetdm"] = "Trade-mark registered in Canada (by a non-Canadian owner)";
$_LANG["hxflagscatldlegaltypetrd"] = "Canadian Trade Union";
$_LANG["hxflagscatldlegaltypeplt"] = "Canadian Political Party";
$_LANG["hxflagscatldlegaltypelam"] = "Canadian Library Archive or Museum";
$_LANG["hxflagscatldlegaltypetrs"] = "Trust established in Canada";
$_LANG["hxflagscatldlegaltypeabo"] = "Aboriginal Peoples (individuals or groups) indigenous to Canada";
$_LANG["hxflagscatldlegaltypeinb"] = "Indian Band recognized by the Indian Act of Canada";
$_LANG["hxflagscatldlegaltypelgr"] = "Legal Representative of a Canadian Citizen or Permanent Resident";
$_LANG["hxflagscatldlegaltypeomk"] = "Official mark registered in Canada";
$_LANG["hxflagscatldlegaltypemaj"] = "Her Majesty the Queen";

// .CN
// Options, Registrant ID Type
$_LANG["hxflagscntldregistrantidtypesfz"] = "Chinese ID Card";
$_LANG["hxflagscntldregistrantidtypehz"] = "Foreign Passport";
$_LANG["hxflagscntldregistrantidtypegajmtx"] = "Exit-Entry Permit for Travelling to and from Hong Kong and Macao";
$_LANG["hxflagscntldregistrantidtypetwjmtx"] = "Travel passes for Taiwan Residents to Enter or Leave the Mainland";
$_LANG["hxflagscntldregistrantidtypewjlsfz"] = "Foreign Permanent Resident ID Card";
$_LANG["hxflagscntldregistrantidtypegajzz"] = "Residence permit for Hong Kong / Macao residents";
$_LANG["hxflagscntldregistrantidtypetwjzz"] = "Residence permit for Taiwan residents";
$_LANG["hxflagscntldregistrantidtypejgz"] = "Chinese officer certificate";
$_LANG["hxflagscntldregistrantidtypeorg"] = "Chinese Organization Code Certificate";
$_LANG["hxflagscntldregistrantidtypeyyzz"] = "Chinese business license";
$_LANG["hxflagscntldregistrantidtypetydm"] = "Certificate for Uniform Social Credit Code";
$_LANG["hxflagscntldregistrantidtypebddm"] = "Military Code Designation";
$_LANG["hxflagscntldregistrantidtypejddwfw"] = "Military Paid External Service License";
$_LANG["hxflagscntldregistrantidtypesydwfr"] = "Public Institution Legal Person Certificate";
$_LANG["hxflagscntldregistrantidtypewgczjg"] = "Resident Representative Offices of Foreign Enterprises Registration Form";
$_LANG["hxflagscntldregistrantidtypeshttfr"] = "Social Organization Legal Person Registration Certificate";
$_LANG["hxflagscntldregistrantidtypezjcs"] = "Religion Activity Site Registration Certificate";
$_LANG["hxflagscntldregistrantidtypembfqy"] = "Private Non-Enterprise Entity Registration Certificate";
$_LANG["hxflagscntldregistrantidtypejjhfr"] = "Fund Legal Person Registration Certificate";
$_LANG["hxflagscntldregistrantidtypelszy"] = "Practicing License of Law Firm";
$_LANG["hxflagscntldregistrantidtypewgzhwh"] = "Registration Certificate of Foreign Cultural Center in China";
$_LANG["hxflagscntldregistrantidtypewlczjg"] = "Resident Representative Office of Tourism Departments of Foreign Government Approval Registration Certificate";
$_LANG["hxflagscntldregistrantidtypesfjd"] = "Judicial Expertise License";
$_LANG["hxflagscntldregistrantidtypejwjg"] = "Overseas Organization Certificate";
$_LANG["hxflagscntldregistrantidtypeshfwjg"] = "Social Service Agency Registration Certificate";
$_LANG["hxflagscntldregistrantidtypembxxbx"] = "Private School Permit";
$_LANG["hxflagscntldregistrantidtypeyljgzy"] = "Medical Institution Practicing License";
$_LANG["hxflagscntldregistrantidtypegzjgzy"] = "Notary Organization Practicing License";
$_LANG["hxflagscntldregistrantidtypebjwsxx"] = "Beijing School for Children of Foreign Embassy Staff in China Permit";
$_LANG["hxflagscntldregistrantidtypeqt"] = "Others";

// .COM.AU
// Options, Registrant ID Type
$_LANG["hxflagscomautldregistrantidtypeabn"] = "Australian Business Number";
$_LANG["hxflagscomautldregistrantidtypeacn"] = "Australian Company Number";
$_LANG["hxflagscomautldregistrantidtyperbn"] = "Business Registration Number";
$_LANG["hxflagscomautldregistrantidtypetm"] = "Trademark Number";

// .COM.BR
$_LANG["hxflagscombrtldidentificationnumberdescr"] = "Please provide your CPF or CNPJ numbers which are issued by the Department of Federal Revenue of Brazil for tax purposes";

// .DE
$_LANG["hxflagsdetldgeneralrequestcontact"] = "General Request Contact";
$_LANG["hxflagsdetldabuseteamcontact"] = "Abuse Team Contact";
$_LANG["hxflagsdetldgeneralrequestcontactdescr"] = "The registry will identify this as the general request contact information. You can provide an email address or a website url.";
$_LANG["hxflagsdetldabuseteamcontactdescr"] = "The registry will identify this as the abuse team contact information. You can provide an email address or a website url.";

// .DK
$_LANG["hxflagsdktldregistrantcontact"] = "Registrant Contact";
$_LANG["hxflagsdktldregistrantlegaltype"] = "Registrant Legal Type";
$_LANG["hxflagsdktldregistrantvatiddescr"] = "(required in case of chosen option `Organization`)";
$_LANG["hxflagsdktldadminvatiddescr"] = "(required in case of chosen option `Organization`)";
$_LANG["hxflagsdktldregistrantlegaltypeindiv"] = "Individual";
$_LANG["hxflagsdktldregistrantlegaltypeorg"] = "Organization";
$_LANG["hxflagsdktldadmincontact"] = "Admin Contact";
$_LANG["hxflagsdktldadminlegaltype"] = "Admin Legal Type";
$_LANG["hxflagsdktldadminlegaltypeindiv"] = "Individual";
$_LANG["hxflagsdktldadminlegaltypeorg"] = "Organization";
$_LANG["hxflagsdktldlegaltypedescr"] = "Also choose `Individual` in case you're a company without VATID (Company data will then be suppressed in registration process).";
$_LANG["hxflagsdktldcontactdescr"] = "DK-HOSTMASTER User ID";

// .ES
$_LANG["hxflagsestldregistranttype"] = "Registrant Contact Type";
$_LANG["hxflagsestldregistrantidentificationnumber"] = "Registrant Identification Number";
$_LANG["hxflagsestldadmintype"] = "Admin Contact Type";
$_LANG["hxflagsestldadminidentificationnumber"] = "Admin Contact Identification Number";
$_LANG["hxflagsestldregistrantlegaltype"] = "Registrant Legal Type";
// Options, Legal Type
$_LANG["hxflagsestldregistrantlegaltype1"] = "Individual";
$_LANG["hxflagsestldregistrantlegaltype39"] = "Economic Interest Group";
$_LANG["hxflagsestldregistrantlegaltype47"] = "Association";
$_LANG["hxflagsestldregistrantlegaltype59"] = "Sports Association";
$_LANG["hxflagsestldregistrantlegaltype68"] = "Professional Association";
$_LANG["hxflagsestldregistrantlegaltype124"] = "Savings Bank";
$_LANG["hxflagsestldregistrantlegaltype150"] = "Community Property";
$_LANG["hxflagsestldregistrantlegaltype152"] = "Community of Owners";
$_LANG["hxflagsestldregistrantlegaltype164"] = "Order or Religious Institution";
$_LANG["hxflagsestldregistrantlegaltype181"] = "Consulate";
$_LANG["hxflagsestldregistrantlegaltype197"] = "Public Law Association";
$_LANG["hxflagsestldregistrantlegaltype203"] = "Embassy";
$_LANG["hxflagsestldregistrantlegaltype229"] = "Local Authority";
$_LANG["hxflagsestldregistrantlegaltype269"] = "Sports Federation";
$_LANG["hxflagsestldregistrantlegaltype286"] = "Foundation";
$_LANG["hxflagsestldregistrantlegaltype365"] = "Mutual Insurance Company";
$_LANG["hxflagsestldregistrantlegaltype434"] = "Regional Government Body";
$_LANG["hxflagsestldregistrantlegaltype436"] = "Central Government Body";
$_LANG["hxflagsestldregistrantlegaltype439"] = "Political Party";
$_LANG["hxflagsestldregistrantlegaltype476"] = "Trade Union";
$_LANG["hxflagsestldregistrantlegaltype510"] = "Farm Partnership";
$_LANG["hxflagsestldregistrantlegaltype524"] = "Public Limited Company";
$_LANG["hxflagsestldregistrantlegaltype525"] = "Sports Association";
$_LANG["hxflagsestldregistrantlegaltype554"] = "Civil Society";
$_LANG["hxflagsestldregistrantlegaltype560"] = "General Partnership";
$_LANG["hxflagsestldregistrantlegaltype562"] = "General and Limited Partnership";
$_LANG["hxflagsestldregistrantlegaltype566"] = "Cooperative";
$_LANG["hxflagsestldregistrantlegaltype608"] = "Employee-owned Company";
$_LANG["hxflagsestldregistrantlegaltype612"] = "Limited Company";
$_LANG["hxflagsestldregistrantlegaltype713"] = "Spanish Office";
$_LANG["hxflagsestldregistrantlegaltype717"] = "Temporary Alliance of Enterprises";
$_LANG["hxflagsestldregistrantlegaltype744"] = "Employee-owned Limited Company";
$_LANG["hxflagsestldregistrantlegaltype745"] = "Regional Public Entity";
$_LANG["hxflagsestldregistrantlegaltype746"] = "National Public Entity";
$_LANG["hxflagsestldregistrantlegaltype747"] = "Local Public Entity";
$_LANG["hxflagsestldregistrantlegaltype878"] = "Designation of Origin Supervisory Council";
$_LANG["hxflagsestldregistrantlegaltype879"] = "Entity Managing Natural Areas";
$_LANG["hxflagsestldregistrantlegaltype877"] = "Others";
// Options, Registrant ID Type
$_LANG["hxflagsestldregistranttype0"] = "For non-spanish owner";
$_LANG["hxflagsestldregistranttype1"] = "For Spanish Individual or Organization";
$_LANG["hxflagsestldregistranttype3"] = "Alien registration card";
$_LANG["hxflagsestldadmintype0"] = "For non-spanish entity";
$_LANG["hxflagsestldadmintype1"] = "For Spanish Individual or Organization";
$_LANG["hxflagsestldadmintype3"] = "Alien registration card";

// .EU
$_LANG["hxflagseutldregistrantcitizenship"] = "Registrant Citizenship";
$_LANG["hxflagseutldregistrantcitizenshipdescr"] = "Required only if you're a European Citizen residing outside of the EU";

// .FI
$_LANG["hxflagsfitldregistrantidnumberdescr"] = (
    "<ul><li>Companies: Please provide the registernumber.</li>" .
    "<li>Individuals from Finland: provide the identity number.</li>" .
    "<li>Other Individuals: leave empty.</li></ul>" .
    "For individuals, please note that the X-FI-REGISTRANT-IDNUMBER has to contain of eleven characters of the form DDMMYYCZZZQ, " .
    "where DDMMYY is the date of birth, C the century sign, ZZZ the individual number and Q the control character (checksum). The " .
    "sign for the century is either + (1800–1899), - (1900–1999), or A (2000–2099). The individual number ZZZ is odd for males and " .
    "even for females and for people born in Finland its range is 002-899 (larger numbers may be used in special cases). An example " .
    "of a valid code is 311280-888Y."
);
$_LANG["hxflagsfitldregistrantbirthdatedescr"] = "(YYYY-MM-DD; only required for Individuals not from Finland)";

// .HK
$_LANG["hxflagshktldregistrantdocumenttype"] = "Registrant Document Type";
$_LANG["hxflagshktldregistrantotherdocumenttype"] = "Registrant Other Document Type";
$_LANG["hxflagshktldregistrantdocumentnumber"] = "Registrant Document Number";
$_LANG["hxflagshktldregistrantdocumentorigincountry"] = "Registrant Document Origin Country";
$_LANG["hxflagshktldregistrantbirthdateforindividuals"] = "Registrant Birth Date for individuals";
// Options, Registrant Document Type
$_LANG["hxflagshktldregistrantdocumenttypehkid"] = "Individual - Hong Kong Identity Number";
$_LANG["hxflagshktldregistrantdocumenttypeothid"] = "Individual - Other's Country Identity Number";
$_LANG["hxflagshktldregistrantdocumenttypepassno"] = "Individual - Passport No.";
$_LANG["hxflagshktldregistrantdocumenttypebirthcert"] = "Individual - Birth Certificate";
$_LANG["hxflagshktldregistrantdocumenttypeothidv"] = "Individual - Others Individual Document";
$_LANG["hxflagshktldregistrantdocumenttypebr"] = "Organization - Business Registration Certificate";
$_LANG["hxflagshktldregistrantdocumenttypeci"] = "Organization - Certificate of Incorporation";
$_LANG["hxflagshktldregistrantdocumenttypecrs"] = "Organization - Certificate of Registration of a School";
$_LANG["hxflagshktldregistrantdocumenttypehksarg"] = "Organization - Hong Kong Special Administrative Region Government Department";
$_LANG["hxflagshktldregistrantdocumenttypehkordinance"] = "Organization - Ordinance of Hong Kong";
$_LANG["hxflagshktldregistrantdocumenttypeothorg"] = "Organization - Others Organization Document";
$_LANG["hxflagshktldregistrantdocumenttypedescr"] = (
    "(NOTE: Additionally, you may need to send us a copy of the document via email. For .HK, this step is only required " .
    "upon request by the registry. For .COM.HK, a copy of a business certificate is required before we can process the registration.)"
);
$_LANG["hxflagshktldregistrantotherdocumenttypedescr"] = "(required for Registrant Document Types `Others Individual/Organization Document`)";
$_LANG["hxflagshktldregistrantbirthdateforindividualsdescr"] = "(mandatory for individuals, form YYYY-MM-DD)";

// .IE
$_LANG["hxflagsietldregistrantclass"] = "Registrant Classification";
$_LANG["hxflagsietldproofofconnectiontoireland"] = "Proof of connection to Ireland";
$_LANG["hxflagsietldproofofconnectiontoirelanddescr"] = (
    "Provide any information supporting your registration request, such as proof of eligibility (e.g. ".
    "VAT, RBN, CRO, CHY, NIC, or Trademark number; school roll number; link to social media page) or a ".
    "brief explanation of why you want this domain and what you will use it for."
);
// Options, Registrant Class
$_LANG["hxflagsietldregistrantclasscompany"] = "Company";
$_LANG["hxflagsietldregistrantclassbusinessowner"] = "Business Owner";
$_LANG["hxflagsietldregistrantclassclubbandlocalgroup"] = "Club/Band/Local Group";
$_LANG["hxflagsietldregistrantclassschoolcollege"] = "School/College";
$_LANG["hxflagsietldregistrantclassstateagency"] = "State Agency";
$_LANG["hxflagsietldregistrantclasscharity"] = "Charity";
$_LANG["hxflagsietldregistrantclassbloggerother"] = "Blogger/Other";

// .IT
$_LANG["hxflagsittldpin"] = "PIN";
$_LANG["hxflagsittldacceptsection3"] = "Section 3 of .IT registrar contract";
$_LANG["hxflagsittldacceptsection5"] = "Section 5 of .IT registrar contract";
$_LANG["hxflagsittldacceptsection6"] = "Section 6 of .IT registrar contract";
$_LANG["hxflagsittldacceptsection7"] = "Section 7 of .IT registrar contract";
$_LANG["hxflagsittldregistrantnationality"] = "Registrant Nationality";
$_LANG["hxflagsittldregistrantnationalitydescr"] = "(the nationality of the registrant contact if it deviates from the country code.)";
$_LANG["hxflagsittldregistrantlegaltype"] = "Registrant Legal Type";
$_LANG["hxflagsittldregistrantlegaltype1"] = "[1] Italian and foreign natural persons";
$_LANG["hxflagsittldregistrantlegaltype2"] = "[2] Italian Companies / One man companies";
$_LANG["hxflagsittldregistrantlegaltype3"] = "[3] Italian Freelance workers / Professionals";
$_LANG["hxflagsittldregistrantlegaltype4"] = "[4] Italian non-profit Organizations";
$_LANG["hxflagsittldregistrantlegaltype5"] = "[5] Italian public Organizations";
$_LANG["hxflagsittldregistrantlegaltype6"] = "[6] Other Italian Subjects";
$_LANG["hxflagsittldregistrantlegaltype7"] = "[7] Other EU-member state Organisation (matching 2 - 6)";

// .JOBS
$_LANG["hxflagsjobstldyesnono"] = "No";
$_LANG["hxflagsjobstldyesnoyes"] = "Yes";
$_LANG["hxflagsjobstldwebsite"] = "Website";
$_LANG["hxflagsjobstldindustryclassification"] = "Industry Classification";
$_LANG["hxflagsjobstldmemberofahrassociation"] = "Member of a Human Resources Association";
$_LANG["hxflagsjobstldcontactjobtitle"] = "Contact Job Title (e.g. CEO)";
$_LANG["hxflagsjobstldcontacttype"] = "Contact Type";
// Options, Industry Classification
$_LANG["hxflagsjobstldindustryclassification2"] = "Accounting/Banking/Finance";
$_LANG["hxflagsjobstldindustryclassification3"] = "Agriculture/Farming";
$_LANG["hxflagsjobstldindustryclassification21"] = "Biotechnology/Science";
$_LANG["hxflagsjobstldindustryclassification5"] = "Computer/Information Technology";
$_LANG["hxflagsjobstldindustryclassification4"] = "Construction/Building Services";
$_LANG["hxflagsjobstldindustryclassification12"] = "Consulting";
$_LANG["hxflagsjobstldindustryclassification6"] = "Education/Training/Library";
$_LANG["hxflagsjobstldindustryclassification7"] = "Entertainment";
$_LANG["hxflagsjobstldindustryclassification13"] = "Environmental";
$_LANG["hxflagsjobstldindustryclassification19"] = "Hospitality";
$_LANG["hxflagsjobstldindustryclassification10"] = "Government/Civil Service";
$_LANG["hxflagsjobstldindustryclassification11"] = "Healthcare";
$_LANG["hxflagsjobstldindustryclassification15"] = "HR/Recruiting";
$_LANG["hxflagsjobstldindustryclassification16"] = "Insurance";
$_LANG["hxflagsjobstldindustryclassification17"] = "Legal";
$_LANG["hxflagsjobstldindustryclassification18"] = "Manufacturing";
$_LANG["hxflagsjobstldindustryclassification20"] = "Media/Advertising";
$_LANG["hxflagsjobstldindustryclassification9"] = "Parks & Recreation";
$_LANG["hxflagsjobstldindustryclassification26"] = "Pharmaceutical";
$_LANG["hxflagsjobstldindustryclassification22"] = "Real Estate";
$_LANG["hxflagsjobstldindustryclassification14"] = "Restaurant/Food Service";
$_LANG["hxflagsjobstldindustryclassification23"] = "Retail";
$_LANG["hxflagsjobstldindustryclassification8"] = "Telemarketing";
$_LANG["hxflagsjobstldindustryclassification24"] = "Transportation";
$_LANG["hxflagsjobstldindustryclassification25"] = "Other";
// Options, Contact Type
$_LANG["hxflagsjobstldcontacttype1"] = "Administrative";
$_LANG["hxflagsjobstldcontacttype0"] = "Other";

// .LOTTO
$_LANG["hxflagslottotldmembershipcontactid"] = "Membership Contact ID";
$_LANG["hxflagslottotldverificationcode"] = "Verification Code";

// .LT
$_LANG["hxflagslttldlegalentityidentificationcode"] = "Legal Entity Identification Code";

// .MELBOURNE
// Options, Nexus Category
$_LANG["hxflagsmelbournetldnexuscategorya"] = "Victorian Entities";
$_LANG["hxflagsmelbournetldnexuscategoryb"] = "Victorian Residents";
$_LANG["hxflagsmelbournetldnexuscategoryc"] = "Associated Entities";
$_LANG["hxflagsmelbournetldnexuscategorydescr"] = (
    "<div style='padding:10px 0px;text-align:justify'><b>Registration Eligibility</b><br/>In order to register or ".
    "renew a domain name the Applicant or Registrant must satisfy one of the following Criteria A, B or C below:<br/><br/>".
    "<b>Criteria A – Victorian Entities</b><br/>The Applicant must be an entity registered with the Australian Securities " .
    "and Investments Commission or the Australian Business Register that:<ul>" .
    "<li>has an address in the State of Victoria associated with its ABN, ACN, RBN or ARBN; or</li><li>has a valid corporate address in the State of Victoria.</li></ul><br/>" .
    "<b>Criteria B – Victorian Residents</b><br/>The Applicant must be an Australian citizen or resident with a valid address in the State of Victoria.<br/><br/>" .
    "<b>Criteria C – Associated Entities</b><br/>The Applicant must be an Associated Entity. The Applicant may only apply for a domain name that is an Exact Match " .
    "or Partial Match to, or an Abbreviation, or an Acronym of:" .
    "<ul><li>the business name of the Applicant, or name by which the Applicant is commonly known ( i.e. a nickname) and the business name must be registered with the ".
    "appropriate authority in the jurisdiction in which that business is domiciled; or</li>" .
    "<li>a product that the Associated Entity manufactures or sells to entities or individuals residing in the State of Victoria;</li>".
    "<li>a service that the Associated Entity provides to residents of the State of Victoria;</li>" .
    "<li>an event that the Associated Entity organises or sponsors in the State of Victoria;</li>" .
    "<li>an activity that the Associated Entity facilitates in the State of Victoria; or</li>" .
    "<li>a course or training program that the Associated Entity provides to residents of the State of Victoria.</li></div>"
);

// .MY
$_LANG["hxflagsmytldregistrantorganisationtype"] = "Registrant Organisation Type";
// Options, Registrant Organisation Type
$_LANG["hxflagsmytldregistrantorganisationtype1"] = "architect firm";
$_LANG["hxflagsmytldregistrantorganisationtype2"] = "audit firm";
$_LANG["hxflagsmytldregistrantorganisationtype3"] = "business pursuant to business registration act(rob)";
$_LANG["hxflagsmytldregistrantorganisationtype4"] = "business pursuant to commercial license ordinance";
$_LANG["hxflagsmytldregistrantorganisationtype5"] = "company pursuant to companies act(roc)";
$_LANG["hxflagsmytldregistrantorganisationtype6"] = "educational institution accredited/registered by relevant government department/agency";
$_LANG["hxflagsmytldregistrantorganisationtype7"] = "farmers organisation";
$_LANG["hxflagsmytldregistrantorganisationtype8"] = "federal government department or agency";
$_LANG["hxflagsmytldregistrantorganisationtype9"] = "foreign embassy";
$_LANG["hxflagsmytldregistrantorganisationtype10"] = "foreign office";
$_LANG["hxflagsmytldregistrantorganisationtype11"] = "government aided primary and/or secondary school";
$_LANG["hxflagsmytldregistrantorganisationtype12"] = "law firm";
$_LANG["hxflagsmytldregistrantorganisationtype13"] = "lembega (board)";
$_LANG["hxflagsmytldregistrantorganisationtype14"] = "local authority department or agency";
$_LANG["hxflagsmytldregistrantorganisationtype15"] = "maktab rendah sains mara (mrsm) under the administration of mara";
$_LANG["hxflagsmytldregistrantorganisationtype16"] = "ministry of defences department or agency";
$_LANG["hxflagsmytldregistrantorganisationtype17"] = "offshore company";
$_LANG["hxflagsmytldregistrantorganisationtype18"] = "parents teachers association";
$_LANG["hxflagsmytldregistrantorganisationtype19"] = "polytechnic under ministry of education administration";
$_LANG["hxflagsmytldregistrantorganisationtype20"] = "private higher educational institution";
$_LANG["hxflagsmytldregistrantorganisationtype21"] = "private school";
$_LANG["hxflagsmytldregistrantorganisationtype22"] = "regional office";
$_LANG["hxflagsmytldregistrantorganisationtype23"] = "religious entity";
$_LANG["hxflagsmytldregistrantorganisationtype24"] = "representative office";
$_LANG["hxflagsmytldregistrantorganisationtype25"] = "society pursuant to societies act(ros)";
$_LANG["hxflagsmytldregistrantorganisationtype26"] = "sports organisation";
$_LANG["hxflagsmytldregistrantorganisationtype27"] = "state government department or agency";
$_LANG["hxflagsmytldregistrantorganisationtype28"] = "trade union";
$_LANG["hxflagsmytldregistrantorganisationtype29"] = "trustee";
$_LANG["hxflagsmytldregistrantorganisationtype30"] = "university under the administration of ministry of education";
$_LANG["hxflagsmytldregistrantorganisationtype31"] = "valuer, appraiser, estate agent firm";

// .NYC
// Options, Nexus Category
$_LANG["hxflagsnyctldnexuscategory1"] = "Natural Person - primary domicile with physical address in NYC";
$_LANG["hxflagsnyctldnexuscategory2"] = "Entity or Organization - primary domicile with physical address in NYC";
$_LANG["hxflagsnyctldnexuscategorydescr"] = "(P.O Boxes are prohibited, see <a href='####TAC####'>.nyc Nexus Policies</a>.)";

// .PRO
$_LANG["hxflagsprotldprofession"] = "Profession";
$_LANG["hxflagsprotldlicensenumber"] = "License Number";
$_LANG["hxflagsprotldauthority"] = "Authority";
$_LANG["hxflagsprotldauthoritywebsite"] = "Authority Website";

// .PT
$_LANG["hxflagspttldroid"] = "ROID";

// .RO
$_LANG["hxflagsrotldregistrantvatiddescr"] = "(required for EU countries AND for romanian registrants)";

// .RU
$_LANG["hxflagsrutldlegaltypeindiv"] = "Individual";
$_LANG["hxflagsrutldlegaltypeorg"] = "Organization";
$_LANG["hxflagsrutldregistrantbirthday"] = "Individuals Birthday";
$_LANG["hxflagsrutldregistrantbirthdaydescr"] = "(required for individuals)";
$_LANG["hxflagsrutldregistrantpassportdata"] = "Individuals Passport Data";
$_LANG["hxflagsrutldregistrantpassportdatadescr"] = "(required for individuals; including passport number, issue date, and place of issue)<br/><br/>";

// .SE
$_LANG["hxflagssetldidentificationnumberdescr"] = (
    "<div style='text-align:justify'><b>For individuals or companies located in Sweden</b> a valid Swedish personal or organizational number must be stated.<br/>" .
    "<b>For individuals and companies outside of Sweden</b> the ID number (e.g. Civic registration number, company registration number, or the equivalent) must be stated.</div>"
);

// .SG
$_LANG["hxflagssgtldrcbsingaporeid"] = "RCB Singapore ID";

// .SWISS
$_LANG["hxflagsswisstldregistrantenterpriseid"] = "Registrant Enterprise ID";
$_LANG["hxflagsswisstldregistrantenterpriseiddescr"] = "(must start with CHE and followed by 9 digits)";

// .SYDNEY
// Options, Nexus Category
$_LANG["hxflagssydneytldnexuscategorya"] = "Criteria A - New South Wales Entities";
$_LANG["hxflagssydneytldnexuscategoryb"] = "Criteria B - New South Wales Residents";
$_LANG["hxflagssydneytldnexuscategoryc"] = "Criteria C - Associated Entities";
$_LANG["hxflagssydneytldnexuscategorydescr"] = (
    "In order to register or renew a ####TLD#### domain name the Applicant or Registrant must satisfy one of the following Criteria A, B or C below:<br/><br/>" .
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
);

// .TEL
// Legal Type, Options
$_LANG["hxflagsteltldlegaltypenatural"] = "Natural Person";
$_LANG["hxflagsteltldlegaltypelegal"] = "Legal Person";
$_LANG["hxflagsteltldwhoisoptoutdescr"] = "(available for Legal Type `Natural`. Choose `No` to get WHOIS data limited to registrant name.)";
$_LANG["hxflagsteltldyesnoy"] = "Yes";
$_LANG["hxflagsteltldyesnon"] = "No";

// .TRAVEL
$_LANG["hxflagstraveltldtravelindustry"] = "Related to the Travel Industry";
$_LANG["hxflagstraveltldtravelindustrydescr"] = "(We acknowledge a relationship to the travel industry and that we are engaged in or plan to engage in activities related to travel.)";
$_LANG["hxflagstraveltldyesno1"] = "Yes";
$_LANG["hxflagstraveltldyesno0"] = "No";

// .US
// Options, Intended Use
$_LANG["hxflagsustldintendedusep1"] = "Business use for profit";
$_LANG["hxflagsustldintendedusep2"] = "Non-profit business / Club / Association / Religious Organization";
$_LANG["hxflagsustldintendedusep3"] = "Personal Use";
$_LANG["hxflagsustldintendedusep4"] = "Educational purposes";
$_LANG["hxflagsustldintendedusep5"] = "Government purposes";
// Options, Nexus Category, https://www.about.us/policies/ustld-nexus-codes
$_LANG["hxflagsustldnexuscategoryc11"] = "A natural person who is a United States Citizen";
$_LANG["hxflagsustldnexuscategoryc12"] = "A natural person who is a permanent resident of the United States of America, or any of its possessions or territories";
$_LANG["hxflagsustldnexuscategoryc21"] = (
    "A U.S.-based organization or company formed within one of the fifty (50) U.S. states, the District of Columbia, or any of the United States " .
    "possessions or territories; or organized or otherwise constituted under the laws of a state of the United States of America, the District of " .
    "Columbia or any of its possessions or territories or a U.S. federal, state, or local government entity or a political subdivision thereof"
);
$_LANG["hxflagsustldnexuscategoryc31"] = (
    "A foreign entity or organization that has a bona fide presence in the United States of America or any of its possessions or territories who " .
    "regularly engages in lawful activities / sales of goods or services or other business, commercial or non-commercial, including not-for-profit relations in the United States"
);
$_LANG["hxflagsustldnexuscategoryc32"] = "A foreign entity that has an office or other facility in the United States";
$_LANG["hxflagsustldnexuscountrydescr"] = "<div>Specify registrant's origin citizenship (in case of last two Nexus Category Options (C31 or C32)).</div>";

// .XXX
$_LANG["hxflagsxxxtldnonresolvingdomain"] = "NON-Resolving Domain";
$_LANG["hxflagsxxxtldmembershipid"] = ".XXX Membership ID";
$_LANG["hxflagsxxxtldmembershipiddescr"] = "(Required in order to make your .XXX domain resolving)";
// Options, Non-Resolving Domain
$_LANG["hxflagsxxxtldnonresolvingdomain0"] = "No - This domain SHOULD resolve";
$_LANG["hxflagsxxxtldnonresolvingdomain1"] = "Yes - This domain SHOULD NOT resolve";

// ----------------------------------------------------------------------
// ----------------------- OWNER CHANGE ---------------------------------
// ----------------------------------------------------------------------
$_LANG["traderequestedsuccessfully"] = "The Trade has been requested successfully.";
$_LANG["ownerchangeproceduresimple"] = "The Change of Registrant for this TLD requires a special procedure called `Trade`. Registrant Contact will be replaced.";
$_LANG["ownerchangeprocedureextended"] = "The Change of Registrant for this TLD requires a special procedure called `Trade`. Registrant and Admin Contact will be replaced.";
$_LANG["ownerchange"] = "Change of Registrant";
$_LANG["bttnsendtrade"] = "Send Trade";
$_LANG["errormissingfields"] = "Missing data for the below mandatory fields:";
