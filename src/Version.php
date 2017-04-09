<?php

namespace Dgame\Conditional;

use Composer\Semver\Comparator;

/**
 * Class Version
 * @package Dgame\Conditional
 */
class Version
{
    /**
     * @var string
     */
    private $version;

    /**
     * Debug constructor.
     *
     * @param string $version
     */
    public function __construct(string $version)
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return bool
     */
    public function isEqualTo(string $version): bool
    {
        return Comparator::equalTo($this->version, $version);
    }

    /**
     * @param string $version
     *
     * @return bool
     */
    public function isNotEqualTo(string $version): bool
    {
        return Comparator::notEqualTo($this->version, $version);
    }

    /**
     * @param string $version
     *
     * @return bool
     */
    public function isGreaterThan(string $version): bool
    {
        return Comparator::greaterThan($this->version, $version);
    }

    /**
     * @param string $version
     *
     * @return bool
     */
    public function isGreaterOrEqualTo(string $version): bool
    {
        return Comparator::greaterThanOrEqualTo($this->version, $version);
    }

    /**
     * @param string $version
     *
     * @return bool
     */
    public function isLowerThan(string $version): bool
    {
        return Comparator::lessThan($this->version, $version);
    }

    /**
     * @param string $version
     *
     * @return bool
     */
    public function isLowerOrEqualTo(string $version): bool
    {
        return Comparator::lessThanOrEqualTo($this->version, $version);
    }

    /**
     * @return bool
     */
    public function isInProduction(): bool
    {
        foreach (['dev', 'rc', 'beta', 'alpha'] as $pre) {
            if (stripos($this->version, $pre) !== false) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return bool
     */
    public function isInDevelop(): bool
    {
        return stripos($this->version, 'dev') !== false;
    }

    /**
     * @return bool
     */
    public function isRC(): bool
    {
        return stripos($this->version, 'rc') !== false;
    }

    /**
     * @return bool
     */
    public function isBeta(): bool
    {
        return stripos($this->version, 'beta') !== false;
    }

    /**
     * @return bool
     */
    public function isAlpha(): bool
    {
        return stripos($this->version, 'alpha') !== false;
    }
}