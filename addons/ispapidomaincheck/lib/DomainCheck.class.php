<?php
namespace ISPAPI;

use WHMCS\Database\Capsule;
use WHMCS\Domains\Pricing\Premium;
use PDO;

/**
 * PHP Class for the HP DomainCheck feature
 *
 * @copyright  2018 HEXONET GmbH
 */
class DomainCheck
{
	private $domain;
	private $domains;
    private $tldgroup;
    private $action;
    private $registrar;
	private $currency;
	private $response;
	private $i18n;

    /*
     *  Constructor
     *
     *  @param string $domain The searched domain
     *  @param string $domains The list of domains to check
     *  @param string $tldgroup Restrict the search to the given tldgroups
     *  @param string $action The action
     *  @param array $registrar The configured registrars (can be more than one)
     *  @param array $currency The selected currency
     */
    public function __construct($domain, $domains, $tldgroup, $action, $registrar, $currency){
    	$this->domain = $domain;
		$this->domains = $domains;
		$this->tldgroup = $tldgroup;
		$this->action = $action;
		$this->registrar = $registrar;
		$this->currency = $currency;
		$this->i18n = new i18n();

		$this->doDomainCheck();
    }

    /*
     * This function is called on each instantiation
     * Calls the right method for a given action
     */
    private function doDomainCheck(){
    	if(isset($this->action) && ($this->action == "getList")){
    		$this->getDomainList();
    	}elseif(isset($this->action) && ($this->action == "removeFromCart")){
    		$this->removeFromCart();
		}elseif(isset($this->action) && ($this->action == "addPremiumToCart")){
    		$this->addPremiumToCart();
		}else{
    		$this->startDomainCheck();
    	}
    	$this->send();
    }

	/*
     * Removes the domain from the cart
     */
	private function removeFromCart(){
		$response = array();

		if(isset($this->domain)){
			foreach ($_SESSION["cart"]["domains"] as $index => $domain) {
				if(in_array($this->domain, $domain)){
					 unset($_SESSION["cart"]["domains"][$index]);
					 $response["feedback"] = $this->i18n->getText("remove_from_cart");
				}
			}
		}
		$this->response = json_encode($response);
	}

	/*
     * Adds the Premium domain to the cart
     */
	private function addPremiumToCart(){
		$response = array();

		if(isset($this->domain)){
			//get the registrarCostPrice, registrarRenewalCostPrice and registrarCurrency of the domain name
			//calculate the customer price and compare with the price we get from $_REQUEST, if they match, add to the cart
			$registrar_array = Helper::SQLCall("SELECT autoreg FROM tbldomainpricing where extension = ?", array(".".$this->getDomainExtension($this->domain)));
			$registrar = $registrar_array["autoreg"];
			if(isset($registrar)){

				$command = array(
	    				"COMMAND" => "checkDomains",
	    				"PREMIUMCHANNELS" => "*",
	    				"DOMAIN" => array($this->domain)
	    		);
				$check = Helper::APICall($registrar, $command);

				if(!empty($check["PROPERTY"]["PREMIUMCHANNEL"][0])){
					$registrarprice = $check["PROPERTY"]["PRICE"][0];
					$registrarpriceCurrency = $check["PROPERTY"]["CURRENCY"][0];

					$register_price = $this->getPremiumRegistrationPrice($registrarprice, $registrarpriceCurrency);
					$renew_price = $this->getPremiumRenewPrice($registrar, $check["PROPERTY"]["CLASS"][0], $registrarpriceCurrency, $this->domain);

					//if the registration price we get from $_REQUEST is the same than the one we calculated, then we can add the dommain to the cart
					if(abs($_REQUEST['registerprice'] - $register_price) < 0.1 ){ //due to roundings, we are not comparing with simple =

						//get the domain currency id
						$domain_currency_array = Helper::SQLCall("SELECT * FROM tblcurrencies WHERE code=? LIMIT 1", array($registrarpriceCurrency));
						$domain_currency_id = $domain_currency_array["id"];

						if(!is_array($_SESSION["cart"]["domains"])){
							$_SESSION["cart"]["domains"] = array();
						}

						$premiumdomain = array( "type" => "register",
												"domain" => $this->domain,
												"regperiod" => "1",
												"isPremium" => "1",
												"domainpriceoverride" => $register_price,
												"registrarCostPrice" => $registrarprice,
												"registrarCurrency" => $domain_currency_id,
												"domainrenewoverride" =>  $renew_price,
												//"registrarRenewalCostPrice" => //NOT REQUIRED
											);

						array_push($_SESSION["cart"]["domains"], $premiumdomain);
						$response["feedback"] = $this->i18n->getText("add_to_cart");

					}
				}
			}
		}
		$this->response = json_encode($response);
	}

