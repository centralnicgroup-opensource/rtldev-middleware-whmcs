<?php
// #########################################################################
// # Add translations for ISPAPI registrar module additional domain fields #
// #########################################################################

// Terms and Conditions Fields, prefixed with hxflagstac
$_LANG["hxflagstacagreement"] = "Vereinbarung";
$_LANG["hxflagstacagreementindiv"] = "Bedingungen für Privatpersonen";
$_LANG["hxflagstactrustee"] = "Treuhandservice";
$_LANG["hxflagstachighlyregulated"] = "Stark Regulierte TLD";
$_LANG["hxflagstachighlyregulateddescrdefault"] = (
    "Bestätigen Sie, daß der Registrant berechtigt ist diese Domain zu registrieren und daß alle angegebenen Daten korrekt und wahrheitsgemäß sind." .
    "Berechtigungskriterien können <a href='####TAC####' target='_blank'>hier</a> eingesehen werden."
);
$_LANG["hxflagstachighlyregulateddescreco"] = (
    $_LANG["hxflagstachighlyregulateddescrdefault"] .
    "<br/>Alle .ECO Domainnamen werden erst Status \"server hold\" registriert, bis zur Vervollständing/Erfüllung der Minimumanforderungen des .ECO Profils. " .
    "D.h. der .ECO Registrant 1) sichert die Einhaltung der .ECO Berechtigungskriterien zu und 2) verspricht eine positive Änderung für den Planeten zu unterstützen " .
    "und bei jeglichen Umweltmaßnahmen wahrheitsgemäße Informationen weiterzugeben. Der Registrant wird per Email informiert, " .
    "wie ein .ECO Profil zu erstellen ist. Sobald dieser Schritt erfolgt ist, wird die .ECO Domain umgehend seitens der Registrierungsstelle aktiviert."
);
$_LANG["hxflagstachighlyregulateddescrnotac"] = (
    "Bestätigen Sie die <b>Schutzmaßnahmen für stark regulierte TLDs</b> anzuerkennen:<br/>" .
    "<div style='text-align:justify'>Sie verstehen und akzeptieren die Zusatzbedingungen zu beachten und zu befolgen:" .
    "<ol><li>Daten des administrativen Kontakts. Sie stimmen zu aktuelle Daten des administrativen Kontakts anzugeben und diese aktuell zu halten, " .
    "um Benachrichtigungen über Beschwerden oder Registrierungsmissbrauchsmeldungen erhalten zu können, als auch Kontaktdaten verantwortlicher / " .
    " branchen-selbstreguliernder Stellen in ihrem Hauptunternehmenssitz.</li>" .
    "<li>Vertretung. Sie bestätigen jegliche Berechtigungen, Urkunden, Lizenzen und/oder andere ähnliche Mitwirkungsberechtigungen " .
    "in der Branche einer solchen stark regulierten TLD zu besitzen.</li>" .
    "<li>Änderung der Berechtigungen, Urkunden, Lizenzen und Mitwirkungsberechtigungen. Sie bestätigen wesentliche Änderungen der Gültigkeit dieser Daten zu melden, " .
    " um sicherzustellen, daß Sie weiterhin den Bestimmungen und Zulassungsvorschriften entsprechen und Ihre Aktivitäten in den Interessen Ihrer Kunden ausüben." .
    "</li>" .
    "</ol></div>"
);
$_LANG["hxflagstacindividualregulateddescrdefault"] = "Bestätigen Sie die <a href='####TAC####' target='_blank'>Richtlinien für Privatpersonen</a> anzuerkennen.";//
$_LANG["hxflagstacregulateddescrdefault"] = "Bestätigen Sie die <a href='####TAC####' target='_blank'>Registrierungsbedingungen der Registrierungsstelle</a> bzgl. Neuregistrierung von ####TLD#### Domainnamen anzuerkennen.";//
$_LANG["hxflagstacregulateddescrngo"] = (
    "Bestätigen Sie die <a href='####TAC####' target='_blank'>Registrierungsbedingungen der Registrierungsstelle</a> bzgl. Neuregistrierung von ####TLD#### Domainnamen anzuerkennen." .
    "<div style='padding:10px 0px;'>Mit der Registrierung einer .NGO Domain erhalten Sie auch gleichzeitig und ohne zusätzliche Kosten eine .ONG Domain. " .
    "Änderungen an der .NGO Domain werden auch automatisch bei der .ONG Domain durchgeführt.</div>"
);
$_LANG["hxflagstacregulateddescritsection3"] = (
    "Bestätigen Sie <b><a href='####TAC####' target='_blank'>Abschnitt 3 - Declarations and assumptions of liability</a></b> anzuerkennen.<br/>" .
    "<div style='text-align:justify;margin-bottom:10px;'>" .
    "Der Registrant des betreffenden Domainnamens erklärt in eignerer Verantwortung folgende Punkte zu erfüllen:" .
    "<ul><li>Im Falle einer Registrierung für eine Privatperson: Im Besitz der Staatsbürgerschaft oder eines Wohnsitzes in der Europäischen Union zu sein</li>" .
    "<li>Im Falle einer Registrierung für andere Firmen: In der Europäischen Union etabliert zu sein.</li>" .
    "<li>Zu wissen und zu akzeptieren, dass die Registrierung und Verwaltung eines Domainnamens den <a href='https://www.nic.it/en/manage-your-it/forms-and-docs' target='_blank'>" .
    "'Management of synchronous operations on domain names of the ccTLD.it - Guidelines'</a> und den <a href='https://www.nic.it/en/manage-your-it/forms-and-docs' target='_blank'>" .
    "'Dispute resolution in the ccTLD.it - Regulations & Guidelines'</a> und deren späteren Änderungen unterliegt.</li>" .
    "<li>Zur Nutzung und/oder rechtliche Verwaltung des beantragten Domainnames berechtigt zu sein und den Rechten Anderer mit der Registrierungsanfrage nicht zu schaden.</li>" .
    "<li>Zu wissen, dass der Aufnahme persönlicher Daten in der Datenbank zugeordneter Domains, und deren möglicher Verbreitung und Einsehbarkeit über das Internet, explizit über die " .
    "Aktivierung entsprechenden Ankreuzfelder zugestimmt werden muss. Siehe <a href='https://www.nic.it/en/manage-your-it/forms-and-docs' target='_blank'>'DBNA and WHOIS Policy'</a>.</li>" .
    "<li>Zu wissen und zu akzeptieren, dass die Registierungsstelle umgehend den Domainnamen im Falle fehlerhafter oder falscher Angaben in dieser Anfrage widerrufen wird oder andere " .
    "rechtliche Schritte einleiten wird. In einem solchen Fall wird der Widerruf in keinster Weise Anlass geben gegen die Registrierungsstelle zu klagen.</li>" .
    "<li>Die Registrierungsstelle von jeglicher Verantwortung entstehend aus der Zuweisung und Nutzung der Domainnamens durch die Privatperson, die die Anfrage gestellt hat, zu entbinden.</li>" .
    "<li>Italienische Rechtsprechung und Gesetze des Staates Italien zu akzeptieren.</li></ul></div>"
);
$_LANG["hxflagstacregulateddescritsection5"] = (
    "Bestätigen Sie <b><a href='####TAC####' target='_blank'>Abschnitt 5 - Consent to the processing of personal data for registration</b></a> anzuerkennen.<br/>" .
    "<div style='text-align:justify;margin-bottom:10px;'>" .
    "Der Interessent erteilt nach der Lektüre o.g. Veröffentlichung sein Einverständnis zur für die Registrierung notwendigen Datenverarbeitung, gemäß dieser Veröffentlichung." .
    "Die Einwilligung ist kein Muss. Wird diese nicht erteilt, so kann die Registrierung, Zuweisung und Verwaltung des Domainnamens nicht abgeschlossen werden.</div>"
);
$_LANG["hxflagstacregulateddescritsection6"] = (
    "Bestätigen Sie <b><a href='####TAC####' target='_blank'>Abschnitt 6 - Consent to the processing of personal data for diffusion and accessibility via the Internet</b></a> anzuerkennen.<br/>" .
    "<div style='text-align:justify;margin-bottom:10px;'>" .
    "Der Interessent erteilt nach Lektüre o.g. Veröffentlichung sein Einverständnis zur Verbreitung und Einsehbarkeit der Daten über das Internet gemäßt dieser Veröffentlichung." .
    "Die Einwilligung ist kein Muss. Wird diese nicht erteilt, ist die Verbreitung und Einsehbarkeit der Daten über das Internet nicht erlaubt.</div>"
);
$_LANG["hxflagstacregulateddescritsection7"] = (
    "Bestätigen Sie <b><a href='####TAC####' target='_blank'>Abschnitt 7 - Explicit Acceptance of the following points</b></a> anzuerkennen.<br/>" .
    "<div style='text-align:justify;margin-bottom:10px;'>" .
    "Zur ausdrücklichen Zustimmung erklärt der Interessent:" .
    "<ul><li>d) zu wissen und zu akzeptieren, dass die Registrierung und Verwaltung eines Domainnamens den <a href='https://www.nic.it/en/manage-your-it/forms-and-docs' target='_blank'>" .
    "'Management of synchronous operations on domain names of the ccTLD.it - Guidelines'</a> und den <a href='https://www.nic.it/en/manage-your-it/forms-and-docs' target='_blank'>" .
    "'Dispute resolution in the ccTLD.it - Regulations & Guidelines'</a> und deren späteren Änderungen unterliegt.</li>" .
    "<li>e) Zu wissen und zu akzeptieren, dass die Registierungsstelle umgehend den Domainnamen im Falle fehlerhafter oder falscher Angaben in dieser Anfrage widerrufen wird oder andere " .
    "rechtliche Schritte einleiten wird. In einem solchen Fall wird der Widerruf in keinster Weise Anlass geben gegen die Registrierungsstelle zu klagen.</li>" .
    "<li>f) Die Registrierungsstelle von jeglicher Verantwortung entstehend aus der Zuweisung und Nutzung der Domainnamens durch die Privatperson, die die Anfrage gestellt hat, zu entbinden.</li>" .
    "<li>g) Italienische Rechtsprechung und Gesetze des Staates Italien zu akzeptieren.</li></ul></div>"
);

