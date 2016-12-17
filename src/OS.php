<?php

namespace Dgame\Conditional;

use Dgame\Wrapper\StringWrapper;

/**
 * Class OS
 * @package Dgame\Conditional
 *
 * @see     https://github.com/tivie/php-os-detector
 */
final class OS
{
    /**
     * @return bool
     */
    public static function isWindowsLike(): bool
    {
        return self::isWindows() || self::isCygwin() || self::isMingw();
    }

    /**
     * @return bool
     */
    public static function isUnixLike(): bool
    {
        return !self::isWindowsLike();
    }

    /**
     * @return StringWrapper
     */
    private function osName(): StringWrapper
    {
        static $object = null;
        if ($object === null) {
            $object = new StringWrapper(php_uname());
            $object->toLowerCase();
        }

        return $object;
    }

    /**
     * @return bool
     */
    public static function isWindows(): bool
    {
        return self::osName()->beginsWith('win');
    }

    /**
     * @return bool
     */
    public static function isLinux(): bool
    {
        return self::osName()->beginsWith('linux');
    }

    /**
     * @return bool
     */
    public static function isUnix(): bool
    {
        return self::osName()->beginsWith('unix');
    }

    /**
     * @return bool
     */
    public static function isCygwin(): bool
    {
        return self::osName()->beginsWith('cygwin');
    }

    /**
     * @return bool
     */
    public static function isMingw(): bool
    {
        return self::osName()->beginsWith('mingw');
    }

    /**
     * @return bool
     */
    public static function isMacOSX(): bool
    {
        return self::osName()->beginsWith('darwin');
    }

    /**
     * @return bool
     */
    public static function isSolaris(): bool
    {
        return self::osName()->beginsWith('sun');
    }

    /**
     * @return bool
     */
    public static function isBSD(): bool
    {
        return self::osName()->beginsWith('openbsd') || self::osName()->beginsWith('freebsd') || self::osName()->beginsWith('netbsd');
    }
}