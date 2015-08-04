<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZendTest\Version\Service;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\Http\Client;
use Zend\Version\Service\ClientService;

class ClientServiceTest extends TestCase
{
    const ENDPOINT = "http://example.com";

    public function testClassExists()
    {
        $this->assertTrue(class_exists("Zend\Version\Service\ClientService"));
    }

    public function testGetLatestReturnsResponseBody()
    {
        if (!getenv('TESTS_ZEND_VERSION_ONLINE_ENABLED')) {
            $this->markTestSkipped('Version online tests are not enabled');
        }
        if (!extension_loaded('openssl')) {
            $this->markTestSkipped('This test requires openssl extension to be enabled in PHP');
        }

        $client = new Client(self::ENDPOINT, [
            'sslverifypeer' => false,
        ]);
        $service = new ClientService($client, self::ENDPOINT);
        $this->assertInternalType("string", $service->getLatest());
    }
}
