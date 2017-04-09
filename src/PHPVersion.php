<?php

namespace Dgame\Conditional;

/**
 * Class PHPVersion
 * @package Dgame\Conditional
 */
final class PHPVersion extends Version
{
    /**
     * PHPVersion constructor.
     *
     * @param string $version
     */
    public function __construct(string $version = PHP_VERSION)
    {
        parent::__construct($version);
    }

    /**
     * @return bool
     */
    public function isBelow(): bool
    {
        return version_compare($this->getVersion(), PHP_VERSION, '<');
    }

    /**
     * @return bool
     */
    public function orBelow(): bool
    {
        return version_compare($this->getVersion(), PHP_VERSION, '<=');
    }

    /**
     * @return bool
     */
    public function isAbove(): bool
    {
        return version_compare($this->getVersion(), PHP_VERSION, '>');
    }

    /**
     * @return bool
     */
    public function orAbove(): bool
    {
        return version_compare($this->getVersion(), PHP_VERSION, '>=');
    }

    /**
     * @return bool
     */
    public function is(): bool
    {
        return version_compare($this->getVersion(), PHP_VERSION, '==');
    }

    /**
     * @return bool
     */
    public function isNot(): bool
    {
        return version_compare($this->getVersion(), PHP_VERSION, '!=');
    }
}