    /*
     * Splits the complete WHMCS TLDs in 2 lists, the first one with the TLDs configured with HEXONET, the second one with all others.
     *
     * @return array an array with 2 keys: ispapi and no_ispapi
     */
    private function sortTLDs(){
    	$tldconfiguration = array();
    	$tldconfiguration["ispapi"] = array();
    	$tldconfiguration["no_ispapi"] = array();

		$extensions = Helper::SQLCall("SELECT extension, autoreg FROM tbldomainpricing", array(), "fetchall");

		foreach($extensions as $extension){
			if(in_array($extension["autoreg"], $this->registrar)){
    			array_push($tldconfiguration["ispapi"], $extension["extension"]);
    		}else{
    			array_push($tldconfiguration["no_ispapi"], $extension["extension"]);
    		}
		}

    	return $tldconfiguration;
    }

    /*
     * Returns the list of domains that have to be checked.
     */
    private function getDomainList(){

    	//delete HTTP:// if domain's starting with it
    	if (preg_match('/^http\:\/\//i', $this->domain)) {
    		$this->domain = substr($this->domain, 7);
    	}
    	//delete HTTPS:// if domain's starting with it
    	if (preg_match('/^https\:\/\//i', $this->domain)) {
    		$this->domain = substr($this->domain, 8);
    	}
    	//delete WWW. if domain's starting with it
    	if (preg_match('/^www[\.]/i', $this->domain)) {
    		$this->domain = substr($this->domain, 4);
    	}

		//lowercase
    	$this->domain = strtolower($this->domain);
		//remove all white spaces
		$this->domain = preg_replace('/\s+/', '', $this->domain);

    	$feedback = array();
    	$do_not_search = false;
    	$domainlist = array();

		//returns error feedback when special characters are used in searched term/domain name
		if(preg_match('/[^äöüa-z0-9\-\. ]/i', $this->domain)){
			$feedback = array("f_type" => "error", "f_message" => $this->i18n->getText("invalid_character_feedback"), "id" => $this->domain);
			$do_not_search = true;
		}

    	$tldconfiguration = $this->sortTLDs();
    	$tldgroups = $this->getTLDGroups();

    	$searched_label = $this->getDomainLabel($this->domain);
		$searched_tld = $this->getDomainExtension($this->domain);

		if( $this->getDomaincheckerMode() == "on" && !empty($this->registrar)){ //if no registrar module found, use regular mode
			//SUGGESTIONS MODE

			//use the first ispapi registrar to query the suggestion list
			$registrar = $this->registrar[0];

			//first convert the search from IDN to Punycode as this is requested by QueryDomainSuggestionList command.
			$searched_label = $this->convertToPunycode($searched_label, $registrar);

			$command = array(
				"COMMAND" => "QueryDomainSuggestionList",
				"KEYWORD" => $searched_label,
				"ZONE" => $tldgroups,
				"SOURCE" => "ISPAPI-SUGGESTIONS",
				"LIMIT" => "60"
			);

			$suggestions = Helper::APICall($registrar, $command);

			//convert the domainlist to IDN again
			$domainlist = $this->convertToIDN($suggestions['PROPERTY']['DOMAIN'], $registrar);
		}
		else{
			//REGULAR MODE
			foreach($tldgroups as $tld){
				array_push($domainlist, $searched_label.".".$tld);
			}
		}

		//check if the searched keyword contains a configured TLD
		//example: thebestshop -> thebest.shop should be at the top
		$extensions = Helper::SQLCall("SELECT extension FROM tbldomainpricing", array(), "fetchall");
		foreach($extensions as $extension){
			$tld = substr($extension["extension"],1);
			if (preg_match('/'.$tld.'$/i', $searched_label)) {
				$tmp = explode($tld, $searched_label);
				$thedomain = $tmp[0].".".$tld;
				//add to the domain to the list if not empty
				if(!empty($tmp[0]))
					$domainlist = array_merge(array($thedomain), $domainlist);
			}
		}

		//remove duplicate entries in the domainlist
		$domainlist = array_unique($domainlist);

		//add the domain at the top of the list even if he's not in the current group, but just when he's configured in WHMCS
		$item = Helper::SQLCall("SELECT autoreg FROM tbldomainpricing WHERE extension = ?", array(".".$searched_tld));
		if(!empty($item)){
			//put the searched domain at the first place of the domain list
			DomainCheck::deleteElement($this->domain, $domainlist);
			array_unshift($domainlist, $this->domain);
		}else{
			//if $searched_tld not empty display feedback message
			if(!empty($searched_tld)){
				$feedback = array("f_type" => "error", "f_message" => $this->i18n->getText("domain_not_supported_feedback"), "id" => $this->domain);
				$do_not_search = true;
			}
		}

		$domainlist_checkorder = $this->getSortedDomainList($domainlist);

		//if there is an issue with the search, do not start checking
		if($do_not_search){
			$domainlist = array();
			$domainlist_checkorder = array();
		}

    	$this->response = json_encode( array("listorder" => $domainlist, "checkorder" => $domainlist_checkorder, "feedback" => $feedback) );
    }

