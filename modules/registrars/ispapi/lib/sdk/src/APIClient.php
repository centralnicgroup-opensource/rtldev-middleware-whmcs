<?php

#declare(strict_types=1);

/**
 * HEXONET
 * Copyright © HEXONET
 */

namespace HEXONET;

use HEXONET\ResponseTemplateManager as RTM;
use HEXONET\Logger as L;

// check the docs, don't worry about http usage here
define("ISPAPI_CONNECTION_URL_PROXY", "http://127.0.0.1/api/call.cgi");
define("ISPAPI_CONNECTION_URL", "https://api.ispapi.net/api/call.cgi");

/**
 * HEXONET APIClient
 *
 * @package HEXONET
 */

class APIClient
{
    /**
     * API connection timeout setting
     * @var integer
     */
    private static $socketTimeout = 300000;
    /**
     * API connection url
     * @var string
     */
    private $socketURL;
    /**
     * Object covering API connection data
     * @var SocketConfig
     */
    private $socketConfig;
    /**
     * activity flag for debug mode
     * @var boolean
     */
    private $debugMode;
    /**
     * user agent
     * @var string
     */
    private $ua;
    /**
     * additional curl options to use
     * @var array
     */
    private $curlopts = [];
    /**
     * logger function name for debug mode
     * @var Logger
     */
    private $logger;

    public function __construct()
    {
        $this->socketURL = "";
        $this->debugMode = false;
        $this->ua = "";
        $this->setURL(ISPAPI_CONNECTION_URL);
        $this->socketConfig = new SocketConfig();
        $this->useLIVESystem();
        $this->setDefaultLogger();
    }

    /**
     * set custom logger to use instead of default one
     * create your own class inheriting from \HEXONET\Logger and overriding method log
     * @param Logger $customLogger
     * @return $this
     */
    public function setCustomLogger($customLogger)
    {
        $this->logger = $customLogger;
        return $this;
    }

    /**
     * set default logger to use
     * @return $this
     */
    public function setDefaultLogger()
    {
        $this->logger = new L();
        return $this;
    }

    /**
     * Enable Debug Output to STDOUT
     * @return $this
     */
    public function enableDebugMode()
    {
        $this->debugMode = true;
        return $this;
    }

    /**
     * Disable Debug Output
     * @return $this
     */
    public function disableDebugMode()
    {
        $this->debugMode = false;
        return $this;
    }

    /**
     * Serialize given command for POST request including connection configuration data
     * @param string|array $cmd API command to encode
     * @param bool $secured secure password (when used for output)
     * @return string encoded POST data string
     */
    public function getPOSTData($cmd, $secured = false)
    {
        $data = $this->socketConfig->getPOSTData();
        if ($secured) {
            $data = preg_replace("/s_pw\=[^&]+/", "s_pw=***", $data);
        }
        $tmp = "";
        if (!is_string($cmd)) {
            foreach ($cmd as $key => $val) {
                if (isset($val)) {
                    $tmp .= $key . "=" . preg_replace("/\r|\n/", "", $val) . "\n";
                }
            }
        } else {
            $tmp = $cmd;
        }
        if ($secured) {
            $tmp = preg_replace("/PASSWORD\=[^\n]+/", "PASSWORD=***", $tmp);
        }
        $tmp = preg_replace("/\n$/", "", $tmp);

        $data .= rawurlencode("s_command") . "=" . rawurlencode($tmp);
        return $data;
    }

    /**
     * Get the API Session ID that is currently set
     * @return string|null API Session ID currently in use
     */
    public function getSession()
    {
        $sessid = $this->socketConfig->getSession();
        return ($sessid === "" ? null : $sessid);
    }

    /**
     * Get the API connection url that is currently set
     * @return string API connection url currently in use
     */
    public function getURL()
    {
        return $this->socketURL;
    }

