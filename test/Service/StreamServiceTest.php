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
use Zend\Version\Service\StreamService;

class StreamServiceTest extends TestCase
{
    const ENDPOINT = "http://example.com";

    public function testClassExists()
    {
        $this->assertTrue(class_exists("Zend\Version\Service\StreamService"));
    }
    
    public function testConstructorTestsAllowUrlFOpen()
    {
        if (!getenv('TESTS_ZEND_VERSION_ONLINE_ENABLED')) {
            $this->markTestSkipped('Online tests are not enabled');
        }
        if (ini_get('allow_url_fopen')) {
            $this->markTestSkipped('This test requires allow_url_fopen to be disabled');
        }

        $this->setExpectedException("Zend\Version\Exception\AllowUrlFOpenException");
        $service = new StreamService(self::ENDPOINT);
    }

    public function testGetLatestReturnsVersion()
    {
        if (!getenv('TESTS_ZEND_VERSION_ONLINE_ENABLED')) {
            $this->markTestSkipped('Online tests are not enabled');
        }
        if (!ini_get('allow_url_fopen')) {
            $this->markTestSkipped('This test requires allow_url_fopen to be enabled');
        }

        $service = new StreamService(self::ENDPOINT);
        $this->assertInstanceOf("Zend\Version\Version", $service->getLatest());
    }
}
