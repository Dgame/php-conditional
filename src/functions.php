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
    return Version::Instance($version);
}
