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
    const DEFAULT_AGENT_NAME = 'Zend-Version';

    /**
     * @var string
     */
    protected $userAgent;

    /**
     * Constructor.
     *
     * @param string $endpoint     An api endpoint
     * @param string $userAgent    A stream context user agent
     * @param string $agentVersion A user agent version
     */
    public function __construct($endpoint, $agentName = self::DEFAULT_AGENT_NAME, $agentVersion = Version\CURRENT)
    {
        if (false === ini_get('allow_url_fopen')) {
            throw AllowUrlFOpenException::disabled();
        }
        $this->endpoint  = (string) $endpoint;
        $this->userAgent = sprintf('%s/%s', $agentName, $agentVersion);
    }

    /**
     * Load the latest version string from the endpoint.
     *
     * @return string A semantic version string e.g. '5.0.34-beta'
     */
    protected function loadLatest()
    {
        $context = stream_context_create(['http' => ['user_agent' => $this->userAgent]]);
        return file_get_contents($this->endpoint, false, $context) ?: null;
    }
}
