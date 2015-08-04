<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Version\Service;

use Zend\Version\Exception\AllowUrlFOpenException;
use Zend\Version\Version;

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

    public function __construct($endpoint, $userAgent = self::DEFAULT_USER_AGENT)
    {
        if (false === ini_get('allow_url_fopen')) {
            throw new AllowUrlFOpenException();
        }
        $this->endpoint  = (string) $endpoint;
        $this->userAgent = (string) $userAgent;
    }

    public function getLatest()
    {
        if (null === $this->latest) {
            $this->latest = $this->getStreamVersion();
        }
        return $this->latest;
    }

    protected function getStreamVersion()
    {
        $context = stream_context_create([
            'http' => ['user_agent' => sprintf('%s/%s', $this->userAgent, Version::VERSION)],
        ]);
        return file_get_contents($this->endpoint, false, $context) ?: null;
    }
}
