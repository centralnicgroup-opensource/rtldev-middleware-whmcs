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
 * @license https://github.com/hexonet/whmcs-ispapi-registrar/LICENSE
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
     * modules are defined for the ispapi registrar module
     *
     * @param $method
     *
     * @dataProvider providerCoreFunctionNames
     */
    public function testCoreModuleFunctionsExist($method)
    {
        $this->assertTrue(function_exists('ispapi_' . $method));
    }

    public function testIspapiConfigCASE1()
    {
        $expected = array(
            "registrar" => "ispapi",
            "entity" => "1234",
            "url" => "https://coreapi.1api.net/api/call.cgi",
            "idns" => "API",
            "proxy" => "google.com",
            "login" => "test.user",
            "password" => "test.passw0rd"
        );
        $actual = ispapi_config(array(
            "registrar" => "ispapi",
            "Username" => "test.user",
            "Password" => "test.passw0rd",
            "UseSSL" => "on",
            "TestMode" => "on",
            "ProxyServer" => "google.com",
            "ConvertIDNs" => "API"
        ));
        $this->assertEquals($expected, $actual);
    }

    public function testIspapiConfigCASE2()
    {
        $expected = array(
            "registrar" => "ispapi",
            "entity" => "1234",
            "url" => "https://coreapi.1api.net/api/call.cgi",
            "idns" => "API",
            "login" => "test.user",
            "password" => "test.passw0rd"
        );
        $actual = ispapi_config(array(
            "registrar" => "ispapi",
            "Username" => "test.user",
            "Password" => "test.passw0rd",
            "UseSSL" => 1,
            "TestMode" => 1,
            "ProxyServer" => "",
            "ConvertIDNs" => "API"
        ));
        $this->assertEquals($expected, $actual);
    }
}
