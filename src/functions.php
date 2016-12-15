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
 * @param       $value
 * @param array ...$args
 */
function println($value, ...$args)
{
    if (PHP_SAPI !== 'cli') {
        print '<pre>';
    }

    if (is_array($value) || is_object($value)) {
        print_r($value);
    } else {
        if (!empty($args)) {
            $value = sprintf($value, ...$args);
        }

        print $value;
    }

    if (PHP_SAPI !== 'cli') {
        print '</pre>';
    } else {
        print PHP_EOL;
    }
}