    /**
     * Set a custom user agent (for platforms that use this SDK)
     * @param string $str user agent label
     * @param string $rv user agent revision
     * @param array $modules further modules to add to user agent string, format: ["<module1>/<version>", "<module2>/<version>", ... ]
     * @return $this
     */
    public function setUserAgent($str, $rv, $modules = [])
    {
        $mods = empty($modules) ? "" : " " . implode(" ", $modules);
        $this->ua = (
            $str . " (" . PHP_OS . "; " . php_uname('m') . "; rv:" . $rv . ")" . $mods . " php-sdk/" . $this->getVersion() . " php/" . implode(".", [PHP_MAJOR_VERSION, PHP_MINOR_VERSION, PHP_RELEASE_VERSION])
        );
        return $this;
    }

    /**
     * Get the user agent string
     * @return string user agent string
     */
    public function getUserAgent()
    {
        if (!strlen($this->ua)) {
            $this->ua = "PHP-SDK (" . PHP_OS . "; " . php_uname('m') . "; rv:" . $this->getVersion() . ") php/" . implode(".", [PHP_MAJOR_VERSION, PHP_MINOR_VERSION, PHP_RELEASE_VERSION]);
        }
        return $this->ua;
    }

    /**
     * Set proxy to use for API communication
     * @param string $proxy proxy to use
     * @return $this
     */
    public function setProxy($proxy)
    {
        $this->curlopts[CURLOPT_PROXY] = $proxy;
        return $this;
    }

    /**
     * Get proxy configuration for API communication
     * @return string|null
     */
    public function getProxy()
    {
        if (isset($this->curlopts[CURLOPT_PROXY])) {
            return $this->curlopts[CURLOPT_PROXY];
        }
        return null;
    }

    /**
     * Set Referer to use for API communication
     * @param string $referer Referer
     * @return $this
     */
    public function setReferer($referer)
    {
        $this->curlopts[CURLOPT_REFERER] = $referer;
        return $this;
    }

    /**
     * Get Referer configuration for API communication
     * @return string|null
     */
    public function getReferer()
    {
        if (isset($this->curlopts[CURLOPT_REFERER])) {
            return $this->curlopts[CURLOPT_REFERER];
        }
        return null;
    }

    /**
     * Get the current module version
     * @return string module version
     */
    public function getVersion()
    {
        return "6.0.8";
    }

    /**
     * Apply session data (session id and system entity) to given php session object
     * @param array $session php session instance ($_SESSION)
     * @return $this
     */
    public function saveSession(&$session)
    {
        $session["socketcfg"] = [
            "entity" => $this->socketConfig->getSystemEntity(),
            "session" => $this->socketConfig->getSession()
        ];
        return $this;
    }

    /**
     * Use existing configuration out of php session object
     * to rebuild and reuse connection settings
     * @param array $session php session object ($_SESSION)
     * @return $this
     */
    public function reuseSession(&$session)
    {
        $this->socketConfig->setSystemEntity($session["socketcfg"]["entity"]);
        $this->setSession($session["socketcfg"]["session"]);
        return $this;
    }

    /**
     * Set another connection url to be used for API communication
     * @param string $value API connection url to set
     * @return $this
     */
    public function setURL($value)
    {
        $this->socketURL = $value;
        return $this;
    }

    /**
     * Set one time password to be used for API communication
     * @param string $value one time password
     * @return $this
     */
    public function setOTP($value)
    {
        $this->socketConfig->setOTP($value);
        return $this;
    }

    /**
     * Set an API session id to be used for API communication
     * @param string $value API session id
     * @return $this
     */
    public function setSession($value)
    {
        $this->socketConfig->setSession($value);
        return $this;
    }

    /**
     * Set an Remote IP Address to be used for API communication
     * To be used in case you have an active ip filter setting.
     * @param string $value Remote IP Address
     * @return $this
     */
    public function setRemoteIPAddress($value)
    {
        $this->socketConfig->setRemoteAddress($value);
        return $this;
    }

    /**
     * Set Credentials to be used for API communication
     * @param string $uid account name
     * @param string $pw account password
     * @return $this
     */
    public function setCredentials($uid, $pw)
    {
        $this->socketConfig->setLogin($uid);
        $this->socketConfig->setPassword($pw);
        return $this;
    }

