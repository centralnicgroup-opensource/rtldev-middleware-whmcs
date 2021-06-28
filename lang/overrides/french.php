<?php

// #########################################################################
// # Add translations for ISPAPI registrar module additional domain fields #
// #########################################################################

// Terms and Conditions Fields, prefixed with hxflagstac
$_LANG["hxflagstacagreement"] = "Accord";
$_LANG["hxflagstacagreementindiv"] = "Conditions pour les particuliers";
$_LANG["hxflagstactrustee"] = "Service de présence locale";
$_LANG["hxflagstachighlyregulated"] = "TLD hautement réglementé";
$_LANG["hxflagstachighlyregulateddescrdefault"] = (
    "Cochez cette case pour confirmer que vous certifiez que le titulaire est admissible à enregistrer ce domaine et que toutes les " .
    "informations fournies sont véridiques et exactes. Les critères d'admissibilité peuvent être consultés <a href=\"{TAC}\" target=\"_blank\">ici</a>."
);
$_LANG["hxflagstachighlyregulateddescreco"] = (
    $_LANG["hxflagstachighlyregulateddescrdefault"] .
    "<br/>Tout les noms de domaine .ECO seront d'abord enregistrés avec le statut \"Server hold\" en attendant l'achèvement des exigences minimales du profil Eco, " .
    "à savoir, le titulaire du .ECO 1) affirmant sa conformité avec la politique d'éligibilité écologique et 2) s'engagant à soutenir un changement positif pour " .
    "la planète et à être honnête lors du partage d'informations sur ses actions environnementales. Le titulaire recevra par courriel des instructions sur la " .
    "façon de créer un profil .ECO. Une fois ces étapes terminées, le nom de domaine .ECO sera immédiatement activé par le registre."
);
$_LANG["hxflagstachighlyregulateddescrnotac"] = (
    "Cochez cette case pour confirmer les <b>garanties pour les TLD hautement réglementés</b>:<br/>" .
    "<div style=\"text-align:justify\">Vous comprenez et acceptez que vous vous conformerez à ces conditions supplémentaires:" .
    "<ol><li>Coordonnées administratives. Vous acceptez de fournir les coordonnées administratives, qui doivent être mises à jour " .
    "pour la notification des plaintes ou des rapports d'abus d'enregistrement, ainsi que les coordonnées des organismes de réglementation " .
    "ou d'autorégulation de l'industrie concernés dans leur lieu d'affaires principal.</li>" .
    "<li>Représentation. Vous confirmez et déclarez que vous possédez toutes les autorisations, chartes, licences et / ou autres informations " .
    "d'identification nécessaires pour participer au secteur associé à un tel TLD hautement réglementé.</li>" .
    "<li>Rapport des changements d'autorisation, chartes, licences, informations d'identification. Vous acceptez de signaler tout changement " .
    "important à la validité de vos autorisations, chartes, licences et/ou autres informations d'identification connexes pour la participation dans " .
    "le secteur associé au TLD hautement réglementé afin de vous assurer de continuer à vous conformer aux réglementations et exigences de licence appropriées " .
    "et de mener généralement vos activités dans l'intérêt des consommateurs que vous servez..</li></ol></div>"
);
$_LANG["hxflagstacindividualregulateddescrdefault"] = "Cochez pour confirmer les <a href=\"{TAC}\" target=\"_blank\">conditions pour les particuliers</a>";
$_LANG["hxflagstacregulateddescrdefault"] = "Cochez cette case pour confirmer que vous acceptez les <a href=\"{TAC}\" target=\"_blank\">conditions d'enregistrement du registre</a> lors d'un nouvel enregistrement de noms de domaine {TLD}.";
$_LANG["hxflagstacregulateddescrngo"] = (
    $_LANG["hxflagstacregulateddescrdefault"] .
    "<div style=\"padding:10px 0px;\">L'enregistrement d'un nom de domaine {TLD} est livré avec un nom de domaine .ONG sans frais supplémentaires. Les modifications " .
    "sur le domaine {TLD} seront automatiquement appliquées au domaine .ONG. Vous ne trouverez donc pas le domaine .ONG répertorié dans votre inventaire de domaines.</div>"
);
$_LANG["hxflagstacregulateddescritsection3"] = (
    "Cochez cette case pour confirmer que vous acceptez la <b><a href=\"{TAC}\" target=\"_blank\">Section 3 - Declarations and Assumptions of Liability</a></b>.<br/>" .
    "<div style=\"text-align:justify;margin-bottom:10px;\">" .
    "Le titulaire du nom de domaine en question déclare sous sa propre responsabilité qu'il est:" .
    "<ul><li>en possession de la citoyenneté ou qu'il réside dans un pays appartenant à l'Union européenne (dans le cas de l'enregistrement des personnes physiques);</li>" .
    "<li>établi dans un pays appartenant à l'Union Européenne (dans le cas de l'enregistrement pour d'autres organisations);</li>" .
    "<li>conscient et accepte que l'enregistrement et la gestion d'un nom de domaine sont soumis aux <a href=\"{TAC}\" target=\"_blank\">'Management of synchronous operations on domain names of the ccTLD {TLD} - Guidelines'</a> " .
    "et aux <a href=\"{TAC}\" target=\"_blank\">'Dispute resolution in the ccTLD {TLD} - Regulations & Guidelines'</a> et leurs modifications ultérieures;</li>" .
    "<li>conscient du droit à l'utilisation et/ou de la disponibilité du nom de domaine demandé, et qu'ils ne portent pas atteinte, à la demande d'enregistrement, les droits d'autrui;</li>" .
    "<li>conscient que l'inclusion de données à caractère personnel dans la base de données des noms de domaine attribués, et leur éventuelle diffusion et accessibilité via Internet, le consentement doit être " .
    "donné explicitement en cochant les cases appropriées dans les informations ci-dessous. Voir: <a href=\"{TAC}\" target=\"_blank\">'the DBNA and WHOIS Policy'</a>;</li>" .
    "<li>conscient et accepte qu'en cas de déclarations erronées ou fausses dans cette demande, le registre doit immédiatement révoquer le nom de domaine, ou procéder à d'autres actions en justice. " .
    "Dans ce cas la révocation ne peut en aucune façon donner lieu à des réclamations contre le registre;</li>" .
    "<li>dégage le registre de toute responsabilité résultant de l'attribution et l'utilisation du nom de domaine par la personne physique qui en a fait la demande;</li>" .
    "<li>accepte la juridiction italienne et les lois de l'état italien.</li></ul>" .
    "</div>"
);
$_LANG["hxflagstacregulateddescritsection5"] = (
    "Cocher la case pour confirmer que vous acceptez la <b><a href=\"{TAC}\" target=\"_blank\">Section 5 - Consent to the processing of personal data for registration</b></a><br/>" .
    "<div style=\"text-align:justify;margin-bottom:10px;\">" .
    "La partie intéressée, après avoir lu la divulgation ci-dessus, donne son consentement au traitement des informations requises pour l'enregistrement, tel que défini dans la divulgation ci-dessus. " .
    "Le consentement est facultatif, mais si aucun consentement n'est donné, il ne sera pas possible de finaliser l'enregistrement, la cession et la gestion du nom de domaine.</div>"
);
$_LANG["hxflagstacregulateddescritsection6"] = (
    "Cocher la case pour confirmer que vous acceptez la <b><a href=\"{TAC}\" target=\"_blank\">Section 6 - Consent to the processing of personal data for diffusion and accessibility via the Internet</b></a><br/>" .
    "<div style=\"text-align:justify;margin-bottom:10px;\">" .
    "La partie intéressée, après avoir lu la divulgation ci-dessus, donne son consentement à la diffusion et à l'accessibilité via Internet, telles que définies dans la divulgation ci-dessus. Le consentement est " .
    "facultatif, mais l'absence de consentement ne permet pas la diffusion et l'accessibilité des données Internet.</div>"
);
$_LANG["hxflagstacregulateddescritsection7"] = (
    "Cocher la case pour confirmer que vous acceptez la <b><a href=\"{TAC}\" target=\"_blank\">Section 7 - Explicit Acceptance of the following points</b></a><br/>" .
    "<div style=\"text-align:justify;margin-bottom:10px;\">" .
    "Pour l'acceptation explicite, les parties intéressés déclarent qu'ils:" .
    "<ul><li>d) sont conscients et conviennent que l'enregistrement et la gestion d'un nom de domaine sont soumis aux règles <a href=\"{TAC}\" target=\"_blank\">'Management of " .
    "synchronous operations on domain names of the ccTLD {TLD} - Guidelines'</a> et <a href=\"{TAC}\" target=\"_blank\">'Dispute resolution in the ccTLD {TLD} - " .
    "Regulations & Guidelines'</a> et leurs modifications ultérieures;</li>"  .
    "<li>e) sont conscients et conviennent qu'en cas de déclarations erronées ou fausses dans cette demande, le registre doit immédiatement révoquer le nom de domaine, ou procéder à d'autres actions en justice. " .
    "Dans ce cas la révocation ne peut en aucune façon donner lieu à des réclamations contre le registre;</li>" .
    "<li>f) dégagent le registre de toute responsabilité résultant de l'attribution et l'utilisation du nom de domaine par la personne physique qui en a fait la demande;</li>" .
    "<li>g) acceptent la juridiction italienne et les lois de l'Etat italien.</li></ul></div>"
);
$_LANG["hxflagstacregulateddescrgoogle"] = (
    "Vous reconnaissez que {TLD} est un espace de noms sécurisé, ce qui signifie que les noms de domaine {TLD} nécessitent un certificat SSL pour fonctionner. " .
    "Les sites Web utilisant un nom de domaine {TLD} ne sont accessibles que par les navigateurs Web utilisant HTTPS via une connexion cryptée et sécurisée."
);

