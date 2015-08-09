<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Version\Service;

use Zend\Http\Client;
use Zend\Version;
use Zend\Version\Exception\InvalidEndpointException;

/**
 * Provides Zend Framework-specific version info.
 */
final class FrameworkService extends AbstractService
{
    use GithubServiceTrait;

    /**@#+
     * Endpoint constants
     * @var string
     */
    const ENDPOINT_GITHUB = 'https://api.github.com/repos/zendframework/zf2/git/refs/tags/release-';
    const ENDPOINT_ZEND   = 'http://framework.zend.com/api/zf-version?v=2';
    /**@#- */

    /**
     * @var \Zend\Http\Client
     */
    private $client;

    /**
     * @var \Zend\Version\Service\ServiceInterface
     */
    private $service;

    /**
     * Constructor
     *
     * @param string      $endpoint a remote service endpoint url
     * @param Client|null $client   optional http client
     */
    public function __construct($endpoint = self::ENDPOINT_ZEND, Client $client = null)
    {
        if (! in_array($endpoint, [self::ENDPOINT_ZEND, self::ENDPOINT_GITHUB])) {
            throw new InvalidEndpointException($endpoint);
        }
        $this->endpoint = $endpoint;
        $this->client   = $client;
    }

    /**
     * Fetch the current framework version
     *
     * @return \Zend\Version\Version
     */
    public function getCurrent()
    {
        return new Version\Version(Version\CURRENT);
    }

    /**
     * Fetches the version of the latest stable release.
     * 
     * If the endpoint is set to ENDPOINT_GITHUB, this will use the GitHub
     * API (v3) and only returns refs that begin with * 'tags/release-'.
     *
     * @return string
     */
    protected function loadLatest()
    {
        $response = $this->getService()->loadLatest();
        if ($this->endpoint === self::ENDPOINT_GITHUB) {
            $response = $this->parseGithubResponse($response);
        }
        return $response;
    }

    /**
     * Lazy-initialize a nested service.
     *
     * @return \Zend\Version\Service\AbstractService
     */
    private function getService()
    {
        if (null === $this->service) {
            $this->service = (null === $this->client)
                ? new StreamService($this->endpoint)
                : new ClientService($this->endpoint, $this->client);
        }
        return $this->service;
    }
}