// Generic Fields
$_LANG["hxflagsyesnoyes"] = "Ja";
$_LANG["hxflagsyesnono"] = "Nein";
$_LANG["hxflagsyesnoy"] = "Ja";
$_LANG["hxflagsyesnon"] = "Nein";
$_LANG["hxflagsyesno1"] = "Ja";
$_LANG["hxflagsyesno0"] = "Nein";

$_LANG["hxflagslegaltype"] = "Rechtsform";
$_LANG["hxflagslegaltypeindiv"] = "Privatperson";
$_LANG["hxflagslegaltypeorg"] = "Unternehmen";
$_LANG["hxflagsintendeduse"] = "Verwendungszweck";
$_LANG["hxflagsregistrantidnumber"] = "Registrant, Identifikationsnr.";
$_LANG["hxflagsregistrantvatid"] = "Registrant, Steuernr.";
$_LANG["hxflagsadminidnumber"] = "Admin-C, Identifikationsnr.";
$_LANG["hxflagsadminvatid"] = "Admin-C, Steuernr.";
$_LANG["hxflagstechidnumber"] = "Tech-C, Identifikationsnr.";
$_LANG["hxflagstechvatid"] = "Tech-C Steuernr.";
$_LANG["hxflagsbillingidnumber"] = "Billing-C, Identifikationsnr.";
$_LANG["hxflagsregistrantidtype"] = "Registrant, Ursprung der Identifikationsnr.";
$_LANG["hxflagsallocationtoken"] = "Bestellschlüssel der Registrierungsstelle";
$_LANG["hxflagsallocationtokendescr"] = (
    "Um eine ####TLD#### Domain zu registrieren, müssen Sie den durch Registrierungsstelle ausgestellten Bestellschlüssel angeben. " .
    "Füllen Sie bitte <a href='####TAC####' target='_blank'>hier</a> den Antrag aus, um den Schlüssel zu erhalten."
);
$_LANG["hxflagsnexuscategory"] = "Nexus Kategorie";
$_LANG["hxflagsnexuscountry"] = "Nexus Länderschlüssel";
$_LANG["hxflagsfax"] = "Fax benötigt";
$_LANG["hxflagsfaxdescr"] = "Ich versichere <a href='####TAC####'>dieses Formular</a> auszufüllen und zu übersenden, um den Registrierungsprozess abzuschließen.";
$_LANG["hxflagsidentificationnumber"] = "Identifikationsnr.";
$_LANG["hxflagswhoisoptout"] = "WHOIS Widerspruch";
$_LANG["hxflagsregistrantbirthdate"] = "Registrant, Geburtsdatum";