// Generic Fields, prefixed with hxflags
$_LANG["hxflagsyesnoyes"] = "Oui";
$_LANG["hxflagsyesnono"] = "Non";
$_LANG["hxflagsyesnoy"] = "Oui";
$_LANG["hxflagsyesnon"] = "Non";
$_LANG["hxflagsyesno1"] = "Oui";
$_LANG["hxflagsyesno0"] = "Non";

$_LANG["hxflagslegaltype"] = "Type juridique";
$_LANG["hxflagslegaltypeindiv"] = "Particulier";
$_LANG["hxflagslegaltypeorg"] = "Organisation";
$_LANG["hxflagsintendeduse"] = "Cas d'utilisation";
$_LANG["hxflagsregistrantidnumber"] = "N° d'identification du titulaire";
$_LANG["hxflagsregistrantvatid"] = "N° de TVA du titulaire";
$_LANG["hxflagsadminidnumber"] = "N° d'identification du contact administratif";
$_LANG["hxflagsadminvatid"] = "N° de TVA du contact administratif";
$_LANG["hxflagstechidnumber"] = "N° d'identification du contact technique";
$_LANG["hxflagstechvatid"] = "N° de TVA du contact technique";
$_LANG["hxflagsbillingidnumber"] = "N° d'identification du contact facturation";
$_LANG["hxflagsregistrantidtype"] = "Type de N° d'identification du titulaire";
$_LANG["hxflagsallocationtoken"] = "Token d'allocation du registre";
$_LANG["hxflagsallocationtokendescr"] = (
    "Pour enregistrer un domaine {TLD}, vous devez fournir le token d'allocation émis par le registre. " .
    "Veuillez remplir la <a href=\"{TAC}\" target=\"_blank\">demande d'enregistration</a> pour obtenir le token."
);
$_LANG["hxflagsnexuscategory"] = "Catégorie Nexus";
$_LANG["hxflagsnexuscountry"] = "Pays Nexus";
$_LANG["hxflagsfax"] = "Fax requis";
$_LANG["hxflagsfaxregistrationdescr"] = "Je confirme qu'après cette demande d'enregistration, j'enverrai <a href=\"{FAXFORM}\" target=\"_blank\">ce formulaire</a> pour terminer ce processus.";
$_LANG["hxflagsfaxtransferdescr"] = "Je confirme qu'après cette demande de transfert, j'enverrai <a href=\"{FAXFORM}\" target=\"_blank\">ce formulaire</a> pour terminer ce processus.";
$_LANG["hxflagsfaxownerchangedescr"] = "Je confirme qu'après cette demande de changement de titulaire, j'enverrai <a href=\"{FAXFORM}\" target=\"_blank\">ce formulaire</a> pour terminer ce processus.";
$_LANG["hxflagsidentificationnumber"] = "N° d'identification";
$_LANG["hxflagswhoisoptout"] = "Désactivation du WHOIS";
$_LANG["hxflagsregistrantbirthdate"] = "Date de naissance du titulaire";

// AFNIC TLDs, prefixed with hxflagsafnic
$_LANG["hxflagsafnictldvatid"] = "N° TVA/SIREN/SIRET";
$_LANG["hxflagsafnictldvatiddescr"] = "(Uniquement pour les entreprises avec n° de TVA/SIREN/SIRET)";
$_LANG["hxflagsafnictldtrademark"] = "Marque déposée N°";
$_LANG["hxflagsafnictldtrademarkdescr"] = "(Uniquement pour les entreprises ayant une marque déposée européenne)";
$_LANG["hxflagsafnictldduns"] = "N° DUNS";
$_LANG["hxflagsafnictlddunsdescr"] = "(Uniquement pour les entreprises avec DUNS n°)";
$_LANG["hxflagsafnictldlocalid"] = "ID Local";
$_LANG["hxflagsafnictldlocaliddescr"] = "(Uniquement pour les entreprises avec identifiant local)";
// French Association, Data from Journal officiel [JO]
$_LANG["hxflagsafnictldjodod"] = "Date de la déclaration au Journal Officiel [JO]";
$_LANG["hxflagsafnictldjododdescr"] = "(Uniquement pour les associations françaises, format: <b>AAAA-MM-JJ</b>)";
$_LANG["hxflagsafnictldjonumber"] = "N° [JO]";
$_LANG["hxflagsafnictldjonumberdescr"] = "(Uniquement pour les associations françaises, le n° du Journal Officiel)";
$_LANG["hxflagsafnictldjopage"] = "Publication [JO]";
$_LANG["hxflagsafnictldjopagedescr"] = "(Uniquement pour les associations françaises, la page de l'annonce au Journal Officiel)";
$_LANG["hxflagsafnictldjodop"] = "Date de publication [JO]";
$_LANG["hxflagsafnictldjodopdescr"] = "(Uniquement pour les associations françaises, la date de publication au Journal Officiel; format: <b>AAAA-MM-JJ</b>)";
// Options, Legal Type
$_LANG["hxflagsafnictldlegaltypeindiv"] = "Particulier";
$_LANG["hxflagsafnictldlegaltypeorg1"] = "Société avec n° TVA/SIREN/SIRET";
$_LANG["hxflagsafnictldlegaltypeorg2"] = "Société avec marque déposée européenne";
$_LANG["hxflagsafnictldlegaltypeorg3"] = "Société avec n° DUNS";
$_LANG["hxflagsafnictldlegaltypeorg4"] = "Identifiant local de la société";
$_LANG["hxflagsafnictldlegaltypeass"] = "Association française";