    /*
     * Returns the list sorted. HEXONET domains at first place, then the others

	 * @param array $domainlist The original domain list
	 *
     * @return array The sorted domain list
     */
    private function getSortedDomainList($domainlist){
    	$tldconfiguration = $this->sortTLDs();
    	$ispapi_domain_list = array();
    	$no_ispapi_domain_list = array();

    	foreach($domainlist as $item){
    		$tld = $this->getDomainExtension($item);
    		if( in_array(".".$tld, $tldconfiguration["ispapi"]) ){
    			array_push($ispapi_domain_list, $item);
    		}else{
    			array_push($no_ispapi_domain_list, $item);
    		}
    	}

    	return array_merge($ispapi_domain_list,$no_ispapi_domain_list);
    }

   /*
	* Returns the domainchecker mode. (Suggestions or Regular)
	*
	* @return string The domainchecker mode
	*/
	private function getDomaincheckerMode() {
		$domainLookupRegistrar = Helper::SQLCall("SELECT value FROM tblconfiguration WHERE setting = 'domainLookupRegistrar' LIMIT 1", array());
		if($domainLookupRegistrar["value"] == "ispapi"){
			$dc_settings = Helper::SQLCall("SELECT value FROM tbldomain_lookup_configuration WHERE registrar = 'ispapi' AND setting = 'suggestions' LIMIT 1", array());
			if(isset($dc_settings["value"])){
				return $dc_settings["value"];
			}
		}
		return "";
	}

	/*
 	* Loads the backorder API, returns false if backorder module not installed.
 	*
 	* @return boolean true if backorder API has been loaded
 	*/
 	private function loadBackorderAPI() {
 		$settings = Helper::SQLCall("SELECT value FROM tbladdonmodules WHERE module = 'ispapibackorder' AND setting = 'access' LIMIT 1", array());
 		if(isset($settings["value"])){
			$backorder_module_api = dirname(__FILE__)."/../../../../modules/addons/ispapibackorder/backend/api.php";
			if(file_exists($backorder_module_api)){
				require_once $backorder_module_api;
				return true;
			}
 		}
 		return false;
 	}