    /**
     * Set Credentials to be used for API communication
     * @param string $uid account name
     * @param string $role role user id
     * @param string $pw role user password
     * @return $this
     */
    public function setRoleCredentials($uid, $role, $pw)
    {
        return $this->setCredentials(!empty($role) ? $uid . "!" . $role : $uid, $pw);
    }

    /**
     * Perform API login to start session-based communication
     * @param string $otp optional one time password
     * @return Response Response
     */
    public function login($otp = "")
    {
        $this->setOTP($otp);
        $rr = $this->request(["COMMAND" => "StartSession"]);
        if ($rr->isSuccess()) {
            $col = $rr->getColumn("SESSION");
            $this->setSession($col ? $col->getData()[0] : "");
        }
        return $rr;
    }

    /**
     * Perform API login to start session-based communication.
     * Use given specific command parameters.
     * @param array $params given specific command parameters
     * @param string $otp optional one time password
     * @return Response Response
     */
    public function loginExtended($params, $otp = "")
    {
        $this->setOTP($otp);
        $rr = $this->request(array_merge(
            ["COMMAND" => "StartSession"],
            $params
        ));
        if ($rr->isSuccess()) {
            $col = $rr->getColumn("SESSION");
            $this->setSession($col ? $col->getData()[0] : "");
        }
        return $rr;
    }

    /**
     * Perform API logout to close API session in use
     * @return Response Response
     */
    public function logout()
    {
        $rr = $this->request(["COMMAND" => "EndSession"]);
        if ($rr->isSuccess()) {
            $this->setSession("");
        }
        return $rr;
    }

    /**
     * Flatten API command's nested arrays for easier handling
     * @param array $cmd API Command
     * @return array
     */
    private function flattenCommand($cmd)
    {
        $newcmd = [];
        foreach ($cmd as $key => $val) {
            if (isset($val)) {
                $val = preg_replace("/\r|\n/", "", $val);
                $newKey = \strtoupper($key);
                if (is_array($val)) {
                    foreach ($cmd[$key] as $idx => $v) {
                        $newcmd[$newKey . $idx] = $v;
                    }
                } else {
                    $newcmd[$newKey] = $val;
                }
            }
        }
        return $newcmd;
    }

    /**
     * Auto convert API command parameters to punycode, if necessary.
     * @param array|string $cmd API command
     * @return array
     */
    private function autoIDNConvert($cmd)
    {
        // don't convert for convertidn command to avoid endless loop
        // and ignore commands in string format (even deprecated)
        if (is_string($cmd) || preg_match("/^CONVERTIDN$/i", $cmd["COMMAND"])) {
            return $cmd;
        }
        $keys = preg_grep("/^(DOMAIN|NAMESERVER|DNSZONE)([0-9]*)$/i", array_keys($cmd));
        if (empty($keys)) {
            return $cmd;
        }
        $toconvert = [];
        $idxs = [];
        foreach ($keys as $key) {
            if (isset($cmd[$key])) {
                if (preg_match('/[^a-z0-9\.\- ]/i', $cmd[$key])) {// maybe preg_grep as replacement
                    $toconvert[] = $cmd[$key];
                    $idxs[] = $key;
                }
            }
        }
        if (empty($toconvert)) {
            return $cmd;
        }
        $r = $this->request([
            "COMMAND" => "ConvertIDN",
            "DOMAIN" => $toconvert
        ]);
        if ($r->isSuccess()) {
            $col = $r->getColumn("ACE");
            if ($col) {
                foreach ($col->getData() as $idx => $pc) {
                    $cmd[$idxs[$idx]] = $pc;
                }
            }
        }
        return $cmd;
    }

