<?php
$tclass = strtoupper(preg_replace("/\./", "", $tld, 1));
$tac = [
    ".ae" => "https://www.nic.ae/content.jsp?action=termcond_ae",
    ".fi" => "https://domain.fi/info/en/index/hakeminen/kukavoihakea.html",
    ".ngo" => "https://thenew.org/org-people/about-pir/policies/ngo-ong-policies/",
    ".nu" => "https://internetstiftelsen.se/app/uploads/2019/02/terms-and-conditions-nu.pdf",
    ".paris" => "http://bienvenue.paris/registry-policies-paris/",
    ".ru" => "http://www.cctld.ru/en/docs/rules.php",
    ".se" => "https://internetstiftelsen.se/app/uploads/2019/02/registreringsvillkor-se-eng.pdf",
    ".xxx" => "http://www.icmregistry.com/about/policies/registry-registrant-agreement/"
];
$cfg = [
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => "Tick to confirm that you agree to the <a href='" . $tac[$tld] . "' target='_blank'>Registry Terms and Conditions of Registration</a> upon new registration of " . $tld . " domain names.",
    "Required" => true,
    "Ispapi-Name" => "X-" . $tclass . "-ACCEPT-REGISTRATION-TAC"
];
if ($tld == ".ngo") {
    $cfg["Description"] .= "<div style='padding:10px 0px;'>The registration of a .NGO domain name is bundled with an .ONG domain name without additional costs. Changes on the .NGO Domain will be auto-applied to the .ONG Domain.</div>";
}
$additionaldomainfields[$tld][] = $cfg;
