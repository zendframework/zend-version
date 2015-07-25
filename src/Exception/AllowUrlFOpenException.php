<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Version\Exception;

use ErrorException;

/**
 * Announces an error with the allow_url_fopen configuration setting
 */
class AllowUrlFOpenException extends ErrorException
{
    /**
     * @var string
     */
    const PATTERN = 'allow_url_fopen is not set, and no Zend\Http\Client ' .
                    'was passed. You must either set allow_url_fopen in your ' .
                    'PHP configuration or pass a configured Zend\Http\Client ' .
                    'as the first argument to %s::getLatestVersion.';
    
    /**
     * Constructor
     * 
     * @param string $className  A fully-qualified class name
     * @param string $fileName   A file name
     * @param int    $lineNumber A file line number
     */
    public function __construct($className, $fileName, $lineNumber)
    {
        $message = sprintf(static::PATTERN, $className);
        parent::__construct($message, 0, E_USER_WARNING, $fileName, $lineNumber);
    }
}
