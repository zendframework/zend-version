<?php

/**
 * Zend Framework (http://framework.zend.com/).
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 *
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Zend\Version;

/**
 * Encapsulates semantic version information.
 */
class Version
{
    /**
     * The current version alias.
     *
     * @var string
     * @deprecated 3.0.0  use Zend\Version\CURRENT instead
     */
    const VERSION = CURRENT;

    /**
     * The version string.
     *
     * @var string
     */
    private $version;

    /**
     * The version parts.
     *
     * @var array
     */
    private $parts = [];

    /**
     * Constructor.
     *
     * @param string $version a semantic version string
     */
    public function __construct($version)
    {
        if (!static::validate($version)) {
            throw new Exception\InvalidFormatException($version);
        }
        $this->version = strtolower($version);
        $this->parseVersionParts();
    }

    /**
     * Splits the version string into its component parts.
     *
     * If minor or patch components are missing, they will be added and
     * the version will be updated.
     *
     * @return void
     */
    private function parseVersionParts()
    {
        preg_match(REGEX, $this->version, $this->parts);
        array_shift($this->parts); // discard the full version
        $numParts = count($this->parts);
        if ($numParts < 3) {
            $this->parts  += array_fill($numParts, 3 - $numParts, '0');
            $this->version = implode('.', $this->parts);
        }
    }

    /**
     * Is this a major version?
     *
     * @param  int|null $major a major version number
     * @return bool
     */
    public function isMajor($major = null)
    {
        if (null !== $major) {
            return $this->parts[0] == $major;
        }
        return $this->parts[1] == '0' && $this->parts[2] == '0';
    }

    /**
     * Is this a minor version?
     *
     * @param  int|null $minor a minor version number
     * @return bool
     */
    public function isMinor($minor = null)
    {
        if (null !== $minor) {
            return $this->parts[1] == $minor;
        }
        return $this->parts[1] != '0' && $this->parts[2] == '0';
    }

    /**
     * Is this a patch version?
     *
     * @param  int|null $patch a patch number
     * @return bool
     */
    public function isPatch($patch = null)
    {
        if (null !== $patch) {
            return $this->parts[2] == $patch;
        }
        return $this->parts[2] != '0';
    }

    /**
     * Is there an extension?
     *
     * @param  string|null $extension a version extension
     * @return bool
     */
    public function hasExtension($extension = null)
    {
        if (! isset($this->parts[3])) {
            return false;
        }
        return ($extension !== null) ? $this->parts[3] === $extension : true;
    }

    /**
     * Compare another version.
     *
     * @link   http://php.net/manual/function.version-compare.php
     * @param  string $another  another version to compare
     * @param  string $operator a comparison operator
     * @return bool
     */
    public function compare($another, $operator = '>=')
    {
        return version_compare((string) $another, $this->version, strtolower($operator));
    }

    /**
     * Convert to a semantic version string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->version;
    }

    /**
     * Validate a version string.
     *
     * @param  string $version a semantic version string
     * @return bool
     */
    public static function validate($version)
    {
        return preg_match(REGEX, (string) $version) === 1;
    }
}
