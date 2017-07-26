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
use Zend\Version\Exception\EndpointException;

/**
 * @group Zend_Version
 */
class EndpointExceptionTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Zend\Version\Exception\EndpointException'));
    }

    public function testClassExtendsInvalidArgumentException()
    {
        $subject = new EndpointException('test');
        $this->assertInstanceOf('InvalidArgumentException', $subject);
    }

    public function testInvalidFormatsMessage()
    {
        $subject = EndpointException::invalid('bad');
        $message = 'Invalid service endpoint [bad]';
        $this->assertSame($message, $subject->getMessage());
    }
}
