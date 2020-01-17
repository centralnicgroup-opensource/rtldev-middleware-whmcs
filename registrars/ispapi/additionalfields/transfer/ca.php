<?php
## add ispapi additional fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "Legal Type",
    "Options" => implode(",", [
        "CCO|Corporation",
        "CCT|Canadian Citizen",
        "RES|Permanent Resident of Canada",
        "GOV|Government or government entity in Canada",
        "EDU|Canadian Educational Institution",
        "ASS|Canadian Unincorporated Association",
        "HOS|Canadian Hospital",
        "PRT|Partnership Registered in Canada",
        "TDM|Trade-mark registered in Canada (by a non-Canadian owner)",
        "TRD|Canadian Trade Union",
        "PLT|Canadian Political Party",
        "LAM|Canadian Library Archive or Museum",
        "TRS|Trust established in Canada",
        "ABO|Aboriginal Peoples (individuals or groups) indigenous to Canada",
        "INB|Indian Band recognized by the Indian Act of Canada",
        "LGR|Legal Representative of a Canadian Citizen or Permanent Resident",
        "OMK|Official mark registered in Canada",
        "MAJ|Her Majesty the Queen"
    ]),
    "Default" => "CCO|Corporation",
    "Ispapi-Name" => "X-CA-LEGALTYPE"
];