	/*
     * Starts the domain check procedure.
     * Handle the check domain with the configured ispapi registrar account configured in WHMCS
     * returns a JSON list of all domains with the availability
     */
    private function startDomainCheck(){
    	$feedback = array();
    	$tldconfiguration = $this->sortTLDs();

    	// create 2 domain lists
    	// 1: domains that use our registrar module
    	// 2: domains that don't use our registrar module
    	$ispapi_domain_list = array();
    	$no_ispapi_domain_list = array();
    	foreach($this->domains as $item){
    		$tld = $this->getDomainExtension($item);
    		if( in_array(".".$tld, $tldconfiguration["ispapi"]) ){
    			array_push($ispapi_domain_list, $item);
    		}else{
    			array_push($no_ispapi_domain_list, $item);
    		}
    	}

    	//for ispapi_domain_list (domains that use our registrar module)
    	$extendeddomainlist = $this->getExtendedDomainlist($ispapi_domain_list);

		//check if premium domains are activated in WHMCS
		$premium_settings = Helper::SQLCall("SELECT * FROM tblconfiguration WHERE setting = 'PremiumDomains' LIMIT 1", array());
		if($premium_settings && $premium_settings["value"] == 1){
			$premiumEnabled = true;
		}else{
			$premiumEnabled = false;
		}

    	$response = array();

		//get the selected currency
		$selected_currency_array = Helper::SQLCall("SELECT * FROM tblcurrencies WHERE id=? LIMIT 1", array($this->currency));

    	foreach($extendeddomainlist as $listitem){
    		//IDN convert before sending to checkdomain
    		$converted_domains = $this->convertIDN($listitem["domain"], $listitem["registrar"]);

    		$command = array(
    				"COMMAND" => "checkDomains",
    				"PREMIUMCHANNELS" => "*",
    				"DOMAIN" => $converted_domains
    		);
			$check = Helper::APICall($listitem["registrar"], $command);

    		$index = 0;
    		foreach($listitem["domain"] as $item){
    			$tmp = explode(" ", $check["PROPERTY"]["DOMAINCHECK"][$index]);
				$code = $tmp[0];
				$availability = $check["PROPERTY"]["DOMAINCHECK"][$index];
				$class = $check["PROPERTY"]["CLASS"][$index];
				$premiumchannel = $check["PROPERTY"]["PREMIUMCHANNEL"][$index];
				$status="";
				$premiumtype="";
				$register_price_unformatted = "";
				$renew_price_unformatted = "";
				$register_price = "";
				$renew_price = "";

				if(preg_match('/549/', $check["PROPERTY"]["DOMAINCHECK"][$index])){
					//TLD NOT SUPPORTED AT HEXONET USE A FALLBACK TO THE WHOIS LOOKUP.
					//Add the domain to the $no_ispapi_domain_list so it will be automatically checked by the WHOIS LOOKUP in the next step.
					array_push($no_ispapi_domain_list, $item);
				}
				elseif(preg_match('/210/', $check["PROPERTY"]["DOMAINCHECK"][$index])){
					//DOMAIN AVAILABLE
					$whmcspricearray = $this->getTLDprice($this->getDomainExtension($item));
	    			$register_price_unformatted = $whmcspricearray["domainregister"][1];
				 	$renew_price_unformatted = $whmcspricearray["domainrenew"][1];

					$register_price = $this->formatPrice($register_price_unformatted, $selected_currency_array);
					$renew_price = $this->formatPrice($renew_price_unformatted, $selected_currency_array);

					$status = "available";
				}
				elseif(!empty($check["PROPERTY"]["PREMIUMCHANNEL"][$index])){ //IT IS A PREMIUMDOMAIN
					if($premiumEnabled){
						//IF PREMIUM DOMAIN ENABLED IN WHMCS - DISPLAY AVAILABLE + PRICE

						$registrarprice = $check["PROPERTY"]["PRICE"][$index];
						$registrarpriceCurrency = $check["PROPERTY"]["CURRENCY"][$index];

						$register_price_unformatted = $this->getPremiumRegistrationPrice($registrarprice, $registrarpriceCurrency);
						$renew_price_unformatted = $this->getPremiumRenewPrice($listitem["registrar"], $check["PROPERTY"]["CLASS"][$index], $registrarpriceCurrency, $item);

						$register_price = $this->formatPrice($register_price_unformatted, $selected_currency_array);
						$renew_price = $this->formatPrice($renew_price_unformatted, $selected_currency_array);

						if (strpos($check["PROPERTY"]["CLASS"][$index], $check["PROPERTY"]["PREMIUMCHANNEL"][$index]) !== false){
							$premiumtype = "PREMIUM";
						}else{
							$premiumtype = $check["PROPERTY"]["PREMIUMCHANNEL"][$index];
						}

						$status = "available";
					}else{
						//PREMIUM DOMAIN NOT ENABLED IN WHMCS -> DISPLAY THE DOMAIN AS TAKEN
						$status = "taken";
					}
				}
				else{
					//DOMAIN TAKEN
					$status = "taken";
				}

				//for security reasons, if one of the prices is not set, then display the domain as taken
				if(empty($register_price) || empty($renew_price)){
					$status = "taken";
					$register_price = "";
					$renew_price = "";
				}

    			array_push($response, array("id" => $item,
											"checkover" => "api",
											"code" => $code,
											"availability" => $availability,
											"class" => $class,
											"premiumchannel" => $premiumchannel,
											"premiumtype" => $premiumtype,
											"registerprice" => $register_price,
											"renewprice" => $renew_price,
											"registerprice_unformatted" => $register_price_unformatted,
											"renewprice_unformatted" => $renew_price_unformatted,
											"status" => $status,
											"cart" => $_SESSION["cart"]));

    			$index++;
    		}
    	}

    	//for no_ispapi_domain_list (domains that don't use our registrar module)
    	foreach($no_ispapi_domain_list as $item){
    		$label = $this->getDomainLabel($item);
    		$tld = $this->getDomainExtension($item);
    		$price = array();

			$command = "domainwhois";
		    $values["domain"] = $label.".".$tld;

		    $check = localAPI($command, $values);

    		if($check["status"] == "available"){
    			$code = "210";
	    		//get the price for this domain
				$whmcspricearray = $this->getTLDprice($this->getDomainExtension($item));
				$register_price_unformatted = $whmcspricearray["domainregister"][1];
				$renew_price_unformatted = $whmcspricearray["domainrenew"][1];

				$register_price = $this->formatPrice($register_price_unformatted, $selected_currency_array);
				$renew_price = $this->formatPrice($renew_price_unformatted, $selected_currency_array);

				$status = "available";
    		}else{
    			$code = "211";
				$status = "taken";
    		}

			if(empty($register_price) || empty($renew_price)){
				$status = "taken";
				$register_price = "";
				$renew_price = "";
			}

			array_push($response, array("id" => $item,
										"checkover" => "whois",
										"code" => $code,
										"availability" => $check["message"],
										"class" => "",
										"premiumchannel" => "",
										"premiumtype" => "",
										"registerprice" => $register_price,
										"renewprice" => $renew_price,
										"registerprice_unformatted" => $register_price_unformatted,
										"renewprice_unformatted" => $renew_price_unformatted,
										"status" => $status,
										"cart" => $_SESSION["cart"]));


    	}

		//Handle the displaying of the backorder button in the search response
		$response = $this->handleBackorderButton($response);

		// Feedback for the template
		$searched_domain_object = array();
		foreach($response as $item){
			if($item["id"] == $this->domain){
				$searched_domain_object = $item;
				continue;
			}
		}

		if(isset($this->domain) && $this->domain == $searched_domain_object["id"]){
			if($searched_domain_object["status"] == "taken" && $searched_domain_object["backorder_available"] == 1 ){
				$feedback = array_merge(array("f_type" => "backorder", "f_message" => $this->i18n->getText("backorder_available_feedback")), $searched_domain_object);
			}
			elseif($searched_domain_object["status"] == "taken"){
				$feedback = array_merge(array("f_type" => "taken", "f_message" => $this->i18n->getText("domain_taken_feedback")), $searched_domain_object);
			}
			elseif($searched_domain_object["status"] == "available"){
				$feedback = array_merge(array("f_type" => "available", "f_message" => $this->i18n->getText("domain_available_feedback")), $searched_domain_object);
			}
		}
    	$response_array = array("data" => $response, "feedback" => $feedback);


    	$this->response = json_encode($response_array);
    }

