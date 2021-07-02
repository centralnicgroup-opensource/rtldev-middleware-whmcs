<?php

namespace WHMCS\Module\Registrar\Ispapi;

use WHMCS\Module\Registrar\Ispapi\Lang as L;

// NOTE: NEVER change the Name of the fields, otherwise WHMCS won't be able to map the
// data to fields for existing entries.

/**
 * AdditionalFields class
 *
 * Covering anything useful we need to better support additional domain fields in WHMCS
 * inherits from \WHMCS\Domains\AdditionalFields to allow access to WHMCS internals for reuse
 */
class AdditionalFields extends \WHMCS\Domains\AdditionalFields
{
    /**
     * translation key prefix
     * @static
     */
    public static $transpfx = "hxflags";
    /**
     * boolean flag: is OT&E system connection
     * @static
     */
    public static $isOTE = false;
    /**
     * system entity id (OTE / LIVE). Used as part transition key
     * @static
     */
    public static $entity = "LIVE";
    /**
     * additional fields configuration split into system entity parts
     * next depth will be the process type and then the domain extension
     * @static
     */
    public static $additionalfieldscfg = [
        "OTE" => null,
        "LIVE" => null
    ];
    /**
     * container to keep client related data like .DK Hostmaster ID or VAT ID
     */
    public static $clientData = [];
    /**
     * Method to initiate the class, entry point for `ispapi_AdditionalDomainFields`
     *
     * Initiates the additional domain fields configuration
     * @static
     */
    public static function init($isOTE)
    {
        self::loadClientDefaults();
        self::$isOTE = $isOTE;
        self::$entity = $isOTE ? "OTE" : "LIVE";
        if (!is_null(self::$additionalfieldscfg[self::$entity])) {
            return;
        }
        self::$additionalfieldscfg[self::$entity] = [
            "register" => [
                // ---------------------- A ---------------------------------
                ".abogado" => [ self::getHighlyRegulatedTLDField(".abogado") ],
                ".ae" => [ self::getRegulatedTLDField(".ae") ],
                ".aero" => [
                    [
                        "Name" => ".aero ID",
                        "Ispapi-Name" => "X-AERO-ENS-AUTH-ID"
                    ],
                    [
                        "Name" => "Password",
                        "Ispapi-Name" => "X-AERO-ENS-AUTH-KEY",
                        "Required" => true
                    ]
                ],
                ".attorney" => [ self::getHighlyRegulatedTLDField(".attorney") ],//NOTAC
                // ---------------------- B ---------------------------------
                ".bank" => [self::getAllocationTokenField()],
                ".barcelona" => [self::getIntendedUseField()],
                ".boats" => [ self::getHighlyRegulatedTLDField(".boats") ],
                ".broker" => [ self::getHighlyRegulatedTLDField(".broker") ],
                // ---------------------- C ---------------------------------
                ".cat" => [self::getHighlyRegulatedTLDField(".cat"), self::getIntendedUseField()],
                ".ca" => [
                    self::getLegalTypeField(".ca", [
                        "Options" => [
                            "CCO", "CCT", "RES", "GOV", "EDU", "ASS", "HOS", "PRT", "TDM", "TRD",
                            "PLT", "LAM", "TRS", "ABO", "INB", "LGR", "OMK", "MAJ"
                        ],
                        "Description" => "catldlegaltypedescr",
                        "Required" => true,
                        "Ispapi-Name" => "X-CA-LEGALTYPE"
                    ]),
                    self::getLanguageField([
                        "Name" => "Contact Language",
                        "Options" => ["EN", "FR"],
                        "Required" => true,
                        "Ispapi-Name" => "X-CA-LANGUAGE"
                    ]),
                    [
                        "Name" => "Registry Information",
                        "Description" => "catldregistryinformationdescr"
                    ]
                ],
                ".cfd" => [ self::getHighlyRegulatedTLDField(".cfd") ],
                ".cn" => [
                    self::getContactIdentificationField("REGISTRANT", [
                        "Required" => true,
                        "Ispapi-Name" => "X-CN-REGISTRANT-ID-NUMBER"
                    ]),
                    self::getContactTypeField(".cn", "REGISTRANT", [
                        "Options" => [
                            "SFZ", "HZ", "GAJMTX", "TWJMTX", "WJLSFZ", "GAJZZ", "TWJZZ", "JGZ",
                            "ORG", "YYZZ", "TYDM", "BDDM", "JDDWFW", "SYDWFR", "WGCZJG", "SHTTFR",
                            "ZJCS", "MBFQY", "JJHFR", "LSZY", "WGZHWH", "WLCZJG", "SFJD", "JWJG",
                            "SHFWJG", "MBXXBX", "YLJGZY", "GZJGZY", "BJWSXX", "QT"
                        ],
                        "Ispapi-Name" => "X-CN-REGISTRANT-ID-TYPE"
                    ])
                ],
                ".com.br" => [
                    self::getRegistrantIdentificationField(".com.br", [
                        "Name" => "Identification Number",
                        "LangVar" => "identificationnumber",
                        "Description" => "combrtldidentificationnumberdescr",
                        "Ispapi-Name" => "X-BR-REGISTER-NUMBER"
                    ])
                ],
                ".com.au" => [
                    self::getContactIdentificationField("REGISTRANT", [
                        "Required" => true,
                        "Ispapi-Name" => "X-AU-REGISTRANT-ID-NUMBER"
                    ]),
                    self::getContactTypeField(".com.au", "REGISTRANT", [
                        "Required" => true,
                        "Options" =>  [ "ABN", "ACN", "RBN", "TM" ],
                        "Ispapi-Name" => "X-AU-REGISTRANT-ID-TYPE"
                    ])
                ],
                // ---------------------- D ---------------------------------
                ".de" => [
                    self::getContactIdentificationField("", [
                        "Name" => "General Request Contact",
                        "Description" => "detldgeneralrequestcontactdescr",
                        "Ispapi-Name" => "X-DE-GENERAL-REQUEST",
                        "LangVar" => "detldgeneralrequestcontact"
                    ]),
                    self::getContactIdentificationField("", [
                        "Name" => "Abuse Team Contact",
                        "Description" => "detldabuseteamcontactdescr",
                        "Ispapi-Name" => "X-DE-ABUSE-CONTACT",
                        "LangVar" => "detldabuseteamcontact"
                    ])
                ],
                ".dentist" => [ self::getHighlyRegulatedTLDField(".dentist") ],//NOTAC
                ".dk" => [
                    self::getLegalTypeField(".dk", [
                        "Name" => "Registrant Legal Type",
                        "LangVar" => "dktldregistrantlegaltype",
                        "Description" => "dktldlegaltypedescr",
                        "Required" => true,
                        "Ispapi-CmdRemove" => [
                            "INDIV" => [
                                "OWNERCONTACT0" => "ORGANIZATION"
                            ]
                        ]
                    ]),
                    self::getVATIDField(".dk", "REGISTRANT", [
                        "Required" => [ "Registrant Legal Type" => ["ORG"] ],
                        "Description" => "dktldregistrantvatiddescr"
                    ]),
                    self::getContactIdentificationField("", [
                        "Name" => "Registrant contact",
                        "Description" => "dktldcontactdescr",
                        "Ispapi-Name" => "X-DK-REGISTRANT-CONTACT",
                        "LangVar" => "dkregistrantcontact",
                        "Ispapi-Prefill" => "DK-ID"
                    ]),
                    self::getLegalTypeField(".dk", [
                        "Name" => "Admin Legal Type",
                        "LangVar" => "dktldadminlegaltype",
                        "Description" => "dktldlegaltypedescr",
                        "Required" => true,
                        "Ispapi-CmdRemove" => [
                            "INDIV" => [
                                "ADMINCONTACT0" => "ORGANIZATION"
                            ]
                        ]
                    ]),
                    self::getVATIDField(".dk", "ADMIN", [
                        "Required" => [ "Admin Legal Type" => ["ORG"] ],
                        "Description" => "dktldadminvatiddescr"
                    ]),
                    self::getContactIdentificationField("", [
                        "Name" => "Admin contact",
                        "Description" => "dktldcontactdescr",
                        "Ispapi-Name" => "X-DK-ADMIN-CONTACT",
                        "LangVar" => "dkadmincontact",
                        "Ispapi-Prefill" => "DK-ID"
                    ])
                ],
                // ---------------------- E ---------------------------------
                ".eco" => [ self::getHighlyRegulatedTLDField(".eco") ],
                ".es" => [
                    self::getLegalTypeField(".es", [
                        "Name" => "Legal Form",
                        "LangVar" => "estldlegalform",
                        "Options" => [
                            "1", "39", "47", "59", "68", "124", "150", "152", "164", "181", "197", "203", "229", "269", "286", "365",
                            "434", "436", "439", "476", "510", "524", "525", "554", "560", "562", "566", "608", "612", "713", "717", "744",
                            "745", "746", "747", "878", "879", "877"
                        ],
                        "Required" => true,
                        "Ispapi-Name" => "X-ES-REGISTRANT-FORM-JURIDICA"
                    ]),
                    self::getIndividualRegulatedTLDField(".es", [
                        "Name" => "Agreement",
                        "Required" => ["Legal Type" => "1"]//only for registrant of type individual
                    ]),
                    self::getContactTypeField(".es", "REGISTRANT", [
                        "Name" => "Registrant Type",
                        "LangVar" => "estldregistranttype",
                        "Options" => [ "0", "1", "3" ],
                        // don't set it to required as 0 doesn't go through #CORE-14277
                        "Ispapi-Name" => "X-ES-REGISTRANT-TIPO-IDENTIFICACION"
                    ]),
                    self::getContactIdentificationField("REGISTRANT", [
                        "Name" => "Registrant Identification Number",
                        "Required" => true,
                        "Ispapi-Name" => "X-ES-REGISTRANT-IDENTIFICACION",
                        "LangVar" => "estldregistrantidentificationnumber"
                    ]),
                    self::getContactTypeField(".es", "ADMIN", [
                        "Name" => "Admin Type",
                        "LangVar" => "estldadmintype",
                        "Options" => [ "0", "1", "3" ],
                        // don't set it to required as 0 doesn't go through #CORE-14277
                        "Ispapi-Name" => "X-ES-REGISTRANT-TIPO-IDENTIFICACION"
                    ]),
                    self::getContactIdentificationField("ADMIN", [
                        "Name" => "Admin-Contact Identification Number",
                        "Required" => true,
                        "Ispapi-Name" => "X-ES-ADMIN-IDENTIFICACION",
                        "LangVar" => "estldadminidentificationnumber"
                    ])
                ],
                ".eu" => [
                    self::getCountryField([
                        "Name" => "Registrant Citizenship",
                        "Options" => "{EUCountryCodeMap}",
                        "Description" => "eutldregistrantcitizenshipdescr",
                        "Ispapi-Name" => "X-EU-REGISTRANT-CITIZENSHIP"
                    ])
                ],
                // ---------------------- F ---------------------------------
                ".fi" => [
                    self::getRegulatedTLDField(".fi", ["Name" => "FICORA Agreement"]),
                    self::getRegistrantIdentificationField(".fi", [
                        "Required" => false,
                        "Description" => "fitldregistrantidnumberdescr"
                    ]),
                    [
                        "Name"  => "Registrant Birthdate",
                        "LangVar" => "registrantbirthdate",
                        "Type"  => "text",
                        "Description" => "fitldregistrantbirthdatedescr"
                    ]
                ],
                ".forex" => [ self::getHighlyRegulatedTLDField(".forex") ],
                ".fr" => [
                    self::getLegalTypeField("afnic", [//override default whmcs field
                        "Required" => true,
                        "Options" => [ "INDIV", "ORG1", "ORG2", "ORG3", "ORG4", "ASS" ]
                    ]),
                    [
                        "Name" => "VATID or SIREN/SIRET number",
                        "LangVar" => "afnictldvatid",
                        "Type" => "text",
                        "Ispapi-Name" => "X-FR-REGISTRANT-LEGAL-ID",
                        "Required" => [ "Legal Type" => [ "ORG1" ] ],
                        "Description" => "afnictldvatiddescr"
                    ],[//override default whmcs field
                        "Name" => "Trademark Number",
                        "LangVar" => "afnictldtrademark",
                        "Ispapi-Name" => "X-FR-REGISTRANT-TRADEMARK-NUMBER",
                        "Required" => [ "Legal Type" => [ "ORG2" ] ],
                        "Description" => "afnictldtrademarkdescr"
                    ],[//override default whmcs field
                        "Name" => "DUNS number",
                        "LangVar" => "afnictldduns",
                        "Ispapi-Name" => "X-FR-REGISTRANT-DUNS-NUMBER",
                        "Required" => [ "Legal Type" => [ "ORG3" ] ],
                        "Description" => "afnictlddunsdescr"
                    ],[
                        "Name" => "Local ID",
                        "LangVar" => "afnictldlocalid",
                        "Type" => "text",
                        "Ispapi-Name" => "X-FR-REGISTRANT-LOCAL-ID",
                        "Required" => [ "Legal Type" => [ "ORG4" ] ],
                        "Description" => "afnictldlocaliddescr"
                    ],[
                        "Name" => "Date of Declaration",
                        "LangVar" => "afnictldjodod",
                        "Type" => "text",
                        "Ispapi-Name" => "X-FR-REGISTRANT-JO-DATE-DECLARATION",
                        "Required" => [ "Legal Type" => [ "ASS" ] ],
                        "Description" => "afnictldjododdescr"
                    ],[
                        "Name" => "Number [JO]",
                        "LangVar" => "afnictldjonumber",
                        "Type" => "text",
                        "Ispapi-Name" => "X-FR-REGISTRANT-JO-NUMBER",
                        "Required" => [ "Legal Type" => [ "ASS" ] ],
                        "Description" => "afnictldjonumberdescr"
                    ],[
                        "Name" => "Page of Announcement [JO]",
                        "LangVar" => "afnictldjopage",
                        "Type" => "text",
                        "Ispapi-Name" => "X-FR-REGISTRANT-JO-PAGE",
                        "Required" => [ "Legal Type" => [ "ASS" ] ],
                        "Description" => "afnictldjopagedescr"
                    ],[
                        "Name" => "Date of Publication [JO]",
                        "LangVar" => "afnictldjodop",
                        "Type" => "text",
                        "Ispapi-Name" => "X-FR-REGISTRANT-JO-DATE-PUBLICATION",
                        "Required" => [ "Legal Type" => [ "ASS" ] ],
                        "Description" => "afnictldjodopdescr"
                    ]
                ],
                // ---------------------- G ---------------------------------
                ".gay" => [
                    self::getHighlyRegulatedTLDField(".gay", [
                        "Ispapi-Name" => "X-GAY-ACCEPT-REQUIREMENTS"
                    ])
                ],
                // ---------------------- H ---------------------------------
                ".health" => [ self::getHighlyRegulatedTLDField(".health") ],
                ".hk" => [
                    self::getIndividualRegulatedTLDField(".hk", [
                        "Name" => "HK Terms for individuals",
                        "Required" => [
                            "Registrant Document Type" => [
                                "HKID",
                                "OTHID",
                                "PASSNO",
                                "BIRTHCERT",
                                "OTHIDV"
                            ]
                        ]
                    ]),
                    [
                        "Name" => "Registrant Document Type",
                        "Type" => "dropdown",
                        "Options" => self::getOptions(".hk", "Registrant Document Type", [
                            "HKID", "OTHID", "PASSNO", "BIRTHCERT", "OTHIDV", "BR", "CI", "CRS", "HKSARG",
                            "HKORDINANCE", "OTHORG"
                        ], true),
                        "Description" => "hktldregistrantdocumenttypedescr",
                        "Required" => true,
                        "Ispapi-Name" => "X-HK-REGISTRANT-DOCUMENT-TYPE"
                    ],[
                        "Name" => "Registrant Other Document Type",
                        "Type" => "text",
                        "Required" => [
                            "Registrant Document Type" => [
                                "OTHIDV",
                                "OTHORG"
                            ]
                        ],
                        "Description" => "hktldregistrantotherdocumenttypedescr",
                        "Ispapi-Name" => "X-HK-REGISTRANT-OTHER-DOCUMENT-TYPE"
                    ],[
                        "Name" => "Registrant Document Number",
                        "Type" => "text",
                        "Required" => true,
                        "Ispapi-Name" => "X-HK-REGISTRANT-DOCUMENT-NUMBER"
                    ],
                    self::getCountryField([
                        "Name" => "Registrant Document Origin Country",
                        "Required" => true,
                        "Options" => "{CountryCodeMap}",
                        "Ispapi-Name" => "X-HK-REGISTRANT-DOCUMENT-ORIGIN-COUNTRY"
                    ]),
                    [
                        "Name" => "Registrant Birth Date for individuals",
                        "Type" => "text",
                        "Required" => [
                            "Registrant Document Type" => [
                                "HKID",
                                "OTHID",
                                "PASSNO",
                                "BIRTHCERT",
                                "OTHIDV"
                            ]
                        ],
                        "Description" => "hktldregistrantbirthdateforindividualsdescr",
                        "Ispapi-Name" => "X-HK-REGISTRANT-BIRTH-DATE"
                    ]
                ],
                ".homes" => [ self::getHighlyRegulatedTLDField(".homes") ],
                // ---------------------- I ---------------------------------
                ".id" => [ self::getHighlyRegulatedTLDField(".id") ],
                ".ie" => [
                    self::getLegalTypeField(".ie", [
                        "Name" => "Registrant Class",
                        "Options" => [
                            "Company", "Business Owner", "Club/Band/Local Group", "School/College", "State Agency",
                            "Charity", "Blogger/Other"
                        ],
                        "Required" => true,
                        "Ispapi-Name" => "X-IE-REGISTRANT-CLASS"
                    ]),
                    [
                        "Name" => "Proof of connection to Ireland",
                        "Type" => "text",
                        "Description" => "ietldproofofconnectiontoirelanddescr",
                        "Required" => true,
                        "Ispapi-Name" => "X-IE-REGISTRANT-REMARKS",
                    ],
                    self::getRegistrantIdentificationField(".ie", [
                        "Required" => false
                    ]),
                    self::getVATIDField(".ie", "REGISTRANT", [
                        "Required" =>  ["Registrant Class" => ["Company"]]
                    ])
                ],
                ".insurance" => [self::getAllocationTokenField()],
                ".it" => [
                    self::getRegulatedTLDField(".it", [//reuse default whmcs field
                        "Name" => "Section 3 Agreement",
                        "LangVar" => "ittldacceptsection3",
                        "Ispapi-Name" => "X-IT-ACCEPT-LIABILITY-TAC"
                    ], "section3"),
                    self::getRegulatedTLDField(".it", [//reuse default whmcs field
                        "Name" => "Section 5 Agreement",
                        "LangVar" => "ittldacceptsection5",
                        "Ispapi-Name" => "X-IT-ACCEPT-REGISTRATION-TAC",
                        "Required" => false
                    ], "section5"),
                    self::getRegulatedTLDField(".it", [//reuse default whmcs field
                        "Name" => "Section 6 Agreement",
                        "LangVar" => "ittldacceptsection6",
                        "Ispapi-Name" => "X-IT-ACCEPT-DIFFUSION-AND-ACCESSIBILITY-TAC"
                    ], "section6"),
                    self::getRegulatedTLDField(".it", [//reuse default whmcs field
                        "Name" => "Section 7 Agreement",
                        "LangVar" => "ittldacceptsection7",
                        "Ispapi-Name" => "X-IT-ACCEPT-EXPLICIT-TAC"
                    ], "section7"),
                    [
                        "Name" => "PIN",
                        "Type" => "text",
                        "Ispapi-Name" => "X-IT-PIN"
                    ],
                    self::getCountryField([
                        "Name" => "Registrant Nationality",
                        "Description" => "ittldregistrantnationalitydescr",
                        "Options" => "{CountryCodeMap}",
                        "Ispapi-Name" => "X-IT-NATIONALITY"
                    ]),
                    self::getLegalTypeField(".it", [
                        "Name" => "Registrant Legal Type",
                        "Options" => [ "1", "2", "3", "4", "5", "6", "7" ],
                        "Ispapi-Name" => "X-IT-REGISTRANT-ENTITY-TYPE"
                    ])
                ],
                // ---------------------- J ---------------------------------
                ".jobs" => [
                    [
                        "Name" => "Company URL",
                        "Ispapi-Name" => "X-JOBS-COMPANYURL"
                    ],
                    self::getLegalTypeField(".jobs", [
                        "Name" => "Industry Classification",
                        "Options" => [
                            "2", "3", "21", "5", "4", "12", "6", "7", "13", "19", "10", "11", "15",
                            "16", "17", "18", "20", "9", "26", "22", "14", "23", "8", "24", "25"
                        ],
                        "Required" => true,
                        "Ispapi-Name" => "X-JOBS-INDUSTRYCLASSIFICATION"
                    ]),
                    self::getYesNoField(".jobs", [
                        "Name" => "Member of a Human Resources Association",
                        "Ispapi-Name" => "X-JOBS-HRANAME"
                    ]),
                    [
                        "Name" => "Contact Job Title (e.g. CEO)",
                        "Type" => "text",
                        "Required" => true,
                        "Ispapi-Name" => "X-JOBS-TITLE"
                    ],
                    self::getContactTypeField(".jobs", "", [
                        "Name" => "Contact Type",
                        "Options" => ["1", "0"],
                        "Ispapi-Name" => "X-JOBS-ADMINTYPE",
                        "LangVar" => "jobstldcontacttype"
                    ])
                ],
                // ---------------------- L ---------------------------------
                ".lotto" => [
                    [
                        "Name" => "Membership Contact ID",
                        "Type" => "text",
                        "Required" => true,
                        "Ispapi-Name" => "X-ASSOCIATION-ID"
                    ],[
                        "Name" => "Verification Code",
                        "Type" => "text",
                        "Required" => true,
                        "Ispapi-Name" => "X-ASSOCIATION-AUTH"
                    ]
                ],
                ".lv" => [
                    self::getVATIDField(".lv", "REGISTRANT", [
                        "Name" => "Vat ID",
                        "Required" => false,
                        "Ispapi-Name" => "X-VATID"
                    ]),
                    self::getRegistrantIdentificationField(".lv", [
                        "Name" => "ID number",
                        "Required" => false,
                        "Ispapi-Name" => "X-IDNUMBER"
                    ])
                ],
                ".law" => [ self::getHighlyRegulatedTLDField(".law") ],
                ".lawyer" => [ self::getHighlyRegulatedTLDField(".lawyer") ],//NOTAC
                ".lt" => [
                    [
                        "Name" => "Legal Entity Identification Code",
                        "Type" => "text",
                        "Required" => false,
                        "Ispapi-Name" => "X-LT-REGISTRANT-LEGAL-ID"
                    ]
                ],
                // ---------------------- M ---------------------------------
                ".madrid" => [ self::getIntendedUseField() ],
                ".makeup" => [ self::getHighlyRegulatedTLDField(".makeup") ],//NOTAC
                ".markets" => [ self::getHighlyRegulatedTLDField(".markets") ],
                ".melbourne" => [
                    self::getNexusCategoryField(".melbourne", [
                        "Options" => [ "A", "B", "C" ],
                        "Description" => "melbournetldnexuscategorydescr"
                    ])
                ],
                ".mk" => [
                    self::getVATIDField(".mk", "REGISTRANT", [
                        "Required" => false
                    ]),
                    self::getContactIdentificationField("REGISTRANT")
                ],
                ".my" => [
                    self::getContactTypeField(".my", "REGISTRANT", [
                        "Name" => "Registrant Organisation Type",
                        "LangVar" => "mytldregistrantorganisationtype",
                        "Options" => [
                            "1", "2", "3", "4", "5", "6", "7", "8", "9", "10","11", "12", "13", "14", "15", "16",
                            "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"
                        ],
                        "Required" => false,
                        "Ispapi-Name" => "X-MY-REGISTRANT-ORGANIZATION-TYPE"
                    ]),
                    self::getContactIdentificationField("REGISTRANT"),
                    self::getContactIdentificationField("ADMIN"),
                    self::getContactIdentificationField("TECH"),
                    self::getContactIdentificationField("BILLING")
                ],
                // ---------------------- N ---------------------------------
                ".new" => [
                    self::getRegulatedTLDField(".new", [
                        "Ispapi-Name" => "X-ACCEPT-SSL-REQUIREMENT",
                        "Required" => true
                    ])
                ],
                ".ngo" => [ self::getRegulatedTLDField(".ngo") ],
                ".no" => [
                    self::getRegistrantIdentificationField(".no", [
                        "Name" => "Registrant ID number",
                        "Ispapi-Name" => "X-NO-REGISTRANT-IDENTITY"
                    ])
                ],
                ".nu" => [
                    self::getRegulatedTLDField(".nu"),
                    self::getContactIdentificationField("REGISTRANT", [ "Description" => "nutldregistrantidnumberdescr"]),
                    self::getVATIDField(".nu", "REGISTRANT", [
                        "Required" => false,
                        "Ispapi-Name" => "X-VATID",
                        "Description" => "nutldvatiddescr"
                    ])
                ],
                ".nyc" => [
                    self::getNexusCategoryField(".nyc", [
                        "Name" => "NEXUS Category",
                        "Options" => [ "1", "2" ],
                        "Description" => "nyctldnexuscategorydescr",
                        "Ispapi-Name" => "X-NYC-REGISTRANT-NEXUS-CATEGORY"
                    ])
                ],
                // ---------------------- P ---------------------------------
                ".paris" => [ self::getRegulatedTLDField(".paris") ],
                ".pt" => [
                    self::getVATIDField(".pt", "REGISTRANT", [
                        "Name" => "Registrant Vat ID",
                        "Required" => false,
                        "Ispapi-Name" => "X-PT-REGISTRANT-VATID"
                    ]),
                    self::getVATIDField(".pt", "TECH", [
                        "Name" => "Tech vat ID",
                        "Required" => false,
                        "Ispapi-Name" => "X-PT-TECH-VATID"
                    ])
                ],
                // ---------------------- Q ---------------------------------
                ".quebec" => [ self::getIntendedUseField() ],
                // ---------------------- R ---------------------------------
                ".ro" => [
                    self::getContactIdentificationField("REGISTRANT"),
                    self::getVATIDField(".ro", "REGISTRANT", [
                        "Description" => "rotldregistrantvatiddescr",
                        "Required" => false
                    ])
                ],
                ".ru" => [
                    self::getLegalTypeField(".ru", ["Required" => true]),
                    self::getIndividualRegulatedTLDField(".ru", [
                        "Required" => [ "Legal Type" => [ "INDIV" ] ]
                    ]),
                    [
                        "Name"  => "Registrant Birthday",
                        "Description" => "rutldregistrantbirthdaydescr",
                        "Type" => "text",
                        "Required" => [ "Legal Type" => [ "INDIV" ] ],
                        "Ispapi-Name" => "X-RU-REGISTRANT-BIRTH-DATE"
                    ], [
                        "Name" => "Registrant Passport Data",
                        "Description" => "rutldregistrantpassportdatadescr",
                        "Type" => "text",
                        "Required" => [ "Legal Type" => [ "INDIV" ] ],
                        "Ispapi-Name" => "X-RU-REGISTRANT-PASSPORT-DATA"
                    ]
                ],
                // ---------------------- S ---------------------------------
                ".scot" => [self::getIntendedUseField()],
                ".se" => [
                    self::getRegulatedTLDField(".se"),
                    [
                        "Name" => "Registrant ID Number",
                        "LangVar" => "identificationnumber",
                        "Type" => "text",
                        "Description" => "setldidentificationnumberdescr",
                        "Ispapi-Name" => "X-NICSE-IDNUMBER"
                    ],[
                        "Name" => "Registrant VAT ID",
                        "Type" => "text",
                        "LangVar" => "registrantvatid",
                        "Ispapi-Name" => "X-NICSE-VATID",
                        "Ispapi-Prefill" => "VAT-ID"
                    ]
                ],
                ".sg" => [
                    [
                        "Name" => "RCB/Singapore ID",
                        "Type" => "text",
                        "Required" => false,
                        "Ispapi-Name" => "X-SG-RCBID"
                    ],
                    self::getContactIdentificationField("ADMIN", [
                        "Name" => "Admin ID number"
                    ])
                ],
                ".sport" => [ self::getIntendedUseField() ],
                ".spreadbetting" => [ self::getHighlyRegulatedTLDField(".spreadbetting") ],
                ".swiss" => [
                    [
                        "Name" => "Enterprise ID",
                        "Type" => "text",
                        "Description" => "swisstldregistrantenterpriseiddescr",
                        "Default" => "CHE",
                        "Ispapi-Name" => "X-SWISS-REGISTRANT-ENTERPRISE-ID"
                    ],
                    self::getIntendedUseField("", [
                        "Name" => "Intended use"
                    ])
                ],
                ".sydney" => [
                    self::getNexusCategoryField(".sydney", [
                        "Options" => [ "A", "B", "C" ],
                        "Description" => "sydneytldnexuscategorydescr"
                    ])
                ],
                // ---------------------- T ---------------------------------
                ".trading" => [ self::getHighlyRegulatedTLDField(".trading") ],
                ".travel" => [
                    self::getYesNoField(".travel", [
                        "Name" => ".travel Industry",
                        "Description" => "traveltldtravelindustrydescr",
                        "Ispapi-Name" => "X-TRAVEL-INDUSTRY",
                        "Options" => [ "1", "0" ],
                        "Required" => true
                    ])
                ],
                // ---------------------- U ---------------------------------
                ".us" => [
                    self::getIntendedUseField(".us", [
                        "Name" => "Application Purpose",
                        "Ispapi-Name" => "X-US-NEXUS-APPPURPOSE",
                        "Type" => "dropdown",
                        "Options" => [ "P1", "P2", "P3", "P4", "P5" ]
                    ]),
                    self::getNexusCategoryField(".us", [
                        "Options" => [ "C11", "C12", "C21", "C31", "C32" ],
                        "Description" => "ustldnexuscategorycdescr"
                    ]),
                    self::getCountryField([
                        "Name" => "Nexus Country",
                        "LangVar" => "nexuscountry",
                        "Description" => "ustldnexuscountrydescr",
                        "Ispapi-Name" => "X-US-NEXUS-VALIDATOR",
                        "Options" => "{CountryCodeMap}",
                        "Required" => [
                            "Nexus Category" => [
                                "C31",
                                "C32"
                            ]
                        ]
                    ])
                ],
                // ---------------------- X ---------------------------------
                ".xxx" => [
                    self::getRegulatedTLDField(".xxx"),
                    self::getYesNoField(".xxx", [
                        "Name" => "Non-Resolving Domain",
                        "Ispapi-Name" => "X-XXX-NON-RESOLVING",
                        "Options" => [ "0", "1" ]
                    ], true),
                    [
                        "Name" => "Membership ID",
                        "Type" => "text",
                        "Description" => "xxxtldmembershipiddescr",
                        "Ispapi-Name" => "X-XXX-MEMBERSHIP-CONTACT",
                        "Required" => false
                    ]
                ],
                // ---------------------- Z ---------------------------------
                ".org.za" => [ self::getHighlyRegulatedTLDField(".za") ]
            ],
            "transfer" => [//TODO review
                ".ca" => [
                    self::getLegalTypeField(".ca", [
                        "Options" => [
                            "CCO", "CCT", "RES", "GOV", "EDU", "ASS", "HOS", "PRT", "TDM", "TRD",
                            "PLT", "LAM", "TRS", "ABO", "INB", "LGR", "OMK", "MAJ"
                        ],
                        "Description" => "catldlegaltypedescr",
                        "Required" => true,
                        "Ispapi-Name" => "X-CA-LEGALTYPE"
                    ])
                ],
                ".cat" => [self::getHighlyRegulatedTLDField(".cat")],
                ".it" => [
                    [
                        "Name" => "PIN",
                        "Type" => "text",
                        "Ispapi-Name" => "X-IT-PIN"
                    ]
                ],
                ".pt" => [
                    [
                        "Name" => "ROID",
                        "Type" => "text",
                        "Required" => true,
                        "Ispapi-Name" => "X-PT-ROID"
                    ]
                ]
            ],
            "trade" => [
                ".be" => [
                    [
                        "Name" => "eppcode",
                        "LangVar" => "_domaineppcode",
                        "Type" => "text",
                        "Required" => false,
                        "Ispapi-Name" => "AUTH",
                        "Description" => "betldtradeauthdescr",
                        "Ispapi-NoSave" => true
                    ]
                ],
                ".pt" => [
                    self::getVATIDField(".pt", "REGISTRANT", [
                        "Name" => "Registrant Vat ID",
                        "Required" => false,
                        "Ispapi-Name" => "X-PT-REGISTRANT-VATID"
                    ])
                ],
                ".swiss" => [
                    [
                        "Name" => "Enterprise ID",
                        "Description" => "swisstldregistrantenterpriseiddescr",
                        "Default" => "CHE",
                        "Ispapi-Name" => "X-SWISS-REGISTRANT-ENTERPRISE-ID"
                    ]
                ]
            ],
            "whoisprivacy" => [
                // for INDIVIDUALS only for the below TLDs, inactive by default
                // which means WHOIS is protected, but can be changed
                ".ca" => [
                    [
                        "Name" => "ID Protection",
                        "Ispapi-Name" => "X-CA-DISCLOSE",
                        "Type" => "dropdown",
                        "Options" => ["0", "1"],
                        "Ispapi-WhoisProtectable" => [
                            "Legal Type" => "/^(CCT|RES|ABO|LGR)$/"
                        ]
                    ]
                ],
                ".se" => [
                    [
                        "Name" => "ID Protection",
                        "Ispapi-Name" => "X-NICSE-DISCLOSE",
                        "Type" => "dropdown",
                        "Options" => ["0", "1"],
                        "Ispapi-WhoisProtectable" => [
                            "ID Number" => "/^.+$/"
                        ]
                    ]
                ],
                ".nz" => [
                    [
                        "Name" => "ID Protection",
                        "Ispapi-Name" => "X-DISCLOSE",
                        "Type" => "dropdown",
                        "Options" => ["0", "1"]
                    ]
                ]
            ]
        ];

        // add translation support in case no generic LangVar field got configured
        foreach (self::$additionalfieldscfg[self::$entity] as $type => &$tlds) {
            foreach ($tlds as $tldkey => &$fields) {
                foreach ($fields as &$f) {
                    // follow a prefixed but similar way WHMCS uses for LangVar ids
                    if (empty($f["LangVar"])) {
                        $f["LangVar"] = self::getTransKey($tldkey, $f["Name"]);
                    }
                    // add translation prefix
                    // prefix is already included in Options, so care just about LangVar and Description
                    if ($f["LangVar"][0] === "_") {
                        $f["LangVar"] = substr($f["LangVar"], 1);
                    } else {
                        $f["LangVar"] = self::$transpfx . $f["LangVar"];
                    }
                    if (!empty($f["Description"])) {// add translation prefix
                        $f["Description"] = self::$transpfx . $f["Description"];
                    }
                }
            }
        }

        // matching configuration for type register
        self::$additionalfieldscfg[self::$entity]["register"][".asn.au"] = self::$additionalfieldscfg[self::$entity]["register"][".com.au"];
        self::$additionalfieldscfg[self::$entity]["register"][".id.au"] = self::$additionalfieldscfg[self::$entity]["register"][".com.au"];
        self::$additionalfieldscfg[self::$entity]["register"][".net.au"] = self::$additionalfieldscfg[self::$entity]["register"][".com.au"];
        self::$additionalfieldscfg[self::$entity]["register"][".org.au"] = self::$additionalfieldscfg[self::$entity]["register"][".com.au"];
        self::$additionalfieldscfg[self::$entity]["register"][".pm"] = self::$additionalfieldscfg[self::$entity]["register"][".fr"];
        self::$additionalfieldscfg[self::$entity]["register"][".re"] = self::$additionalfieldscfg[self::$entity]["register"][".fr"];
        self::$additionalfieldscfg[self::$entity]["register"][".tf"] = self::$additionalfieldscfg[self::$entity]["register"][".fr"];
        self::$additionalfieldscfg[self::$entity]["register"][".wf"] = self::$additionalfieldscfg[self::$entity]["register"][".fr"];
        self::$additionalfieldscfg[self::$entity]["register"][".yt"] = self::$additionalfieldscfg[self::$entity]["register"][".fr"];
        self::$additionalfieldscfg[self::$entity]["register"][".рф"] = self::$additionalfieldscfg[self::$entity]["register"][".ru"];
        self::$additionalfieldscfg[self::$entity]["register"][".香港"] = self::$additionalfieldscfg[self::$entity]["register"][".hk"];
        self::$additionalfieldscfg[self::$entity]["register"][".net.za"] = self::$additionalfieldscfg[self::$entity]["register"][".org.za"];

        // map configuration transfer/trade <- register
        foreach (
            [
            ".abogado", ".ae", ".attorney", ".broker", ".cfd", ".dentist", ".eco", ".eu", ".forex", ".health",
            ".law", ".lawyer", ".lt", ".makeup", ".markets", ".nu", ".ro", ".sg", ".spreadbetting", ".trading", ".us"
            ] as $tld
        ) {
            self::$additionalfieldscfg[self::$entity]["transfer"][$tld] = self::$additionalfieldscfg[self::$entity]["register"][$tld];
            self::$additionalfieldscfg[self::$entity]["trade"][$tld] = self::$additionalfieldscfg[self::$entity]["register"][$tld];
        }

        // map configuration transfer <- register
        foreach ([ ".de", ".nu", ".ro", ".sg", ".spreadbetting" ] as $tld) {
            self::$additionalfieldscfg[self::$entity]["transfer"][$tld] = self::$additionalfieldscfg[self::$entity]["register"][$tld];
        }

        // map configuration trade <- transfer
        foreach ([ ".cat" ] as $tld) {
            self::$additionalfieldscfg[self::$entity]["trade"][$tld] = self::$additionalfieldscfg[self::$entity]["transfer"][$tld];
        }

        // mappable configuration trade <- register
        foreach (
            [
            ".com.au", ".asn.au", ".id.au", ".net.au", ".org.au", ".boats", ".es", ".fi", ".film", ".fr", ".pm", ".re", ".tf", ".travel",
            ".wf", ".yt", ".hk", ".рф", ".homes", ".ie", ".it", ".mk", ".ngo", ".no", ".nu", ".ru", ".se"
            ] as $tld
        ) {
            self::$additionalfieldscfg[self::$entity]["trade"][$tld] = self::$additionalfieldscfg[self::$entity]["register"][$tld];
        }

        // map ALL configurations update <- register (as for trade, we have something separated)
        self::$additionalfieldscfg[self::$entity]["update"] = self::$additionalfieldscfg[self::$entity]["register"];

        // auto-add fax form fields
        foreach (self::$additionalfieldscfg[self::$entity] as $type => &$tlds) {
            foreach ($tlds as $tldkey => &$fields) {
                if ($type === "update") {
                    $tmp = [];
                    foreach ($fields as $field) {
                        if (
                            isset($field["Ispapi-Name"])
                            && preg_match("/X-.+-ACCEPT-.+-TAC$/", $field["Ispapi-Name"])
                        ) {
                            continue;
                        }
                        $tmp[] = $field;
                    }
                    $fields = $tmp;
                } elseif ($type === "registration" || $type === "transfer") {
                    if (self::requiresFaxForm($tldkey, $type)) {
                        $field = self::getFaxFormField($type);
                        $field["LangVar"] = self::$transpfx . $field["LangVar"];
                        if (!empty($field["Description"])) {// add translation prefix
                            $field["Description"] = self::$transpfx . $field["Description"];
                        }
                        $fields[] = $field;
                    }
                }
            }
        }
    }

