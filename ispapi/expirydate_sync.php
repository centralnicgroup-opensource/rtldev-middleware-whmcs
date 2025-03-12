<?php

require_once "init.php";
require_once "includes/registrarfunctions.php";

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

use Illuminate\Database\Capsule\Manager as DB;
use WHMCS\Config\Setting as Setting;

/**
 * Expiry Date Sync Class
 */
class ExpiryDateSync
{
    /** @var array<string,string> */
    private $supportedRegistrars;
    /** @var boolean */
    private $dueDateSyncEnabled;
    /** @var integer */
    private $dueDateSyncDays;

    public function __construct()
    {
        $auth = new \WHMCS\Auth();
        if (!$auth->isLoggedIn()) {
            $auth->redirect("../expirydate_sync.php");
        }

        $this->supportedRegistrars = [
            "ispapi" => "Hexonet (ispapi)",
            "cnic" => "CentralNic Reseller (cnic)",
            "ibs" => "InternetBS (ibs)",
            "tppwregistrar" => "TPP Wholesale (tppwregistrar)",
            "moniker" => "Moniker"
        ];

        $registrar = new \WHMCS\Module\Registrar();
        $this->supportedRegistrars = array_filter($this->supportedRegistrars, function ($key) use ($registrar) {
            return $registrar->load($key) && $registrar->isActivated();
        }, ARRAY_FILTER_USE_KEY);

        $this->dueDateSyncEnabled = Setting::getValue("DomainSyncNextDueDate");
        $this->dueDateSyncDays = $this->dueDateSyncEnabled ? (int) Setting::getValue("DomainSyncNextDueDateDays") : 0;
    }

    /**
     * Check if the bulk domains sync is requested or single domain sync is requested
     * 
     * @return void
     */
    public function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $action = \App::getFromRequest("action");
            if ($action == "fetchDomains") {
                $this->fetchDomains();
            } elseif ($action == "syncDomain") {
                $this->fetchDomainAndSync();
            }
        }
    }

    /**
     * Get supported registrars
     *
     * @param boolean $getRegistrarIds Get registrar Identifiers
     * @return array<string,string>|array<string>
     */
    public function getSupportedRegistrars($getRegistrarIds = false)
    {
        return $getRegistrarIds ? array_keys($this->supportedRegistrars) : $this->supportedRegistrars;
    }

    /**
     * Fetch domains from WHMCS
     * 
     * @return void
     */
    private function fetchDomains()
    {
        $registrarId = \App::getFromRequest("registrar");
        if (in_array($registrarId, $this->getSupportedRegistrars(true))) {
            $results = DB::table("tbldomains")
                ->where("registrar", $registrarId)
                ->where("status", "Active")
                ->get()
                ->toJSON();
            echo $results;
            exit;
        }
    }

    /**
     * Fetch domain info from WHMCS and sync with registrar
     * 
     * @return void
     */
    private function fetchDomainAndSync()
    {
        $domainId = \App::getFromRequest("domainid");
        $results = DB::table("tbldomains")
            ->where("id", $domainId)
            ->where("status", "Active")
            ->first();
        if (!is_object($results) || empty($results->registrar) || empty($results->domain)) {
            echo json_encode(["domain" => $domainId, "status" => "Failed, Domain is not active or not found."]);
            exit;
        }
        $params = $this->getRegistrarParams($results->registrar);
        if (isset($params["error"])) {
            echo json_encode(["domain" => $results->domain, "status" => $params["error"]]);
            exit;
        }
        $syncResult = $this->syncDomainData((array)$results, $params);
        echo json_encode($syncResult);
        exit;
    }

    /**
     * Get registrar parameters
     *
     * @param string $registrarId Registrar ID
     * @return array<string,mixed>
     */
    private function getRegistrarParams(string $registrarId)
    {
        if (in_array($registrarId, $this->getSupportedRegistrars(true))) {
            $module = \getRegistrarConfigOptions($registrarId);
            if ($module) {
                return $module;
            }
            return ["error" => "The specified Registrar Module ($registrarId) is not activated."];
        }
        return ["error" => "The Registrar Module is not supported."];
    }

    /**
     * Sync domain data
     *
     * @param array<string,mixed> $whmcs WHMCS domain data
     * @param array<string,mixed> $params Registrar module parameters
     * @return array<string,string>
     */
    private function syncDomainData(array $whmcs, array $params): array
    {
        $domainid = $whmcs["id"];
        $domain = $whmcs["domain"];
        $whmcsexpiry = $whmcs["expirydate"];
        $nextduedate = $whmcs["nextduedate"];
        $nextinvoicedate = $whmcs["nextinvoicedate"];
        $params["domainid"] = $domainid;

        $expiryRaw = RegCallFunction($params, "Sync");
        if (empty($expiryRaw)) {
            return ["domain" => $domain, "status" => "Failed loading status."];
        }

        $expiryDate = $expiryRaw["expirydate"];
        if ($expiryDate === $whmcsexpiry) {
            return ["domain" => $domain, "status" => "Processed, Unchanged."];
        }

        $data = ["expirydate" => $expiryDate];

        if ($this->dueDateSyncEnabled) {
            $newduedate = $expiryDate;
            if ($this->dueDateSyncDays) {
                $newduedate = (new DateTime($newduedate))->modify("-{$this->dueDateSyncDays} days")->format("Y-m-d");
            }
            if ($newduedate !== $nextduedate) {
                $data["nextduedate"] = $newduedate;
                $data["nextinvoicedate"] = $newduedate;
            }
        }

        DB::table("tbldomains")
            ->where("domain", $domain)
            ->where("id", $domainid)
            ->update($data);

        return [
            "domain" => $domain,
            "old_expiry" => $whmcsexpiry,
            "new_expiry" => $expiryDate,
            "next_due_date" => $data["nextduedate"] ?? $nextduedate,
            "next_invoice_date" => $data["nextinvoicedate"] ?? $nextinvoicedate,
            "status" => "Processed"
        ];
    }
}