// .AERO
$_LANG["hxflagsaerotldaeroid"] = ".AERO ID <sup style=\"cursor:help;\" title=\"Voir https://www.information.aero/\">Qu'est ce que c'est?</sup>";
$_LANG["hxflagsaerotldaerokey"] = ".AERO Key <sup style=\"cursor:help;\" title=\"Voir https://www.information.aero/\">Qu'est ce que c'est?</sup>";

// .BE
$_LANG["hxflagsbetldtradeauthdescr"] = "Le changement de titulaire nécessite un code EPP valide. Ceci s'applique lors du changement du nom, de l'organisation ou de l'adresse e-mail du titulaire.";

// .CA
$_LANG["hxflagscatldcontactlanguage"] = "Langue du contact";
$_LANG["hxflagscatldregistryinformation"] = "Information du registre";
$_LANG["hxflagscatldregistryinformationdescr"] = (
    "Chaque fois que vous enregistrez un domaine {TLD} pour un nouveau titulaire (ou changez le titulaire pour un nouveau), ce nouveau titulaire doit " .
    "accepter le contrat en 7 jours pour que le domaine devienne actif. Sinon, le domaine est supprimé par le registre sans aucun remboursement. " .
    "<br/><b>Ce n'est que dans un tel cas qu'un courriel de confirmation sera envoyé au nouveau titulaire couvrant les étapes nécessaires pour accepter le présent contrat.</b><br/>" .
    "Si ce titulaire a déjà été confirmé auparavant le domaine sera enregistré en temps réel."
);
// Options, Legal Type
$_LANG["hxflagscatldlegaltypecco"] = "Société";
$_LANG["hxflagscatldlegaltypecct"] = "Citoyen canadien";
$_LANG["hxflagscatldlegaltyperes"] = "Résident permanent du Canada";
$_LANG["hxflagscatldlegaltypegov"] = "Gouvernement ou entité gouvernementale au Canada";
$_LANG["hxflagscatldlegaltypeedu"] = "Établissement d'enseignement canadien";
$_LANG["hxflagscatldlegaltypeass"] = "Associations canadienne non incorporées";
$_LANG["hxflagscatldlegaltypehos"] = "Hôpital canadien";
$_LANG["hxflagscatldlegaltypeprt"] = "Partenariat enregistré au Canada";
$_LANG["hxflagscatldlegaltypetdm"] = "Marque déposée enregistrée au Canada (par un propriétaire non canadien)";
$_LANG["hxflagscatldlegaltypetrd"] = "Syndicat canadien";
$_LANG["hxflagscatldlegaltypeplt"] = "Parti politique canadien";
$_LANG["hxflagscatldlegaltypelam"] = "Bibliothèque, archives ou musée canadien";
$_LANG["hxflagscatldlegaltypetrs"] = "Compagnie d'assurance établie au Canada";
$_LANG["hxflagscatldlegaltypeabo"] = "Peuples autochtones (individus ou groupes) autochtones du Canada";
$_LANG["hxflagscatldlegaltypeinb"] = "Bande indienne reconnue par la Loi sur les Indiens du Canada";
$_LANG["hxflagscatldlegaltypelgr"] = "Représentant légal d'un citoyen canadien ou d'un résident permanent";
$_LANG["hxflagscatldlegaltypeomk"] = "Marque officielle enregistrée au Canada";
$_LANG["hxflagscatldlegaltypemaj"] = "Sa Majesté la Reine";
// Legal Type Description, don't move it up.
$_LANG["hxflagscatldlegaltypedescr"] = (
    "<p>Le registre canadien (`CIRA`) s'engage à protéger la confidentialité des renseignements personnels dans le cadre de son fonctionnement et de l'administration du nom de domaine.</p>" .
    "<p>Les personnes inscrites dans les catégories de présence canadienne suivantes sont considérées comme des individus:</p>" .
    "<ul>" .
        "<li>" . $_LANG["hxflagscatldlegaltypecct"] . "</li>" .
        "<li>" . $_LANG["hxflagscatldlegaltyperes"] . "</li>" .
        "<li>" . $_LANG["hxflagscatldlegaltypelgr"] . "</li>" .
        "<li>" . $_LANG["hxflagscatldlegaltypeabo"] . "</li>" .
    "</ul>" .
    "<p>Toutes les autres catégories sont considérées comme des déclarants non individuels et ne sont pas autorisées à modifier leurs paramètres de confidentialité WHOIS. Pour les non-particuliers, " .
    "les données de contact sont publiques et sont publiées dans le WHOIS par le registre. Les individus peuvent choisir en utilisant le champ `" . $_LANG["hxflagswhoisoptout"] . "` ci-dessous.</p>"
);

// .CN
// Options, Registrant ID Type
$_LANG["hxflagscntldregistrantidtypesfz"] = "Carte d'identité chinoise";
$_LANG["hxflagscntldregistrantidtypehz"] = "Passeport étranger";
$_LANG["hxflagscntldregistrantidtypegajmtx"] = "Permis de sortie et d'entrée pour voyager vers et de Hong Kong et Macao";
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
$_LANG["hxflagscntldregistrantidtypejjhfr"] = "Certificat d'inscription d'une personne morale d'une fondation";
$_LANG["hxflagscntldregistrantidtypelszy"] = "Permis De pratique du cabinet d'avocats";
$_LANG["hxflagscntldregistrantidtypewgzhwh"] = "Certificat d'inscription du centre culturel étranger en Chine";
$_LANG["hxflagscntldregistrantidtypewlczjg"] = "Certificat d'inscription des représentations résidentes des services touristiques d'un gouvernement étrangers";
$_LANG["hxflagscntldregistrantidtypesfjd"] = "Licence d'expertise judiciaire";
$_LANG["hxflagscntldregistrantidtypejwjg"] = "Certificat d'organisation à l'étranger";
$_LANG["hxflagscntldregistrantidtypeshfwjg"] = "Certificat d'inscription d'agence de service social";
$_LANG["hxflagscntldregistrantidtypembxxbx"] = "Permis d'école privée";
$_LANG["hxflagscntldregistrantidtypeyljgzy"] = "Permis de pratique d'établissement médical";
$_LANG["hxflagscntldregistrantidtypegzjgzy"] = "Licence de notaire";
$_LANG["hxflagscntldregistrantidtypebjwsxx"] = "Permis de l'école Bejing pour les enfants du personnel diplomatique étranger en Chine";
$_LANG["hxflagscntldregistrantidtypeqt"] = "Autre";

