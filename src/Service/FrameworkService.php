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
use Zend\Version\Exception\InvalidEndpointException;

/**
 * Provides Zend Framework-specific version info.
 */
final class FrameworkService extends AbstractService
{
    const ENDPOINT_GITHUB = 'https://api.github.com/repos/zendframework/zf2/git/refs/tags/release-';
    const ENDPOINT_ZEND   = 'http://framework.zend.com/api/zf-version?v=2';

    private $client;

    private $service;

    public function __construct($endpoint = self::ENDPOINT_ZEND, Client $client = null)
    {
        if (! in_array($endpoint, [self::ENDPOINT_ZEND, self::ENDPOINT_GITHUB])) {
            throw new InvalidEndpointException($endpoint);
        }
        $this->endpoint = $endpoint;
        $this->client   = $client;
    }

    public function getLatest()
    {
        if (null === $this->latest) {
            $this->latest = $this->getService()->getLatest();
        }
        return $this->latest;
    }

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
