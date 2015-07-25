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

    public function testClassHasPatternConstant()
    {
        $this->assertInternalType('string', AllowUrlFOpenException::PATTERN);
    }

    public function testMessageUsesClassName()
    {
        $subject = new AllowUrlFOpenException(static::class, __FILE__, __LINE__);
        $message = sprintf(AllowUrlFOpenException::PATTERN, static::class);
        $this->assertSame($message, $subject->getMessage());
    }

    public function testGetFileReturnsFilename()
    {
        $subject = new AllowUrlFOpenException(static::class, __FILE__, __LINE__);
        $this->assertSame(__FILE__, $subject->getFile());
    }

    public function testGetLineReturnsLinenumber()
    {
        $line    = __LINE__;
        $subject = new AllowUrlFOpenException(static::class, __FILE__, $line);
        $this->assertSame($line, $subject->getLine());
    }

    public function testGetSeverityReturnsUserWarning()
    {
        $subject = new AllowUrlFOpenException(static::class, __FILE__, __LINE__);
        $this->assertSame(E_USER_WARNING, $subject->getSeverity());
    }
}