    /**
     * Perform API request using the given command
     * @param array $cmd API command to request
     * @return Response Response
     */
    public function request($cmd)
    {
        // flatten nested api command bulk parameters
        $mycmd = $this->flattenCommand($cmd);
        // auto convert umlaut names to punycode
        $mycmd = $this->autoIDNConvert($mycmd);

        // request command to API
        $cfg = [
            "CONNECTION_URL" => $this->socketURL
        ];
        $curl = curl_init($cfg["CONNECTION_URL"]);
        $data = $this->getPOSTData($mycmd);
        $secured = $this->getPOSTData($mycmd, true);
        if ($curl === false) {
            $r = new Response("nocurl", $mycmd, $cfg);
            if ($this->debugMode) {
                $this->logger->log($secured, $r, "CURL for PHP missing.");
            }
            return $r;
        }
        curl_setopt_array($curl, [
            //timeout: APIClient.socketTimeout,
            CURLOPT_POST            =>  1,
            CURLOPT_POSTFIELDS      =>  $data,
            CURLOPT_HEADER          =>  0,
            CURLOPT_RETURNTRANSFER  =>  1,
            CURLOPT_USERAGENT       =>  $this->getUserAgent(),
            CURLOPT_HTTPHEADER      =>  [
                'Expect:',
                'Content-type: text/html; charset=UTF-8'
            ]
        ] + $this->curlopts);
        $r = curl_exec($curl);
        $error = null;
        if ($r === false) {
            $r = "httperror";
            $error = curl_error($curl);
        }
        $r = new Response($r, $mycmd, $cfg);

        curl_close($curl);
        if ($this->debugMode) {
            $this->logger->log($secured, $r, $error);
        }
        return $r;
    }

    /**
     * Request the next page of list entries for the current list query
     * Useful for tables
     * @param Response $rr API Response of current page
     * @throws \Exception in case Command Parameter LAST is in use while using this method
     * @return Response|null Response or null in case there are no further list entries
     */
    public function requestNextResponsePage($rr)
    {
        $mycmd = $rr->getCommand();
        if (array_key_exists("LAST", $mycmd)) {
            throw new \Exception("Parameter LAST in use. Please remove it to avoid issues in requestNextPage.");
        }
        $first = 0;
        if (array_key_exists("FIRST", $mycmd)) {
            $first = $mycmd["FIRST"];
        }
        $total = $rr->getRecordsTotalCount();
        $limit = $rr->getRecordsLimitation();
        $first += $limit;
        if ($first < $total) {
            $mycmd["FIRST"] = $first;
            $mycmd["LIMIT"] = $limit;
            return $this->request($mycmd);
        }

        return null;
    }

    /**
     * Request all pages/entries for the given query command
     * @param array $cmd API list command to use
     * @return Response[] Responses
     */
    public function requestAllResponsePages($cmd)
    {
        $responses = [];
        $rr = $this->request(array_merge([], $cmd, ["FIRST" => 0]));
        $tmp = $rr;
        $idx = 0;
        do {
            $responses[$idx++] = $tmp;
            $tmp = $this->requestNextResponsePage($tmp);
        } while ($tmp !== null);
        return $responses;
    }

    /**
     * Set a data view to a given subuser
     * @param string $uid subuser account name
     * @return $this
     */
    public function setUserView($uid = '')
    {
        $this->socketConfig->setUser($uid);
        return $this;
    }

    /**
     * Reset data view back from subuser to user
     * @return $this
     */
    public function resetUserView()
    {
        $this->socketConfig->setUser("");
        return $this;
    }

    /**
     * Activate High Performance Setup
     * @return $this
     */
    public function useHighPerformanceConnectionSetup()
    {
        $this->setURL(ISPAPI_CONNECTION_URL_PROXY);
        return $this;
    }


    /**
     * Activate Default Connection Setup (which is the default anyways)
     * @return $this
     */
    public function useDefaultConnectionSetup()
    {
        $this->setURL(ISPAPI_CONNECTION_URL);
        return $this;
    }

    /**
     * Set OT&E System for API communication
     * @return $this
     */
    public function useOTESystem()
    {
        $this->socketConfig->setSystemEntity("1234");
        return $this;
    }

    /**
     * Set LIVE System for API communication (this is the default setting)
     * @return $this
     */
    public function useLIVESystem()
    {
        $this->socketConfig->setSystemEntity("54cd");
        return $this;
    }
}
