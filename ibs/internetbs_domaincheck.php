<?php

require 'init.php';
require ROOTDIR . '/includes/functions.php';
require ROOTDIR . '/includes/registrarfunctions.php';

function parseResult($data)
{
    $result = array ();
    $arr = explode("\n", $data);
    foreach ($arr as $str) {
        list ( $varName, $value ) = explode("=", $str, 2);
        $varName = trim($varName);
        $value = trim($value);
        $result [$varName] = $value;
    }
    return $result;
}

logactivity("Internetbs: Domain Check");
logactivity($postfields['Domain']);
$params = getregistrarconfigoptions('ibs');

$postfields = array ();
$postfields ['ApiKey'] = $params ['Username'];
$postfields ['Password'] = $params ['Password'];
$postfields ['ResponseFormat'] = 'TEXT';
$postfields ['Domain'] = $_GET['domain'];

$testMode = trim(strtolower($params ['TestMode'])) === "on";

if ($testMode) {
    $url = 'https://testapi.internet.bs/domain/check';
} else {
    $url = 'https://api.internet.bs/domain/check';
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, "WHMCS Internet.bs Corp. Domain Check");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

$data = curl_exec($ch);
$curl_err = false;
if (curl_error($ch)) {
    $curl_err = 'CURL Error: ' . curl_errno($ch) . ' - ' . curl_error($ch);
    exit('CURL Error: ' . curl_errno($ch) . ' - ' . curl_error($ch));
}
curl_close($ch);
if ($curl_err) {
    $cronreport .= "Error connecting to API: $curl_err";
} else {
    $result = parseResult($data);
    if (!$result) {
        $cronreport .= "Error connecting to API:<br>" . nl2br($data) . "<br>";
    } else {
        if (isset($result["status"]) && (strtoupper($result["status"]) === "AVAILABLE")) {
            echo "domain found";
        } else {
            echo "domains not found";
        }
    }
}
