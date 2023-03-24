<?php

 define("CLIENTAREA", true);

//define("FORCESSL", true); // Uncomment to force the page to use https://

if (file_exists('dbconnect.php')) {
    require('dbconnect.php');
} else {
    require("init.php");
}

$ca = new WHMCS_ClientArea();

$ca->setPageTitle("WHOIS Lookup");

$ca->addToBreadCrumb('domain-whois.php', 'WHOIS ');

$ca->initPage();

$captcha = getCaptchConfig();

$ca->assign("captchaType", $captcha["type"]);

if (isset($_POST["domain-whois"])) {
    $domainName = $_POST["domainname"];
    $ca->assign("domain", $domainName);

    $validCaptcha = verifyCaptcha($captcha, $_POST);
    if ($validCaptcha) {
        $command = 'DomainWhois';
        $postData = array(
           'domain' => $domainName,
        );
        $adminUsername = getAdmin();

        $results = localAPI($command, $postData, $adminUsername);
        $ca->assign("results", $results);

        if ($results['result'] == "error") {
            $error = $results['message'];
            $ca->assign("error", $error);
        } else {
            $ca->assign("results", $results);
            $whoisResult = urldecode($results["whois"]);
            $domainStatus = $results["status"];
            $whoisServer = "";

            $domain = explode(".", $domainName, 2);
            $tld = $domain[1];

            if (($tld == "com") || ($tld == "net") || ($tld == "cc")) {
                $whoisArray = explode("\n", $whoisResult);

                if (preg_match('/Whois Server:\s(.*)\sReferral URL/si', $whoisResult, $regs)) {
                    $whoisServer = trim($regs[1]);
                } else {
                    $whoisServer = "";
                }

                $whoisServer = trim(strip_tags($whoisServer));

                if ($whoisServer) {
                    $fp = @fsockopen($whoisServer, 43, $errNo, $errStr);
                    if (!$fp) {
                        $ca->assign("error", "Something went wrong.");
                    } else {
                        $data = $domainName . "\r\n";
                        fputs($fp, $data);
                        while (!feof($fp)) {
                            $whois .= fgets($fp, 128);
                        }
                        fclose($fp);
                        $ca->assign("whois", $whois);
                    }
                }
            } else {
                $ca->assign("whois", $whoisResult);
            }
            $ca->assign("status", $domainStatus);
        }
    } else {
        $ca->assign('error', "Invalid Captcha code");
    }
}
$ca->setTemplate('domain-whois');

$ca->output();


function getCaptchConfig()
{
    $captcha = array();
    $table = "tblconfiguration";
    $fields = "setting,value";
    $result = select_query($table, $fields);
    while ($data = mysql_fetch_array($result)) {
        if ($data['setting'] == "CaptchaType") {
            $captcha["type"] = $data['value'];
            if (empty($captcha["type"])) {
                $captcha["type"] = "nocaptcha";
            }
        }
        if ($data['setting'] == "ReCAPTCHAPrivateKey") {
            $captcha["privatekey"] = $data["value"];
        }
        if ($data['setting'] == "ReCAPTCHAPublicKey") {
            $captcha["publickey"] = $data["value"];
        }
    }
    return $captcha;
}

function getAdmin()
{
    $table = "tbladmins";
    $fields = "username";
    $result = select_query($table, $fields, '', '', '', 1);
    while ($data = mysql_fetch_array($result)) {
        $username = $data["username"];
    }
    return $username;
}

function verifyCaptcha($captcha, $postData)
{

    if ($captcha["type"] == "recaptcha") {
        if (verifyGoogleRecaptcha($captcha["privatekey"], $postData["g-recaptcha-response"])) {
            return true;
        } else {
            return false;
        }
    } else {
        $recaptcha = $_SESSION["captchaValue"];
        $md5Recaptch = md5($postData["code"]);
        if ($recaptcha == $md5Recaptch) {
            return true;
        } else {
            return false;
        }
    }
}

function verifyGoogleRecaptcha($privatekey, $captchaResponse)
{
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $privatekey . '&response=' . $captchaResponse);
        $responseData = json_decode($verifyResponse);
    if ($responseData->success) {
        return true;
    } else {
        return false;
    }
}
