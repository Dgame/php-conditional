<?php

namespace Dgame\Conditional;

/**
 * Class OS
 * @package Dgame\Conditional
 *
 * @see     https://github.com/tivie/php-os-detector
 */
final class OS
{
    const OTHER_FAMILY           = 0x00000;
    const UNIX_FAMILY            = 0x00001;
    const WINDOWS_FAMILY         = 0x00002;
    const UNIX_ON_WINDOWS_FAMILY = 0x00004;

    const WINDOWS  = 0x00008;
    const GEN_UNIX = 0x00010;
    const MAC_OSX  = 0x00020;
    const LINUX    = 0x00040;
    const MSYS     = 0x00080;
    const CYGWIN   = 0x00100;
    const SUN_OS   = 0x00200;
    const NONSTOP  = 0x00400;
    const QNX      = 0x00800;
    const BSD      = 0x01000;
    const BE_OS    = 0x02000;
    const HP_UX    = 0x04000;
    const ZOS      = 0x08000;
    const AIX      = 0x10000;

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
        return !self::isWindowsLike() && !self::isNonStop();
    }

    /**
     * @return bool
     */
    public static function isWindows(): bool
    {
        switch (PHP_OS) {
            case 'WINDOWS':
            case 'WINNT':
            case 'WIN32':
            case 'INTERIX':
            case 'UWIN':
            case 'UWIN-W7':
                return true;
            default:
                return false;
        }
    }

    /**
     * @return bool
     */
    public static function isCygwin(): bool
    {
        switch (PHP_OS) {
            case 'CYGWIN':
            case 'CYGWIN_NT-5.1':
            case 'CYGWIN_NT-6.1':
            case 'CYGWIN_NT-6.1-WOW64':
                return true;
            default:
                return false;
        }
    }

    /**
     * @return bool
     */
    public static function isMingw(): bool
    {
        switch (PHP_OS) {
            case 'MINGW':
            case 'MINGW32_NT-6.1':
            case 'MSYS_NT-6.1':
                return true;
            default:
                return false;
        }
    }

    /**
     * @return bool
     */
    public static function isMacOSX(): bool
    {
        switch (PHP_OS) {
            case 'DARWIN':
                return true;
            default:
                return false;
        }
    }

    /**
     * @return bool
     */
    public static function isLinux(): bool
    {
        switch (PHP_OS) {
            case 'LINUX':
            case 'GNU':
            case 'GNU/LINUX':
                return true;
            default:
                return false;
        }
    }

    /**
     * @return bool
     */
    public static function isAix(): bool
    {
        switch (PHP_OS) {
            case 'AIX':
                return true;
            default:
                return false;
        }
    }

    /**
     * @return bool
     */
    public static function isZOS(): bool
    {
        switch (PHP_OS) {
            case 'OS390':
            case 'OS/390':
            case 'OS400':
            case 'OS/400':
            case 'ZOS':
            case 'Z/OS':
                return true;
            default:
                return false;
        }
    }

    /**
     * @return bool
     */
    public static function isHPUX(): bool
    {
        switch (PHP_OS) {
            case 'HP-UX':
                return true;
            default:
                return false;
        }
    }

    /**
     * @return bool
     */
    public static function isSolaris(): bool
    {
        switch (PHP_OS) {
            case 'SOLARIS':
            case 'SUNOS':
                return true;
            default:
                return false;
        }
    }

    /**
     * @return bool
     */
    public static function isBSD(): bool
    {
        switch (PHP_OS) {
            case 'DRAGONFLY':
            case 'OPENBSD':
            case 'FREEBSD':
            case 'NETBSD':
            case 'GNU/KFREEBSD':
            case 'GNU/FREEBSD':
            case 'DEBIAN/FREEBSD':
                return true;
            default:
                return false;
        }
    }

    /**
     * @return bool
     */
    public static function isGenUnix(): bool
    {
        switch (PHP_OS) {
            case 'MINIX':
            case 'IRIX':
            case 'IRIX64':
            case 'OSF1':
            case 'SCO_SV':
            case 'ULTRIX':
            case 'RELIANTUNIX-Y':
            case 'SINIX-Y':
            case 'UNIXWARE':
            case 'SN5176':
            case 'K-OS':
            case 'KOS':
                return true;
            default:
                return false;
        }
    }

    /**
     * @return bool
     */
    public static function isQNX(): bool
    {
        switch (PHP_OS) {
            case 'QNX':
                return true;
            default:
                return false;
        }
    }

    /**
     * @return bool
     */
    public static function isBeOS(): bool
    {
        switch (PHP_OS) {
            case 'BEOS':
            case 'BE_OS':
            case 'HAIKU':
                return true;
            default:
                return false;
        }
    }

    /**
     * @return bool
     */
    public static function isNonStop(): bool
    {
        switch (PHP_OS) {
            case 'NONSTOP KERNEL':
            case 'NONSTOP':
                return true;
            default:
                return false;
        }
    }
}