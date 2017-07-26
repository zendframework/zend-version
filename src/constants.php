<?php
/**
 * Zend Framework (http://framework.zend.com/).
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Version;

/**
 * The current Zend Framework version.
 *
 * @var string
 */
const CURRENT = '3.0.0-dev';

/**
 * A semantic version matching regex pattern.
 *
 * @var  string
 * @link http://semver.org
 */
const REGEX = '/(?:(\d+)\.?)(?:(\d+)\.?)?(\d+)?(?:\-?([a-z0-9\.\-]+))?/i';
