<?php

require "init.php";
require ROOTDIR . "/includes/functions.php";
require ROOTDIR . "/includes/registrarfunctions.php";

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

logactivity("Internetbs: Domain Check, " . $_GET["domain"]);
$params = $module->getSettings();

# don't replace this with the call to _CheckAvailability
$result = ibs_call($params, "domain/check", [
    "ResponseFormat" => "TEXT",
    "Domain" => $_GET["domain"]
]);

if (!isset($result["status"]) || $result["status"] === "FAILURE") {
    echo "ERROR: Availability Check failed. " . $result["message"];
    exit(-1);
}

# Examplary API response
#
# transactid=...
# status=AVAILABLE
# domain=...
# minregperiod=1Y
# maxregperiod=10Y
# registrarlockallowed=YES
# privatewhoisallowed=YES
# realtimeregistration=YES
# price_ispremium=NO

if (strtoupper($result["status"]) === "AVAILABLE") {
    echo "domain found";
    exit(0);
}

echo "domain not found";
exit(0);
