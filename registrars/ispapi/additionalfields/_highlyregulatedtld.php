<?php
$tclass = strtoupper(preg_replace("/\./", "", $tld, 1));
$tac = [
    ".boats" => "https://get.boats/policies/",
    ".abogado" => "http://nic.law/eligibilitycriteria/",
    ".broker" => "https://nic.broker/",
    ".cat" => "http://fundacio.cat/en/domini/rules-cat-domain",
    ".cfd" => "https://nic.cfd/",
    ".eco" => "https://home.eco/registrars/policies/",
    ".forex" => "https://nic.forex/",
    ".health" => "https://get.health/registration-policies",
    ".homes" => "https://domains.homes/Policies/",
    ".id" => "https://pandi.id/regulasi/",
    ".law" => "http://nic.law/eligibilitycriteria/",
    ".markets" => "https://nic.markets/",
    ".spreadbetting" => "https://nic.spreadbetting/",
    ".trading" => "https://nic.trading/",
    ".za" => "https://www.zadna.org.za/"
];
$cfg = [
    "Name" => "Highly Regulated TLD",
    "Type" => "tickbox",
    "Required" => true,
    "Ispapi-Name" => "X-" . $tclass . "-ACCEPT-HIGHLY-REGULATED-TAC"
];

if (isset($tac[$tld])) {
    $cfg["Description"] = "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is true and accurate. Eligibility criteria may be viewed <a href='" . $tac[$tld] . "' target='_blank'>here</a>.";
} elseif ($tld == ".eco") {
    $cfg["Description"] = "Tick to confirm that you certify that the Registrant is eligibile to register this domain and that all provided information is true and accurate. Eligibility criteria may be viewed <a href='". $tac[$tld] . "' target='_blank'>here</a>.<br/>All .ECO domain names will be first registered with \"server hold\" status pending the completion of the minimum requirements of the Eco Profile, namely, the .ECO registrant 1) affirming their compliance with the .ECO Eligibility Policy and 2) pledging to support positive change for the planet and to be honest when sharing information on their environmental actions. The registrant will be emailed with instructions on how to create an Eco Profile. Once these steps have been completed, the .ECO domain will be immediately activated by the registry.";
} else {
    $cfg["Description"] = "Tick to confirm the <b>Safeguards for Highly-regulated TLDs</b>:<br/>
                        <div style='text-align:justify'>You understand and agree that you will abide by and be compliant with these additional terms:
                        <ol><li>Administrative Contact Information. You agree to provide administrative contact information, which must be kept up-to-date, for the notification of complaints or reports of registration abuse, as well as the contact details of the relevant regulatory, or industry selfregulatory, bodies in their main place of business.</li>
                        <li>Representation. You confirm and represent that you possesses any necessary authorizations, charters, licenses and/or other related credentials for participation in the sector associated with such Highly-Regulated TLD.</li>
                        <li>Report of Changes of Authorization, Charters, Licenses, Credentials. You agree to report any material changes to the validity of your authorizations, charters, licenses and/or other related credentials for participation in the sector associated with the Highly-Regulated TLD to ensure you continue to conform to the appropriate regulations and licensing requirements and generally conduct you activities in the interests of the consumers you serve..</li>
                        </ol></div>";
}
$additionaldomainfields[$tld][] = $cfg;
