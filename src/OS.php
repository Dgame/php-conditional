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
    private function os(): StringWrapper
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
        return self::os()->beginsWith('win');
    }

    /**
     * @return bool
     */
    public static function isLinux(): bool
    {
        return self::os()->beginsWith('linux');
    }

    /**
     * @return bool
     */
    public static function isUnix(): bool
    {
        return self::os()->beginsWith('unix');
    }

    /**
     * @return bool
     */
    public static function isCygwin(): bool
    {
        return self::os()->beginsWith('cygwin');
    }

    /**
     * @return bool
     */
    public static function isMingw(): bool
    {
        return self::os()->beginsWith('mingw');
    }

    /**
     * @return bool
     */
    public static function isMacOSX(): bool
    {
        return self::os()->beginsWith('darwin');
    }

    /**
     * @return bool
     */
    public static function isSolaris(): bool
    {
        return self::os()->beginsWith('sun');
    }

    /**
     * @return bool
     */
    public static function isBSD(): bool
    {
        return self::os()->beginsWith('openbsd') || self::os()->beginsWith('freebsd') || self::os()->beginsWith('netbsd');
    }
}