<?php

require "init.php";

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

use Illuminate\Database\Capsule\Manager as DB;
use WHMCS\Module\Registrar\Ispapi\Domain as HXDomain;
use WHMCS\Config\Setting as Setting;

function SyncDomain($whmcs, $params, $syncndd, $syncDueDateDays)
{

    $domainid = $whmcs["id"];
    $domain = $whmcs["domain"];

    $whmcsexpiry = $whmcs["expirydate"];
    $nextduedate = $whmcs["nextduedate"];
    $nextduedatetime = strtotime($nextduedate);
    $nextinvoicedate = $whmcs["nextinvoicedate"];
    $nextinvoicedatetime = strtotime($nextinvoicedate);

    $hxexpiryraw = HXDomain::getExpiryData($params, $domain);
    // $hxexpiryraw["expirydate"]: string // YYYY-MM-DD, local time zone
    // $hxexpiryraw["expired"]: true
    // $hxexpiryraw["active"]: true
    // -- or empty --
    if (empty($hxexpiryraw)) {
        echo "<tr><td>$domain</td><td>Failed loading status.</td></tr>";
        return;
    }
    $hxexpiry = $hxexpiryraw["expirydate"];
    $hxexpirytime = strtotime($hxexpiry);

    if ($hxexpiry === $whmcsexpiry) {
        echo "<tr><td>$domain</td><td>Processed, Unchanged.</td></tr>";
        return;
    }
    echo "<tr><td>$domain</td><td>OLD: ED[$whmcsexpiry] NDD[$nextduedate] NID[$nextinvoicedate]";

    $data = [
        "expirydate" => $hxexpiry
    ];

    if ($syncndd) {
        $newduedate = $hxexpiry;
        if ($syncDueDateDays) {
            $newduedate = explode("-", $newduedate);
            $newduedate = date("Y-m-d", mktime(0, 0, 0, $newduedate[1], $newduedate[2] - $syncDueDateDays, $newduedate[0]));
        }
        if ($newduedate !== $nextduedate) {
            $data["nextduedate"] = $newduedate;
            $data["nextinvoicedate"] = $newduedate;
        }
        $nextduedate = $newduedate;
        $nextinvoicedate = $newduedate;
    }

    echo "<br/>NEW: ED[$hxexpiry] NDD[$nextduedate] NID[$nextinvoicedate]</td></tr>";

    update_query("tbldomains", $data, [
        "domain" => $domain,
        "id" => $domainid
    ]);
}

$registrar = new \WHMCS\Module\Registrar();
if (!$registrar->load("ispapi")) {
    die("Unable to load the ISPAPI Registrar Module.");
}
if (!$registrar->isActivated()) {
    die("The ISPAPI Registrar Module is not activated.");
}

$params = $registrar->getSettings();

$domainid = App::getFromRequest("domainid");
$syncndd = Setting::getValue("DomainSyncNextDueDate");
$ndddays = 0;
if ($syncndd) {
    $ndddays = (int) Setting::getValue("DomainSyncNextDueDateDays");
}

if (!empty($domainid)) {
    $results = DB::table("tbldomains")
        ->where("registrar", "ispapi")
        ->where("status", "Active")
        ->where("id", $domainid)
        ->get()
        ->toJSON();
} else {
    $results = DB::table("tbldomains")
        ->where("registrar", "ispapi")
        ->where("status", "Active")
        ->get()
        ->toJSON();
}

echo "*** Updating HEXONET<small>ispapi</small> domains' expirydate, nextduedate, nextinvoicedate ***<br/><br/>";
echo "<table><thead><tr><th><b>Domain</b></th><th><b>Info</b></th></tr></thead><tbody>";
$results = json_decode($results, true);
foreach ($results as $result) {
    $r = SyncDomain($result, $params, $syncndd, $ndddays);
    ob_flush();
    flush();
}
echo "</table><br/>";
echo "*** DONE ***<br/>";
