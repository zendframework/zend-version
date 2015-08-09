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

class AbstractServiceTest extends TestCase
{
    const CLASSNAME   = 'Zend\Version\Service\AbstractService';
    const DEV_VERSION = '0.0.1-dev';

    public function testClassExists()
    {
        $this->assertTrue(class_exists(self::CLASSNAME));
    }

    public function testClassImplementsServiceInterface()
    {
        $service = $this->getMockForAbstractClass(self::CLASSNAME);
        $this->assertInstanceOf('Zend\Version\Service\ServiceInterface', $service);
    }

    public function testIsLatestValidatesVersion()
    {
        $this->setExpectedException('Zend\Version\Exception\InvalidFormatException');
        $service = $this->getMockForAbstractClass(self::CLASSNAME);
        $service->isLatest('foo');
    }

    public function testIsLatestReturnsBool()
    {
        $service = $this->getMockForAbstractClass(self::CLASSNAME);
        $service
            ->expects($this->once())
            ->method('loadLatest')
            ->will($this->returnValue('5.38.1'));

        $this->assertFalse($service->isLatest(self::DEV_VERSION));
    }

    public function testIsLatestReturnsTrueWithMissingLatest()
    {
        $service = $this->getMockForAbstractClass(self::CLASSNAME);
        $service
            ->expects($this->once())
            ->method('loadLatest')
            ->will($this->returnValue(null));

        $this->assertTrue($service->isLatest(self::DEV_VERSION));
    }
}