// AFNIC TLDs, prefixed with hxflagsafnic
$_LANG["hxflagsafnictldvatid"] = "Steuernr. oder SIREN/SIRET Nr.";
$_LANG["hxflagsafnictldvatiddescr"] = "(Nur für Unternehmen mit Steuernr. oder SIREN/SIRET Nr.)";
$_LANG["hxflagsafnictldtrademark"] = "Markenzeichennr.";
$_LANG["hxflagsafnictldtrademarkdescr"] = "(Nur für Unternehmen mit europäischer Marke)";
$_LANG["hxflagsafnictldduns"] = "DUNS Nr.";
$_LANG["hxflagsafnictlddunsdescr"] = "(Nur für Unternehmen mit DUNS Nr.)";
$_LANG["hxflagsafnictldlocalid"] = "Regionale Kennung";
$_LANG["hxflagsafnictldlocaliddescr"] = "(Nur für Unternehmen mit regionaler Kennung)";
// French Association, Data from Journal officiel [JO]
$_LANG["hxflagsafnictldjodod"] = "Datum der Ankündigung [JO]";
$_LANG["hxflagsafnictldjododdescr"] = "(Nur für französische Verbände, Format <b>JJJJ-MM-TT</b>)";
$_LANG["hxflagsafnictldjonumber"] = "Nummer [JO]";
$_LANG["hxflagsafnictldjonumberdescr"] = "(Nur für französische Verbände, Nr. des Journal Officiel)</div>";
$_LANG["hxflagsafnictldjopage"] = "Seite der Ankündigung [JO]";
$_LANG["hxflagsafnictldjopagedescr"] = "(Nur für französische Verbände, Seite der Ankündigung im Journal Officiel)";
$_LANG["hxflagsafnictldjodop"] = "Datum der Veröffentlichung [JO]";
$_LANG["hxflagsafnictldjodopdescr"] = "(Nur für französische Verbände, Veröffentlichungsdatum im Format <b>JJJJ-MM-TT</b>)";
// Options, Legal Type
$_LANG["hxflagsafnictldlegaltypeindiv"] = "Privatperson";
$_LANG["hxflagsafnictldlegaltypeorg1"] = "Unternehmen mit Steuernr. oder SIREN/SIRET Nr.";
$_LANG["hxflagsafnictldlegaltypeorg2"] = "Unternehmen mit europäischer Marke";
$_LANG["hxflagsafnictldlegaltypeorg3"] = "Unternehmen mit DUNS Nr.";
$_LANG["hxflagsafnictldlegaltypeorg4"] = "Unternehmen mit regionaler Kennung";
$_LANG["hxflagsafnictldlegaltypeass"] = "Französischer Verband";

// .AERO
$_LANG["hxflagsaerotldaeroid"] = ".AERO ID";
$_LANG["hxflagsaerotldaerokey"] = ".AERO Key";

// .CA
$_LANG["hxflagscatldcontactlanguage"] = "Kontaktsprache";
// Options, Legal Type
$_LANG["hxflagscatldlegaltypecco"] = "Unternehmen";
$_LANG["hxflagscatldlegaltypecct"] = "Kanadischer Staatsbürger";
$_LANG["hxflagscatldlegaltyperes"] = "Ständiger Wohnsitz in Kanada";
$_LANG["hxflagscatldlegaltypegov"] = "Regierung oder Regierungsbehörde in Kanada";
$_LANG["hxflagscatldlegaltypeedu"] = "Kanadische Bildungseinrichtung";
$_LANG["hxflagscatldlegaltypeass"] = "Kanadischer, nicht eingetragener Verein";
$_LANG["hxflagscatldlegaltypehos"] = "Kanadisches Krankenhaus";
$_LANG["hxflagscatldlegaltypeprt"] = "In Kanada eingetragene Partnerschaft";
$_LANG["hxflagscatldlegaltypetdm"] = "In Kanada registrierte Marke (durch einen nicht-kanadischen Inhaber)";
$_LANG["hxflagscatldlegaltypetrd"] = "Kanadische Handelsgesellschaft";
$_LANG["hxflagscatldlegaltypeplt"] = "Kanadische, politische Partei";
$_LANG["hxflagscatldlegaltypelam"] = "Kanadisches Bibliotheksarchiv oder Museum";
$_LANG["hxflagscatldlegaltypetrs"] = "In Kanada etablierter Konzern";
$_LANG["hxflagscatldlegaltypeabo"] = "Ureinwohner (Einzelpersonen oder Gruppen) uransässig in Kanada";
$_LANG["hxflagscatldlegaltypeinb"] = "Durch den Indian Act Kanadas anerkannter Indianischer Stamm";
$_LANG["hxflagscatldlegaltypelgr"] = "Rechtlicher Vertreter eines kanadischen Staatsbürgers oder ständigen Bewohners";//
$_LANG["hxflagscatldlegaltypeomk"] = "Offzielle in Kanada registrierte Marke";
$_LANG["hxflagscatldlegaltypemaj"] = "Ihre Majestät die Königin";

