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
use Zend\Version\Exception\NestedServiceException;

/**
 * @group Zend_Version
 */
class NestedServiceExceptionTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Zend\Version\Exception\NestedServiceException'));
    }

    public function testClassExtendsDomainException()
    {
        $this->assertInstanceOf('DomainException', new NestedServiceException());
    }

    public function testRecursionFormatsMessage()
    {
        $exception = NestedServiceException::recursion(__CLASS__);
        $message   = "Nested service must not be an instance of " . __CLASS__;
        $this->assertSame($message, $exception->getMessage());
    }
}
