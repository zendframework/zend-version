<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Version\Exception;

use InvalidArgumentException;

/**
 * Announces an invalid service endpoint.
 */
class InvalidEndpointException extends InvalidArgumentException
{
    /**
     * @var string
     */
    const PATTERN = 'Invalid service endpoint [%s]';

    /**
     * Constructor
     * 
     * @param string $endpoint An invalid version string
     */
    public function __construct($endpoint)
    {
        parent::__construct(sprintf(static::PATTERN, $endpoint));
    }
}
