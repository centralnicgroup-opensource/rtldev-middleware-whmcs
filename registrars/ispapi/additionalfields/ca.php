<?php
## .CA DOMAIN REQUIREMENTS ##
## add ispapi additional fields ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Legal Type",
    "LangVar" => "catldlegaltype",
    "Type" => "dropdown",
    "Options" => implode(",", array(
        "Corporation (Canada or Canadian province or territory)",
        "Canadian Citizen",
        "Permanent Resident of Canada",
        "Government or government entity in Canada",
        "Canadian Educational Institution",
        "Canadian Unincorporated Association",
        "Canadian Hospital",
        "Partnership Registered in Canada",
        "Trade-mark registered in Canada (by a non-Canadian owner)",
        "Canadian Trade Union",
        "Canadian Political Party",
        "Canadian Library Archive or Museum",
        "Trust established in Canada",
        "Aboriginal Peoples (individuals or groups) indigenous to Canada",
        "Indian Band recognized by the Indian Act of Canada",
        "Legal Representative of a Canadian Citizen or Permanent Resident",
        "Official mark registered in Canada",
        "Her Majesty the Queen"
    )),
    "Default" => "Corporation",
    "Description" => "Legal type of registrant contact",
    "Required" => true,
    "Ispapi-Name" => "X-CA-LEGALTYPE",
    "Ispapi-Options" => implode(",", array(
        "CCO",
        "CCT",
        "RES",
        "GOV",
        "EDU",
        "ASS",
        "HOP",
        "PRT",
        "TDM",
        "TRD",
        "PLT",
        "LAM",
        "TRS",
        "ABO",
        "INB",
        "LGR",
        "OMK",
        "MAJ"
    ))
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Contact Language",
    "Type" => "dropdown",
    "Options" => "English,French",
    "Default" => "English",
    "Required" => true,
    "Ispapi-Name" => "X-CA-LANGUAGE",
    "Ispapi-Options" => "EN,FR"
);
$additionaldomainfields[$tld][] = array('Name' => 'CIRA Agreement', "Remove" => true);
$additionaldomainfields[$tld][] = array(
    "Name" => "WHOIS Opt-out",
    "LangVar" => "catldwhoisoptout",
    "Type" => "tickbox",
    "Description" => "Tick to hide your contact information in CIRA WHOIS (only available to individuals)",
    "Ispapi-Name" => "X-CA-DISCLOSE",
    "Ispapi-Eval" => 'if ( $value ) { $value = "0"; } else { $value = "1"; }'
);