	/*
     * Add the backorder functionality when ISPAPI Backorder module installed.
     */
	private function handleBackorderButton($response){
		if(!$this->loadBackorderAPI())
			return $response;
		$newresponse = array();

		//Get all domains that have already been backordered by the user. If not logged in, array will be empty, this is perfect.
		$queryBackorderList = array(
			"COMMAND" => "QueryBackorderList"
		);
		$ownbackorders = backorder_api_call($queryBackorderList);

		//Get the list of all TLDs available in the backorder module
		$tlds = "";
		$backorder_tlds = Helper::SQLCall("SELECT extension FROM backorder_pricing WHERE currency_id = ?", array($this->currency), "fetchall");
		foreach($backorder_tlds as $backorder){
			$tlds .= "|.".$backorder["extension"];
		}
		$tld_list = substr($tlds, 1);

		//Iterate all responses and add the backorder information
		foreach($response as $item){
			$tmp = $item;
			$tmp["backorder_available"] = $tmp["backordered"] = 0;
			if($item["code"]==211 && empty($item["premiumchannel"])){ //we are not supporting premium backorders, so we don't add them here.
				//In this case, backorder module is installed

				//Check if pricing set for this TLD
				$tmp["backorder_available"] = (preg_match('/^([a-z0-9](\-*[a-z0-9])*)\\'.$tld_list.'$/i', $item["id"])) ? 1 : 0;

				//Check if backorder set in the backorder module
				$tmp["backordered"] = (in_array($item["id"], $ownbackorders["PROPERTY"]["DOMAIN"])) ? 1 : 0;

				if($tmp["backorder_available"]){
					$tmp["backorderprice"] = $this->getBackorderPrice($item["id"]);
					//if no price set for the currency, then do not display the backorder
					if(empty($tmp["backorderprice"])){
						$tmp["backorder_available"] = 0;
					}
				}

			}
			$newresponse[] = $tmp;
		}

		return $newresponse;
	}

