<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Version\Service;

abstract class AbstractService implements ServiceInterface
{
    protected $endpoint;

    protected $latest;

    public function isLatest($version)
    {
        if (! $latest = $this->getLatest()) {
            return true;
        }
        return version_compare((string) $version, (string) $latest, '>=');
    }
}