// .CN
// Options, Registrant ID Type
$_LANG["hxflagscntldregistrantidtypesfz"] = "Chinesischer Personalausweis";
$_LANG["hxflagscntldregistrantidtypehz"] = "Ausländischer Reisepass";
$_LANG["hxflagscntldregistrantidtypegajmtx"] = "Ausreise-Einreise Erlaubnis zur Reise nach Hong Kong und Macao und zurück";
$_LANG["hxflagscntldregistrantidtypetwjmtx"] = "Reisepässe für Bewohner Taiwans um das Festland zu betreten oder zu belassen";
$_LANG["hxflagscntldregistrantidtypewjlsfz"] = "Ausländischer Personalausweis";
$_LANG["hxflagscntldregistrantidtypegajzz"] = "Wohnsitzerlaubnis für Bewohner von Hong Kong und Macao";
$_LANG["hxflagscntldregistrantidtypetwjzz"] = "Wohnsitzerlaubnis für Bewohner von Taiwan";
$_LANG["hxflagscntldregistrantidtypejgz"] = "Amtliches chinesisches Zertifikat";
$_LANG["hxflagscntldregistrantidtypeorg"] = "CCC Zertifikat";
$_LANG["hxflagscntldregistrantidtypeyyzz"] = "Chinesische Gewerbeerlaubnis";
$_LANG["hxflagscntldregistrantidtypetydm"] = "USCC Zertifikat";
$_LANG["hxflagscntldregistrantidtypebddm"] = "Militärische Code-Bezeichnung";
$_LANG["hxflagscntldregistrantidtypejddwfw"] = "Militärisch-bezahlte, ausländische Service-Lizenz";
$_LANG["hxflagscntldregistrantidtypesydwfr"] = "Zertifikat einer juristischen Person der öffentlichen Einrichtung";
$_LANG["hxflagscntldregistrantidtypewgczjg"] = "Registrierungsformular für Ansässige Vertretungen ausländischer Unternehmen";
$_LANG["hxflagscntldregistrantidtypeshttfr"] = "Registrierungszertifikat einer juristischen Person einer sozialen Einrichtung";
$_LANG["hxflagscntldregistrantidtypezjcs"] = "Registrierungszertifikat einer relgiösen Aktivitätsseite";
$_LANG["hxflagscntldregistrantidtypembfqy"] = "Registrierungszertifikat einer privaten Nichtunternehmenseinheiten";
$_LANG["hxflagscntldregistrantidtypejjhfr"] = "Registrierungszertifikat einer juristische Person einer Stiftung";
$_LANG["hxflagscntldregistrantidtypelszy"] = "Ausübungszertifikat einer Kanzlei";
$_LANG["hxflagscntldregistrantidtypewgzhwh"] = "Registrierungszertifikat eines ausländischen Kulturzentrums in China";
$_LANG["hxflagscntldregistrantidtypewlczjg"] = "Registrierungszertifikat für ansässige Vertretungen der Touristenabteilungen einer ausländischen Regierung";
$_LANG["hxflagscntldregistrantidtypesfjd"] = "Zertifikat einer juristische Ausbildung";
$_LANG["hxflagscntldregistrantidtypejwjg"] = "Zertifikat eines Unternehmens im Ausland";
$_LANG["hxflagscntldregistrantidtypeshfwjg"] = "Registrierungszertifikat einer Sozialdienstagentur";
$_LANG["hxflagscntldregistrantidtypembxxbx"] = "Erlaubnis einer Privatschule";
$_LANG["hxflagscntldregistrantidtypeyljgzy"] = "Ausübungszertifikat einer medizinischen Einrichtung";
$_LANG["hxflagscntldregistrantidtypegzjgzy"] = "Ausübungszertifikat eines notoriellen Unternehmens";
$_LANG["hxflagscntldregistrantidtypebjwsxx"] = "Erlaubnis der Schule für Kinder ausländischer Botschaftsmitarbeiter in Beijing/China";//
$_LANG["hxflagscntldregistrantidtypeqt"] = "Sonstiges";

// .COM.AU
// Options, Registrant ID Type
$_LANG["hxflagscomautldregistrantidtypeabn"] = "Australische Steuernummer";
$_LANG["hxflagscomautldregistrantidtypeacn"] = "Australische Firmennummer";
$_LANG["hxflagscomautldregistrantidtyperbn"] = "Handelsregisternummer";
$_LANG["hxflagscomautldregistrantidtypertm"] = "Markennummer";

// .COM.BR
$_LANG["hxflagscombrtldidentificationnumberdescr"] = "Bitte geben Sie Ihre CPF oder CNPJ Nummern an, welche Ihnen das staatlische Finanzministerium Brasiliens für steuerliche Zwecke ausstellt.";

// .DE
$_LANG["hxflagsdetldgeneralrequestcontact"] = "Kontakt für allg. Anfragen";
$_LANG["hxflagsdetldabuseteamcontact"] = "Kontakt für Missbrauchsmeldungen";
$_LANG["hxflagsdetldgeneralrequestcontactdescr"] = "Sie können eine Email- oder Webseitenadresse angeben";
$_LANG["hxflagsdetldabuseteamcontactdescr"] = "Sie können eine Email- oder Webseitenadresse angeben";

// .DK
$_LANG["hxflagsdktldregistrantcontact"] = "Registrant, Kontakt";
$_LANG["hxflagsdktldadmincontact"] = "Admin, Kontakt";
$_LANG["hxflagsdktldlegaltypeindividual"] = "Privatperson";
$_LANG["hxflagsdktldlegaltypeorganization"] = "Unternehmen";
$_LANG["hxflagsdktldlegaltypedescr"] = "Wählen Sie bitte auch `Privatperson` un Falle eines Kleinunternehmens ohne Umsatzsteuer-ID-Nr.";
$_LANG["hxflagsdktldcontactdescr"] = "DK-HOSTMASTER Benutzer ID";