// .COM.AU
// Options, Registrant ID Type
$_LANG["hxflagscomautldregistrantidtypeabn"] = "N° d'entreprise australien";
$_LANG["hxflagscomautldregistrantidtypeacn"] = "N° de société australien";
$_LANG["hxflagscomautldregistrantidtyperbn"] = "N° d'enregistrement commercial";
$_LANG["hxflagscomautldregistrantidtypetm"] = "Marque N°";

// .COM.BR
$_LANG["hxflagscombrtldidentificationnumberdescr"] = "Veuillez fournir vos numéros CPF ou CNPJ qui sont émis par le ministère du revenu fédéral du Brésil à des fins fiscales";

// .DE
$_LANG["hxflagsdetldgeneralrequestcontact"] = "Contact de demande générale";
$_LANG["hxflagsdetldabuseteamcontact"] = "Contact de l'équipe d'abus";
$_LANG["hxflagsdetldgeneralrequestcontactdescr"] = "Le registre identifiera ces informations comme coordonnées générales de la demande. Vous pouvez fournir une adresse e-mail ou une URL de site Web.";
$_LANG["hxflagsdetldabuseteamcontactdescr"] = "Le registre identifiera ces informations comme les coordonnées de l'équipe chargée des abus. Vous pouvez fournir une adresse e-mail ou une URL de site Web.";

// .DK
$_LANG["hxflagsdktldregistrantcontact"] = "Contact du titulaire";
$_LANG["hxflagsdktldregistrantlegaltype"] = "Type juridique du titulaire";
$_LANG["hxflagsdktldregistrantvatiddescr"] = "(requis en cas d'option choisie `Organisation`)";
$_LANG["hxflagsdktldadminvatiddescr"] = "(requis en cas d'option choisie `Organisation`)";
$_LANG["hxflagsdktldregistrantlegaltypeindiv"] = "Particulier";
$_LANG["hxflagsdktldregistrantlegaltypeorg"] = "Société";
$_LANG["hxflagsdktldadmincontact"] = "Contact administrateur";
$_LANG["hxflagsdktldadminlegaltype"] = "Type juridique de l'administrateur";
$_LANG["hxflagsdktldadminlegaltypeindiv"] = "Particulier";
$_LANG["hxflagsdktldadminlegaltypeorg"] = "Société";
$_LANG["hxflagsdktldlegaltypedescr"] = "Choisissez également `Particulier` au cas où vous êtes une entreprise sans VATID (Les données de l'entreprise seront ensuite supprimées lors du processus d'enregistrement).";
$_LANG["hxflagsdktldcontactdescr"] = "DK-HOSTMASTER Identifiant d'utilisateur";

// .ES
$_LANG["hxflagsestldregistranttype"] = "Contact du titulaire";
$_LANG["hxflagsestldregistrantidentificationnumber"] = "N° d'identification du titulaire";
$_LANG["hxflagsestldadmintype"] = "Type de contact administrateur";
$_LANG["hxflagsestldadminidentificationnumber"] = "N° d'identification du contact administrateur";
$_LANG["hxflagsestldlegalform"] = "Type juridique du titulaire";
// Options, Legal Type
$_LANG["hxflagsestldlegalform1"] = "Particulier";
$_LANG["hxflagsestldlegalform39"] = "Groupement d'intérêt économique";
$_LANG["hxflagsestldlegalform47"] = "Association";
$_LANG["hxflagsestldlegalform59"] = "Association sportive";
$_LANG["hxflagsestldlegalform68"] = "Association professionelle";
$_LANG["hxflagsestldlegalform124"] = "Caisse d'épargne";
$_LANG["hxflagsestldlegalform150"] = "Propriété de la communauté";
$_LANG["hxflagsestldlegalform152"] = "Communauté de propriétaires";
$_LANG["hxflagsestldlegalform164"] = "Ordre ou institution religieuse";
$_LANG["hxflagsestldlegalform181"] = "Consulat";
$_LANG["hxflagsestldlegalform197"] = "Association de droit public";
$_LANG["hxflagsestldlegalform203"] = "Ambassade";
$_LANG["hxflagsestldlegalform229"] = "Autorité locale";
$_LANG["hxflagsestldlegalform269"] = "Fédération sportive";
$_LANG["hxflagsestldlegalform286"] = "Fondation";
$_LANG["hxflagsestldlegalform365"] = "Compagnie d'assurance mutuelle";
$_LANG["hxflagsestldlegalform434"] = "Organisation gouvernementale régionale";
$_LANG["hxflagsestldlegalform436"] = "Organisation gouvernementale centrale";
$_LANG["hxflagsestldlegalform439"] = "Parti politique";
$_LANG["hxflagsestldlegalform476"] = "Syndicat";
$_LANG["hxflagsestldlegalform510"] = "Partenariat agricole";
$_LANG["hxflagsestldlegalform524"] = "Société anonyme";
$_LANG["hxflagsestldlegalform525"] = "Association sportive";
$_LANG["hxflagsestldlegalform554"] = "Société civile";
$_LANG["hxflagsestldlegalform560"] = "Partenariat générale";
$_LANG["hxflagsestldlegalform562"] = "Partenariat générale et limité";
$_LANG["hxflagsestldlegalform566"] = "Coopération";
$_LANG["hxflagsestldlegalform608"] = "Société détenue par les employés";
$_LANG["hxflagsestldlegalform612"] = "Société anonyme";
$_LANG["hxflagsestldlegalform713"] = "Bureau espagnol";
$_LANG["hxflagsestldlegalform717"] = "Alliance temporaire des entreprises";
$_LANG["hxflagsestldlegalform744"] = "Société anonyme détenue par les employés";
$_LANG["hxflagsestldlegalform745"] = "Entité publique régionale";
$_LANG["hxflagsestldlegalform746"] = "Entité publique nationale";
$_LANG["hxflagsestldlegalform747"] = "Entité publique locale";
$_LANG["hxflagsestldlegalform878"] = "Conseil de surveillance de l'appellation d'origine";
$_LANG["hxflagsestldlegalform879"] = "Entité gérant les espaces naturels";
$_LANG["hxflagsestldlegalform877"] = "Autres";
// Options, Registrant ID Type
$_LANG["hxflagsestldregistranttype0"] = "Pour le titulaire non espagnol";
$_LANG["hxflagsestldregistranttype1"] = "Pour une personne ou une organisation espagnole";
$_LANG["hxflagsestldregistranttype3"] = "Carte d'enregistrement pour étranger";
$_LANG["hxflagsestldadmintype0"] = "Pour le titulaire non espagnol";
$_LANG["hxflagsestldadmintype1"] = "Pour une personne ou une organisation espagnole";
$_LANG["hxflagsestldadmintype3"] = "Carte d'enregistrement pour étranger";

// .EU
$_LANG["hxflagseutldregistrantcitizenship"] = "Citoyenneté du titulaire";
$_LANG["hxflagseutldregistrantcitizenshipdescr"] = "Requis uniquement si vous êtes un citoyen européen résidant en dehors de l'UE";

