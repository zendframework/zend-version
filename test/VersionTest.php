<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZendTest\Version;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\Version\Version;

class VersionTest extends TestCase
{
    const TEST_VERSION_1 = '1';
    const TEST_VERSION_2 = '2.21';
    const TEST_VERSION_3 = '1.2.3';
    const TEST_VERSION_4 = '0.0.14-alpha';
    const TEST_VERSION_5 = 'bad';

    public function testClassExists()
    {
        $this->assertTrue(class_exists("Zend\Version\Version"));
    }

    public function testConstructorValidatesVersion()
    {
        $this->setExpectedException("Zend\Version\Exception\InvalidFormatException");
        $version = new Version(self::TEST_VERSION_5);
    }

    /**
     * @dataProvider getVersionStrings
     */
    public function testToString($actual, $expected)
    {
        $version = new Version($actual);
        $this->assertSame($expected, (string) $version);
    }

    public function getVersionStrings()
    {
        return [
            [self::TEST_VERSION_1, '1.0.0'],
            [self::TEST_VERSION_2, '2.21.0'],
            [self::TEST_VERSION_3, self::TEST_VERSION_3],
            [self::TEST_VERSION_4, self::TEST_VERSION_4],
        ];
    }

    public function testIsMajorReturnsBool()
    {
        $version = new Version(self::TEST_VERSION_1);
        $this->assertTrue($version->isMajor(1));

        $version = new Version(self::TEST_VERSION_2);
        $this->assertFalse($version->isMajor());
    }

    public function testIsMinorReturnsBool()
    {
        $version = new Version(self::TEST_VERSION_2);
        $this->assertTrue($version->isMinor());

        $version = new Version(self::TEST_VERSION_3);
        $this->assertFalse($version->isMinor(5));
    }

    public function testIsPatchReturnsBool()
    {
        $version = new Version(self::TEST_VERSION_3);
        $this->assertTrue($version->isPatch(3));

        $version = new Version(self::TEST_VERSION_1);
        $this->assertFalse($version->isPatch());
    }

    public function testHasExtensionReturnsBool()
    {
        $version = new Version(self::TEST_VERSION_4);
        $this->assertTrue($version->hasExtension('alpha'));

        $version = new Version(self::TEST_VERSION_1);
        $this->assertFalse($version->hasExtension());
    }

    public function testCompareReturnsBool()
    {
        $version = new Version(self::TEST_VERSION_1);
        $this->assertFalse($version->compare(self::TEST_VERSION_4));
    }
}