// .ES
$_LANG["hxflagsestldregistranttype"] = "Registrant, Typ";
$_LANG["hxflagsestldregistrantidentificationnumber"] = "Registrant, Identifikationsnr.";
$_LANG["hxflagsestldadmintype"] = "Admin-C, Typ";
$_LANG["hxflagsestldadminidentificationnumber"] = "Admin-C, Identifikationsnr.";
// Options, Legal Type
$_LANG["hxflagsestldlegaltype1"] = "Privatperson";
$_LANG["hxflagsestldlegaltype39"] = "Wirtschaftliche Interessenvereinigung";
$_LANG["hxflagsestldlegaltype47"] = "Verband";
$_LANG["hxflagsestldlegaltype59"] = "Sportverein";
$_LANG["hxflagsestldlegaltype68"] = "Fachverband";
$_LANG["hxflagsestldlegaltype124"] = "Sparkasse";
$_LANG["hxflagsestldlegaltype150"] = "Gemeinschaftsgut";
$_LANG["hxflagsestldlegaltype152"] = "Eigentümergemeinschaft";
$_LANG["hxflagsestldlegaltype164"] = "Orden oder religiöse Einrichtung";
$_LANG["hxflagsestldlegaltype181"] = "Konsulat";
$_LANG["hxflagsestldlegaltype197"] = "Verband des öffentlichen Rechts";
$_LANG["hxflagsestldlegaltype203"] = "Botschaft";
$_LANG["hxflagsestldlegaltype229"] = "Komunalverwaltung";
$_LANG["hxflagsestldlegaltype269"] = "Sportbund";
$_LANG["hxflagsestldlegaltype286"] = "Stiftung";
$_LANG["hxflagsestldlegaltype365"] = "Gegenseitigkeitsversicherungsgesellschaft";
$_LANG["hxflagsestldlegaltype434"] = "Landesregierungsbehörde";
$_LANG["hxflagsestldlegaltype436"] = "Zentrale Regierungsbehörde";
$_LANG["hxflagsestldlegaltype439"] = "Politische Partei";
$_LANG["hxflagsestldlegaltype476"] = "Handelsgesellschaft";
$_LANG["hxflagsestldlegaltype510"] = "Landwirtschaftliche Partnerschaft";
$_LANG["hxflagsestldlegaltype524"] = "Aktiengesellschaft";
$_LANG["hxflagsestldlegaltype525"] = "Sportverein";
$_LANG["hxflagsestldlegaltype554"] = "Zivilgesellschaft";
$_LANG["hxflagsestldlegaltype560"] = "Allgemeine Partnerschaft";
$_LANG["hxflagsestldlegaltype562"] = "Allgemeine und beschränkte Partnerschaft";
$_LANG["hxflagsestldlegaltype566"] = "Genossenschaft";
$_LANG["hxflagsestldlegaltype608"] = "Unternehmen im Belegschaftsbesitz";
$_LANG["hxflagsestldlegaltype612"] = "Aktiengesellschaft";
$_LANG["hxflagsestldlegaltype713"] = "Spanisches Amt";
$_LANG["hxflagsestldlegaltype717"] = "Vorübergehende Unternehmenskooperation";
$_LANG["hxflagsestldlegaltype744"] = "Aktiengesellschaft im Belegschaftsbesitz";
$_LANG["hxflagsestldlegaltype745"] = "Regionale öffentliche Einrichtung";
$_LANG["hxflagsestldlegaltype746"] = "Nationale öffentliche Einrichtung";
$_LANG["hxflagsestldlegaltype747"] = "Lokale öffentliche Einrichtung";
$_LANG["hxflagsestldlegaltype878"] = "Herkunftsbezeichnung Aufsichtsrat";
$_LANG["hxflagsestldlegaltype879"] = "Managing Naturräume verwaltenden Entität";
$_LANG["hxflagsestldlegaltype877"] = "Sonstiges";
// Options, Registrant ID Type
$_LANG["hxflagsestldregistrantidtype0"] = "Nicht-spanischer Besitzer";
$_LANG["hxflagsestldregistrantidtype1"] = "Spanische Privatperson oder Firma";
$_LANG["hxflagsestldregistrantidtype3"] = "Meldebescheinigung der Ausländerbehörde";
$_LANG["hxflagsestldadminidtype0"] = "Nicht-spanische Entität";
$_LANG["hxflagsestldadminidtype1"] = "Spanische Privatperson oder Firma";
$_LANG["hxflagsestldadminidtype3"] = "Meldebescheinigung der Ausländerbehörde";

// .EU
$_LANG["hxflagseutldregistrantcitizenship"] = "Registrant, Staatsangehörigkeit";
$_LANG["hxflagseutldregistrantcitizenshipdescr"] = "Benötigt für europäische Statsbürger wohnhaft außerhalb der EU";

// .FI
$_LANG["hxflagsfitldregistrantidnumberdescr"] = (
    "<ul><li>Unternehmen: Bitte die Handelsregistrierungsnr. angeben.</li>" .
    "<li>Privatpersonen aus Finland: Bitte die Ausweisnr. angeben.</li>" .
    "<li>Sonstige Privatpersonen: Nichts angeben.</li></ul>" .
    "Die Eingabe für Privatpersonen muss aus elf Zeichen der Form TTMMJJCZZZQ erfolgen. " .
    "<ul><li>TTMMJJ: Geburtsdatum</li>" .
    "<li>C: Jahrhundertzeichen `+` für 1800–1899, `-` für 1900–1999 oder `A` für 2000-2099</li>" .
    "<li>ZZZ: die Individuelle Nummer - ungerade für Männer, gerade für Frauen und für in Finland Geborene der Bereich 002-899 (In Ausnahmefällen auch größere Nummern).</li>" .
    "<li>Q: dem Kontrollzeichen (checksum).</li></ul>An example of a valid code is 311280-888Y."
);
$_LANG["hxflagsfitldregistrantbirthdatedescr"] = "(YYYY-MM-DD; only required for Individuals not from Finland)";

// .HK
$_LANG["hxflagshktldregistrantdocumenttype"] = "Registrant, Dokumenttyp";
$_LANG["hxflagshktldregistrantotherdocumenttype"] = "Registrant, anderer Dokumenttyp";
$_LANG["hxflagshktldregistrantdocumentnumber"] = "Registrant, Dokumentnr.";
$_LANG["hxflagshktldregistrantdocumentorigincountry"] = "Registrant, Ausstellungsland des DoKuments";
$_LANG["hxflagshktldregistrantbirthdateforindividuals"] = "Registrant, Geburtsdatum für Privatpersonen";
// Options, Registrant Document Type
$_LANG["hxflagshktldregistrantdocumenttypehkid"] = "Privatperson - Hong Kong Ausweisnummer";
$_LANG["hxflagshktldregistrantdocumenttypeothid"] = "Privatperson - Ausweisnummer eines anderen Landes";
$_LANG["hxflagshktldregistrantdocumenttypepassno"] = "Privatperson - Reisepassnummer";
$_LANG["hxflagshktldregistrantdocumenttypebirthcert"] = "Privatperson - Geburtsurkunde";
$_LANG["hxflagshktldregistrantdocumenttypeothidv"] = "Privatperson - Sonstiges Dokument";
$_LANG["hxflagshktldregistrantdocumenttypebr"] = "Unternehmen - Urkunde der Gewerbeanmeldung";
$_LANG["hxflagshktldregistrantdocumenttypeci"] = "Unternehmen - Gründungsurkunde";
$_LANG["hxflagshktldregistrantdocumenttypecrs"] = "Unternehmen - Registrierungsbescheinigung einer Schule";
$_LANG["hxflagshktldregistrantdocumenttypehksarg"] = "Unternehmen - Hong Kong Sonderverwaltungsregion einer Regierungsabteilung";
$_LANG["hxflagshktldregistrantdocumenttypehkordinance"] = "Unternhemen - Verordnung von Hong Kong";
$_LANG["hxflagshktldregistrantdocumenttypeothorg"] = "Unternehmen - Sonstiges Dokument";
$_LANG["hxflagshktldregistrantdocumenttypedescr"] = (
    "(HINWEIS: Zusätzlich könnte es erforderlich sein, dass Sie uns eine Kopie des Dokuments per Email zusenden müssen. Für .HK ist dieser Schritt nur notwendig " .
    "auf Anfrage der Registrierungsstelle. Für .COM.HK wird die Gewerbeerlaubnis benötigt, bevor der Registrierungsanfrage bearbeitet werden kann.)"
);
$_LANG["hxflagshktldregistrantotherdocumenttypedescr"] = "(für vorige Typauswahl `Privatperson/Unternehmen - Sonstiges Dokument` benötigt)";
$_LANG["hxflagshktldregistrantbirthdateforindividualsdescr"] = "(benötigt für Privatpersonen, Format JJJJ-MM-TT)";

