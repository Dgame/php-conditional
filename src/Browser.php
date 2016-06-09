<?php

namespace Dgame\Conditional;

use Dgame\Conditional\Builder\BrowserBuilder;
use Dgame\Conditional\Exception\NotSupportedException;
use Dgame\Conditional\Info\BrowserInfo;

/**
 * Class Browser
 * @package Dgame\Conditional
 */
final class Browser
{
    const FIREFOX  = 'Firefox';
    const MSIE     = 'MSIE';
    const CHROME   = 'Chrome';
    const SAFARI   = 'Safari';
    const OPERA    = 'Opera';
    const NETSCAPE = 'Netscape';

    const ALIASE = [
        'MSIE'     => 'Internet Explorer',
        'Firefox'  => 'Mozilla Firefox',
        'Chrome'   => 'Google Chrome',
        'Safari'   => 'Apple Safari',
        'Opera'    => 'Opera',
        'Netscape' => 'Netscape'
    ];

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
     * @param string $browser
     *
     * @return bool
     */
    public static function Is(string $browser) : bool
    {
        if (self::IsKnownAlias($browser)) {
            return BrowserInfo::Instance()->getCurrentBrowser()->getAlias() === $browser;
        }

        return BrowserInfo::Instance()->getCurrentBrowser()->getName() === $browser;
    }

    /**
     * @param string $name
     *
     * @return string
     * @throws NotSupportedException
     */
    public static function AliasOf(string $name) : string
    {
        $result = array_search($name, self::ALIASE);
        if ($result !== false) {
            return $result;
        }

        throw new NotSupportedException('There is no alias for browser' . $name);
    }

    /**
     * @param string $alias
     *
     * @return string
     * @throws NotSupportedException
     */
    public static function NameOf(string $alias) : string
    {
        if (self::IsKnownAlias($alias)) {
            return self::ALIASE[$alias];
        }

        throw new NotSupportedException('There is no browser for alias ' . $alias);
    }

    /**
     * @param string $alias
     *
     * @return bool
     */
    public static function IsKnownAlias(string $alias) : bool
    {
        return array_key_exists($alias, self::ALIASE);
    }

    /**
     * Browser constructor.
     *
     * @param BrowserBuilder $builder
     */
    public function __construct(BrowserBuilder $builder)
    {
        $this->platform = $builder->getPlatform();
        $this->name     = $builder->getBrowserName();
        $this->alias    = $builder->getBrowserAlias();
        $this->version  = $builder->getBrowserVersion();

        if (empty($this->alias) && !empty($this->name)) {
            $this->alias = self::AliasOf($this->name);
        } else if (!empty($this->alias) && empty($this->name)) {
            $this->name = self::NameOf($this->alias);
        }
    }

    /**
     * @return null|string
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @return bool
     */
    public function hasPlatform() : bool
    {
        return !empty($this->platform);
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @return bool
     */
    public function hasVersion() : bool
    {
        return !empty($this->version);
    }

    /**
     * @return null|string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return bool
     */
    public function matchVersion(string $version) : bool
    {
        $pattern = sprintf('#^%s#', $version);

        return preg_match($pattern, $this->version) === 1;
    }
}