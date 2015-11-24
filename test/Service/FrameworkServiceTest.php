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
use Zend\Version;
use Zend\Version\Service\FrameworkService;

class FrameworkServiceTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists("Zend\Version\Service\FrameworkService"));
    }

    public function testConstructorValidatesRecursion()
    {
        $internal = $this->getMockForAbstractClass("Zend\Version\Service\ServiceInterface");
        $internal->endpoint = FrameworkService::ENDPOINT_GITHUB;
        $service = new FrameworkService($internal);
        $this->setExpectedException("Zend\Version\Exception\NestedServiceException");
        $test = new FrameworkService($service);
    }

    public function testConstructorValidatesEndpoint()
    {
        $this->setExpectedException("Zend\Version\Exception\InvalidEndpointException");
        $service = FrameworkService::stream("foo");
    }

    public function testGetCurrentReturnsCurrentVersion()
    {
        $internal = $this->getMockForAbstractClass("Zend\Version\Service\ServiceInterface");
        $internal->endpoint = FrameworkService::ENDPOINT_ZEND;
        $service = new FrameworkService($internal);
        $version = $service->getCurrent();
        $this->assertInstanceOf("Zend\Version\Version", $version);
        $this->assertSame(Version\CURRENT, (string) $version);
    }

    public function testGetLatestWithStreamService()
    {
        if (!getenv('TESTS_ZEND_VERSION_ONLINE_ENABLED')) {
            $this->markTestSkipped('Online tests are not enabled');
        }
        if (!ini_get('allow_url_fopen')) {
            $this->markTestSkipped('This test requires allow_url_fopen to be enabled');
        }

        $service = FrameworkService::stream();
        $this->assertInstanceOf('Zend\Version\Version', $service->getLatest());
    }

    public function testGetLatestWithClientService()
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
        $service = FrameworkService::client(FrameworkService::ENDPOINT_GITHUB, $client);
        $this->assertInstanceOf('Zend\Version\Version', $service->getLatest());
    }
}
