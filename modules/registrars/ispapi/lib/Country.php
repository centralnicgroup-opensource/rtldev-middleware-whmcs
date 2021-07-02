<?php

namespace WHMCS\Module\Registrar\Ispapi;

/**
 * AdditionalFields class
 *
 * Covering anything useful we need to better support additional domain fields in WHMCS
 * inherits from \WHMCS\Domains\AdditionalFields to allow access to WHMCS internals for reuse
 */
class Country extends \WHMCS\Domains\Domain
{
    /**
     * Get list of country codes of EU member states
     * @static
     * @return array
     */
    public static function getEUMemberStatesCountryCodes()
    {
        return parent::eligibleCountriesForEuTld();
    }

    /**
     * Get list of all configured country codes
     * @static
     * @return array
     */
    public static function getCountryCodes()
    {
        return array_keys((new \WHMCS\Utility\Country())->getCountryNameArray());
    }
}
