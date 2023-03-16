<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

if (count($argv)<4) {
    die(
        "Missing Parameters:\n" .
        "  - for OTE:  php test.curl.php OTE \"<your username>\" \"<your password>\"\n" .
        "  - for LIVE: php test.curl.php LIVE \"<your username>\" \"<your password>\"\n"
    );
}

if ($argv[1] === "OTE") {
    $url = "https://api-ote.rrpproxy.net/api/call.cgi";
    echo "Connecting to OTE system ...\n$url\n\n";
} else {
    $url = "https://api.rrpproxy.net/api/call.cgi";
    echo "Connecting to LIVE system ...\n$url\n\n";
}
$ch = curl_init($url);
if ($ch === false) {
    die("CURL: impossible to establish a HTTP Connection;");
}

$data = (
    "s_login=" . rawurlencode($argv[2]) . "&" .
    "s_pw=" . rawurlencode($argv[3]) . "&" .
    "command=statusaccount\n"
);
curl_setopt_array($ch, [
    CURLOPT_TIMEOUT         =>  30,
    CURLOPT_POST            =>  1,
    CURLOPT_POSTFIELDS      =>  $data,
    CURLOPT_HEADER          =>  0,
    CURLOPT_RETURNTRANSFER  =>  1,
    CURLOPT_HTTPHEADER      =>  [
        'Expect:',
        'Content-Type: application/x-www-form-urlencoded', //UTF-8 implied
        'Content-Length: ' . strlen($data)
    ]
]);
$r = curl_exec($ch);
$err = curl_error($ch);
if ($err) {
    curl_close($ch);
    die("Curl Error: " . $err . "<br /><br />");
}
if ($r === false) {
    curl_close($ch);
    die("CURL: curl-exec failed, check PHP-CURL installation");
}
curl_close($ch);
echo $r;
