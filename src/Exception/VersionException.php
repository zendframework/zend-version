<?php
/**
 * Zend Framework (http://framework.zend.com/).
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Version\Exception;

use DomainException;

/**
 * Announces a version error.
 */
final class VersionException extends DomainException
{
    /**
     * Announces an invalid version format.
     *
     * @param  string $version An invalid version string
     * @return self
     * @link   http://semver.org
     */
    public static function invalidFormat($version)
    {
        return new static("Invalid Format: [$version] is not a semantic version");
    }
}
