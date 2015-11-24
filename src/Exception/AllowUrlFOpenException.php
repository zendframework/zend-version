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
final class AllowUrlFOpenException extends ErrorException
{
    /**
     * Announces allow_url_fopen is disabled.
     *
     * @param  int  $code An error code
     * @return self
     */
    public static function disabled($code = 0)
    {
        return new static('allow_url_fopen is not enabled', $code, E_USER_WARNING);
    }
}
