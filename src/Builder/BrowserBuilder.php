<?php

namespace Dgame\Conditional\Builder;

use Dgame\Conditional\Browser;

/**
 * Class BrowserBuilder
 * @package Dgame\Conditional\Builder
 */
final class BrowserBuilder
{
    /**
     * @var null|string
     */
    private $platform = null;
    /**
     * @var null|string
     */
    private $name = null;
    /**
     * @var null|string
     */
    private $alias = null;
    /**
     * @var null|string
     */
    private $version = null;

    /**
     * @return Browser
     */
    public function build() : Browser
    {
        return new Browser($this);
    }

    /**
     * @return null|string
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @param string $platform
     *
     * @return BrowserBuilder
     */
    public function setPlatform(string $platform) : BrowserBuilder
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBrowserName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return BrowserBuilder
     */
    public function setBrowserName(string $name) : BrowserBuilder
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBrowserAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     *
     * @return BrowserBuilder
     */
    public function setBrowserAlias(string $alias) : BrowserBuilder
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBrowserVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return BrowserBuilder
     */
    public function setBrowserVersion(string $version) : BrowserBuilder
    {
        $this->version = $version;

        return $this;
    }
}