<?php

namespace Dgame\Conditional;

use Dgame\Conditional\Exception\NotSupportedException;
use Dgame\Conditional\Info\EnvironmentInfo;
use Dgame\Conditional\Info\OSInfo;
use Dgame\Conditional\Version\BooleanVersion;
use Dgame\Conditional\Version\BrowserVersion;
use Dgame\Conditional\Version\OSVersion;
use Dgame\Conditional\Version\PHPVersion;
use Dgame\Conditional\Version\UserVersion;

/**
 * Class Version
 * @package Dgame\Conditional
 */
abstract class Version
{
    const X86    = 32;
    const X86_64 = 64;

    /**
     * @param OS $os
     *
     * @return Conditional
     */
    public static function OS(OS $os) : Conditional
    {
        $version = OSVersion::Instance($os);

        return $version->conditional();
    }

    /**
     * @param int|null $bit
     *
     * @return Conditional
     */
    public static function Windows(int $bit = null) : Conditional
    {
        $bit = $bit === null ? OSInfo::Instance()->getCurrentOS()->getBitAsInt() : $bit;
        $os  = OS::Instance(OS::WINDOWS, $bit);

        return self::OS($os);
    }

    /**
     * @param int|null $bit
     *
     * @return Conditional
     */
    public static function Linux(int $bit = null) : Conditional
    {
        $bit = $bit === null ? OSInfo::Instance()->getCurrentOS()->getBitAsInt() : $bit;
        $os  = OS::Instance(OS::LINUX, $bit);

        return self::OS($os);
    }

    /**
     * @param int|null $bit
     *
     * @return Conditional
     */
    public static function OSX(int $bit = null) : Conditional
    {
        $bit = $bit === null ? OSInfo::Instance()->getCurrentOS()->getBitAsInt() : $bit;
        $os  = OS::Instance(OS::OSX, $bit);

        return self::OS($os);
    }

    /**
     * @return Conditional
     */
    public static function X86() : Conditional
    {
        $name = OSInfo::Instance()->getCurrentOS()->getName();
        $os   = OS::Instance($name, self::X86);

        return self::OS($os);
    }

    /**
     * @return Conditional
     */
    public static function X86_64() : Conditional
    {
        $name = OSInfo::Instance()->getCurrentOS()->getName();
        $os   = OS::Instance($name, self::X86_64);

        return self::OS($os);
    }

    /**
     * @param string $version
     *
     * @return Conditional
     */
    public static function PHP(string $version) : Conditional
    {
        $version = PHPVersion::Instance($version);

        return $version->conditional();
    }

    /**
     * @param bool $condition
     *
     * @return Conditional
     */
    public static function Is(bool $condition) : Conditional
    {
        $version = new BooleanVersion($condition);

        return $version->conditional();
    }

    /**
     * @return Conditional
     */
    public static function Localhost() : Conditional
    {
        return self::Is(EnvironmentInfo::Instance()->isOnLocalhost());
    }

    /**
     * @return Conditional
     */
    public static function Console() : Conditional
    {
        return self::Is(EnvironmentInfo::Instance()->isOnConsole());
    }

    /**
     * @param string $browser
     *
     * @return Conditional
     */
    public static function Browser(string $browser) : Conditional
    {
        $version = new BrowserVersion($browser);

        return $version->conditional();
    }

    /**
     * @return Conditional
     */
    public static function Firefox() : Conditional
    {
        return self::Browser(Browser::FIREFOX);
    }

    /**
     * @return Conditional
     */
    public static function MSIE() : Conditional
    {
        return self::Browser(Browser::MSIE);
    }

    /**
     * @return Conditional
     */
    public static function Chrome() : Conditional
    {
        return self::Browser(Browser::CHROME);
    }

    /**
     * @return Conditional
     */
    public static function Safari() : Conditional
    {
        return self::Browser(Browser::SAFARI);
    }

    /**
     * @return Conditional
     */
    public static function Opera() : Conditional
    {
        return self::Browser(Browser::OPERA);
    }

    /**
     * @return Conditional
     */
    public static function Netscape() : Conditional
    {
        return self::Browser(Browser::NETSCAPE);
    }

    /**
     * @return Conditional
     */
    final public function conditional() : Conditional
    {
        return new Conditional($this);
    }

    /**
     * @return bool
     */
    abstract public function isValid() : bool;
}

/**
 * @param $value
 *
 * @return Conditional
 * @throws NotSupportedException
 */
function condition($value) : Conditional
{
    if (is_bool($value)) {
        return Version::Is($value);
    }

    if ($value instanceof OS) {
        return Version::OS($value);
    }

    if (is_string($value)) {
        return new Conditional(UserVersion::Instance($value));
    }

    throw new NotSupportedException('No match for value ' . $value);
}

/**
 * @param string $label
 *
 * @return UserVersion
 */
function debug(string $label) : UserVersion
{
    return UserVersion::Instance($label);
}