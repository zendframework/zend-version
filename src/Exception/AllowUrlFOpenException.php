<?php
/**
 * Zend Framework (http://framework.zend.com/).
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Version\Exception;

use ErrorException;

/**
 * Announces an error with the allow_url_fopen configuration setting.
 */
class AllowUrlFOpenException extends ErrorException
{
    /**
     * @var string
     */
    const DEFAULT_MESSAGE = 'allow_url_fopen is not enabled';

    /**
     * Constructor.
     *
     * @param string $message An error message
     * @param int    $code    An error code
     * @param int    $level   A severity level
     */
    public function __construct($message = self::DEFAULT_MESSAGE, $code = 0, $level = E_USER_WARNING)
    {
        parent::__construct($message, $code, $level);
    }
}
