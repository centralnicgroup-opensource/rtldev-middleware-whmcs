<?php
$tclass = strtoupper(preg_replace("/\./", "", $tld, 1));
$tac = array(
    ".boats" => "https://get.boats/policies/",
    ".abogado" => "http://nic.law/eligibilitycriteria/",
    ".broker" => "https://nic.broker/",
    ".cat" => "http://fundacio.cat/en/domini/rules-cat-domain",
    ".cfd" => "https://nic.cfd/",
    ".forex" => "https://nic.forex/",
    ".health" => "https://get.health/registration-policies",
    ".homes" => "https://domains.homes/Policies/",
    ".id" => "https://pandi.id/regulasi/",
    ".law" => "http://nic.law/eligibilitycriteria/",
    ".markets" => "https://nic.markets/",
    ".spreadbetting" => "https://nic.spreadbetting/",
    ".trading" => "https://nic.trading/",
    ".za" => "https://www.zadna.org.za/"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Highly Regulated TLD",
    "Type" => "dropdown",
    "Description" => "<div>I certify that the Registrant is eligibile to register this domain and that all provided information is true and accurate. Eligibility criteria may be viewed <a href='" . $tac[$tld] . "' target='_blank'>here</a>.</div>",
    "Options" => ",I accept",
    "Default" => "",
    "Required" => true,
    "Ispapi-Name" => "X-" . $tclass . "-ACCEPT-HIGHLY-REGULATED-TAC",
    "Ispapi-Options" => ",1"
);