// .IE
$_LANG["hxflagsietldregistrantclass"] = "Registrant, Klassifizierung";
$_LANG["hxflagsietldproofofconnectiontoireland"] = "Ihre Verbindung zu Irland";
$_LANG["hxflagsietldproofofconnectiontoirelanddescr"] = (
    "Geben Sie bitte alle Daten zur Stützung Ihrer Registrierungsanfrage an, wie den Verbindungsnachweis (z.B. ".
    "VAT, RBN, CRO, CHY, NIC oder Markennummer; Schulrollennummer; Link zur Social-Media-Seite oder eine ".
    "kurze Erklärung warum und wofür Sie diese Domain registrieren möchten)."
);
// Options, Registrant Class
$_LANG["hxflagsietldregistrantclasscompany"] = "Unternehmen";
$_LANG["hxflagsietldregistrantclassbusinessowner"] = "Geschäftsinhaber";
$_LANG["hxflagsietldregistrantclassclubbandlocalgroup"] = "Klub/Band/Ortsverband";
$_LANG["hxflagsietldregistrantclassschoolcollege"] = "Schule/Hochschule";
$_LANG["hxflagsietldregistrantclassstateagency"] = "Staatliche Behörde";
$_LANG["hxflagsietldregistrantclasscharity"] = "Stiftung";
$_LANG["hxflagsietldregistrantclassbloggerother"] = "Blogger/Sonstiges";

// .IT
$_LANG["hxflagsittldpin"] = "PIN";

// .JOBS
$_LANG["hxflagsjobstldwebsite"] = "Webseite";
$_LANG["hxflagsjobstldindustryclassification"] = "Branchenklassifizierung";
$_LANG["hxflagsjobstldmemberofahrassociation"] = "Mitglied eines HR Verbandes";
$_LANG["hxflagsjobstldcontactjobtitle"] = "Kontakt, Berufsbezeichnung (e.g. CEO)";
$_LANG["hxflagsjobstldcontacttype"] = "Kontakt, Typ";
// Options, Industry Classification
$_LANG["hxflagsjobstldindustryclassification2"] = "Buchhaltung/Bankwesen/Finanzwesen";
$_LANG["hxflagsjobstldindustryclassification3"] = "Agrar-/Landwirtschaft";
$_LANG["hxflagsjobstldindustryclassification21"] = "Biotechnik/Wissenschaft";
$_LANG["hxflagsjobstldindustryclassification5"] = "Computertechnik/Informationstechnologie";
$_LANG["hxflagsjobstldindustryclassification4"] = "Bauleistungen";
$_LANG["hxflagsjobstldindustryclassification12"] = "Beratung";
$_LANG["hxflagsjobstldindustryclassification6"] = "Bildung/Fortbildung/Bibliothek";
$_LANG["hxflagsjobstldindustryclassification7"] = "Unterhaltungsindustrie";
$_LANG["hxflagsjobstldindustryclassification13"] = "Umweltbranche";
$_LANG["hxflagsjobstldindustryclassification19"] = "Hotelbranche";
$_LANG["hxflagsjobstldindustryclassification10"] = "Regierung/Bürgerdienst";
$_LANG["hxflagsjobstldindustryclassification11"] = "Gesundheitswesen";
$_LANG["hxflagsjobstldindustryclassification15"] = "Personalwesen/HR";
$_LANG["hxflagsjobstldindustryclassification16"] = "Versicherungswesen";
$_LANG["hxflagsjobstldindustryclassification17"] = "Rechtsbranche";
$_LANG["hxflagsjobstldindustryclassification18"] = "Fertigung";
$_LANG["hxflagsjobstldindustryclassification20"] = "Medien/Werbung";
$_LANG["hxflagsjobstldindustryclassification9"] = "Parks & Freizeit";
$_LANG["hxflagsjobstldindustryclassification26"] = "Pharmaindustrie";
$_LANG["hxflagsjobstldindustryclassification22"] = "Immobilienbranche";
$_LANG["hxflagsjobstldindustryclassification14"] = "Restaurant/Nahrungsmitteldienstleistung";
$_LANG["hxflagsjobstldindustryclassification23"] = "Einzelhandel";
$_LANG["hxflagsjobstldindustryclassification8"] = "Telemarketing";
$_LANG["hxflagsjobstldindustryclassification24"] = "Transportindustrie";
$_LANG["hxflagsjobstldindustryclassification25"] = "Sonstiges";
// Options, Contact Type
$_LANG["hxflagsjobstldcontacttype1"] = "Administrativ";
$_LANG["hxflagsjobstldcontacttype0"] = "Sonstiges";

// .LOTTO
$_LANG["hxflagslottotldmembershipcontactid"] = "Mitglied, Kontakt ID";
$_LANG["hxflagslottotldverificationcode"] = "Verifizierungscode";

// .LT
$_LANG["hxflagslttldlegalentityidentificationcode"] = "Rechtsträger, Identifikationsnr.";

