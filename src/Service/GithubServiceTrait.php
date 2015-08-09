<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Version\Service;

use Zend\Json\Json;

/**
 * Allows Github's git/refs api to be parsed.
 *
 * @see http://developer.github.com/v3/git/refs/#get-all-references
 */
trait GithubServiceTrait
{
    /**
     * Parse the Github response.
     * 
     * Because GitHub returns the refs in alphabetical order, we need to reduce
     * the array to a single value, comparing the version numbers with
     * version_compare().
     *
     * @param  string $response an API response
     * @return string
     */
    private function parseGithubResponse($response)
    {
        $decodedResponse = Json::decode($response, Json::TYPE_ARRAY);

        // Simplify the API response into a simple array of version numbers
        $tags = array_map(function ($tag) {
            return substr($tag['ref'], 18); // Reliable because we're
                                            // filtering on 'refs/tags/release-'
        }, $decodedResponse);

        // Fetch the latest version number from the array
        return array_reduce($tags, function ($a, $b) {
            return version_compare($a, $b, '>') ? $a : $b;
        });
    }
}
