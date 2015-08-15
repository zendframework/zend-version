<?php
/**
 * Zend Framework (http://framework.zend.com/).
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Version\Service;

use Zend\Version\Exception\InvalidFormatException;
use Zend\Version\Version;

/**
 * A generic implementation of the ServiceInterface.
 */
abstract class AbstractService implements ServiceInterface
{
    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var \Zend\Version\Version
     */
    protected $latest;

    /**
     * Retrieve the latest version.
     *
     * @return \Zend\Version\Version
     */
    public function getLatest()
    {
        if (null === $this->latest && $response = $this->loadLatest()) {
            $this->latest = new Version($response);
        }

        return $this->latest;
    }

    /**
     * Compare a version against the latest version.
     *
     * @param  string $version A semantic version string e.g. '5.0.34-beta'
     * @return bool
     * @throws \Zend\Version\Exception\InvalidFormatException when the version is not semantic
     */
    public function isLatest($version)
    {
        if (!Version::validate($version)) {
            throw new InvalidFormatException($version);
        }
        if (!$latest = $this->getLatest()) {
            return true;
        }

        return $latest->compare($version);
    }

    /**
     * Load the latest version string from the endpoint.
     *
     * @return string A semantic version string e.g. '5.0.34-beta'
     */
    abstract protected function loadLatest();
}