// .FI
$_LANG["hxflagsfitldregistrantidnumberdescr"] = (
    "<ul><li>Entreprises: veuillez indiquer le numéro d'enregistrement.</li>" .
    "<li>Particuliers finlandais: fournir le numéro d'identité.</li>" .
    "<li>Autres individus: laisser vide.</li></ul>" .
    "Pour les particuliers, veuillez noter que le X-FI-REGISTRANT-IDNUMBER doit contenir onze caractères dans le format JJMMAASZZZQ, " .
    "où JJMMAA est la date de naissance, S le signe du siècle, ZZZ le numéro individuel et Q le caractère de contrôle (somme de contrôle). " .
    "Le signe pour le siècle est soit + (1800–1899), - (1900–1999) ou A (2000–2099). Le nombre individuel ZZZ est impair pour les hommes et " .
    "les femmes et pour les personnes nées en Finlande, sa fourchette est de 002 à 899 (un plus grand nombre peut être utilisé dans des cas spéciaux). " .
    "Un exemple de code valide est 311280-888Y."
);
$_LANG["hxflagsfitldregistrantbirthdatedescr"] = "(AAAA-MM-JJ; requis uniquement pour les personnes ne venant pas de Finlande)";

// .HK
$_LANG["hxflagshktldregistrantdocumenttype"] = "Type de document du titulaire";
$_LANG["hxflagshktldregistrantotherdocumenttype"] = "Autre type de document du titulaire";
$_LANG["hxflagshktldregistrantdocumentnumber"] = "N° de document du titulaire";
$_LANG["hxflagshktldregistrantdocumentorigincountry"] = "Pays d'origine du document du titulaire";
$_LANG["hxflagshktldregistrantbirthdateforindividuals"] = "Date de naissance du titulaire pour les particuliers";
// Options, Registrant Document Type
$_LANG["hxflagshktldregistrantdocumenttypehkid"] = "Particulier - N° d'identité de Hong Kong";
$_LANG["hxflagshktldregistrantdocumenttypeothid"] = "Particulier - N° d'identité d'un autre pays";
$_LANG["hxflagshktldregistrantdocumenttypepassno"] = "Particulier - N° Passeport";
$_LANG["hxflagshktldregistrantdocumenttypebirthcert"] = "Particulier - Acte de naissance";
$_LANG["hxflagshktldregistrantdocumenttypeothidv"] = "Particulier - Autres documents";
$_LANG["hxflagshktldregistrantdocumenttypebr"] = "Société - Certificat d'enregistrement d'entreprise";
$_LANG["hxflagshktldregistrantdocumenttypeci"] = "Société - Certificat de constitution";
$_LANG["hxflagshktldregistrantdocumenttypecrs"] = "Société - Certificat d'inscription d'une école";
$_LANG["hxflagshktldregistrantdocumenttypehksarg"] = "Société - Département administratif de la Région administrative spéciale de Hong Kong";
$_LANG["hxflagshktldregistrantdocumenttypehkordinance"] = "Société - Ordonnance de Hong Kong";
$_LANG["hxflagshktldregistrantdocumenttypeothorg"] = "Société - Autres documents";
$_LANG["hxflagshktldregistrantdocumenttypedescr"] = (
    "(REMARQUE: En outre, vous devrez peut-être nous envoyer une copie du document par e-mail. Pour .HK, cette étape n'est requise que " .
    "sur demande du registre. Pour .COM.HK, une copie d'un certificat d'entreprise est requise avant de pouvoir procéder à l'enregistrement.)"
);
$_LANG["hxflagshktldregistrantotherdocumenttypedescr"] = "(requis pour les types de documents du déclarant `Autres documents`)";
$_LANG["hxflagshktldregistrantbirthdateforindividualsdescr"] = "(obligatoire pour les particuliers, format: AAAA-MM-JJ)";

// .IE
$_LANG["hxflagsietldregistrantclass"] = "Classification du titulaire";
$_LANG["hxflagsietldproofofconnectiontoireland"] = "Preuve de connexion à l'Irlande";
$_LANG["hxflagsietldproofofconnectiontoirelanddescr"] = (
    "Fournissez toute information à l'appui de votre demande d'inscription, telle qu'une preuve d'admissibilité (Ex. " .
    "TVA, RBN, CRO, CHY, NIC ou numéro de marque; numéro de rôle scolaire; lien vers la page des médias sociaux) " .
    "ou une brève explication de la raison pour laquelle vous voulez ce domaine et ce que vous allez en faire."
);
// Options, Registrant Class
$_LANG["hxflagsietldregistrantclasscompany"] = "Entreprise";
$_LANG["hxflagsietldregistrantclassbusinessowner"] = "Propriétaire d'entreprise";
$_LANG["hxflagsietldregistrantclassclubbandlocalgroup"] = "Club/Groupe/Groupe local";
$_LANG["hxflagsietldregistrantclassschoolcollege"] = "École/Collège";
$_LANG["hxflagsietldregistrantclassstateagency"] = "Agence d'état";
$_LANG["hxflagsietldregistrantclasscharity"] = "Charité";
$_LANG["hxflagsietldregistrantclassbloggerother"] = "Blogueur/Autre";

// .IT
$_LANG["hxflagsittldpin"] = ".IT PIN";
$_LANG["hxflagsittldacceptsection3"] = "Section 3 du contrat d'enregistrement .IT";
$_LANG["hxflagsittldacceptsection5"] = "Section 5 du contrat d'enregistrement .IT";
$_LANG["hxflagsittldacceptsection6"] = "Section 6 du contrat d'enregistrement .IT";
$_LANG["hxflagsittldacceptsection7"] = "Section 7 du contrat d'enregistrement .IT";
$_LANG["hxflagsittldregistrantnationality"] = "Nationalité du titulaire";
$_LANG["hxflagsittldregistrantnationalitydescr"] = "(la nationalité du contact inscrit si elle est différente du code pays.)";
$_LANG["hxflagsittldregistrantlegaltype"] = "Type juridique du titulaire";
$_LANG["hxflagsittldregistrantlegaltype1"] = "[1] Personnes physiques italiennes et étrangères";
$_LANG["hxflagsittldregistrantlegaltype2"] = "[2] Entreprises / Sociétés monoparentales (IT)";
$_LANG["hxflagsittldregistrantlegaltype3"] = "[3] Travailleurs indépendants / Professionnels (IT)";
$_LANG["hxflagsittldregistrantlegaltype4"] = "[4] Associations à but non lucratif (IT)";
$_LANG["hxflagsittldregistrantlegaltype5"] = "[5] Organisations publiques (IT)";
$_LANG["hxflagsittldregistrantlegaltype6"] = "[6] Autres sujets (IT)";
$_LANG["hxflagsittldregistrantlegaltype7"] = "[7] Organisation d'un autre état membre de l'UE (correspondant à 2 - 6)";

