<?php
// #########################################################################
// # Add translations for ISPAPI registrar module additional domain fields #
// #########################################################################

// Terms and Conditions Fields, prefixed with hxflagstac
$_LANG["hxflagstacagreement"] = "Accord";
$_LANG["hxflagstacagreementindiv"] = "Conditions pour les particuliers";
$_LANG["hxflagstactrustee"] = "Service de Présence Locale";
$_LANG["hxflagstachighlyregulated"] = "TLD hautement réglementé";
$_LANG["hxflagstachighlyregulateddescrdefault"] = (
    "Cochez cette case pour confirmer que vous certifiez que le titulaire est admissible à enregistrer ce domaine et que toutes les " .
    "informations fournies sont véridiques et exactes. Critères d'admissibilité peuvent être consultés <a href='####TAC####' target='_blank'>ici</a>."
);
$_LANG["hxflagstachighlyregulateddescreco"] = (
    $_LANG["hxflagstachighlyregulateddescrdefault"] .
    "<br/>Tout les noms de domaine .ECO seront d'abord enregistrés avec le statut \"Server hold\" en attendant l'achèvement des exigences minimales du profil Eco, " .
    "à savoir, le .ECO titulaire 1) affirmant leur conformité avec la .Politique D'éligibilité Écologique et 2) s'engager à soutenir un changement positif pour " .
    "la planète et à être honnête lors du partage d'informations sur leurs actions environnementales. Le titulaire recevra par courriel des instructions sur la " .
    "façon de créer un profil .ECO. Quand fait, le nom de domaine .ECO sera immédiatement activé par le registre."
);
$_LANG["hxflagstachighlyregulateddescrnotac"] = (
    "Cochez cette case pour confirmer les <b>garanties pour les TLD hautement réglementés</b>:<br/>" .
    "<div style='text-align:justify'>Vous comprenez et acceptez que vous vous conformerez à ces conditions supplémentaires:" .
    "<ol><li>Coordonnées Administratives. Vous acceptez de fournir les coordonnées administratives, qui doivent être mises à jour " .
    "pour la notification des plaintes ou des rapports d'abus d'enregistrement, ainsi que les coordonnées des organismes de réglementation " .
    "ou d'autorégulation de l'industrie concernés dans leur lieu d'affaires principal.</li>" .
    "<li>Représentation. Vous confirmez et déclarez que vous possédez toutes les autorisations, chartes, licences et / ou autres informations " .
    "d'identification nécessaires pour participer au secteur associé à un tel TLD hautement réglementé.</li>" .
    "<li>Rapport des changements D'autorisation, chartes, licences, informations d'identification. Vous acceptez de signaler tout changement " .
    "important à la validité de vos autorisations, chartes, licences et/ou autres informations d'identification connexes pour la participation dans " .
    "le secteur associé au TLD hautement réglementé afin de vous assurer de continuer à vous conformer aux réglementations et exigences de licence appropriées " .
    "et de mener généralement vos activités dans l'intérêt des consommateurs que vous servez..</li></ol></div>"
);
$_LANG["hxflagstacindividualregulateddescrdefault"] = "Cochez pour confirmer les <a href='####TAC####' target='_blank'>Conditions pour les Particuliers</a>";
$_LANG["hxflagstacregulateddescrdefault"] = "Cochez cette case pour confirmer que vous acceptez les <a href='####TAC####' target='_blank'>conditions D'enregistrement du Registre</a> lors d'un nouvel enregistrement de noms de domaine ####TLD####.";
$_LANG["hxflagstacregulateddescrngo"] = (
    $_LANG["hxflagstacregulateddescrdefault"] .
    "<div style='padding:10px 0px;'>L'enregistrement d'un nom de domaine ####TLD#### est livré avec un nom de domaine .ONG sans frais supplémentaires. Les modifications ".
    "sur le domaine ####TLD#### seront automatiquement appliquées au domaine .ONG. Vous ne trouverez donc pas le domaine .ONG répertorié dans votre inventaire de domaines.</div>"
);
$_LANG["hxflagstacregulateddescritsection3"] = (
    "Cochez cette case pour confirmer que vous acceptez la <b><a href='####TAC####' target='_blank'>Section 3 - Declarations and Assumptions of Liability</a></b>.<br/>" .
    "<div style='text-align:justify;margin-bottom:10px;'>" .
    "Le titulaire du nom de domaine en question déclare sous sa propre responsabilité qu'il:" .
    "<ul><li>en possession de la citoyenneté ou résident dans un pays appartenant à l'Union européenne (dans le cas de l'enregistrement des personnes physiques);</li>" .
    "<li>établi dans un pays appartenant à l'Union Européenne (dans le cas de l'enregistrement pour d'autres organisations);</li>" .
    "<li>sachant et acceptez que l'enregistrement et la gestion d'un nom de domaine sont soumis aux <a href='https://www.nic.it/en/manage-your-it/forms-and-docs' target='_blank'>'Management of synchronous operations on domain names of the ccTLD ####TLD#### - Guidelines'</a> " .
    "et aux <a href='https://www.nic.it/en/manage-your-it/forms-and-docs' target='_blank'>'Dispute resolution in the ccTLD ####TLD#### - Regulations & Guidelines'</a> et leurs modifications ultérieures;</li>" .
    "<li>le droit à l'utilisation et/ou de la disponibilité du nom de domaine demandé, et qu'ils ne portent pas atteinte, à la demande d'enregistrement, les droits d'autrui;</li>" .
    "<li>sachant que pour l'inclusion de données à caractère personnel dans la base de données des noms de domaine attribués, et leur éventuelle diffusion et accessibilité via Internet, le consentement doit être " .
    "donné explicitement en cochant les cases appropriées dans les informations ci-dessous. Voir: <a href='https://www.nic.it/en/manage-your-it/forms-and-docs' target='_blank'>'the DBNA and WHOIS Policy'</a>;</li>" .
    "<li>conscient et accepter qu'en cas de déclarations erronées ou fausses dans cette demande, le Registre doit immédiatement révoquer le nom de domaine, ou procéder à d'autres actions en justice. " .
    "Dans ce cas la révocation ne peut en aucune façon donner lieu à des réclamations contre le Registre;</li>" .
    "<li>relâchez le Registre de toute responsabilité résultant de l'attribution et l'utilisation du nom de domaine par la personne physique qui en a fait la demande;</li>" .
    "<li>accepter la juridiction italienne et les lois de l'État italien.</li></ul>" .
    "</div>"
);
$_LANG["hxflagstacregulateddescritsection5"] = (
    "Cocher la case pour confirmer que vous acceptez la <b><a href='####TAC####' target='_blank'>Section 5 - Consent to the processing of personal data for registration</b></a><br/>" .
    "<div style='text-align:justify;margin-bottom:10px;'>" .
    "La partie intéressée, après avoir lu la divulgation ci-dessus, donne son consentement au traitement des informations requises pour l'enregistrement, tel que défini dans la divulgation ci-dessus. " .
    "Le consentement est facultatif, mais si aucun consentement n'est donné, il ne sera pas possible de finaliser l'enregistrement, la cession et la gestion du nom de domaine.</div>"
);
$_LANG["hxflagstacregulateddescritsection6"] = (
    "Cocher la case pour confirmer que vous acceptez la <b><a href='####TAC####' target='_blank'>Section 6 - Consent to the processing of personal data for diffusion and accessibility via the Internet</b></a><br/>" .
    "<div style='text-align:justify;margin-bottom:10px;'>" .
    "La partie intéressée, après avoir lu la divulgation ci-dessus, donne son consentement à la diffusion et à l'accessibilité via Internet, telles que définies dans la divulgation ci-dessus. Le consentement est " .
    "facultatif, mais l'absence de consentement ne permet pas la diffusion et l'accessibilité des données Internet.</div>"
);
$_LANG["hxflagstacregulateddescritsection7"] = (
    "Cocher la case pour confirmer que vous acceptez la <b><a href='####TAC####' target='_blank'>Section 7 - Explicit Acceptance of the following points</b></a><br/>" .
    "<div style='text-align:justify;margin-bottom:10px;'>" .
    "Pour l'acceptation explicite, l'intéressé déclare qu'ils:" .
    "<ul><li>d) sont conscients et conviennent que l'enregistrement et la gestion d'un nom de domaine sont soumis aux règles <a href='https://www.nic.it/en/manage-your-it/forms-and-docs' target='_blank'>'Management of " .
    "synchronous operations on domain names of the ccTLD ####TLD#### - Guidelines'</a> et <a href='https://www.nic.it/en/manage-your-it/forms-and-docs' target='_blank'>'Dispute resolution in the ccTLD ####TLD#### - " .
    "Regulations & Guidelines'</a> et leurs modifications ultérieures;</li>"  .
    "<li>e) sont conscients et conviennent qu'en cas de déclarations erronées ou fausses dans cette demande, le Registre doit immédiatement révoquer le nom de domaine, ou procéder à d'autres actions en justice. " .
    "Dans ce cas la révocation ne peut en aucune façon donner lieu à des réclamations contre le Registre;</li>" .
    "<li>f) relâchez le Registre de toute responsabilité résultant de l'attribution et l'utilisation du nom de domaine par la personne physique qui en a fait la demande;</li>" .
    "<li>g) accepter la juridiction italienne et les lois de l'Etat italien.</li></ul>" .
    "</div>"
);

