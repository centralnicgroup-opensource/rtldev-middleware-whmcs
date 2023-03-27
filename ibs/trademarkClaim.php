<?php

define("CLIENTAREA", true);
//define("FORCESSL", true); // Uncomment to force the page to use https://

if (file_exists('dbconnect.php')) {
    require('dbconnect.php');
} else {
    require("init.php");
}

$ca = new WHMCS_ClientArea();

$ca->setPageTitle("Trademark Claims Notice");

$ca->addToBreadCrumb('trademarkClaim.php', 'Trademark Claims Notice');

$ca->initPage();


$cart = $_SESSION["cart"];
if (count($cart) > 0) {
    $currentDomainKey = $_SESSION["currentdomainKey"];
    $domainName = $cart['domains'][$currentDomainKey]['domain'];
    $lookupKey = $cart['domains'][$currentDomainKey]['TMCH'][$domainName]['lookupkey'];

    $data = internetbs_TmchInfo($lookupKey);
    $markCnt = 0;
    foreach ($data as $key => $value) {
        if (strpos($key, "markname") !== false) {
            $markCnt++;
        }
    }

    $markName = "";
    $markHolder = "";
    $goodsAndService = "";
    $class = "";

    $markDetails = array();
    for ($cnt = 0; $cnt < $markCnt; $cnt++) {
        $marknamevar = "tmch_" . $cnt . "_markname";
        $markholdervar = "tmch_" . $cnt . "_org";
        $markclassvar = "tmch_" . $cnt . "_classdesc";
        $markgoodsvar = "tmch_" . $cnt . "_goodsandservices";
        $markJurisdictionvar = "tmch_" . $cnt . "_jurdesc";

        $markholderstreetvar = "tmch_" . $cnt . "_addr_street";
        $markholdercityvar = "tmch_" . $cnt . "_addr_city";
        $markholderpcvar = "tmch_" . $cnt . "_addr_pc";
        $markholderstatevar = "tmch_" . $cnt . "_addr_state";
        $markholdercountryvar = "tmch_" . $cnt . "_addr_country";

        $markcontactnamevar = "tmch_" . $cnt . "_contact_name";
        $markcontactorgvar = "tmch_" . $cnt . "_contact_org";
        $markcontactstreetvar = "tmch_" . $cnt . "_contact_addr_street";
        $markcontactcityvar = "tmch_" . $cnt . "_contact_addr_city";
        $markcontactpcvar = "tmch_" . $cnt . "_contact_addr_pc";
        $markcontactstatevar = "tmch_" . $cnt . "_contact_addr_state";
        $markcontactcountryvar = "tmch_" . $cnt . "_contact_addr_country";
        $markcontactphonevar = "tmch_" . $cnt . "_contact_voice";
        $markcontactfaxvar = "tmch_" . $cnt . "_contact_fax";
        $markcontactemailvar = "tmch_" . $cnt . "_contact_email";

        if (isset($data[$marknamevar])) {
            $markDetails[$cnt]['markName'] = $data[$marknamevar];
        }
        if (isset($data[$markholdervar])) {
            $markDetails[$cnt]['markHolder'] = $data[$markholdervar];
        }
        if (isset($data[$markclassvar])) {
            $markDetails[$cnt]['class'] = $data[$markclassvar];
        }
        if (isset($data[$markgoodsvar])) {
            $markDetails[$cnt]['goodsAndService'] = $data[$markgoodsvar];
        }
        if (isset($data[$markJurisdictionvar])) {
            $markDetails[$cnt]['markJurisdiction'] = $data[$markJurisdictionvar];
        }

        if (isset($data[$markholderstreetvar])) {
            $markDetails[$cnt]['holderStreet'] = $data[$markholderstreetvar];
        }
        if (isset($data[$markholdercityvar])) {
            $markDetails[$cnt]['holderCity'] = $data[$markholdercityvar];
        }
        if (isset($data[$markholderpcvar])) {
            $markDetails[$cnt]['holderPc'] = $data[$markholderpcvar];
        }
        if (isset($data[$markholdercountryvar])) {
            $markDetails[$cnt]['holderCountry'] = $data[$markholdercountryvar];
        }
        if (isset($data[$markholderstatevar])) {
            $markDetails[$cnt]['holderState'] = $data[$markholderstatevar];
        }

        if (isset($data[$markcontactorgvar])) {
            $markDetails[$cnt]['contactOrg'] = $data[$markcontactorgvar];
        }
        if (isset($data[$markcontactnamevar])) {
            $markDetails[$cnt]['contactName'] = $data[$markcontactnamevar];
        }
        if (isset($data[$markcontactstreetvar])) {
            $markDetails[$cnt]['contactStreet'] = $data[$markcontactstreetvar];
        }
        if (isset($data[$markcontactcityvar])) {
            $markDetails[$cnt]['contactCity'] = $data[$markcontactcityvar];
        }
        if (isset($data[$markcontactpcvar])) {
            $markDetails[$cnt]['contactPc'] = $data[$markcontactpcvar];
        }
        if (isset($data[$markcontactcountryvar])) {
            $markDetails[$cnt]['contactCountry'] = $data[$markcontactcountryvar];
        }
        if (isset($data[$markcontactstatevar])) {
            $markDetails[$cnt]['contactState'] = $data[$markcontactstatevar];
        }
        if (isset($data[$markcontactphonevar])) {
            $markDetails[$cnt]['contactInfo'] = "Phone number: " . $data[$markcontactphonevar];
        }
        if (isset($data[$markcontactfaxvar])) {
            $markDetails[$cnt]['contactInfo'] .= ", Fax: " . $data[$markcontactfaxvar];
        }
        if (isset($data[$markcontactemailvar])) {
            $markDetails[$cnt]['contactEmail'] = $data[$markcontactemailvar];
        }
    }

    $ca->assign('cnt', $markCnt - 1);
    $ca->assign('domainKey', $currentDomainKey);
    $ca->assign('domain', $domainName);
    $ca->assign('markDetails', $markDetails);

    if (isset($_POST["accepttm"])) {
        $_SESSION["cart"]["domains"][$currentDomainKey]["TMCH"][$domainName]['tcnAccept'] = 1;
        $_SESSION["cart"]["domains"][$currentDomainKey]['tmchid'] = $data["tmch_id"];
        $_SESSION["cart"]["domains"][$currentDomainKey]['tmchnotafterdate'] = $data["tmch_notafter"];
        $_SESSION["cart"]["domains"][$currentDomainKey]['accepteddate'] = date("Y-m-d H:i:s");
        header("Location: cart.php?a=view");
    }
} else {
    $ca->assign("error", "Cart is Empty");
}

$ca->setTemplate('trademarkClaim');

$ca->output();

header("Location: cart.php?a=view");
