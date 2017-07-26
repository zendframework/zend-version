<?php
/**
 * Zend Framework (http://framework.zend.com/).
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Version\Exception;

use InvalidArgumentException;

/**
 * Announces an endpoint error.
 */
final class EndpointException extends InvalidArgumentException
{
    /**
     * Announces an invalid service endpoint.
     *
     * @param string $endpoint An invalid endpoint string
     */
    public static function invalid($endpoint)
    {
        return new static("Invalid service endpoint [$endpoint]");
    }
}