// Generic Fields, prefixed with hxflags
$_LANG["hxflagsyesnoyes"] = "Oui";
$_LANG["hxflagsyesnono"] = "Non";
$_LANG["hxflagsyesnoy"] = "Oui";
$_LANG["hxflagsyesnon"] = "Non";
$_LANG["hxflagsyesno1"] = "Oui";
$_LANG["hxflagsyesno0"] = "Non";

$_LANG["hxflagslegaltype"] = "Juridique Type";
$_LANG["hxflagslegaltypeindiv"] = "Particulier";
$_LANG["hxflagslegaltypeorg"] = "Organisation";
$_LANG["hxflagsintendeduse"] = "Utilisation Prévue";
$_LANG["hxflagsregistrantidnumber"] = "N° d'identification du déclarant";
$_LANG["hxflagsregistrantvatid"] = "N° de TVA du déclarant";
$_LANG["hxflagsadminidnumber"] = "N° d'identification du contact administratif";
$_LANG["hxflagsadminvatid"] = "N° de TVA du contact administratif";
$_LANG["hxflagstechidnumber"] = "N° d'identification du contact technique";
$_LANG["hxflagstechvatid"] = "N° de TVA du contact technique";
$_LANG["hxflagsbillingidnumber"] = "N° d'identification du contact facturation";
$_LANG["hxflagsregistrantidtype"] = "Type de N° d'identification du déclarant";
$_LANG["hxflagsallocationtoken"] = "Jeton d'Allocation de Registre";
$_LANG["hxflagsallocationtokendescr"] = (
    "Pour enregistrer un domaine ####TLD####, vous devez fournir le jeton d'allocation émis par le registre. " .
    "Veuillez remplir la demande d'enregistration  <a href='####TAC####' target='_blank'>ici</a> pour obtenir le jeton."
);
$_LANG["hxflagsnexuscategory"] = "Catégorie Nexus";
$_LANG["hxflagsnexuscountry"] = "Pays Nexus";
$_LANG["hxflagsfax"] = "Fax Requis";
$_LANG["hxflagsfaxdescr"] = "Je confirme qu'après cette demande d'enregistration, je vais envoyer <a href='####TAC####'>ce formulaire</a> à compléter le processus d'enregistration.";
$_LANG["hxflagsidentificationnumber"] = "N° d'identification";
$_LANG["hxflagswhoisoptout"] = "Désactivation du WHOIS";
$_LANG["hxflagsregistrantbirthdate"] = "Date de naissance du déclarant";

