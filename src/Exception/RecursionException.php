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
 * Announces a recursion error.
 *
 * @see \Zend\Version\Service\FrameworkService::__construct()
 */
final class RecursionException extends DomainException
{
}