    /**
     * Load client's default data for pre-filling fields
     */
    public static function loadClientDefaults()
    {
        self::$clientData = [];
        self::$clientData["DK-ID"] = "";
        if (function_exists("getCustomFields")) {
            $cfs = getCustomFields("client", "", $_SESSION["uid"], "on", "");
            foreach ($cfs as $cf) {
                if ("dkhostmasteruserid" === $cf["textid"] && !empty($cf["value"])) {
                    self::$clientData["DK-ID"] = $cf["value"];
                }
            }
        }

        self::$clientData["VAT-ID"] = "";
        $r = localAPI("GetClientsDetails", [
            'clientid' => $_SESSION["uid"]
        ]);
        if ($r["result"] === "success") {
            self::$clientData["VAT-ID"] = $r["client"]["tax_id"];
            $langs = \Lang::getLocales();
            $current = \Lang::getName();
            foreach ($langs as $locale) {
                if ($locale["language"] === $current) {
                    self::$clientData["LANG"] = strtoupper($locale["languageCode"]);
                    break;
                }
            }
        }
    }

    /**
     * Method to dynamically add additional fields to the API command
     *
     * Auto-detects the API parameter name and applies the appropriate POST value
     * The provided command will be updated by reference.
     * @static
     * @param array $params common module parameters
     * @see https://developers.whmcs.com/domain-registrars/module-parameters/
     * @param array $command the API command to update
     */
    public static function addToCMD($params, &$command)
    {
        //TODO cleanup when _AdditionalDomainFields has $params["type"] fixed
        $params = injectDomainObjectIfNecessary($params);
        $type = isset($params["type"]) ? $params["type"] : "register";

        (new self($params["TestMode"] === "on"))
                ->setDomainType($type)
                ->setDomain($params["domainObj"]->getDomain())
                ->setFieldValues($params["additionalfields"])
                ->addToCommand($command);
    }

