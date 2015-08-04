<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZendTest\Version\Exception;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\Version\Exception\InvalidFormatException;

/**
 * @group Zend_Version
 */
class InvalidFormatExceptionTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Zend\Version\Exception\InvalidFormatException'));
    }

    public function testClassExtendsDomainException()
    {
        $mock = $this->getMock('Zend\Version\Exception\InvalidFormatException', [], [], '', false);
        $this->assertInstanceOf('DomainException', $mock);
    }

    public function testClassHasPatternConstant()
    {
        $this->assertInternalType('string', InvalidFormatException::PATTERN);
    }

    public function testMessageUsesVersion()
    {
        $version = 'bad';
        $subject = new InvalidFormatException($version);
        $message = sprintf(InvalidFormatException::PATTERN, $version);
        $this->assertSame($message, $subject->getMessage());
    }
}