// .JOBS
$_LANG["hxflagsjobstldyesnono"] = "Non";
$_LANG["hxflagsjobstldyesnoyes"] = "Oui";
$_LANG["hxflagsjobstldwebsite"] = "Site Internet";
$_LANG["hxflagsjobstldindustryclassification"] = "Classification de l'industrie";
$_LANG["hxflagsjobstldmemberofahrassociation"] = "Membre d'une association de ressources humaines";
$_LANG["hxflagsjobstldcontactjobtitle"] = "Titre du poste (p. ex. CEO)";
$_LANG["hxflagsjobstldcontacttype"] = "Type de contact";
// Options, Industry Classification
$_LANG["hxflagsjobstldindustryclassification2"] = "Comptabilité / Banque / Finance";
$_LANG["hxflagsjobstldindustryclassification3"] = "Agriculture / Élevage";
$_LANG["hxflagsjobstldindustryclassification21"] = "Biotechnologie / Science";
$_LANG["hxflagsjobstldindustryclassification5"] = "Informatique / Technologie de l'information";
$_LANG["hxflagsjobstldindustryclassification4"] = "Construction / Services de construction";
$_LANG["hxflagsjobstldindustryclassification12"] = "Consultant";
$_LANG["hxflagsjobstldindustryclassification6"] = "Éducation / Formation / Bibliothèque";
$_LANG["hxflagsjobstldindustryclassification7"] = "Divertissement";
$_LANG["hxflagsjobstldindustryclassification13"] = "Environnement";
$_LANG["hxflagsjobstldindustryclassification19"] = "Hospitalité";
$_LANG["hxflagsjobstldindustryclassification10"] = "Service Gouvernement/Publique";
$_LANG["hxflagsjobstldindustryclassification11"] = "Soins de santé";
$_LANG["hxflagsjobstldindustryclassification15"] = "RH / Recrutement";
$_LANG["hxflagsjobstldindustryclassification16"] = "Assurance";
$_LANG["hxflagsjobstldindustryclassification17"] = "Droit";
$_LANG["hxflagsjobstldindustryclassification18"] = "Fabrication";
$_LANG["hxflagsjobstldindustryclassification20"] = "Publicité dans les médias";
$_LANG["hxflagsjobstldindustryclassification9"] = "Parcs et loisirs";
$_LANG["hxflagsjobstldindustryclassification26"] = "Pharmacie";
$_LANG["hxflagsjobstldindustryclassification22"] = "Immobilier";
$_LANG["hxflagsjobstldindustryclassification14"] = "Restaurant / Service alimentaire";
$_LANG["hxflagsjobstldindustryclassification23"] = "Vente au détail";
$_LANG["hxflagsjobstldindustryclassification8"] = "Télémarketing";
$_LANG["hxflagsjobstldindustryclassification24"] = "Transport";
$_LANG["hxflagsjobstldindustryclassification25"] = "Autres";
// Options, Contact Type
$_LANG["hxflagsjobstldcontacttype1"] = "Administratif";
$_LANG["hxflagsjobstldcontacttype0"] = "Autre";

// .LOTTO
$_LANG["hxflagslottotldmembershipcontactid"] = "ID du membre (Membership Contact ID)";
$_LANG["hxflagslottotldverificationcode"] = "Code de vérification";

// .LT
$_LANG["hxflagslttldlegalentityidentificationcode"] = "Code d'identification d'entité légale";

// .MELBOURNE
// Options, Nexus Category
$_LANG["hxflagsmelbournetldnexuscategorya"] = "Entités victoriennes";
$_LANG["hxflagsmelbournetldnexuscategoryb"] = "Résidents victoriens";
$_LANG["hxflagsmelbournetldnexuscategoryc"] = "Entités associées";
$_LANG["hxflagsmelbournetldnexuscategorydescr"] = (
    "<div style=\"padding:10px 0px;text-align:justify\"><b>Admissibilité à l'inscription</b><br/>" .
    "Pour enregistrer ou renouveler un nom de domaine, le demandeur ou le titulaire doit satisfaire à l'un des critères A, B ou C ci-dessous.:<br/><br/>" .
    "<b>Critère A - Entités victoriennes</b><br/>Le demandeur doit être une entité enregistrée auprès de la `<a href=\"https://asic.gov.au/\" target=\"_blank\">Australian Securities and " .
    "Investments Commission</a>` ou du `<a href=\"https://register.business.gov.au/\" target=\"_blank\">Australian Business Register</a>` qui:<ul>" .
    "<li>possède une adresse dans l'État de Victoria associée à son ABN, ACN, RBN ou ARBN; ou</li><li>a une adresse d'entreprise valide dans l'État de Victoria.</li></ul><br/>" .
    "<b>Critère B - Résidents victoriens</b><br/>Le demandeur doit être un citoyen australien ou un résident ayant une adresse valide dans l'État de Victoria.<br/><br/>" .
    "<b>Critère C - Entités associées</b><br/>Le demandeur doit être une entité associée. Le demandeur peut demander un nom de domaine qui est une correspondance exacte ou " .
    "une correspondance partielle avec, ou une abréviation, ou un acronyme de:" .
    "<ul><li>Le nom commercial du demandeur ou le nom sous lequel le demandeur est généralement connu (c'est-à-dire un surnom) " .
    "et le nom de l'entreprise doit être enregistré auprès de l'autorité compétente dans la juridiction où cette entreprise est domiciliée; ou</li>" .
    "<li>un produit que l'entité associée fabrique ou vend à des entités ou des particuliers résidant dans l'État de Victoria;</li>" .
    "<li>un service que l'entité associée fournit aux résidents de l'État de Victoria;</li>" .
    "<li>un événement que l'entité associée organise ou parraine dans l'État de Victoria;</li>" .
    "<li>une activité que l'Entité associée facilite dans l'État de Victoria; ou</li>" .
    "<li>un cours ou un programme de formation que l'entité associée offre aux résidents de l'État de Victoria.</li></div>"
);