    /**
     * Method to generate a clean translation key suffix
     * @static
     * @param string $name suffix to cleanup
     * @return string
     */
    public static function cleanTranslationSuffix($name)
    {
        return preg_replace("/[^a-z0-9]/i", "", $name);
    }

    /**
     * Method to return list of additional fields for the given parameter data
     *
     * Keeps generated configuration as TransientData. This will improve performance when fields can be requested from API.
     * @static
     * @param array $params common module parameters
     * @see https://developers.whmcs.com/domain-registrars/module-parameters/
     * @return array
     */
    public static function getAdditionalDomainFields(array $params)
    {
        // TODO Review in case params["type"] is no longer always "register";
        //      Review static method addToCMD
        $tld = $params["tld"];
        $type = $params["type"];

        // check if a configuration exists for the given order type (register/transfer/trade/update)
        $cfg = self::$additionalfieldscfg[self::$entity];
        if (!is_null($cfg) && isset($cfg[$type])) {
            // check if a configuration exists for the given tld
            $tlddotted = "." . $tld;
            if (isset($cfg[$type][$tlddotted])) {
                return self::transform($tlddotted, $cfg[$type][$tlddotted], $params["whmcsVersion"], $params["fields"], $type);
            }
            // check if a configuration exists for 2nd level fallback (in case of incoming 3rd level tld)
            $tldfb = preg_replace("/^[^.]+/", "", $tld);
            if ($tlddotted !== $tldfb && isset($cfg[$type][$tldfb])) {
                return self::transform($tlddotted, $cfg[$type][$tldfb], $params["whmcsVersion"], $params["fields"], $type);
            }
        }
        //nothing found ...
        return self::transform($tlddotted, [], $params["whmcsVersion"], $params["fields"], $type);
    }

