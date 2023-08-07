<?php
define("CLIENTAREA", true);

//define("FORCESSL", true); // Uncomment to force the page to use https://

// NOTE: captcha code handling removed as of July 18th 2023 (status was broken)
// Removed handling of .com & .net & .cc as of July 18th 2023 (status was broken)

require("init.php");

$ca = new WHMCS_ClientArea();
$ca->setPageTitle("WHOIS Lookup");
$ca->addToBreadCrumb("domain-whois.php", "WHOIS ");
$ca->initPage();
$ca->setTemplate("domain-whois");

if (isset($_POST["domain-whois"])) {
    $domainName = $_POST["domainname"];
    $ca->assign("domain", $domainName);

    $results = localAPI("DomainWhois", [
        "domain" => $domainName,
    ]);
    $ca->assign("results", $results);

    if ($results["result"] == "error") {
        $error = $results["message"];
        $ca->assign("error", $error);
    } else {
        $ca->assign("results", $results);
        $whoisResult = urldecode($results["whois"]);
        $domainStatus = $results["status"] === "available" ? $domainName . " is available to register!" : "";
        $whoisServer = "";

        $domain = explode(".", $domainName, 2);
        $tld = $domain[1];
        $ca->assign("whois", $whoisResult);
        $ca->assign("status", $domainStatus);
    }
}

$ca->output();