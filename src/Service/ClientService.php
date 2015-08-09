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
use Zend\Http\Request;

/**
 * Provides version api access via an http client.
 */
class ClientService extends AbstractService
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Constructor.
     *
     * @param string $endpoint an Api endpoint
     * @param Client $client   an http client
     */
    public function __construct($endpoint, Client $client)
    {
        $this->endpoint = (string) $endpoint;
        $this->client   = $client;
    }

    /**
     * Load the latest version string from the endpoint.
     *
     * @return string A semantic version string e.g. '5.0.34-beta'
     */
    protected function loadLatest()
    {
        $request = new Request();
        $request->setUri($this->endpoint);
        $this->client->setRequest($request);
        $response = $this->client->send();

        return ($response->isSuccess()) ? $response->getBody() : null;
    }
}
