<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Version\Service;

/**
 * A version service provides the latest version and various validators.
 */
interface ServiceInterface
{
    /**
     * Retrieve the latest version as a string.
     *
     * @return string A semantic version string e.g. '5.0.34-beta'
     */
    public function getLatest();

    /**
     * Compare a version against the latest version.
     * 
     * @param  string $version A semantic version string e.g. '5.0.34-beta'
     * @return bool
     * @throws \Zend\Version\Exception\InvalidFormatException when the version is not semantic
     */
    public function isLatest($version);
}
