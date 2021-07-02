<?php

namespace WHMCS\Module\Registrar\Ispapi;

class Logger
{

    private $additionalData;

    public function __construct($data = [])
    {
        $this->additionalData = $data;
    }
    /**
     * log given data
     * @param string $requestString request data
     * @param \HEXONET\Response $r API response object
     * @param string $error error message
     */
    public function log($requestString, $r, $error = "")
    {
        if (function_exists("logModuleCall")) {
            // fallback to command name, if we can't identify ispapi method used
            $cmd = $r->getCommand();
            $action = $cmd["COMMAND"];
            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS | DEBUG_BACKTRACE_PROVIDE_OBJECT);
            do {
                $t = array_shift($trace);
                if (preg_match("/^ispapi_(.+)$/i", $t["function"], $m) && $m[1] !== "call") {
                    $action = $m[1];
                }
            } while (!empty($trace));

            logModuleCall(
                $this->additionalData["module"],
                $action,
                $r->getCommandPlain() . "\n" . $requestString,
                ($error ? $error . "\n\n" : "") . $r->getPlain()
            );
        }
    }
}