    /**
     * Method to generate a generic `Allocation Token` field
     * @static
     * @return array
     */
    public static function getAllocationTokenField()
    {
        return [
            "Name" => "Registry's Allocation Token",
            "LangVar" => "allocationtoken",
            "Type" => "text",
            "Required" => true,
            "Description" => "allocationtokendescr",
            "Ispapi-Name" => "X-ALLOCATIONTOKEN"
        ];
    }

    /**
     * Method to generate a generic contact-type related identification field
     * @static
     * @param string $contacttype contact type (REGISTRANT, ADMIN, TECH, BILLING)
     * @param array $overrides array to override defaults for reuse (optional)
     * @return array
     */
    public static function getContactIdentificationField($contacttype, $overrides = [])
    {
        $name = strtolower($contacttype);
        return array_merge([
            "Name" => ucfirst($name) . " ID Number",
            "LangVar" => $name . "idnumber",
            "Type" => "text",
            "Required" => false,
            "Ispapi-Name" => "X-" . $contacttype . "-IDNUMBER"
        ], $overrides);
    }

    /**
     * Method to generate a generic contact type dropdown list field
     * @static
     * @param string $tld dotted domain name extension
     * @param string $contacttype contact type (REGISTRANT, ADMIN, TECH, BILLING)
     * @param array $overrides array to override defaults for reuse (optional)
     * @return array
     */
    public static function getContactTypeField($tld, $contacttype, $overrides = [])
    {
        $name = strtolower($contacttype);
        $f = array_merge([
            "Name" => ucfirst($name) . " ID Type",
            "LangVar" => $name . "idtype",
            "Type" => "dropdown",
            "Options" => [],
            "Required" => false,
            "Ispapi-Name" => "X-" . $contacttype . "-IDTYPE"
        ], $overrides);
        $f["Options"] = self::getOptions($tld, $f["Name"], $f["Options"], $f["Required"]);
        $f["Default"] = preg_replace("/\|.+$/", "", $f["Options"][0]);
        return $f;
    }

