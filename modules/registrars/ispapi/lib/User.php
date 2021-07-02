<?php

namespace WHMCS\Module\Registrar\Ispapi;

use WHMCS\Module\Registrar\Ispapi\Ispapi;

class User
{
    /**
     * Load User Relations from API (or Session)
     * Once loaded, this is stored in $_SESSION["ISPAPICACHE"]["RELATIONS"] for 600 seconds.
     *
     * @param array $params common module parameters
     *
     * @return array/bool the user relations, false if not found
     */
    public static function loadRelations($params)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $ts = time();
        if ((!isset($_SESSION["ISPAPICACHE"])) || (($_SESSION["ISPAPICACHE"]["TIMESTAMP"] + 600) < $ts )) {
            $command["COMMAND"] = "StatusUser";
            $response = Ispapi::call($command, $params);
            if ($response["CODE"] === "200") {
                $_SESSION["ISPAPICACHE"] = [
                    "TIMESTAMP" => $ts,
                    "RELATIONS" => $response["PROPERTY"]
                ];
                return $_SESSION["ISPAPICACHE"]["RELATIONS"];
            } else {
                return false;
            }
        } else {
            return $_SESSION["ISPAPICACHE"]["RELATIONS"];
        }
    }

    /**
     * Get the value for a given user relationtype
     *
     * @param array $params common module parameters
     * @param string $relationtype the name of the user relationtype
     *
     * @return integer/bool the user relationvalue, false if not found
     */
    public static function getRelationValue($params, $relationtype)
    {
        $relations = self::loadRelations($params);
        foreach ($relations["RELATIONTYPE"] as $idx => $relation) {
            if ($relation === $relationtype) {
                return $relations["RELATIONVALUE"][$idx];
            }
        }
        return false;
    }
}
