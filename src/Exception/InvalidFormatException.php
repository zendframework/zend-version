<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Version\Exception;

use DomainException;

/**
 * Announces an invalid version format.
 * 
 * @link http://semver.org
 */
class InvalidFormatException extends DomainException
{
    /**
     * @var string
     */
    const PATTERN = 'Invalid Format: [%s] is not a semantic version';

    /**
     * Constructor
     * 
     * @param string $version An invalid version string
     */
    public function __construct($version)
    {
        parent::__construct(sprintf(static::PATTERN, $version));
    }
}