    /**
     * Method to generate a generic country dropdown list field
     *
     * Displays the country name und submits the assigned 2-char country code
     * @static
     * @param array $overrides array to override defaults for reuse
     * @return array
     */
    public static function getCountryField($overrides)
    {
        $cfg = array_merge([
            "Name" => "Registrant Citizenship",
            "Type" => "dropdown",
            "Required" => false
        ], $overrides);
        $locale = \Lang::getLanguageLocale();
        $map = [];
        if ($cfg["Options"] === "{CountryCodeMap}") { // reuse WHMCS placeholder as identifier
            $cfg["Options"] = Country::getCountryCodes();
        }
        if ($cfg["Options"] === "{EUCountryCodeMap}") {
            $cfg["Options"] = Country::getEUMemberStatesCountryCodes();
        }
        foreach ($cfg["Options"] as &$val) {
            $map[$val] = upperCaseFirstLetter(\Punic\Territory::getName($val, $locale));
        }
        asort($map);
        $cfg["Options"] = [];
        foreach ($map as $val => $localizedName) {
            $cfg["Options"][] = ($val . "|" . $localizedName);
        }
        if ($cfg["Required"] !== true) {//false or conditional requirement
            array_unshift($cfg["Options"], "");
        }
        $cfg["Default"] = preg_replace("/\|.+$/", "", $cfg["Options"][0]);
        return $cfg;
    }

    /**
     * Generate a generic fax form agreement field
     * @static
     * @param string $type process type (register/transfer/ownerchange)
     * @return array
     */
    public static function getFaxFormField($type)
    {
        return [
            "Name" => "Fax required",
            "LangVar" => "fax",
            "Type" => "tickbox",
            "Description" => "fax" . self::getFaxType($type) . "descr",
            "Default" => "",
            "Required" => true,
            "Ispapi-NoSave" => true
        ];
    }