// .MELBOURNE
// Options, Nexus Category
$_LANG["hxflagsmelbournetldnexuscategorya"] = "Unternehmen von Victoria";
$_LANG["hxflagsmelbournetldnexuscategoryb"] = "Bewohner von Victoria";
$_LANG["hxflagsmelbournetldnexuscategoryc"] = "Assoziiertes Unternehmen";
$_LANG["hxflagsmelbournetldnexuscategorydescr"] = (
    "<div style='padding:10px 0px;text-align:justify'><b>Registrierungsberechtigung</b><br/>" .
    "Um eine Domain zu verlängern oder zu registrieren muss der Besitzer oder Registrant eine der folgenden Kriterien A, B oder C erfüllen:<br/><br/>".
    "<b>Kriterium A – Unternehmen von Victoria</b><br/>Der Registrant muss ein im <a href='https://register.business.gov.au/' target='_blank'>australischen Handelsregister</a> oder über die ".
    "`<a href='https://asic.gov.au/' target='_blank'>Australian Securities and Investment Commission</a>` registriertes Unternehmen sein. Der Registrant <ul>" .
    "<li>hat eine mit seiner ABN, ACN, RBN oder ARBN Nummer verknüpfte Adresse im Staat Victoria - oder - </li>" .
    "<li>hat eine gültige Firmenanschrift im Staat Victoria.</li></ul><br/>" .
    "<b>Kritermium B – Bewohner von Victoria</b><br/>Der Registrant muss ein australischer Staatbürger sein oder eine gültige Wohnsitzadresse im Staat Victoria vorweisen können.<br/><br/>" .
    "<b>Kritermium C – Assoziiertes Unternehmen</b><br/>Der Registrant muss ein assoziiertes Unternehmen sein. Er kann sich nur um einen Domainnamen bewerben, der in Bezug folgender Punkte " .
    " einer Abkürzung, einem Akronym oder einem direkten oder nur teilweisen Treffer entspricht:" .
    "<ul><li>Firmenname oder Name/Rufname/Pseudonym des Registranten, wobei der Firmenname bei der für den Geschäftsbereich zuständigen Behörde registiert sein muss. - oder -</li>" .
    "<li>ein Produkt welches durch das assoziierte Unternehmen selbst hergestellt oder an Firmen und Privatkunden im Staat Victoria verkauft wird. - oder -</li>".
    "<li>eine Dienstleistung des Unternehmens, die Bewohnern des Staats Victoria angeboten wird. - oder -</li>" .
    "<li>eine Veranstaltung im Staat Victoria, welche das Unternehmen organisiert oder fördert. - oder -</li>" .
    "<li>eine Tätigkeit, die das Unternehmen im Staat Victoria erleichtert - oder -</li>" .
    "<li>für die Bewohner des Staats Vicoria bereitgestellter Kurs oder bereitgestelltes Ausbildungsprogramm.</li></div>"
);//

// .MY
$_LANG["hxflagsmytldregistrantorganisationtype"] = "Registrant, Unternehmenstyp";
// Options, Registrant Organisation Type
$_LANG["hxflagsmytldregistrantorganisationtype1"] = "Architekturbüro";
$_LANG["hxflagsmytldregistrantorganisationtype2"] = "Wirtschaftprüfungsgesellschaft";
$_LANG["hxflagsmytldregistrantorganisationtype3"] = "Geschäftsbetrieb gemäß `Business Registration Act (ROB)`";
$_LANG["hxflagsmytldregistrantorganisationtype4"] = "Geschäftsbetrieb gemäß Gewerbescheinverordnung";
$_LANG["hxflagsmytldregistrantorganisationtype5"] = "Unternehmen gemäß `Companies Act (ROC)`";
$_LANG["hxflagsmytldregistrantorganisationtype6"] = "Durch zuständige Regierungsstelle/Behörde akreditierte/registrierte Bildungsstätte";
$_LANG["hxflagsmytldregistrantorganisationtype7"] = "Organisation der Landwirte";
$_LANG["hxflagsmytldregistrantorganisationtype8"] = "Bundesregierungsbehörde/-stelle";
$_LANG["hxflagsmytldregistrantorganisationtype9"] = "Ausländische Botschaft";
$_LANG["hxflagsmytldregistrantorganisationtype10"] = "Auswärtiges Amt";
$_LANG["hxflagsmytldregistrantorganisationtype11"] = "staatlich geförderte Grund- oder weiterführende Schule";
$_LANG["hxflagsmytldregistrantorganisationtype12"] = "Anwaltskanzlei";
$_LANG["hxflagsmytldregistrantorganisationtype13"] = "Lembaga (Board)";
$_LANG["hxflagsmytldregistrantorganisationtype14"] = "Kommunalbehörde/-stelle";
$_LANG["hxflagsmytldregistrantorganisationtype15"] = "MARA Junior Science College (MRSM)";
$_LANG["hxflagsmytldregistrantorganisationtype16"] = "Abteilung/Dienststelle des Verteidigunsministeriums";
$_LANG["hxflagsmytldregistrantorganisationtype17"] = "Briefkastenfirma";
$_LANG["hxflagsmytldregistrantorganisationtype18"] = "Eltern/Lehrerverband";
$_LANG["hxflagsmytldregistrantorganisationtype19"] = "Fachhochschule unter Leitung des Bildungsministeriums";
$_LANG["hxflagsmytldregistrantorganisationtype20"] = "Private höhere Bildungsstätte";
$_LANG["hxflagsmytldregistrantorganisationtype21"] = "Privatschule";
$_LANG["hxflagsmytldregistrantorganisationtype22"] = "Regionalbüro";
$_LANG["hxflagsmytldregistrantorganisationtype23"] = "Religiöse Einheit";
$_LANG["hxflagsmytldregistrantorganisationtype24"] = "Vetretungsbüro";
$_LANG["hxflagsmytldregistrantorganisationtype25"] = "Gesellschaft gemäß `Societies Act (ROS)`";
$_LANG["hxflagsmytldregistrantorganisationtype26"] = "Organisation des Sports";
$_LANG["hxflagsmytldregistrantorganisationtype27"] = "Landesregierungsbehörde/-stelle";
$_LANG["hxflagsmytldregistrantorganisationtype28"] = "Handelsgesellschaft";
$_LANG["hxflagsmytldregistrantorganisationtype29"] = "Treuhänder";
$_LANG["hxflagsmytldregistrantorganisationtype30"] = "Universität unter Leitung des Bildungsministeriums";
$_LANG["hxflagsmytldregistrantorganisationtype31"] = "Gutachter-, Sachverständigen- und Immobiliengunternehmen";

// .NYC
// Options, Nexus Category
$_LANG["hxflagsnyctldnexuscategory1"] = "Natürliche Person mit primärem Wohnsitz in NYC";
$_LANG["hxflagsnyctldnexuscategory2"] = "Entität oder Unternehmen mit primärem Wohnsitz in NYC";
$_LANG["hxflagsnyctldnexuscategorydescr"] = "(Postfächer sind unzulässig, siehe <a href='####TAC####'>.NYC Nexus-Richtlinien</a>.)";

