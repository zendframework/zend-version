<?php
/**
 * @see       https://github.com/zendframework/zend-version for the canonical source repository
 * @copyright Copyright (c) 2018 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-version/blob/master/LICENSE.md New BSD License
 */

if (! class_exists(\PHPUnit\Framework\Error\Warning::class)) {
    class_alias(
        \PHPUnit_Framework_Error_Warning::class,
        \PHPUnit\Framework\Error\Warning::class
    );
}