    /**
     * Returns WHMCS response plus pending / pendingData to cover fax form confirmation cases
     * @param array $r API response (ModifyDomain / TradeDomain)
     * @return array
     */
    public function respondPending($r)
    {
        $pending = (
            (isset($r["PENDING"]) && $r["PENDING"] === "1") ||
            $r["DESCRIPTION"] === "trade requested - fax confirmation required"
        );
        $values = [
            "pending" => $pending,
            "success" => true
        ];
        if ($pending) {
            // check if some fax form is required for owner change
            $tld = strtolower(preg_replace("/^.+\./", ".", $this->activeTLD));//2nd lvl tld
            if (self::requiresFaxForm($tld, $this->domainType)) {
                $tldcl = substr($tld, 1);//strip leading dot
                $values["pendingData"] = [
                    "message" => "domains.changePendingFormRequired",
                    "replacement" => [
                        ":form" => (
                            "<a href=\"" .
                            self::getFaxURL($tld, $this->domainType, $this->activeDomain) .
                            "\" target=\"_blank\">domainform.net</a>"
                        )
                    ]
                ];
            }
        }
        return $values;
    }

    /**
     * Generate a generic agreement field for higly regulated domain extensions
     * @static
     * @param string $tld dotted domain name extension
     * @return array
     */
    public static function getHighlyRegulatedTLDField($tld)
    {
        return [
            "Name" => "Highly Regulated TLD",
            "LangVar" => "tachighlyregulated",
            "Type" => "tickbox",
            "Required" => true,
            "Description" => self::getTACDescription($tld, "HIGHLYREGULATED"),
            "Ispapi-Name" => "X-" . self::getTLDClass($tld) . "-ACCEPT-HIGHLY-REGULATED-TAC"
        ];
    }

    /**
     * Generate a generic agreement field for individual regulated domain extensions
     * @static
     * @param string $tld dotted domain name extension
     * @param array $overrides array to override defaults for reuse (optional)
     * @return array
     */
    public static function getIndividualRegulatedTLDField($tld, $overrides = [])
    {
        return array_merge([
            "Name" => "Terms for Individuals",
            "LangVar" => "tacagreementindiv",
            "Type" => "tickbox",
            "Description" => self::getTACDescription($tld, "INDIVIDUALREGULATED"),
            "Required" => true,
            "Ispapi-Name" => "X-" . self::getTLDClass($tld) . "-ACCEPT-INDIVIDUAL-REGISTRATION-TAC"
        ], $overrides);
    }

    /**
     * Generate a generic `Intended Use` field
     * @static
     * @param string $tld dotted domain name extension (optional)
     * @param array $overrides array to override defaults for reuse (optional)
     * @return array
     */
    public static function getIntendedUseField($tld = "", $overrides = [])
    {
        $cfg = array_merge([
            "Name" => "Intended Use",
            "LangVar" => "intendeduse",
            "Type" => "text",
            "Required" => true,
            "Ispapi-Name" => "X-CORE-INTENDED-USE"
        ], $overrides);
        if ($cfg["Type"] === "dropdown") {
            $cfg["Options"] = self::getOptions($tld, $cfg["Name"], $cfg["Options"], $cfg["Required"]);
            $cfg["Default"] = preg_replace("/\|.+$/", "", $cfg["Options"][0]);
        }
        return $cfg;
    }

    /**
     * Get Mapping of lowercase language code and localized Name
     * @return array
     */
    private static function getLanguages()
    {
        $langs = [];
        foreach (\Lang::getLocales() as $row) {
            $langs[$row["languageCode"]] = $row["localisedName"];
        }
        return $langs;
    }

    /**
     * Generate a generic Language dropdown list
     *
     * Display the localized language name and submits the assigned 2-char language code
     * @static
     * @param array $overrides array to override defaults for reuse (optional)
     * @return array
     */
    public static function getLanguageField($overrides = [])
    {
        $cfg = array_merge([
            "Name" => "Registrant Language",
            "Type" => "dropdown",
            "Required" => false,
            "Ispapi-Prefill" => "LANG"
        ], $overrides);

        $langs = self::getLanguages();

        $map = [];
        foreach ($cfg["Options"] as &$val) {
            $lc = strtolower($val);
            $map[$val] = isset($langs[$lc]) ? $langs[$lc] : $val;
        }
        asort($map);
        $cfg["Options"] = [];
        foreach ($map as $val => $localizedName) {
            $option = $val;
            if ($val !== $localizedName) {
                $option .= "|" . $localizedName;
            }
            $cfg["Options"][] = $option;
        }
        if ($cfg["Required"] !== true) {//false or conditional requirement
            array_unshift($cfg["Options"], "");
        }
        $cfg["Default"] = preg_replace("/\|.+$/", "", $cfg["Options"][0]);
        return $cfg;
    }

    /**
     * Generate a generic `Legal Type` field
     * @static
     * @param string $tld dotted domain name extension
     * @param array $overrides array to override defaults for resue (optional)
     * @return array
     */
    public static function getLegalTypeField($tld, $overrides = [])
    {
        $f = array_merge([
            "Name" => "Legal Type",
            "Type" => "dropdown",
            "Options" => ["INDIV", "ORG"],
            "LangVar" => "legaltype"
        ], $overrides);

        $f["Options"] = self::getOptions($tld, $f["Name"], $f["Options"], $f["Required"]);
        $f["Default"] = preg_replace("/\|.+$/", "", $f["Options"][0]);
        return $f;
    }

    /**
     * Generate a generic `Nexus Category` dropdown list field
     * @static
     * @param string $tld dotted domain name extension
     * @param array $overrides array to override defaults for reuse (optional)
     * @return array
     */
    public static function getNexusCategoryField($tld, $overrides = [])
    {
        $cfg = array_merge([
            "Name" => "Nexus Category",
            "LangVar" => "nexuscategory",
            "Type" => "dropdown",
            "Required" => true,
            "Options" => [],
            "Ispapi-Name" => "X-" . self::getTLDClass($tld) . "-NEXUS-CATEGORY"
        ], $overrides);
        $cfg["Options"] = self::getOptions($tld, $cfg["Name"], $cfg["Options"], $cfg["Required"]);
        $cfg["Default"] = preg_replace("/\|.+$/", "", $cfg["Options"][0]);
        return $cfg;
    }

    /**
     * Generate the `Options` configuration part
     * @static
     * @param string $tld dotted domain name extension
     * @param string $transprefix translation key prefix
     * @param array $optvals array with option values
     * @param bool $isRequired flag if this field is required
     * @return array
     */
    public static function getOptions($tld, $transprefix, $optvals, $isRequired = false)
    {
        $options = [];
        foreach ($optvals as &$val) {
            $options[] = ($val . "|" . self::$transpfx . self::getTransKey($tld, $transprefix . strtolower($val)));
        }
        if ($isRequired !== true) {//false or conditional requirement
            if ($tld !== ".es") { // #CORE-14277, set Option to required when fixed
                array_unshift($options, "");
            }
        }
        return $options;
    }

    /**
     * Generate a generic `Registrant Identification Number` field
     * @static
     * @param string $tld dotted domain name extension
     * @param array $overrides array to override defaults for reuse (optional)
     * @return array
     */
    public static function getRegistrantIdentificationField($tld, $overrides = [])
    {
        $tclass = self::getTLDClass($tld);
        return array_merge(
            self::getContactIdentificationField("REGISTRANT"),
            [
                "Required" => true,
                "Ispapi-Name" =>  "X-" . $tclass . "-REGISTRANT-IDNUMBER"
            ],
            $overrides
        );
    }

    /**
     * Generate a generic agreement field for regulated domain name extensions
     * @static
     * @param string $tld dotted domain name extension
     * @param array $overrides array to override defaults for reuse (optional)
     * @param string $descrid additional suffix for translation key (optional)
     * @return array
     */
    public static function getRegulatedTLDField($tld, $overrides = [], $descrid = "")
    {
        return array_merge([
            "Name" => "Agreement",
            "Type" => "tickbox",
            "Description" => self::getTACDescription($tld, "REGULATED", $descrid),
            "Required" => true,
            "LangVar" => "tacagreement",
            "Ispapi-Name" => "X-" . self::getTLDClass($tld) . "-ACCEPT-REGISTRATION-TAC"
        ], $overrides);
    }

    /**
     * Return the fax type (mapping of whmcs internal type to our fax type)
     * @static
     * @param string $type process type
     * @return string
     */
    public static function getFaxType($type)
    {
        if (in_array($type, ["update", "trade"])) {
            return "ownerchange";
        }
        if ($type === "register") {
            return "registration";
        }
        return $type;
    }

    /**
     * Checks if fax form confirmation is necessary
     * @static
     * @param string $tld dotted domain name extension
     * @param string $type process type
     * @return bool
     */
    public static function requiresFaxForm($tld, $type)
    {
        $tld = preg_replace("/^.+\./", "", $tld);
        $map = [
            "registration" => [ ".no" ],
            "transfer" => [ ".nu" ],
            "ownerchange" => [ ".au", ".no", ".nu", ".pt", ".ru", ".se" ]
        ];
        $ftype = self::getFaxType($type);
        if (isset($map[$ftype]) && in_array($tld, $map[$ftype])) {
            return true;
        }
        return false;
    }

