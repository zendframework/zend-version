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
use Zend\Version\Exception\VersionException;

/**
 * @group Zend_Version
 */
class VersionExceptionTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Zend\Version\Exception\VersionException'));
    }

    public function testClassExtendsDomainException()
    {
        $this->assertInstanceOf('DomainException', new VersionException());
    }

    public function testInvalidFormatsMessage()
    {
        $subject = VersionException::invalidFormat('bad');
        $message = 'Invalid Format: [bad] is not a semantic version';
        $this->assertSame($message, $subject->getMessage());
    }
}
