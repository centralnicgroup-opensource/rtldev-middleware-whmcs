<?php
namespace IspapiTest;

use PHPUnit\Framework\TestCase;

/**
 * ISPAPI Registrar Module Test
 *
 * PHPUnit test that asserts the fundamental requirements of a WHMCS
 * registrar module.
 *
 * Custom module tests are added in addtion.
 *
 * @copyright Copyright (c) HEXONET GmbH 2018
 * @license https://github.com/hexonet/ispapi_whmcs/LICENSE
 */

class IspapiRegistrarModuleTest extends TestCase
{

    public static function providerCoreFunctionNames()
    {
        return array(
            array('RegisterDomain'),
            array('TransferDomain'),
            array('RenewDomain'),
            array('GetNameservers'),
            array('SaveNameservers'),
            array('GetContactDetails'),
            array('SaveContactDetails'),
        );
    }

    /**
     * Test Core Module Functions Exist
     *
     * This test confirms that the functions we recommend for all registrar
     * modules are defined for the sample module
     *
     * @param $moduleName
     *
     * @dataProvider providerCoreFunctionNames
     */
    public function testCoreModuleFunctionsExist($moduleName)
    {
        $this->assertTrue(function_exists('ispapi_' . $moduleName));
    }
}
