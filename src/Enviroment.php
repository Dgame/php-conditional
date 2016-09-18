<?php

namespace Dgame\Conditional;

/**
 * Class Enviroment
 * @package Dgame\Conditional
 */
final class Enviroment
{
    const X86    = 32;
    const X86_64 = 64;

    /**
     * @var Enviroment
     */
    private static $instance;
    /**
     * @var bool
     */
    private $onWindows = false;
    /**
     * @var bool
     */
    private $onCommandLine = false;
    /**
     * @var bool
     */
    private $onLocalhost = false;
    /**
     * @var int
     */
    private $bits = 0;

    /**
     * Enviroment constructor.
     */
    private function __construct()
    {
        $this->onWindows     = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
        $this->onCommandLine = php_sapi_name() === 'cli' || defined('STDIN');
        $this->onLocalhost   = array_key_exists('REMOTE_ADDR', $_SERVER) && in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']);
        $this->bits          = PHP_INT_SIZE === 8 ? self::X86_64 : self::X86;
    }

    /**
     *
     */
    private function __clone()
    {
    }

    /**
     * @return Enviroment
     */
    public static function Instance(): Enviroment
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param int|null $bits
     *
     * @return Debug
     */
    public static function Windows(int $bits = null)
    {
        $condition = self::Instance()->isOnWindows();
        if ($condition && $bits !== null) {
            $condition = self::Instance()->isOnXBit($bits);
        }

        return Debug::Instance(__METHOD__)->enableIf($condition);
    }

    /**
     * @return Debug
     */
    public static function CLI()
    {
        $condition = self::Instance()->isOnCommandLine();

        return Debug::Instance(__METHOD__)->enableIf($condition);
    }

    /**
     * @return Debug
     */
    public static function Local()
    {
        $condition = self::Instance()->isOnLocalhost();

        return Debug::Instance(__METHOD__)->enableIf($condition);
    }

    /**
     * @return boolean
     */
    public function isOnWindows(): bool
    {
        return $this->onWindows;
    }

    /**
     * @return boolean
     */
    public function isOnCommandLine(): bool
    {
        return $this->onCommandLine;
    }

    /**
     * @return boolean
     */
    public function isOnLocalhost(): bool
    {
        return $this->onLocalhost;
    }

    /**
     * @return bool
     */
    public function isOn64Bit(): bool
    {
        return $this->bits === self::X86_64;
    }

    /**
     * @return bool
     */
    public function isOn32Bit(): bool
    {
        return $this->bits === self::X86;
    }

    /**
     * @param int $bits
     *
     * @return bool
     */
    public function isOnXBit(int $bits): bool
    {
        return $this->bits === $bits;
    }

    /**
     * @param string $architecture
     *
     * @return bool
     */
    public function isOn(string $architecture): bool
    {
        switch (strtolower($architecture)) {
            case 'x86':
                return $this->isOn32Bit();
            case 'x86_64':
                return $this->isOn64Bit();
            default:
                return false;
        }
    }
}