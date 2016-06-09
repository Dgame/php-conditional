<?php

namespace Dgame\Conditional\Info;

use Dgame\Conditional\OS;
use Dgame\Conditional\Version;

/**
 * Class OSInfo
 * @package Dgame\Conditional\Info
 */
final class OSInfo
{
    /**
     * @var null|OSInfo
     */
    private static $instance = null;
    /**
     * @var OS|null
     */
    private $os = null;

    /**
     * OSInfo constructor.
     */
    private function __construct()
    {
        list($os_name) = explode(' ', php_uname('s'));

        $this->os = new OS($os_name, PHP_INT_SIZE === 8 ? Version::X86_64 : Version::X86);
    }

    /**
     * @return OSInfo
     */
    public static function Instance() : OSInfo
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return OS
     */
    public function getCurrentOS() : OS
    {
        return $this->os;
    }

    /**
     * @return bool
     */
    public function isOn32Bit() : bool
    {
        return $this->os->isOn32Bit();
    }

    /**
     * @return bool
     */
    public function isOn64Bit() : bool
    {
        return $this->os->isOn64Bit();
    }
}