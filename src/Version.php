<?php

namespace Dgame\Conditional;

/**
 * Class Version
 * @package Dgame\Conditional
 */
final class Version
{
    /**
     * @var string
     */
    private $version;
    /**
     * @var bool
     */
    private $verified = false;

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
     * @return bool
     */
    public function isBelow(): bool
    {
        $this->verified = version_compare($this->version, PHP_VERSION, '<');

        return $this->verified;
    }

    /**
     * @return bool
     */
    public function orBelow(): bool
    {
        $this->verified = version_compare($this->version, PHP_VERSION, '<=');

        return $this->verified;
    }

    /**
     * @return bool
     */
    public function isAbove(): bool
    {
        $this->verified = version_compare($this->version, PHP_VERSION, '>');

        return $this->verified;
    }

    /**
     * @return bool
     */
    public function orAbove(): bool
    {
        $this->verified = version_compare($this->version, PHP_VERSION, '>=');

        return $this->verified;
    }

    /**
     * @return bool
     */
    public function isExact(): bool
    {
        $this->verified = version_compare($this->version, PHP_VERSION, '==');

        return $this->verified;
    }

    /**
     * @param string $version
     *
     * @return Version
     */
    public function isEqualTo(string $version): Version
    {
        $this->verified = version_compare($this->version, $version, '==');

        return $this;
    }

    /**
     * @param string $version
     *
     * @return Version
     */
    public function isNotEqualTo(string $version): Version
    {
        $this->verified = version_compare($this->version, $version, '!=');

        return $this;
    }

    /**
     * @param string $version
     *
     * @return Version
     */
    public function isGreaterThan(string $version): Version
    {
        $this->verified = version_compare($this->version, $version, '>');

        return $this;
    }

    /**
     * @param string $version
     *
     * @return Version
     */
    public function isGreaterOrEqualTo(string $version): Version
    {
        $this->verified = version_compare($this->version, $version, '>=');

        return $this;
    }

    /**
     * @param string $version
     *
     * @return Version
     */
    public function isLowerThan(string $version): Version
    {
        $this->verified = version_compare($this->version, $version, '<');

        return $this;
    }

    /**
     * @param string $version
     *
     * @return Version
     */
    public function isLowerOrEqualTo(string $version): Version
    {
        $this->verified = version_compare($this->version, $version, '<=');

        return $this;
    }

    /**
     * @return boolean
     */
    public function isVerified(): bool
    {
        return $this->verified;
    }

    /**
     * @return Version
     */
    public function isProduction(): Version
    {
        foreach (['dev', 'rc', 'beta', 'alpha'] as $pre) {
            if (stripos($this->version, $pre) !== false) {
                $this->verified = false;

                return $this;
            }
        }

        $this->verified = true;

        return $this;
    }

    /**
     * @return Version
     */
    public function isDevelop(): Version
    {
        $this->verified = stripos($this->version, 'dev') !== false;

        return $this;
    }

    /**
     * @return Version
     */
    public function isRC(): Version
    {
        $this->verified = stripos($this->version, 'rc') !== false;

        return $this;
    }

    /**
     * @return Version
     */
    public function isBeta(): Version
    {
        $this->verified = stripos($this->version, 'beta') !== false;

        return $this;
    }

    /**
     * @return Version
     */
    public function isAlpha(): Version
    {
        $this->verified = stripos($this->version, 'alpha') !== false;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return Version
     */
    public function output(string $value): Version
    {
        if ($this->isVerified()) {
            if (!Enviroment::Instance()->isOnCommandLine()) {
                print '<pre>';
            }

            print $value . PHP_EOL;

            if (!Enviroment::Instance()->isOnCommandLine()) {
                print '</pre>';
            }
        }

        return $this;
    }

    /**
     * @param callable $callback
     * @param array    ...$args
     *
     * @return Version
     */
    public function then(callable $callback, ...$args): Version
    {
        if ($this->isVerified()) {
            $callback($this->version, ...$args);
        }

        return $this;
    }

    /**
     * @param callable $callback
     * @param array    ...$args
     *
     * @return Version
     */
    public function otherwise(callable $callback, ...$args): Version
    {
        if (!$this->isVerified()) {
            $callback($this->version, ...$args);
        }

        return $this;
    }
}