$expiryDateSync = new ExpiryDateSync();
$expiryDateSync->handleRequest();

// HTML and JavaScript for the page
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domain Expiry Date Sync</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="/assets/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <style>
        .centered-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .centered-form form {
            width: 100%;
            max-width: 600px;
        }

        .loading-spinner {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }

        .form-buttons {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        #domainTable {
            margin-top: 20px;
            max-height: 600px;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <div class="container centered-form">
        <div id="step1">
            <form id="domainSyncForm" class="form-inline">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label for="registrar" class="mr-2">Select Registrar:</label>
                        <select id="registrar" name="registrar" class="form-control">
                            <?php foreach ($expiryDateSync->getSupportedRegistrars() as $key => $value) : ?>
                                <option value="<?php echo $key; ?>" <?php echo $key === \App::getFromRequest("registrar") ? "selected" : ""; ?>><?php echo $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-buttons">
                    <button type="button" class="btn btn-primary" onclick="fetchDomains()">
                        <i class="fas fa-sync-alt"></i> Submit
                    </button>
                </div>
            </form>
        </div>
        <div id="step2" style="display:none;">
            <form id="syncForm" class="form-inline">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label for="syncType" class="mr-2">Sync Type:</label>
                        <select id="syncType" name="syncType" class="form-control" onchange="toggleDomainInput()">
                            <option value="all">All Domains</option>
                            <option value="single">Single Domain</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2" id="domainInput" style="display:none;">
                    <div class="col-md-6">
                        <label for="domain" class="mr-2">Domain:</label>
                        <input type="text" id="domain" name="domain" class="form-control" list="domainList">
                        <datalist id="domainList"></datalist>
                    </div>
                </div>
                <div class="form-buttons">
                    <button type="button" class="btn btn-secondary" id="prevButtonStep2" onclick="goToStep(1)">
                        <i class="fas fa-arrow-left"></i> Previous
                    </button>
                    <button type="button" class="btn btn-primary" onclick="syncDomains()">
                        <i class="fas fa-sync-alt"></i> Sync
                    </button>
                </div>
            </form>
        </div>
        <div id="step3" style="display:none;">
            <div id="results">
                <table id='domainTable' class='table table-striped'>
                    <thead>
                        <tr>
                            <th>Domain</th>
                            <th>Status</th>
                            <th>Old Expiry</th>
                            <th>New Expiry</th>
                            <th>Next Due Date</th>
                            <th>Next Invoice Date</th>
                        </tr>
                    </thead>
                    <tbody id='domainResults'></tbody>
                </table>
                <div class="form-buttons mt-2">
                    <button type="button" class="btn btn-secondary" onclick="goToStep(1)">
                        <i class="fas fa-arrow-left"></i> Previous
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="loading-spinner">
        <i class="fas fa-spinner fa-spin fa-3x"></i>
    </div>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/dataTables.responsive.min.js"></script>
    <script>
        let domains = [];
        let dataTableInitialized = false;
        const domainId = "<?php echo \App::getFromRequest("domainid"); ?>";
        const supportedRegistrars = <?php echo json_encode($expiryDateSync->getSupportedRegistrars()); ?>;

        function showLoading() {
            document.querySelector('.loading-spinner').style.display = 'block';
        }

        function hideLoading() {
            document.querySelector('.loading-spinner').style.display = 'none';
        }

        function fetchDomains() {
            showLoading();
            var registrar = document.getElementById("registrar").value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "expirydate_sync.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    domains = JSON.parse(xhr.responseText);
                    domains.forEach(function(domain) {
                        var option = document.createElement("option");
                        option.value = domain.domain;
                        document.getElementById("domainList").appendChild(option);
                    });
                    goToStep(2);
                    $("#domain").autocomplete({
                        source: domains.map(function(domain) {
                            return domain.domain;
                        })
                    });
                    hideLoading();
                }
            };
            xhr.send("action=fetchDomains&registrar=" + encodeURIComponent(registrar));
        }

        function toggleDomainInput() {
            var syncType = document.getElementById("syncType").value;
            if (syncType === "single") {
                document.getElementById("domainInput").style.display = "block";
            } else {
                document.getElementById("domainInput").style.display = "none";
            }
        }

        function syncDomains() {
            showLoading();
            var syncType = document.getElementById("syncType").value;
            goToStep(3);
            if (syncType === "all") {
                domains.forEach(function(domain, index) {
                    syncDomain(domain, index, domains.length);
                });
            } else {
                var domainName = document.getElementById("domain").value;
                var domain = domains.find(d => d.domain === domainName);
                if (domain) {
                    syncDomain(domain, 0, 1);
                } else {
                    alert("Domain not found in the list.");
                    goToStep(2);
                    hideLoading();
                }
            }
        }

        function syncDomain(domain, index, totalDomains) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "expirydate_sync.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var result = JSON.parse(xhr.responseText);
                    var domainResults = document.getElementById("domainResults");
                    var row = "<tr><td>" + result.domain + "</td><td>" + result.status + "</td><td>" + (result.old_expiry || '') + "</td><td>" + (result.new_expiry || '') + "</td><td>" + (result.next_due_date || '') + "</td><td>" + (result.next_invoice_date || '') + "</td></tr>";
                    domainResults.innerHTML += row;
                    if (index === totalDomains - 1) {
                        if (!dataTableInitialized) {
                            $('#domainTable').DataTable({
                                dom: 'Bfrtip',
                            });
                            dataTableInitialized = true;
                        }
                        hideLoading();
                    }
                }
            };
            xhr.send("action=syncDomain&domainid=" + encodeURIComponent(domain.id));
        }

        function goToStep(step) {
            if (Object.keys(supportedRegistrars).length === 1 && step === 1) {
                step = 2;
            }
            document.getElementById("step1").style.display = step === 1 ? "block" : "none";
            document.getElementById("step2").style.display = step === 2 ? "block" : "none";
            document.getElementById("step3").style.display = step === 3 ? "block" : "none";
            if (step === 1 || step === 2) {
                // Remove domainid from URL
                const url = new URL(window.location);
                url.searchParams.delete('domainid');
                window.history.pushState({}, '', url);
                // Clear the table and destroy DataTable instance if it exists
                if (dataTableInitialized) {
                    $('#domainTable').DataTable().clear().destroy();
                    document.getElementById("domainResults").innerHTML = "";
                    dataTableInitialized = false;
                }
            }
            if (step === 2 && Object.keys(supportedRegistrars).length === 1) {
                document.getElementById("prevButtonStep2").style.display = "none";
            } else {
                document.getElementById("prevButtonStep2").style.display = "inline-block";
            }
        }

        $(document).ready(function() {
            // Automatically start syncing if domainId is provided
            if (domainId) {
                showLoading();
                goToStep(3);
                syncDomain({
                    id: domainId
                }, 0, 1);
            }

            // Automatically go to step 2 if there is only one registrar available and fetch domains
            if (Object.keys(supportedRegistrars).length === 1 && !domainId) {
                document.getElementById("registrar").value = Object.keys(supportedRegistrars)[0];
                fetchDomains();
            }
        });
    </script>
</body>

</html>