    /**
     * get fax form url (FFORM project)
     * @static
     * @param string $tld dotted domain name extension
     * @param string $domain domain name
     * @return string
     */
    public static function getFaxURL($tld, $type, $domain = null)
    {
        return (
            "https://www" . (self::$isOTE ? "-ote" : "" ) . ".domainform.net/" .
            "form/" . preg_replace("/^.*\./", "", $tld) . "/search?type=" . self::getFaxType($type) . "&language=en" .
            (is_null($domain) ? "" : "&domain=" . $domain)
        );
    }

    /**
     * Get Terms & Conditions URL
     * @static
     * @param string $tld dotted domain name extension
     * @return string
     */
    public static function getTAC($tld)
    {
        $tac = [
            ".abogado" => "http://nic.law/eligibilitycriteria/",
            ".ae" => "https://www.nic.ae/content.jsp?action=termcond_ae",
            ".bank" => "https://www.register.bank/get-started/",
            ".boats" => "https://get.boats/policies/",
            ".broker" => "https://nic.broker/",
            ".ca" => "https://" . (self::$isOTE ? "api.ca-ote.fury.ca/" : "cira.ca/registrant-" ) . "agreement",
            ".cat" => "http://domini.cat/en/domini/rules-cat-domain",
            ".cfd" => "https://nic.cfd/",
            ".eco" => "https://home.eco/registrars/policies/",
            ".es" => "https://www.dominios.es/dominios/en/todo-lo-que-necesitas-saber/sobre-registros-de-dominios/terms-and-conditions",
            ".fi" => "https://domain.fi/info/en/index/hakeminen/kukavoihakea.html",
            ".forex" => "https://nic.forex/",
            ".gay" => "https://toplevel.design/policy",
            ".health" => "https://get.health/registration-policies",
            ".hk" => "https://www.hkirc.hk/content.jsp?id=3#!/6",
            ".homes" => "https://domains.homes/Policies/",
            ".id" => "https://pandi.id/regulasi/",
            ".insurance" => "https://www.register.insurance/get-started/",
            ".it" => "https://www.nic.it/en/manage-your-it/forms-and-docs",
            ".law" => "http://nic.law/eligibilitycriteria/",
            ".markets" => "https://nic.markets/",
            ".ngo" => "https://thenew.org/org-people/about-pir/policies/policies-ngo-ong/",
            ".nu" => "https://internetstiftelsen.se/app/uploads/2019/02/terms-and-conditions-nu.pdf",
            ".nyc" => "https://www.ownit.nyc/policies/",
            ".paris" => "http://bienvenue.paris/registry-policies-paris/",
            ".ru" => "http://www.cctld.ru/en/docs/rules.php",
            ".se" => "https://internetstiftelsen.se/app/uploads/2019/02/registreringsvillkor-se-eng.pdf",
            ".spreadbetting" => "https://nic.spreadbetting/",
            ".trading" => "https://nic.trading/",
            ".xxx" => "http://www.icmregistry.com/about/policies/registry-registrant-agreement/",
            ".za" => "https://www.zadna.org.za/"
        ];
        if (isset($tac[$tld])) {
            return $tac[$tld];
        }
        $tld = preg_replace("/^.+\./", ".", $tld);
        if (isset($tac[$tld])) {
            return $tac[$tld];
        }
        return "#";
    }

    /**
     * Get translation key for terms & conditions field's `Description`
     * @static
     * @param string $tld dotted domain name extension
     * @param string $type regulation type (REGULATED, INDIVIDUALREGULATED, HIGHLYREGULATED) (optional)
     * @param string $descrid additional translation key suffix in case you need more than one TaC field per tld (optional)
     * @return string
     */
    public static function getTACDescription($tld, $type = "REGULATED", $descrid = false)
    {
        $tac = self::getTAC($tld);
        $map = [
            "HIGHLYREGULATED" => [
                "default" => "tachighlyregulateddescrdefault",
                "notac" => "tachighlyregulateddescrnotac",
                ".eco" => "tachighlyregulateddescreco"
            ],
            "INDIVIDUALREGULATED" => [
                "default" => "tacindividualregulateddescrdefault"
            ],
            "REGULATED" => [
                "default" => "tacregulateddescrdefault",
                ".ngo" => "tacregulateddescrngo",
                ".it" => [
                    "section3" => "tacregulateddescritsection3",
                    "section5" => "tacregulateddescritsection5",
                    "section6" => "tacregulateddescritsection6",
                    "section7" => "tacregulateddescritsection7"
                ],
                ".new" => "tacregulateddescrgoogle"
            ]
        ];
        if (isset($map[$type][$tld])) {
            if ($descrid && isset($map[$type][$tld][$descrid])) {
                return $map[$type][$tld][$descrid];
            }
            return $map[$type][$tld];
        }
        if ($tac === "#" && isset($map[$type]["notac"])) {
            return $map[$type]["notac"];
        }
        return $map[$type]["default"];
    }

    /**
     * Get domain name extension class name
     * @static
     * @param string $tld dotted domain name extension
     * @return string
     */
    public static function getTLDClass($tld)
    {
        return strtoupper(preg_replace("/\./", "", $tld, 1));
    }

    /**
     * Get a generic translation key
     * @static
     * @param string $tld dotted domain name extension
     * @param string $suffix translation key suffix
     * @return string
     */
    public static function getTransKey($tld, $suffix)
    {
        return strtolower(str_replace(".", "", $tld) . "tld" . self::cleanTranslationSuffix($suffix));
    }

    /**
     * Generate a generic contact-type related `VAT ID` input field
     * @static
     * @param string $tld dotted domain name extension
     * @param string $contacttype contact type (REGISTRANT, ADMIN, TECH, BILLING)
     * @param array $overrides array to override defaults for reuse (optional)
     * @return array
     */
    public static function getVATIDField($tld, $contacttype, $overrides = [])
    {
        $name = strtolower($contacttype);
        return array_merge([
            "Name" => ucfirst($name) . " VAT ID",
            "LangVar" => $name . "vatid",
            "Type" => "text",
            "Required" => [ "Legal Type" => [ "ORG" ] ],
            "Ispapi-Name" => "X-" . $contacttype . "-VATID",
            "Ispapi-Prefill" => "VAT-ID"
        ], $overrides);
    }

    /**
     * Generate a generic dropdown list field for acceptance by `Yes` / `No`
     * @static
     * @param string $tld dotted domain name extension
     * @param array $overrides array to override defaults for reuse (optional)
     *
     */
    public static function getYesNoField($tld, $overrides = [], $customlables = false)
    {
        $cfg = array_merge([
            "Type" => "dropdown",
            "Options" => ["no", "yes"]
        ], $overrides);
        if (!$customlables) {
            $cfg["Options"] = self::getOptions($tld, "yesno", $cfg["Options"], $cfg["Required"]);
        } else {
            $cfg["Options"] = self::getOptions($tld, $cfg["Name"], $cfg["Options"], $cfg["Required"]);
        }
        $cfg["Default"] = preg_replace("/\|.+$/", "", $cfg["Options"][0]);
        return $cfg;
    }

