<?php

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    $ch = curl_init("https://api-ote.ispapi.net/api/call.cgi");
if ($ch === false) {
    die("CURL: impossible to establish a HTTP Connection;");
}
    $data = (
        rawurlencode("s_pw") . "=" . rawurlencode("test.passw0rd") . "&" .
        rawurlencode("s_login") . "=" . rawurlencode("test.user") . "&" .
        rawurlencode("s_entity") . "=" . rawurlencode("1234") . "&" .
        rawurlencode("s_remoteaddr") . "=" . rawurlencode("192.168.1.4") . "&" .
        rawurlencode("s_command") . "=" . rawurlencode("COMMAND=StatusAccount\n")
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
    ]/* + $this->curlopts*/);
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
