<?php

require "init.php";

# Load the IBS Registrar Module
$module = new WHMCS\Module\Registrar();
if (!$module->load("ibs")) {
    echo "ERROR: Unable to load the Internet.bs Registrar Module.\n";
    exit(-1);
}

# Check if the Module has been activated
if (!$module->isActivated()) {
    echo "ERROR: The Internet.bs Registrar Module is not activated.\n";
    exit(-1);
}

# fetch currency
$results = localAPI("GetCurrencies", []);
$defaultCurrency = $results["currencies"]["currency"][0]["code"];
$currency = "USD";
if (in_array($defaultCurrency, ["USD", "CAD", "AUD", "JPY", "EUR", "GBP"])) {
    $currency = $defaultCurrency;
}

# Prepare API Request
$params = $module->getSettings();

$result = ibs_call($params, "Account/PriceList/Get", [
    "version" => "5",
    "currency" => $currency
]);

if ($result["status"] === "FAILURE") {
    echo "ERROR: Unable to fetch list of TLDs. " . $r["message"];
    exit(-1);
}

# transactid=...
# status=SUCCESS
# product_0_authinforequired=YES
# product_0_rgp=2160
# product_0_minperiod=1
# product_0_maxperiod=10
# product_0_inc=1
# product_0_registration=<price>
# product_0_renewal=<price>
# product_0_transfer=<price>
# product_0_restore=<price>
# product_0_tld=ac.nz
# product_0_currency=USD
# product_1_authinforequired=YES
# product_1_rgp=720
# product_1_minperiod=1
# product_1_maxperiod=10
# product_1_inc=1
# product_1_registration=<price>
# product_1_renewal=<price>
# product_1_transfer=<price>
# product_1_restore=<price>
# product_1_tld=academy
# product_1_currency=USD
# ...

$tlds = [];
foreach($result as $key => $value) {
    if (preg_match("/^product_\d_tld$/", $key)) {
        $tlds[] = "." . $value;
    }
}
$tldStr = implode(",", $tlds);

# >= WHMCS 7, /resources/domains/dist.whois.json -> default file, the below is the override file
# @see https://docs.whmcs.com/WHOIS_Servers
$whoisJsonFile = ROOTDIR . "/resources/domains/whois.json";

$whoisArray = [
    "extensions" => $tldStr,
    "uri" => \WHMCS\Config\Setting::getValue("SystemURL") . "internetbs_domaincheck.php?domain=",
    "available" => "domain found"
];
if (!file_exists($whoisJsonFile)) {
    $f = fopen($whoisJsonFile, "w+");
    $jsonArray = json_encode([$whoisArray], JSON_PRETTY_PRINT);
    if (fwrite($f, $jsonArray) === false) {
        echo "Error while updating whois servers.";
        fclose($f);
        exit(-1);
    }
    echo "Whois server has been updated successfully.";
    fclose($f);
    exit(0);
}

if (!is_writable($whoisJsonFile)) {
    echo "File " . $whoisJsonFile . " is not writable.";
    exit(-1);
}

$f = fopen($whoisJsonFile, "r");
$content = fread($f, filesize($whoisJsonFile));
$whoisJsonDecode = json_decode($content, true);
$whoisJsonDecode[] = $whoisArray;
$jsonArray = json_encode($whoisJsonDecode, JSON_PRETTY_PRINT);
fclose($f);

$f = fopen($whoisJsonFile, "w+");
if (fwrite($f, $jsonArray) === false) {
    echo "Error while updating whois servers.";
    exit(-1);
}

echo "Whois servers have been updated successfully.";
fclose($f);
exit(0);