// .MY
$_LANG["hxflagsmytldregistrantorganisationtype"] = "Type d'organisation inscrite";
// Options, Registrant Organisation Type
$_LANG["hxflagsmytldregistrantorganisationtype1"] = "cabinet d'architectes";
$_LANG["hxflagsmytldregistrantorganisationtype2"] = "cabinet d'audit";
$_LANG["hxflagsmytldregistrantorganisationtype3"] = "entreprise en vertu de la loi sur l'enregistrement des entreprises (ROB)";
$_LANG["hxflagsmytldregistrantorganisationtype4"] = "entreprise conformément à l'ordonnance sur les licences commerciales";
$_LANG["hxflagsmytldregistrantorganisationtype5"] = "société en vertu de la loi sur les sociétés (ROC)";
$_LANG["hxflagsmytldregistrantorganisationtype6"] = "établissement d'enseignement accrédité / enregistré par le ministère / organe gouvernemental compétent";
$_LANG["hxflagsmytldregistrantorganisationtype7"] = "organisation paysanne";
$_LANG["hxflagsmytldregistrantorganisationtype8"] = "ministère ou organisme du gouvernement fédéral";
$_LANG["hxflagsmytldregistrantorganisationtype9"] = "ambassade étrangère";
$_LANG["hxflagsmytldregistrantorganisationtype10"] = "bureau étranger";
$_LANG["hxflagsmytldregistrantorganisationtype11"] = "école primaire et / ou secondaire subventionnée par le gouvernement";
$_LANG["hxflagsmytldregistrantorganisationtype12"] = "cabinet d'avocats";
$_LANG["hxflagsmytldregistrantorganisationtype13"] = "lembega (bord)";
$_LANG["hxflagsmytldregistrantorganisationtype14"] = "service ou agence de l'autorité locale";
$_LANG["hxflagsmytldregistrantorganisationtype15"] = "maktab rendah sains mara (MRSM) sous l'administration de mara";
$_LANG["hxflagsmytldregistrantorganisationtype16"] = "ministère ou organisme du ministère de la défense";
$_LANG["hxflagsmytldregistrantorganisationtype17"] = "entreprise délocalisée";
$_LANG["hxflagsmytldregistrantorganisationtype18"] = "association parents-enseignants";
$_LANG["hxflagsmytldregistrantorganisationtype19"] = "école polytechnique sous l'administration du ministère de l'éducation";
$_LANG["hxflagsmytldregistrantorganisationtype20"] = "établissement d'enseignement supérieur privé";
$_LANG["hxflagsmytldregistrantorganisationtype21"] = "école privée";
$_LANG["hxflagsmytldregistrantorganisationtype22"] = "bureau régional";
$_LANG["hxflagsmytldregistrantorganisationtype23"] = "entité religieuse";
$_LANG["hxflagsmytldregistrantorganisationtype24"] = "bureau de représentation";
$_LANG["hxflagsmytldregistrantorganisationtype25"] = "société conformément à la loi sur les sociétés (ROS)";
$_LANG["hxflagsmytldregistrantorganisationtype26"] = "organisation sportive";
$_LANG["hxflagsmytldregistrantorganisationtype27"] = "ministère ou organisme du gouvernement de l'État";
$_LANG["hxflagsmytldregistrantorganisationtype28"] = "syndicat";
$_LANG["hxflagsmytldregistrantorganisationtype29"] = "curateur";
$_LANG["hxflagsmytldregistrantorganisationtype30"] = "université sous l'administration du ministère de l'éducation";
$_LANG["hxflagsmytldregistrantorganisationtype31"] = "évaluateur, cabinet d'agent immobilier";

// .NU
$_LANG["hxflagsnutldregistrantidnumberdescr"] = (
    "<b>Pour les particuliers ou les entreprises situés en Suède</b>, un numéro personnel ou organisationnel suédois valide doit être indiqué.<br/>" .
    "<b>Pour les particuliers et les sociétés en dehors de la Suède</b>, le numéro d'identification (par exemple, le numéro d'enregistrement civique, le numéro d'enregistrement de la société ou l'équivalent) doit être indiqué."
);
$_LANG["hxflagsnutldvatiddescr"] = "(Requis uniquement pour les entreprises situées à l'intérieur de l'Union européenne mais en dehors de la Suède)";

// .NYC
// Options, Nexus Category
$_LANG["hxflagsnyctldnexuscategory1"] = "Personne physique - domicile principal avec adresse physique à NYC";
$_LANG["hxflagsnyctldnexuscategory2"] = "Entité ou organisation - domicile principal avec adresse physique à NYC";
$_LANG["hxflagsnyctldnexuscategorydescr"] = "(Les boîtes postales sont interdites, voir <a href=\"{TAC}\" target=\"_blank\">.NYC Politiques Nexus</a>.)";

// .PRO
$_LANG["hxflagsprotldprofession"] = "Profession";
$_LANG["hxflagsprotldlicensenumber"] = "N° de Licence";
$_LANG["hxflagsprotldauthority"] = "Autorité";
$_LANG["hxflagsprotldauthoritywebsite"] = "Site Web de l'autorité";

// .PT
$_LANG["hxflagspttldroid"] = "ROID";

// .RO
$_LANG["hxflagsrotldregistrantvatiddescr"] = "(requis pour les pays de l'UE et pour les déclarants roumains)";

// .RU
$_LANG["hxflagsrutldlegaltypeindiv"] = "Particulier";
$_LANG["hxflagsrutldlegaltypeorg"] = "Société";
$_LANG["hxflagsrutldregistrantbirthday"] = "Date de naissance";
$_LANG["hxflagsrutldregistrantbirthdaydescr"] = "(requis pour les particuliers)";
$_LANG["hxflagsrutldregistrantpassportdata"] = "Données de passeport";
$_LANG["hxflagsrutldregistrantpassportdatadescr"] = "(requis pour les particuliers; y compris le numéro de passeport, la date de délivrance et le lieu de délivrance)<br/><br/>";

// .SE
$_LANG["hxflagssetldidentificationnumberdescr"] = (
    "<div style=\"text-align:justify\"><b>Pour les particuliers ou les sociétés situés en Suède </b>, un numéro suédois personnel ou organisationnel valide doit être indiqué.<br/>" .
    "<b>Pour les individus et les sociétés en dehors de la Suède </b>, le numéro d'identification (p. ex., le n° d'enregistrement civique, le n° d'enregistrement de la société ou l'équivalent) doit être indiqué.</div>"
);

// .SG
$_LANG["hxflagssgtldrcbsingaporeid"] = "RCB Singapore ID";

// .SWISS
$_LANG["hxflagsswisstldregistrantenterpriseid"] = "ID d'entreprise du titulaire";
$_LANG["hxflagsswisstldregistrantenterpriseiddescr"] = "(doit commencer par CHE et suivi de 9 chiffres)";

// .SYDNEY
// Options, Nexus Category
$_LANG["hxflagssydneytldnexuscategorya"] = "Critère A - Entités de Nouvelle-Galles du Sud";
$_LANG["hxflagssydneytldnexuscategoryb"] = "Critère B - Résidents de la Nouvelle-Galles du Sud";
$_LANG["hxflagssydneytldnexuscategoryc"] = "Critère C - Entités associées";
$_LANG["hxflagssydneytldnexuscategorydescr"] = (
    "Pour enregistrer ou renouveler un nom de domaine {TLD}, le demandeur ou le titulaire doit satisfaire à l'un des critères A, B ou C ci-dessous.:<br/><br/>" .
    "<b>Critère A - Entités de Nouvelle-Galles du Sud</b><br/>" .
    "Le demandeur doit être une entité enregistrée auprès de la Australian Securities and Investments Commission ou du Australian Business Register qui:<br/>" .
    "a une adresse dans l'État de Nouvelle-Galles du Sud associée à son ABN, ACN, RBN ou ARBN; ou a une adresse d'entreprise valide dans l'État de Nouvelle-Galles du Sud.<br/>" .
    "<b>Critère B - Résidents de la Nouvelle-Galles du Sud</b><br/>" .
    "Le demandeur doit être un citoyen australien ou un résident ayant une adresse valide dans l'État de Nouvelle-Galles du Sud.<br/>" .
    "<b>Critère C - Entités associées</b><br/>" .
    "Le demandeur doit être une entité associée. Le demandeur peut demander un nom de domaine qui est a une correspondance exacte ou partielle, ou qui est une abréviation, ou un acronyme du:<br/>" .
    "nom commercial du demandeur ou du nom sous lequel le demandeur est généralement connu (c'est-à-dire un surnom), le nom de l'entreprise doit être enregistré auprès de l'autorité compétente " .
    "dans la juridiction où cette entreprise est domiciliée; ou un produit que l'entité associée fabrique ou vend à des entités ou des particuliers résidant dans l'État de Nouvelle-Galles du Sud;" .
    "un service que l'entité associée fournit aux résidents de l'État de Nouvelle-Galles du Sud; un événement que l'entité associée organise ou parraine dans l'État de la Nouvelle-Galles du Sud;" .
    "une activité que l'entité associée facilite dans l'État de Nouvelle-Galles du Sud; ou un cours ou programme de formation que l'entité associée propose aux résidents de l'État de Nouvelle-Galles du Sud."
);

