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
use Zend\Version\Service\FrameworkService;

class FrameworkServiceTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists("Zend\Version\Service\FrameworkService"));
    }

    public function testConstructorValidatesEndpoint()
    {
        $this->setExpectedException("Zend\Version\Exception\InvalidEndpointException");
        $service = new FrameworkService("foo");
    }

    /**
     * @ runInSeparateProcess
     */
    public function testGetLatestWithoutClient()
    {
        if (!getenv('TESTS_ZEND_VERSION_ONLINE_ENABLED')) {
            $this->markTestSkipped('Online tests are not enabled');
        }
        if (!ini_get('allow_url_fopen')) {
            $this->markTestSkipped('This test requires allow_url_fopen to be enabled');
        }

        $service = new FrameworkService();
        $this->assertInternalType('string', $service->getLatest());
    }

    /**
     * @ runInSeparateProcess
     */
    public function testGetLatestWithClient()
    {
        if (!getenv('TESTS_ZEND_VERSION_ONLINE_ENABLED')) {
            $this->markTestSkipped('Online tests are not enabled');
        }
        if (!extension_loaded('openssl')) {
            $this->markTestSkipped('This test requires openssl extension to be enabled in PHP');
        }

        $client = new Client("http://example.com", [
            'sslverifypeer' => false,
        ]);
        $service = new FrameworkService(FrameworkService::ENDPOINT_GITHUB, $client);
        $this->assertInternalType('string', $service->getLatest());
    }
}
