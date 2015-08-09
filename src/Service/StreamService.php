<?php
/**
 * Zend Framework (http://framework.zend.com/).
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Version\Service;

use Zend\Version;
use Zend\Version\Exception\AllowUrlFOpenException;

/**
 * Provides version api access via a file stream.
 */
class StreamService extends AbstractService
{
    /**
     * @var string
     */
    const DEFAULT_USER_AGENT = 'Zend-Version';

    /**
     * @var string
     */
    protected $userAgent;

    /**
     * @var string
     */
    protected $agentVersion;

    /**
     * Constructor.
     *
     * @param string $endpoint     An api endpoint
     * @param string $userAgent    A stream context user agent
     * @param string $agentVersion A user agent version
     */
    public function __construct($endpoint, $userAgent = self::DEFAULT_USER_AGENT, $agentVersion = Version\CURRENT)
    {
        if (false === ini_get('allow_url_fopen')) {
            throw new AllowUrlFOpenException();
        }
        $this->endpoint     = (string) $endpoint;
        $this->userAgent    = (string) $userAgent;
        $this->agentVersion = (string) $agentVersion;
    }

    /**
     * Load the latest version string from the endpoint.
     *
     * @return string A semantic version string e.g. '5.0.34-beta'
     */
    protected function loadLatest()
    {
        $context = stream_context_create([
            'http' => ['user_agent' => sprintf('%s/%s', $this->userAgent, $this->agentVersion)],
        ]);

        return file_get_contents($this->endpoint, false, $context) ?: null;
    }
}
