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
        $this->assertInstanceOf('ErrorException', new AllowUrlFOpenException());
    }

    public function testDisabledMessage()
    {
        $exception = AllowUrlFOpenException::disabled();
        $this->assertSame('allow_url_fopen is not enabled', $exception->getMessage());
    }

    public function testDisabledSeverity()
    {
        $subject = AllowUrlFOpenException::disabled();
        $this->assertSame(E_USER_WARNING, $subject->getSeverity());
    }
}