// .PRO
$_LANG["hxflagsprotldprofession"] = "Beruf";
$_LANG["hxflagsprotldlicensenumber"] = "Lizenznummber";
$_LANG["hxflagsprotldauthority"] = "Behörde";
$_LANG["hxflagsprotldauthoritywebsite"] = "Webseite der Behörde";

// .PT
$_LANG["hxflagspttldroid"] = "ROID";

// .RO
$_LANG["hxflagsrotldregistrantvatiddescr"] = "(benötigt bei Staaten der EU, SOWIE bei rumänischen Registranten)";

// .RU
$_LANG["hxflagsrutldindividualsbirthday"] = "Registrant, Geburtstag";
$_LANG["hxflagsrutldindividualspassportdata"] = "Registrant, Ausweisdaten";
$_LANG["hxflagsrutldindividualspassportdatadescr"] = "(benötigt bei Privatpersonen; inkl. Reisepassnummer, Ausstellungsdatum u. -ort)<br/><br/>";

// .SE
$_LANG["hxflagssetldidentificationnumberdescr"] = (
    "<div style='text-align:justify'><b>Bei Privatpersonen und Unternehmen mit Sitz in Schweden</b> muss eine gültige schwedische Identifikations- oder Firmennummer angegeben werden.<br/>" .
    "<b>Bei Privatpersonen oder Firmen außerhalb von Schweden</b> muss eine Identifizierungsnummer angegeben werden (z.B. bürgerliche Meldenr., Handelsregisternr., oder vergleichbar).</div>"
);

// .SG
$_LANG["hxflagssgtldrcbsingaporeid"] = "RCB/Singapore ID";

// .SWISS
$_LANG["hxflagsswisstldregistrantenterpriseid"] = "Registrant, ID des Unternehmens";
$_LANG["hxflagsswisstldregistrantenterpriseiddescr"] = "(muss mit `CHE` beginnen, gefolgt von 9 Zahlen)";

// .SYDNEY
// Options, Nexus Category
$_LANG["hxflagssydneytldnexuscategorya"] = "Kriterium A - Unternehmen von New South Wales";
$_LANG["hxflagssydneytldnexuscategoryb"] = "Kriterium B - Bewohner von New South Wales";
$_LANG["hxflagssydneytldnexuscategoryc"] = "Kriterium C - Assoziierte Unternehmen";

// .TEL
// Legal Type, Options
$_LANG["hxflagsteltldlegaltypenaturl"] = "Natürliche Person";
$_LANG["hxflagsteltldlegaltypelegal"] = "Juristische Person";
$_LANG["hxflagsteltldwhoisoptoutdescr"] = "(verfügbar für Rechtsform `Natürliche Person`. Wählen Sie `Nein` um WHOIS Daten auf den Name des Registranten zu beschränken.)";

// .TRAVEL
$_LANG["hxflagstraveltldtravelindustry"] = ".TRAVEL Branche";
$_LANG["hxflagstraveltldtravelindustrydescr"] = "(Wir bestätigen eine Verbindnung zur Reisebranche und daß wir an reisebezogenen Aktivitäten beteiligt sind oder dies planen.)";

// .US
// Options, Intended Use
$_LANG["hxflagsustldintendedusep1"] = "Geschäft zu Profitzwecken";
$_LANG["hxflagsustldintendedusep2"] = "Nicht-kommerzielles Unternehmen / Klub / Verein / religiöse Vereinigung";
$_LANG["hxflagsustldintendedusep3"] = "Privatgebrauch";
$_LANG["hxflagsustldintendedusep4"] = "Bildungszwecke";
$_LANG["hxflagsustldintendedusep5"] = "Regierungszwecke";
// Options, Nexus Category, https://www.about.us/policies/ustld-nexus-codes
$_LANG["hxflagsustldnexuscategoryc11"] = "Eine natürliche Person, die Bürger der Vereinigten Staaten ist";
$_LANG["hxflagsustldnexuscategoryc12"] = "Eine natürliche Person mit ständigem Wohnsitz in den USA oder in einem der zugehörigen Gebiete/Territorien";
$_LANG["hxflagsustldnexuscategoryc21"] = (
    "Eine U.S.-Organisation oder Firma, die in einem der 50 U.S. Staaten, im Bezirk Columbien oder in einem der US-Gebiete/Territorien gegründet " .
    "oder aufgebaut wurde, oder anderweitig unter der Gesetzen der USA, des Bezirks Columbien oder in einem der US-Gebiete/Territorien errichtet wurde " .
    "oder eine U.S. Bundes-, Landes- oder Kommunalbehörde oder eine Gebietskörperschaft davon."
);
$_LANG["hxflagsustldnexuscategoryc31"] = (
    "Eine ausländische Entität oder Firma mit gutgläubiger Präsenz in den USA oder in einem der zugehörigen Gebiete/Territorien, die sich regelmäßig mit ".
    "gesetzlichen Angelegenheiten, Güterverkauf oder Dienstleistungen oder sonstigen kommerziellen oder nicht-kommerziellen Geschäften befasst inkl. gemeinnützige Beziehungen zu den Vereinigte Staaten"
);
$_LANG["hxflagsustldnexuscategoryc32"] = "Ein ausländisches Unternehmen mit Büro oder Werk in den Vereinigten Staaten";
$_LANG["hxflagsustldnexuscountrydescr"] = "<div>Geben Sie die ursprüngliche Staatsbürgerschaft des Registranten an (NUR benötigt für die letzen beiden Optionen der Nexus Kategorie (C31 or C32)).</div>";

// .XXX
$_LANG["hxflagsxxxtldresolvingdomain"] = "NICHT-Auflösende Domain";
$_LANG["hxflagsxxxtldnonresolvingdomaindescr"] = "(Dieser .XXX Domainname soll <b>NICHT</b> auflösen!)";
$_LANG["hxflagsxxxtldmembershipid"] = ".XXX Mitgliedsnr.";
$_LANG["hxflagsxxxtldmembershipiddescr"] = "(Benötigt, damit Ihre .XXX Domain auflöst)";
// Options, Non-Resolving Domain
$_LANG["hxflagsxxxtldnonresolvingdomain0"] = "Nein - diese Domain soll auflösen.";
$_LANG["hxflagsxxxtldnonresolvingdomain1"] = "Ja - dies Domain soll NICHT auflösen";