    /*
     * Returns the registration price for a given tld
     *
     * @param string $tld The domain extension

     * @return array An array with price for 1 to 10 years
     *
     */
	private function getTLDprice($tld) {
		$domainprices = array();

		//get the selected currency
		$selected_currency_array = Helper::SQLCall("SELECT * FROM tblcurrencies WHERE id=? LIMIT 1", array($this->currency));

		$sql = "SELECT tdp.extension, tp.type, msetupfee year1, qsetupfee year2, ssetupfee year3, asetupfee year4, bsetupfee year5, monthly year6, quarterly year7, semiannually year8, annually year9, biennially year10
				FROM tbldomainpricing tdp, tblpricing tp
				WHERE tp.relid = tdp.id
				AND tp.tsetupfee = 0
				AND tp.currency = ?
				AND tp.type IN ('domainregister', 'domainrenew')
				AND tdp.extension = ?";

		$list = Helper::SQLCall($sql, array($selected_currency_array["id"], ".".$tld), "fetchall");

		foreach($list as $item) {
			if(!empty($item)){
				for ( $i = 1; $i <= 10; $i++ ) {
					if (($item['year'.$i] > 0)){
						$domainprices[$item['type']][$i] = round($item['year'.$i], 2); //$this->formatPrice($item['year'.$i], $selected_currency_array);
					}
				}
			}
		}
		return $domainprices;
	}

	/*
     * Returns the backorder price for a domain
	 *
	 * @param string $domain The domain

     * @return string The backorder price well formatted in the selected currency
	 */
	private function getBackorderPrice($domain) {
		//get the selected currency
		$selected_currency_array = Helper::SQLCall("SELECT * FROM tblcurrencies WHERE id=? LIMIT 1", array($this->currency));

		//get backorder price of the domain
		$price = Helper::SQLCall("SELECT * FROM backorder_pricing WHERE extension=? AND currency_id=? LIMIT 1", array($this->getDomainExtension($domain), $this->currency));

		$backorderprice = isset($price) ? $price["fullprice"] : "";

		return $this->formatPrice($backorderprice, $selected_currency_array);
	}

	/*
     * Returns the price for a premiumdomain registration.
     *
     * @param string $registrarprice The domain registration price asked by the registrar
     * @param string $registrarpriceCurrency The currency of this price

     * @return string The price well formatted
	 *
	 * (Sometimes we are getting rounding problems (1 cent), not exactly the same price than with the standard lookup.)
	 *
     */
	private function getPremiumRegistrationPrice($registrarprice, $registrarpriceCurrency) {
		return $this->convertPriceToSelectedCurrency($registrarprice, $registrarpriceCurrency);
	}

	/*
	 * Adds the resseler markup to the given price
	 *
	 * @param string $price A price

     * @return string The markuped price
	 */
	private function addResselerMarkup($price){
		$markupToAdd = Premium::markupForCost($price);
		return $price + ($price * $markupToAdd / 100);
	}

	/*
	 * Converts the price in the selected currency and add the markup.
	 * Selected currency is taken from the session.
	 *
	 * @param string $price A price
     * @param string $currency A currency

     * @return string The price converted BUT NOT FORMATTED
	 */
	private function convertPriceToSelectedCurrency($price, $currency) {
		//get the selected currency
		$selected_currency_array = Helper::SQLCall("SELECT * FROM tblcurrencies WHERE id=? LIMIT 1", array($this->currency));
		$selected_currency_code = $selected_currency_array["code"];

		//check if the registrarpriceCurrency is available in WHMCS
		$domain_currency_array = Helper::SQLCall("SELECT * FROM tblcurrencies WHERE code=? LIMIT 1", array(strtoupper($currency)));

		if($domain_currency_array){
			//WE ARE ABLE TO CALCULATE THE PRICE
			$domain_currency_code = $domain_currency_array["code"];
			if($selected_currency_code == $domain_currency_code){
				return round($this->addResselerMarkup($price), 2);
			}else{
				if($domain_currency_array["default"] == 1){
					//CONVERT THE PRICE IN THE SELECTED CURRENCY
					$convertedprice = $price * $selected_currency_array["rate"];
					return round($this->addResselerMarkup($convertedprice), 2);
				}else{
					//FIRST CONVERT THE PRICE TO THE DEFAULT CURRENCY AND THEN CONVERT THE PRICE IN THE SELECTED CURRENCY

					//get the default currency set in WHMCS
					$default_currency_array = Helper::SQLCall("SELECT * FROM tblcurrencies WHERE `default` = 1", array());
					$default_currency_code = $default_currency_array["code"];

					//get the price in the default currency
					$price_default_currency = $price * ( 1 / $domain_currency_array["rate"] );

					//get the price in the selected currency
					$price_selected_currency = $price_default_currency * $selected_currency_array["rate"];

					return round($this->addResselerMarkup($price_selected_currency), 2);
				}
			}
		}
		return "";
	}

