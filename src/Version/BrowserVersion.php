<?php

namespace Dgame\Conditional\Version;

use Dgame\Conditional\Browser;
use Dgame\Conditional\Builder\BrowserBuilder;
use Dgame\Conditional\Info\BrowserInfo;
use Dgame\Conditional\Version;

/**
 * Class BrowserVersion
 * @package Dgame\Conditional\Version
 */
final class BrowserVersion extends Version
{
    private $builder = null;

    /**
     * BrowserVersion constructor.
     *
     * @param string $browser
     */
    public function __construct(string $browser)
    {
        $this->builder = new BrowserBuilder();

        if (Browser::IsKnownAlias($browser)) {
            $this->builder->setBrowserAlias($browser);
        } else {
            $this->builder->setBrowserName($browser);
        }
    }

    /**
     * @param string $version
     *
     * @return BrowserVersion
     */
    public function version(string $version) : BrowserVersion
    {
        $this->builder->setBrowserVersion($version);

        return $this;
    }

    /**
     * @param string $platform
     *
     * @return BrowserVersion
     */
    public function platform(string $platform) : BrowserVersion
    {
        $this->builder->setPlatform($platform);

        return $this;
    }

    /**
     * @return bool
     */
    public function isValid() : bool
    {
        $browser = $this->builder->build();
        $current = BrowserInfo::Instance()->getCurrentBrowser();

        if ($browser->getName() !== $current->getName()) {
            return false;
        }

        if ($browser->hasVersion() && $current->matchVersion($browser->getVersion())) {
            return false;
        }

        if ($browser->hasPlatform() && $browser->getPlatform() !== $current->getPlatform()) {
            return false;
        }

        return true;
    }
}