    /**
     * Transform our format into WHMCS expected format
     *
     * Replaces translation keys with translations, Placeholders with data and aligns the format to WHMCS.
     * Cares about making Conditional Requirements compatible with 7.8 and disabling default WHMCS domain fields not in use.
     * @static
     * @param string $tld dotted domain name extension
     * @param array $fields our generated field configurations for the given extension
     * @param string $whmcsVersion WHMCS Version String
     * @param array $defaultfields WHMCS default field configurations
     * @param string $type order type (register, transfer, update, trade)
     * @return array
     */
    public static function transform($tld, $fields, $whmcsVersion, $defaultfields, $type = "register")
    {
        $currentlang = $_SESSION["Language"];
        foreach ($fields as &$f) {
            // Prefill with real Data
            if (isset($f["Ispapi-Prefill"]) && isset(self::$clientData[$f["Ispapi-Prefill"]])) {
                $prefill = self::$clientData[$f["Ispapi-Prefill"]];
                if (
                    !isset($f["Options"])
                    || in_array($prefill, preg_replace("/\|.+$/", "", $f["Options"]))
                ) {
                    $f["Default"] = $prefill;
                }
            }
            // translate Description field
            if (isset($f["Description"])) {
                $f["Description"] = L::trans($f["Description"]);
                if (preg_match("/{TAC}/", $f["Description"])) {
                    $tac = self::getTAC($tld);
                    $f["Description"] = preg_replace("/{TAC}/", $tac, $f["Description"]);
                }
                if (preg_match("/{FAXFORM}/", $f["Description"])) {
                    $fform = self::getFaxURL($tld, $type);
                    $f["Description"] = preg_replace("/{FAXFORM}/", $fform, $f["Description"]);
                }
                if (preg_match("/{TLD}/", $f["Description"])) {
                    $f["Description"] = preg_replace("/{TLD}/", strtoupper($tld), $f["Description"]);
                }
            }
            // translate Options field
            if (isset($f["Options"])) {
                foreach ($f["Options"] as $idx => $opt) {
                    if (preg_match("/\|/", $opt)) {
                        list($val, $transkey) = explode("|", $opt);
                        // replace all comma in text by U+201A as comma is used as separator for Options by WHMCS
                        $f["Options"][$idx] = ($val . "|" . str_replace(",", "‚", L::trans($transkey)));
                    }
                }
                $f["Options"] = implode(",", $f["Options"]);
            }
            // Make conditional Requirements downward compatible
            if ($f["Required"] && is_array($f["Required"])) {
                if (substr($whmcsVersion, 0, 3) < "7.9") {
                    $f["Required"] = false;
                }
            }
        }

        // auto-matic remove standard whmcs fields if not overriden
        if (!empty($defaultfields)) {
            foreach ($defaultfields as &$df) {
                $found = false;
                foreach ($fields as &$f) {
                    if ($df["Name"] === $f["Name"]) {
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $fields[] = [
                        "Name" => $df["Name"],
                        "Remove" => true
                    ];
                }
            }
        }

        // return in expected WHMCS format
        return ["fields" => $fields];
    }

    /**
     * Check if there are required fields related to Admin-C
     * @return bool
     */
    public function needsAdminC()
    {
        return !empty($this->getRequiredFields("/-ADMIN-/"));
    }

    /**
     * Check if there are required fields related to Admin-C
     * @return bool
     */
    public function needsTechC()
    {
        return !empty($this->getRequiredFields("/-TECH-/"));
    }

    /**
     * Check if there are required fields related to BILLING-C
     * @return bool
     */
    public function needsBillingC()
    {
        return !empty($this->getRequiredFields("/-BILLING-/"));
    }

    /**
     * Constructor
     * If we can drop out any system-entity specifics in future, we can remove it completely
     * @param bool $isOTE flag used to identify which system entity is used (OT&E or LIVE)
     */
    public function __construct($isOTE)
    {
        self::init($isOTE);
    }

    public function getRequiredFields($regex = false)
    {
        $reqfields = [];
        foreach ($this->getFields() as $fieldKey => $values) {
            $isRequired = $this->getConfigValue($fieldKey, "Required");
            $iname = $this->getConfigValue($fieldKey, "Ispapi-Name");
            if ($isRequired && ($regex === false || preg_match($regex, $iname))) {
                $reqfields[] = $this->getFieldName($fieldKey);
            }
        }
        return $reqfields;
    }

    /**
     * Add additional field values to the API command by appropriate parameter names (`Ispapi-Name`)
     * @param array $command API command to add additional domain field parameters to
     */
    public function addToCommand(&$command)
    {
        // now add the x-flags to command
        foreach ($this->getFields() as $fieldKey => $values) {
            $remove = $this->getConfigValue($fieldKey, "Ispapi-CmdRemove");
            if (!empty($remove)) {
                if (isset($remove[$this->getFieldValue($fieldKey)])) {
                    $val = $remove[$this->getFieldValue($fieldKey)];
                    if (is_array($val)) {
                        foreach ($val as $k => $v) {
                            unset($command[$k][$v]);
                        }
                    } else {
                        unset($command[$remove[$this->getFieldValue($fieldKey)]]);
                    }
                }
            }
            $iname = $this->getConfigValue($fieldKey, "Ispapi-Name");
            if (empty($iname)) {
                continue;
            }
            $type = $this->getConfigValue($fieldKey, "Type");
            $val = $this->getFieldValue($fieldKey);
            $command[$iname] = $val;//RSRBE-4752 Support Empty Values
        }
    }

    /**
     * Checks if given domain name's WHOIS data can be protected
     * @return bool
     */
    public function isWhoisProtectable()
    {
        $tld = preg_replace("/^.+\./", "", $this->getTLD());
        // here we can use index 0, as we access data as defined in static array
        if (!isset(self::$additionalfieldscfg[self::$entity]["whoisprivacy"][$tld][0]["Ispapi-WhoisProtectable"])) {
            return true;
        }
        $depfields = self::$additionalfieldscfg[self::$entity]["whoisprivacy"][$tld][0]["Ispapi-WhoisProtectable"];

        if ($this->domainType !== "register") {
            $addflds = new self(self::$isOTE);
            $addflds->setDomainType("register")->setTLD($tld);
        } else {
            $addflds = $this;
        }

        $protectable = true;
        $fields = $addflds->getFields();
        foreach ($depfields as $name => $regexp) {
            foreach ($fields as $fieldKey => $values) {
                if ($addflds->getConfigValue($fieldKey, "Name") === $name) {
                    $val = $addflds->getFieldValue($fieldKey);
                    $protectable = $protectable && preg_match($regexp, $val);
                    if (!$protectable) {
                        break 2;
                    }
                    break;
                }
            }
        }
        return $protectable;
    }

    /**
     * Get the field key for the WHOIS Privacy Protection field
     * @return bool|int FALSE if not found, otherwise the field key
     */
    public function getWhoisProtectionFieldKey()
    {
        $fields = $this->getFields();
        foreach ($fields as $fieldKey => $values) {
            if ($this->getConfigValue($fieldKey, "Name") === "ID Protection") {
                return $fieldKey;
            }
        }
        return false;
    }

    /**
     * Checks if given domain name's WHOIS data is currently protected
     * NOTE: we cannot use fieldKey 0 directly as default whmcs fields are increasing it even though removed
     * So searching for the right field name is a must.
     * @return bool
     */
    public function isWhoisProtected()
    {
        $fieldKey = $this->getWhoisProtectionFieldKey();
        if ($fieldKey !== false) {
            if (!preg_match("/-DISCLOSE$/i", $this->getConfigValue($fieldKey, "Ispapi-Name"))) {
                return (bool)$this->getFieldValue($fieldKey);
            }
            return !(bool)$this->getFieldValue($fieldKey);
        }
        return false;
    }

    /**
     * Reflect the desired registry-side WHOIS Privacy Service changes in command accordingly
     * Works in case domain type is set to `whoisprivacy`
     * @param array $command API Command to update
     * @param string $idprotection desired new whois privacy status
     */
    public function addWhoisProtectiontoCommand(&$command, $idprotection)
    {
        $fieldKey = $this->getWhoisProtectionFieldKey();
        if ($fieldKey !== false) {
            $iname = $this->getConfigValue($fieldKey, "Ispapi-Name");
            if (preg_match("/-DISCLOSE$/i", $iname)) {
                $command[$iname] = $idprotection ? "0" : "1";
            } else {
                $command[$iname] = $idprotection;
            }
        }
    }

    /**
     * Return field's value under consideration of default value and type-specifics
     * @param int $fieldKey the index of the field in the additional fields list
     * @return string|int
     */
    public function getFieldValue($fieldKey)
    {
        $val = $this->getConfigValue($fieldKey, "Default");
        if (parent::getFieldValue($fieldKey) !== "") {
            $val = parent::getFieldValue($fieldKey);
        }
        if ($this->getConfigValue($fieldKey, "Type") === "tickbox") {
            $val = ($val) ? 1 : 0;
        }
        return $val;
    }

    /**
     * Pre-fill WHMCS additional field values by our API data
     * @param array $r Domain::getStatus response
     * @return AdditionalFields
     */
    public function setFieldValuesFromAPI($r)
    {
        if (!$r["success"]) {
            return $this;
        }
        $data = [];
        foreach ($this->getFields() as $fieldKey => $values) {
            $type = $this->getConfigValue($fieldKey, "Type");
            $iname = $this->getConfigValue($fieldKey, "Ispapi-Name");
            $name = $this->getConfigValue($fieldKey, "Name");
            $defaultval = $this->getConfigValue($fieldKey, "Default");
            if (isset($r["data"][$iname][0])) {
                $data[$name] = $r["data"][$iname][0];
                if ($type === "tickbox" && $data[$name] === "1") {
                    $data[$name] = $defaultval;
                }
            }
        }
        parent::setFieldValues($data);
        return $this;
    }

    /**
     * Take over Field Values from another type
     * e.g. when dynamically switching from trade to update
     * @param string $type process type
     * @param array $d data container of the additional fields data
     * @return AdditionalFields
     */
    public function setFieldValuesFromType($type, $d)
    {
        $addflds = new self(self::$isOTE);
        $data = $addflds->setDomainType($type)
                ->setDomain($this->activeDomain)
                ->setFieldValues($d)
                ->getAsNameValueArray();
        parent::setFieldValues($data);
        return $this;
    }

    /**
     * Set the current process type
     *
     * Note: to be used before calling setTLD or setDomain methods
     * @param string $type process type
     * @return AdditionalFields
     */
    public function setDomainType($type = "register")
    {
        $type = strtolower($type);
        if (!in_array($type, ["register", "transfer", "update", "trade", "whoisprivacy"])) {
            $type = "register";
        }
        $this->domainType = $type;
        return $this;
    }

    /**
     * Return Additional Fields HTML Code with escaped single quotes
     * @param string $domainKey
     * @return string
     */
    public function getFieldsForOutput($domainKey = "")
    {
        $fs = parent::getFieldsForOutput($domainKey);
        $html = "<br/>";
        if (!empty($fs)) {
            foreach ($fs as $fieldLabel => $inputHTML) {
                $html .= "<div class=\"form-group\"><label>$fieldLabel</label><br/>$inputHTML</div>";
            }
            $html = str_replace("\\'", "\'", str_replace("'", "\'", $html));
        }
        return $html;
    }

    /**
     * Save additional domain fields data changes to DB
     * But ensure to skip the ones that shall not reach the DB e.g. .be Auth Field
     * @param int $domainID ID of the Domain
     * @param bool $creating flag
     */
    public function saveToDatabase($domainID, $creating = true)
    {
        $fieldsOrg = $this->getFields();
        $filtered = [];
        foreach ($fieldsOrg as $fieldKey => $values) {
            $ignore = $this->getConfigValue($fieldKey, "Ispapi-NoSave");
            if ($ignore) {
                $name = $this->getConfigValue($fieldKey, "Name");
                logActivity($this->activeDomain . ": Skipped DB Update for Additional Field `" . $name . "`.");
                continue;
            }
            $filtered[$fieldKey] = $values;
        }
        if (!empty($filtered)) {
            $this->fieldsData = $filtered;
            parent::saveToDatabase($domainID, $creating);
            $this->fieldsData = $fieldsOrg;
        }
    }
}