	/*
     * Returns the price for a premiumdomain renewal.
     *
     * @param string $registrarprice The domain registration price asked by the registrar
     * @param string $registrarpriceCurrency The currency of this price

     * @return string The price well formatted
	 *
     */
	private function getPremiumRenewPrice($registrar, $class, $registrarPriceCurrency, $domain) {
		$registrarPriceCurrency = strtoupper($registrarPriceCurrency);

		//get the domain currency id
		$domain_currency_array = Helper::SQLCall("SELECT * FROM tblcurrencies WHERE code=? LIMIT 1", array($registrarPriceCurrency));
		$domain_currency_id = $domain_currency_array["id"];

		//get domain extension
		$tld = $this->getDomainExtension($domain);

		//here we are calling the getRenewPrice from the respective registar module
		//$registrarRenewPrice = ispapi_getRenewPrice(getregistrarconfigoptions($registrar), $class, $domain_currency_id, $tld);
		$registrarRenewPrice = call_user_func($registrar."_getRenewPrice", getregistrarconfigoptions($registrar), $class, $domain_currency_id, $tld);

		//the renew price has to be converted to the selected currency
		return $this->convertPriceToSelectedCurrency($registrarRenewPrice, $registrarPriceCurrency);
	}

	/*
	 * Returns the formatted price
	 * (10.00 -> $10.00 USD)
	 *
	 * @param integer $number The price
	 * @param array $cur The currency array
	 *
	 * @return string The formatted price with the right unit at the right place
	 *
	 */
	private function formatPrice($number, $cur) {
		//$number = round($number, 3, PHP_ROUND_HALF_UP);
		if (empty($number) || $number <= 0){
			return "";
		}
		$format = $cur["format"];
		if ( $format == 1 ) {
			$number = number_format($number, 2, '.', '');
		}
		if ( $format == 2 ) {
			$number = number_format($number, 2, '.', ',');
		}
		if ( $format == 3 ) {
			$number = number_format($number, 2, ',', '.');
		}
		if ( $format == 4 ) {
			$number = preg_replace('/\.?0+$/', '', number_format($number, 2, '.', ','));
		}

		$price = $cur["prefix"].$number.$cur["suffix"];

		if (function_exists('mb_detect_encoding')) {
			if(mb_detect_encoding($price, 'UTF-8, ISO-8859-1') === 'UTF-8'){
				return $price;
			}else{
				return utf8_encode($price);
			}
		}else{
			return $price;
		}
	}

    /*
     *  Returns an extended domain list
     *
     *  @param list $domainlist the initial domain list (like: array(mydomain1.tld, mydomain2.tld, ...) )
     *  @return list Returns the extended domain list with for each domains the extension, the registrar and the ispapi connection object to handle further api calls.
     */
    private function getExtendedDomainlist($domainlist){
    	$whmcsdomainlist = array();
    	$whmcsdomainlist["extension"] = array();
    	$whmcsdomainlist["autoreg"] = array();

    	//create an array with extension and autoreg (autoreg = the configured resgistrar for this extension)
		$list = Helper::SQLCall("SELECT extension, autoreg  FROM tbldomainpricing", array(), "fetchall");
		foreach($list as $item){
			if(!empty($item["autoreg"])){
    			array_push($whmcsdomainlist["extension"], $item["extension"]);
    			array_push($whmcsdomainlist["autoreg"],$item["autoreg"]);
    		}
		}

		$extendeddomainlist = array();
		$ispapiobject = array();

    	foreach($domainlist as $domain){
    		$tld = ".".$this->getDomainExtension($domain);
    		$index = array_search($tld, $whmcsdomainlist["extension"]);
    		array_push($extendeddomainlist, array("domain"=>$domain,
    											  "extension" => $whmcsdomainlist["extension"][$index],
    											  "autoreg" => $whmcsdomainlist["autoreg"][$index]));
    	}

    	//reorganize the information
    	$newlist = array();
    	foreach($extendeddomainlist as $item){
    		if(!isset($newlist[$item["autoreg"]])){
    			$newlist[$item["autoreg"]]["domain"] = array();
    			$newlist[$item["autoreg"]]["registrar"] = $item["autoreg"];
    		}
    		array_push($newlist[$item["autoreg"]]["domain"], $item["domain"]);
    	}

    	return $newlist;
    }

