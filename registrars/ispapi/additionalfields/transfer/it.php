<?php
## .IT DOMAIN REQUIREMENTS ##
## add ispapi additional fields ##

$additionaldomainfields[$tld][] = [
    "Name" => "Accept Section 6 of .IT registrar contract",
    "Description" => "<b>Section 6 - Consent to the processing of personal data for diffusion and accessibility via the Internet</b><br/><div style='text-align:justify;margin-bottom:10px;'>
The interested party, after reading the above disclosure, gives consent to the dissemination and accessibility via the Internet, as defined in the disclosure above. Giving consent is optional, but absence of consent does not allow the dissemination and accessibility of Internet data.</div>",
    "Type" => "tickbox",
    "Ispapi-Name" => "X-IT-ACCEPT-DIFFUSION-AND-ACCESSIBILITY-TAC",
    "Required" => false
];
