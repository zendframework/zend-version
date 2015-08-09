<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Version;

/**
 * Stores semantic version information for Zend Framework.
 */
class Version
{
    /**
     * The current version alias
     *
     * @var        string
     * @deprecated 3.0.0  use Zend\Version\CURRENT instead
     */
    const VERSION = CURRENT;
    
    /**
     * The version string
     *
     * @var string
     */
    private $version;
    
    /**
     * The version parts
     *
     * @var array
     */
    private $parts = [];
    
    /**
     * Constructor
     *
     * @param string $version a semantic version string
     */
    public function __construct($version)
    {
        if (! static::validate($version)) {
            throw new Exception\InvalidFormatException($version);
        }
        $this->version = strtolower($version);
        $this->parseVersionParts();
    }

    /**
     * Splits the version string into its component parts
     *
     * If minor or patch components are missing, they will be added and
     * the version will be updated.
     *
     * @return null
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
     * @return bool
     */
    public function isMajor()
    {
        return $this->parts[1] == '0' && $this->parts[2] == '0';
    }
    
    /**
     * Is this a minor version?
     *
     * @return bool
     */
    public function isMinor()
    {
        return $this->parts[1] != '0' && $this->parts[2] == '0';
    }
    
    /**
     * Is this a patch version?
     *
     * @return bool
     */
    public function isPatch()
    {
        return $this->parts[2] != '0';
    }

    /**
     * Is there an extension?
     *
     * @return bool
     */
    public function hasExtension()
    {
        return isset($this->parts[3]);
    }
    
    /**
     * Compare another version
     *
     * @link   http://php.net/manual/function.version-compare.php
     * @param  string $another  another version to compare
     * @param  string $operator a comparison operator
     * @return bool
     */
    public function compareTo($another, $operator = '>=')
    {
        return version_compare((string) $another, $this->version, strtolower($operator));
    }
    
    /**
     * Convert to a semantic version string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->version;
    }
    
    /**
     * Validate a version string
     *
     * @param  string $version a semantic version string
     * @return bool
     */
    public static function validate($version)
    {
        return preg_match(REGEX, (string) $version) === 1;
    }
}