// .TRAVEL
$_LANG["hxflagstraveltldtravelindustry"] = "Liés à l'industrie du voyage";
$_LANG["hxflagstraveltldtravelindustrydescr"] = "(Nous reconnaissons avoir une relation avec l'industrie du voyage et nous sommes engagés ou prévoyons de nous engager dans des activités liées aux voyages.)";
$_LANG["hxflagstraveltldyesno1"] = "Oui";
$_LANG["hxflagstraveltldyesno0"] = "Non";

// .US
// Options, Intended Use
$_LANG["hxflagsustldintendedusep1"] = "Utilisation commerciale à but lucratif";
$_LANG["hxflagsustldintendedusep2"] = "Entreprise à but non lucratif / Club / Association / Organisation religieuse";
$_LANG["hxflagsustldintendedusep3"] = "Usage personnel";
$_LANG["hxflagsustldintendedusep4"] = "Un but éducatif";
$_LANG["hxflagsustldintendedusep5"] = "Objectifs gouvernementaux";
// Options, Nexus Category, https://www.about.us/policies/ustld-nexus-codes
$_LANG["hxflagsustldnexuscategoryc11"] = "[C11] Une personne physique qui est un citoyen américain";
$_LANG["hxflagsustldnexuscategoryc12"] = "[C12] Une personne physique qui est un résident permanent des États-Unis d'Amérique ou de l'un de ses biens ou territoires";
$_LANG["hxflagsustldnexuscategoryc21"] = "[C21] Une organisation ou entreprise basée aux États-Unis; voir ci-dessous";
$_LANG["hxflagsustldnexuscategoryc31"] = "[C31] Une entité ou organisation étrangère; voir ci-dessous";
$_LANG["hxflagsustldnexuscategoryc32"] = "[C32] Une entité étrangère qui a un bureau ou une autre installation aux États-Unis";
$_LANG["hxflagsustldnexuscategorycdescr"] = (
    "<ul><li>[C21]: Une organisation ou entreprise basée aux États-Unis dans l'un des cinquante (50) états américains, dans le District de Columbia ou dans l'un des territoires des États-Unis; " .
    "ou constitué en vertu des lois d'un état des États-Unis d'Amérique, le district de " .
    "Columbia ou de l'un quelconque de ses biens ou territoires ou d'une entité gouvernementale fédérale, d'état ou locale des États-Unis ou d'une de ses subdivisions politiques</li>" .
    "<li>[C31]: Une entité ou organisation étrangère qui a une présence de bonne foi aux États-Unis d'Amérique ou dans l'un de ses biens ou territoires et qui se livre régulièrement à des " .
    "activités / ventes licites de biens ou de services ou d'autres activités commerciales ou non commerciales. (à but lucratif ou non lucratif)" .
    "</li></ul>"
);
$_LANG["hxflagsustldnexuscountrydescr"] = "<div>préciser la nationalité d'origine du titulaire (dans le cas des deux dernières options de catégorie Nexus (C31 ou C32)).</div>";

// .XXX
$_LANG["hxflagsxxxtldnonresolvingdomain"] = "Domaine sans résolution";
$_LANG["hxflagsxxxtldmembershipid"] = "ID d'adhésion .XXX";
$_LANG["hxflagsxxxtldmembershipiddescr"] = "(Obligatoire pour que votre domaine .XXX fonctionne)";
// Options, Non-Resolving Domain
$_LANG["hxflagsxxxtldnonresolvingdomain0"] = "Non - Ce domaine DOIT résoudre";
$_LANG["hxflagsxxxtldnonresolvingdomain1"] = "Oui - Ce domaine NE DOIT PAS résoudre";

// ----------------------------------------------------------------------
// ----------------------- WHOIS PRIVACY --------------------------------
// ----------------------------------------------------------------------
$_LANG["hxwhoisprivacy"] = "Confidentialité WHOIS";
$_LANG["hxwhoisprivacyrequestsuccess"] = "Les modifications apportées au service de confidentialité WHOIS ont été appliquées avec succès.";
$_LANG["hxwhoisprivacywhy"] = "Pourquoi la confidentialité WHOIS est importante";
$_LANG["hxwhoisprivacyreason"] = (
    "L'enregistrement de nom de domaine nécessite la fourniture d'informations de contact personnelles pour un stockage permanent géré par des serveurs tiers pour le WHOIS. " .
    "Cela signifie que votre nom, adresse, numéro de téléphone et e-mail sont enregistrés et détenus par des tiers sans restriction. Certains registres proposent leur " .
    "propre service de confidentialité WHOIS gratuitement qui permet de protéger les données WHOIS de tous les tiers."
);
$_LANG["hxwhoisprivacystatus"] = "Statut de confidentialité WHOIS";
$_LANG["hxwhoisprivacystatus1"] = "Vos informations WHOIS sont actuellement protégées";
$_LANG["hxwhoisprivacystatus0"] = "Vos informations WHOIS ne sont actuellement pas protégées";
$_LANG["hxwhoisprivacystatusnp"] = "Le service de confidentialité WHOIS est UNIQUEMENT disponible pour les particuliers";
$_LANG["hxwhoisprivacybttnenable"] = "Activer";
$_LANG["hxwhoisprivacybttndisable"] = "Désactiver";

// ----------------------------------------------------------------------
// ----------------------- DNSSEC MANAGEMENT ----------------------------
// ----------------------------------------------------------------------
$_LANG["hxdnssecmanagement"] = "Gestion DNSSEC";

// ----------------------------------------------------------------------
// ----------------------- Private Nameservers List ---------------------
// ----------------------------------------------------------------------
$_LANG["hxpnslist"] = "Liste Serveur DNS privé";
$_LANG["hxpnscolpns"] = "Serveur DNS privé";
$_LANG["hxpnscolip"] = "adresse IP";
$_LANG["hxpnsempty"] = "Aucun serveur DNS privé enregistré sous ce nom de domaine.";

// ----------------------------------------------------------------------
// ----------------------- Web Apps -------------------------------------
// ----------------------------------------------------------------------
$_LANG["hxwebapps"] = "Applications Web";

// ----------------------------------------------------------------------
// ------------------ Contact Information -------------------------------
// ----------------------------------------------------------------------
$_LANG["hxdomaincontactstradeinfo"] = (
    "Les modifications des données de contact du titulaire peuvent entraîner un " .
    "processus dit de \"Trade\" qui, dans certains cas, n'est pas achevé en temps réel. " .
    "Veuillez être patient si les changements ne sont pas reflétés immédiatement."
);