    /*
     * Get all domains of the selected categories if they are configured in WHMCS
	 * If not categorie selected, then returns all the categories.
     *
     * @return array An array with all TLDs of the selected categories.
     */
	 private function getTLDGroups(){
		 //get all the tlds configured in WHMCS
		 $tlds_configured_in_whmcs = array();
		 $tlds_configured_in_whmcs_array = Helper::SQLCall("SELECT extension FROM tbldomainpricing", array(), "fetchall");
		 foreach($tlds_configured_in_whmcs_array as $tld){
			 array_push($tlds_configured_in_whmcs, substr($tld["extension"], 1));
		 }

		 //if $this->tldgroup empty, it means no category selected, so return all the caterogies
		 if(empty($this->tldgroup)){
			 $groups = array();
			 $all_categories = Helper::SQLCall("SELECT id FROM ispapi_tblcategories", array(), "fetchall");
			 foreach($all_categories as $categorie){
				 array_push($groups, $categorie["id"]);
			 }
		 }else{
			 $groups = explode(',', $this->tldgroup);
		 }

		 $tlds = array();

		 foreach($groups as $group) {
			 $tlds_of_the_group = Helper::SQLCall("SELECT id, name, tlds FROM ispapi_tblcategories WHERE id = ? LIMIT 1", array($group));
			 if($tlds_of_the_group){
				 $tlds_of_the_group_array = explode(' ', $tlds_of_the_group["tlds"]);

				 //remove all empty elements (yes it happens) and all tlds which are not configured in WHMCS
				 $i=0;
				 foreach($tlds_of_the_group_array as $tld){
					 if( empty($tld) || (!in_array($tld, $tlds_configured_in_whmcs)) ){
						 unset($tlds_of_the_group_array[$i]);
					 }
					 $i++;
				 }

				 $tlds = array_merge($tlds, $tlds_of_the_group_array);
			 }
		 }
		 return $tlds;
	}

    /*
     * Convert the domain into an IDN code
     *
     * @param string|array $domain The domain name or an array of domains
     * @param IspApiConnection object $ispapi The IspApiConnection object to send API Requests
     * @return string|array IDN code of the domain name or array of IDN codes (saarbrücken.de => xn--saarbrcken-feb.de )
     */
    private function convertIDN($domain, $registrar){
		$command = array(
				"COMMAND" => "convertIDN",
				"DOMAIN" => $domain
		);
		$response = Helper::APICall($registrar, $command);

		if(!is_array($domain)){
	    	return $response["PROPERTY"]["ACE"][0];
		}else{
			return $response["PROPERTY"]["ACE"];
		}
    }

	/*
	 * Convert the domain from IDN to Punycode (müller.com => xn--mller-kva.com)
	 *
	 * @param string|array $domain The domain name or an array of domains
	 * @param IspApiConnection object $ispapi The IspApiConnection object to send API Requests
	 * @return string|array Punycode of the domain name or array of Punycodes
	 */
	private function convertToPunycode($domain, $registrar){
		$command = array(
				"COMMAND" => "convertIDN",
				"DOMAIN" => $domain
		);
		$response = Helper::APICall($registrar, $command);

		if(!is_array($domain)){
			return $response["PROPERTY"]["ACE"][0];
		}else{
			return $response["PROPERTY"]["ACE"];
		}
	}

	/*
	 * Convert the domain from Punycode to IDN (xn--mller-kva.com => müller.com)
	 *
	 * @param string|array $domain The domain name or an array of domains
	 * @param IspApiConnection object $ispapi The IspApiConnection object to send API Requests
	 * @return string|array IDN of the domain name or array of IDNs.
	 */
	private function convertToIDN($domain, $registrar){
		$command = array(
				"COMMAND" => "convertIDN",
				"DOMAIN" => $domain
		);
		$response = Helper::APICall($registrar, $command);

		if(!is_array($domain)){
			return $response["PROPERTY"]["IDN"][0];
		}else{
			return $response["PROPERTY"]["IDN"];
		}
	}

	/*
     * Helper to delete an element from an array.
	 *
     * @param string $element The element to delete
     * @param array &$array The array
	 *
     */
	public static function deleteElement($element, &$array){
	    $index = array_search($element, $array);
	    if($index !== false){
	        unset($array[$index]);
	    }
	}

    /*
     * Get the domain label.
     * (testdomain.net => testdomain)
     *
     * @param string $domain The domain name
     * @return string The domain label
     */
    private function getDomainLabel($domain){
    	$tmp = explode(".", $domain);
    	return $tmp[0];
    }

    /*
     * Get the domain extension
     * (testdomain.net => net)
     *
     * @param string $domain The domain name
     * @return string The domain extension (without ".")
     */
    private function getDomainExtension($domain){
    	$tmp = explode(".", $domain, 2);
    	return $tmp[1];
    }

    /*
     * Send the JSON response back to the template
     */
    public function send(){
		echo $this->response;
		die();
    }
}

?>
