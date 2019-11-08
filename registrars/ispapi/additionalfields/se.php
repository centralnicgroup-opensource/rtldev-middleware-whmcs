<?php
## .SE DOMAIN REQUIREMENTS ##
## add ispapi additional fields ##
$additionaldomainfields[$tld][] = [
    "Name" => "Identification Number",
    "Description" => "<div style='text-align:justify'><b>For individuals or companies located in Sweden</b> a valid Swedish personal or organizational number must be stated.<br/>
                      <b>For individuals and companies outside of Sweden</b> the ID number (e.g. Civic registration number, company registration number, or the equivalent) must be stated.</div>",
    "Ispapi-Name" => "X-NICSE-IDNUMBER"
];
$additionaldomainfields[$tld][] = [
    "Name" => "VAT",
    "Ispapi-Name" => "X-NICSE-VATID"
];
include "_acceptregistrationtac.php";