// AFNIC TLDs, prefixed with hxflagsafnic
$_LANG["hxflagsafnictldvatid"] = "N° TVA/SIREN/SIRET";
$_LANG["hxflagsafnictldvatiddescr"] = "(Seulement pour les entreprises avec n° de TVA/SIREN/SIRET)";
$_LANG["hxflagsafnictldtrademark"] = "Marque N°";
$_LANG["hxflagsafnictldtrademarkdescr"] = "(Seulement pour les entreprises ayant une marque européenne)";
$_LANG["hxflagsafnictldduns"] = "N° DUNS";
$_LANG["hxflagsafnictlddunsdescr"] = "(Seulement pour les entreprises avec DUNS n°)";
$_LANG["hxflagsafnictldlocalid"] = "ID Local";
$_LANG["hxflagsafnictldlocaliddescr"] = "(Seulement pour les entreprises avec identifiant local)";
// French Association, Data from Journal officiel [JO]
$_LANG["hxflagsafnictldjodod"] = "Date de la déclaration [JO]";
$_LANG["hxflagsafnictldjododdescr"] = "(Seulement pour l'association française, forme: <b>AAAA-MM-JJ</b>)";
$_LANG["hxflagsafnictldjonumber"] = "N° [JO]";
$_LANG["hxflagsafnictldjonumberdescr"] = "(Seulement pour l'association française, le n° du Journal Officiel)";
$_LANG["hxflagsafnictldjopage"] = "La Page de l'Annonce [JO]";
$_LANG["hxflagsafnictldjopagedescr"] = "(Uniquement pour l'association française, la page de l'annonce au Journal Officiel)";
$_LANG["hxflagsafnictldjodop"] = "Date de Publication [JO]";
$_LANG["hxflagsafnictldjodopdescr"] = "(Uniquement pour l'association française, la date de publication au Journal Officiel; forme <b>AAAA-MM-JJ</b>)";
// Options, Legal Type
$_LANG["hxflagsafnictldlegaltypeindiv"] = "Particular";
$_LANG["hxflagsafnictldlegaltypeorg1"] = "Société avec n° TVA/SIREN/SIRET";
$_LANG["hxflagsafnictldlegaltypeorg2"] = "Société avec la marque européenne";
$_LANG["hxflagsafnictldlegaltypeorg3"] = "Société avec n° DUNS";
$_LANG["hxflagsafnictldlegaltypeorg4"] = "Identifiant local de la Société";
$_LANG["hxflagsafnictldlegaltypeass"] = "Association française";

