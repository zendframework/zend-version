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
use Zend\Version\Exception\AllowUrlFOpenException;

/**
 * @group Zend_Version
 */
class AllowUrlFOpenExceptionTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Zend\Version\Exception\AllowUrlFOpenException'));
    }

    public function testClassExtendsErrorException()
    {
        $mock = $this->getMock('Zend\Version\Exception\AllowUrlFOpenException', [], [], '', false);
        $this->assertInstanceOf('ErrorException', $mock);
    }

    public function testClassHasDefaultMessage()
    {
        $this->assertInternalType('string', AllowUrlFOpenException::DEFAULT_MESSAGE);
    }

    public function testMessageUsesDefaultMessage()
    {
        $subject = new AllowUrlFOpenException();
        $this->assertSame(AllowUrlFOpenException::DEFAULT_MESSAGE, $subject->getMessage());
    }

    public function testGetCodeReturnsDefault()
    {
        $subject = new AllowUrlFOpenException();
        $this->assertSame(0, $subject->getCode());
    }

    public function testGetSeverityReturnsUserWarning()
    {
        $subject = new AllowUrlFOpenException();
        $this->assertSame(E_USER_WARNING, $subject->getSeverity());
    }
}
