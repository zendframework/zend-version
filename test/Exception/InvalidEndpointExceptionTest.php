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
use Zend\Version\Exception\InvalidEndpointException;

/**
 * @group Zend_Version
 */
class InvalidEndpointExceptionTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Zend\Version\Exception\InvalidFormatException'));
    }

    public function testClassExtendsInvalidArgumentException()
    {
        $subject = new InvalidEndpointException('test');
        $this->assertInstanceOf('InvalidArgumentException', $subject);
    }

    public function testClassHasPatternConstant()
    {
        $this->assertInternalType('string', InvalidEndpointException::PATTERN);
    }

    public function testMessageUsesVersion()
    {
        $endpoint = 'bad';
        $subject = new InvalidEndpointException($endpoint);
        $message = sprintf(InvalidEndpointException::PATTERN, $endpoint);
        $this->assertSame($message, $subject->getMessage());
    }
}
