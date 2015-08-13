<?php
/**
 * Zend Framework (http://framework.zend.com/).
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Version\Service;

use Zend\Http\Client;
use Zend\Version;
use Zend\Version\Exception\InvalidEndpointException;
use Zend\Version\Exception\RecursionException;

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
     * @var \Zend\Version\Service\ServiceInterface
     */
    private $service;

    /**
     * Use an internal StreamService
     *
     * @param  string $endpoint An api endpoint
     * @return self
     */
    public static function stream($endpoint = self::ENDPOINT_ZEND)
    {
        return new static(new StreamService($endpoint));
    }

    /**
     * Use an internal ClientService
     *
     * @param  string $endpoint An api endpoint
     * @param  Client $client   An http client
     * @return self
     */
    public static function client($endpoint = self::ENDPOINT_ZEND, Client $client)
    {
        return new static(new ClientService($endpoint, $client));
    }

    /**
     * Constructor.
     *
     * @param ServiceInterface $service A nested service
     */
    public function __construct(ServiceInterface $service)
    {
        if ($service instanceof self) {
            throw new RecursionException("Nested service must not be an instance of " . __CLASS__);
        }
        if (! in_array($service->endpoint, [self::ENDPOINT_ZEND, self::ENDPOINT_GITHUB])) {
            throw new InvalidEndpointException($service->endpoint);
        }
        $this->service = $service;
    }

    /**
     * Fetch the current framework version.
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
        $response = $this->service->loadLatest();
        if ($this->service->endpoint === self::ENDPOINT_GITHUB) {
            $response = $this->parseGithubResponse($response);
        }
        return $response;
    }
}