// .AERO
$_LANG["hxflagsaerotldaeroid"] = ".AERO ID <sup style='cursor:help;' title='Obtain from https://www.information.aero/'>qu'est-ce?</sup>";
$_LANG["hxflagsaerotldaerokey"] = ".AERO Key <sup style='cursor:help;' title='Obtain from https://www.information.aero/'>qu'est-ce?</sup>";

// .CA
$_LANG["hxflagscatldcontactlanguage"] = "Langue de Contact";
$_LANG["hxflagscatldwhoisoptoutdescr"] = "Cochez cette case pour masquer vos coordonnées dans CIRA WHOIS (uniquement disponible pour les particuliers)";
// Options, Legal Type
$_LANG["hxflagscatldlegaltypecco"] = "Corporation";
$_LANG["hxflagscatldlegaltypecct"] = "Citoyen canadien";
$_LANG["hxflagscatldlegaltyperes"] = "Résident permanent du Canada";
$_LANG["hxflagscatldlegaltypegov"] = "Gouvernement ou entité gouvernementale au Canada";
$_LANG["hxflagscatldlegaltypeedu"] = "Établissement d'enseignement canadien";
$_LANG["hxflagscatldlegaltypeass"] = "Canadian association non constituées en société";
$_LANG["hxflagscatldlegaltypehos"] = "Hôpital Canadien";
$_LANG["hxflagscatldlegaltypeprt"] = "Société de personnes enregistrée au Canada";
$_LANG["hxflagscatldlegaltypetdm"] = "Marque de commerce enregistrée au Canada (par un propriétaire non canadien)";
$_LANG["hxflagscatldlegaltypetrd"] = "Syndicat canadien";
$_LANG["hxflagscatldlegaltypeplt"] = "Parti politique canadien";
$_LANG["hxflagscatldlegaltypelam"] = "Bibliothèque archives ou musée canadien";
$_LANG["hxflagscatldlegaltypetrs"] = "Trust établie au Canada";
$_LANG["hxflagscatldlegaltypeabo"] = "Peuples autochtones (individus ou groupes) autochtones du Canada";
$_LANG["hxflagscatldlegaltypeinb"] = "Bande indienne reconnue par la Loi sur les Indiens du Canada";
$_LANG["hxflagscatldlegaltypelgr"] = "Représentant légal d'un citoyen canadien ou d'un résident permanent";
$_LANG["hxflagscatldlegaltypeomk"] = "Marque officielle enregistrée au Canada";
$_LANG["hxflagscatldlegaltypemaj"] = "Sa Majesté la Reine";

