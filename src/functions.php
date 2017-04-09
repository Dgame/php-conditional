<?php

namespace Dgame\Conditional;

/**
 * @param string $label
 *
 * @return Debug
 */
function debug(string $label): Debug
{
    return Debug::Instance($label);
}

/**
 * @param string $version
 *
 * @return Version
 */
function version(string $version): Version
{
    return new Version($version);
}

/**
 * @param string $version
 *
 * @return PHPVersion
 */
function versionPHP(string $version = PHP_VERSION): PHPVersion
{
    return new PHPVersion($version);
}

/**
 * @param string $value
 * @param array  ...$args
 */
function println(string $value, ...$args)
{
    if (!empty($args)) {
        $value = sprintf($value, ...$args);
    }

    if (PHP_SAPI !== 'cli') {
        $value = sprintf('<pre>%s</pre>', $value);
    }

    print $value;

    if (PHP_SAPI === 'cli') {
        print PHP_EOL;
    }
}