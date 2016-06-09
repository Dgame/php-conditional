<?php

namespace Dgame\Conditional;

use Dgame\Conditional\Exception\NotSupportedException;
use Dgame\Conditional\Info\Info;
use Dgame\Conditional\Version\BooleanVersion;
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
        return new Conditional(OSVersion::Instance($os));
    }

    /**
     * @param int|null $bit
     *
     * @return Conditional
     */
    public static function Windows(int $bit = null) : Conditional
    {
        $bit = $bit === null ? Info::Instance()->getCurrentOS()->getBitAsInt() : $bit;
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
        $bit = $bit === null ? Info::Instance()->getCurrentOS()->getBitAsInt() : $bit;
        $os  = OS::Instance(OS::LINUX, $bit);

        return self::OS($os);
    }

    /**
     * @return Conditional
     */
    public static function X86() : Conditional
    {
        $name = Info::Instance()->getCurrentOS()->getName();
        $os   = OS::Instance($name, self::X86);

        return self::OS($os);
    }

    /**
     * @return Conditional
     */
    public static function X86_64() : Conditional
    {
        $name = Info::Instance()->getCurrentOS()->getName();
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
        return new Conditional(PHPVersion::Instance($version));
    }

    /**
     * @param bool $condition
     *
     * @return Conditional
     */
    public static function Is(bool $condition) : Conditional
    {
        return new Conditional(new BooleanVersion($condition));
    }

    /**
     * @return Conditional
     */
    public static function Localhost() : Conditional
    {
        return self::Is(Info::Instance()->isOnLocalhost());
    }

    /**
     * @return Conditional
     */
    public static function Console() : Conditional
    {
        return self::Is(Info::Instance()->isOnConsole());
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
function version($value) : Conditional
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