// .CN
// Options, Registrant ID Type
$_LANG["hxflagscntldregistrantidtypesfz"] = "Carte d'identité chinoise";
$_LANG["hxflagscntldregistrantidtypehz"] = "Passeport étranger";
$_LANG["hxflagscntldregistrantidtypegajmtx"] = "Permis de sortie et entrée pour voyager à Hong Kong et Macao et inversement";
$_LANG["hxflagscntldregistrantidtypetwjmtx"] = "Passeports des résidents de Taiwan pour entrer ou sortir du continent";
$_LANG["hxflagscntldregistrantidtypewjlsfz"] = "Carte d'identité de résident permanent étranger";
$_LANG["hxflagscntldregistrantidtypegajzz"] = "Permis de résidence pour les résidents de Hong Kong / Macao";
$_LANG["hxflagscntldregistrantidtypetwjzz"] = "Permis de résidence pour les résidents de Taiwan";
$_LANG["hxflagscntldregistrantidtypejgz"] = "Certificat d'officier chinois";
$_LANG["hxflagscntldregistrantidtypeorg"] = "Certificat de code d'organisation chinois";
$_LANG["hxflagscntldregistrantidtypeyyzz"] = "Licence commerciale chinoise";
$_LANG["hxflagscntldregistrantidtypetydm"] = "Certificat USCC";
$_LANG["hxflagscntldregistrantidtypebddm"] = "Désignation du code militaire";
$_LANG["hxflagscntldregistrantidtypejddwfw"] = "Licence de service externe payé par militaire";
$_LANG["hxflagscntldregistrantidtypesydwfr"] = "Certificat d'une personne morale d'établissement public";
$_LANG["hxflagscntldregistrantidtypewgczjg"] = "Certificat d'inscription des bureaux de représentation résidents des entreprises étrangères";
$_LANG["hxflagscntldregistrantidtypeshttfr"] = "Certificat d'inscription d'une personne morale d'une organisation sociale";
$_LANG["hxflagscntldregistrantidtypezjcs"] = "Certificat d'inscription d'un site d'activités religieuses";
$_LANG["hxflagscntldregistrantidtypembfqy"] = "Certificat d'inscription d'une entité privée non-enterprise";
$_LANG["hxflagscntldregistrantidtypejjhfr"] = "Certificat d'inscription d'une personne morale d'une Fondation";
$_LANG["hxflagscntldregistrantidtypelszy"] = "Permis De pratique du cabinet d'avocats";
$_LANG["hxflagscntldregistrantidtypewgzhwh"] = "Certificat d'inscription du centre culturel étranger en Chine";
$_LANG["hxflagscntldregistrantidtypewlczjg"] = "Certificat d'inscription des représentations résidentes des services touristiques d'un gouvernement étrangers";
$_LANG["hxflagscntldregistrantidtypesfjd"] = "Licence d'expertise judiciaire";
$_LANG["hxflagscntldregistrantidtypejwjg"] = "Certificat d'organisation à l'étranger";
$_LANG["hxflagscntldregistrantidtypeshfwjg"] = "Certificat d'inscription d'agence de service social";
$_LANG["hxflagscntldregistrantidtypembxxbx"] = "Permis d'école privée";
$_LANG["hxflagscntldregistrantidtypeyljgzy"] = "Permis de pratique d'établissement médical";
$_LANG["hxflagscntldregistrantidtypegzjgzy"] = "Permis de pratique d'une notaire organisation";
$_LANG["hxflagscntldregistrantidtypebjwsxx"] = "Permis de l'école Bejing pour les enfants du personnel diplomatique étranger en Chine";
$_LANG["hxflagscntldregistrantidtypeqt"] = "Autre";

// .COM.AU
// Options, Registrant ID Type
$_LANG["hxflagscomautldregistrantidtypeabn"] = "N° d'entreprise australien";
$_LANG["hxflagscomautldregistrantidtypeacn"] = "N° d'une société australienne";
$_LANG["hxflagscomautldregistrantidtyperbn"] = "N° d'enregistrement commercial";
$_LANG["hxflagscomautldregistrantidtypetm"] = "Marque N°";

// .COM.BR
$_LANG["hxflagscombrtldidentificationnumberdescr"] = "Veuillez fournir vos numéros CPF ou CNPJ qui sont émis par le Ministère du revenu fédéral du Brésil à des fins fiscales";

// .DE <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< TODO
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
$_LANG["hxflagsfitldregistrantbirthdatedescr"] = "(AAAA-MM-JJ; only required for Individuals not from Finland)";

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
$_LANG["hxflagshktldregistrantbirthdateforindividualsdescr"] = "(mandatory for individuals, forme AAAA-MM-JJ)";

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
    "In order to register or renew a domain name the Applicant or Registrant must satisfy one of the following Criteria A, B or C below:<br/><br/>" .
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
