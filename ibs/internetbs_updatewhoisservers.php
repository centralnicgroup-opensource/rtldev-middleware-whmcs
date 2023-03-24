<?php

if (file_exists('dbconnect.php')) {
    require 'dbconnect.php';
} else {
    require 'init.php';
}

$file = ROOTDIR . '/includes/whoisservers.php';
$tlds = ".feedback,.com,.site,.tech,.store,.online,.us,.biz,.space,.net,.college,.design,.me,.rent,.xyz,.org,.group,.asia,.cx,.eu,.be,.it,.co,.co.com,.pro,.guru,.london,.bid,.club,.date,.download,.loan,.review,.science,.trade,.webcam,.uk,.fr,.de,.tokyo,.us.com,.eu.com,.nyc,.info,.vegas,.tel,.co.uk,.bar,.host,.email,.ink,.press,.rest,.com.de,.com.se,.mex.com,.website,.cc,.wiki,.center,.company,.cool,.digital,.discount,.domains,.expert,.foundation,.gallery,.life,.management,.photography,.photos,.services,.solutions,.systems,.technology,.tips,.today,.tools,.vision,.watch,.works,.zone,.care,.global,.house,.land,.media,.money,.uk.com,.uk.net,.de.com,.in,.tv,.re,.nl,.la,.pw,.za.bz,.in.net,.mobi,.org.uk,.me.uk,.com.co,.net.co,.nom.co,.co.in,.net.in,.org.in,.firm.in,.gen.in,.ind.in,.pm,.tf,.wf,.yt,.br.com,.cn.com,.gb.com,.gb.net,.no.com,.ru.com,.sa.com,.se.net,.za.com,.jpn.com,.ae.org,.us.org,.gr.com,.jp.net,.hu.net,.africa.com";

/* Get WHMCS installation url */
$queryresult = select_query("tblconfiguration", "value", "setting='SystemUrl'");
$result = mysql_fetch_assoc($queryresult);
$websiteUrl = $result["value"];
$domainCheckUrl = $websiteUrl . "internetbs_domaincheck.php?domain=";
$domainAvailableString = "domain found";

if (file_exists($file)) {
    if (is_writable($file)) {
        $f = fopen($file, 'r');
        $oldContent = fread($f, filesize($file));

        $tldArray = explode(",", $tlds);
        for ($i = 0, $iMax = count($tldArray); $i < $iMax; $i++) {
            $tld = $tldArray[$i];
            $tldData = $tld . "|" . $domainCheckUrl . "|HTTPREQUEST-" . $domainAvailableString;
            if (strpos($oldContent, $tld) !== false) {
                $searchTld = $tld . "|";
                $pattern = preg_quote($searchTld, '/');
                $pattern = "/^$pattern.*\$/m";
                if (preg_match($pattern, $oldContent, $matches)) {
                    $oldContent = preg_replace($pattern, $tldData, $oldContent);
                } else {
                    $oldContent .= $tldData . "\n";
                }
            } else {
                $oldContent .= $tldData . "\n";
            }
        }
        $f = fopen($file, 'w+');
        if (fwrite($f, $oldContent)) {
            echo "Whois servers has been updated.";
        } else {
            echo "Error while updating whois servers.";
        }
        fclose($f);
    } else {
        echo "File whoiseservers.php is not writable.";
    }
} else {
    $whoisJsonFile = ROOTDIR . "/resources/domains/whois.json";
    $whoisArray = array(
            "extensions" => $tlds,
            "uri" => $domainCheckUrl,
            "available" => $domainAvailableString
            );
    if (file_exists($whoisJsonFile)) {
        if (is_writable($whoisJsonFile)) {
            $f = fopen($whoisJsonFile, 'r');
            $content = fread($f, filesize($whoisJsonFile));
            $whoisJsonDecode = json_decode($content, true);

            $whoisJsonDecode[] = $whoisArray;
            $jsonArray = json_encode($whoisJsonDecode, JSON_PRETTY_PRINT);

            $f = fopen($whoisJsonFile, 'w+');
            if (fwrite($f, $jsonArray)) {
                echo "Whois server has been updated successfully.";
            } else {
                echo "Error while updating whois servers.";
            }
            fclose($f);
        } else {
            echo "File whois.json is not writable.";
        }
    } else {
        $f = fopen($whoisJsonFile, 'w+');
        $jsonArray = json_encode(array($whoisArray), JSON_PRETTY_PRINT);
        if (fwrite($f, $jsonArray)) {
            echo "Whois server has been updated successfully.";
        } else {
            echo "Error while updating whois servers.";
        }
        fclose($f);
    }
}
