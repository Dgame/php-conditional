<?php

namespace Dgame\Conditional\Info;

use Dgame\Conditional\OS;
use Dgame\Conditional\Version;

/**
 * Class Info
 * @package Dgame\Conditional\Info
 */
final class Info
{
    const OS      = 'os';
    const CONSOLE = 'console';
    const LOCAL   = 'local';

    /**
     * @var Info|null
     */
    private static $instance = null;

    /**
     * @var array
     */
    private $info = [];

    /**
     * Info constructor.
     */
    private function __construct()
    {
        list($os_name) = explode(' ', php_uname('s'));
        
        $this->info[self::OS] = new OS($os_name, PHP_INT_SIZE === 8 ? Version::X86_64 : Version::X86);

        if (array_key_exists('argv', $_SERVER)) {
            $this->info[self::CONSOLE] = true;
            $this->info[self::LOCAL]   = false;
        } else {
            $this->info[self::CONSOLE] = false;
            $this->info[self::LOCAL]   = in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']);
        }
    }

    /**
     * @return Info|null
     */
    public static function Instance()
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
        return $this->info[self::OS];
    }

    /**
     * @return bool
     */
    public function isOn32Bit() : bool
    {
        return $this->getCurrentOS()->isOn32Bit();
    }

    /**
     * @return bool
     */
    public function isOn64Bit() : bool
    {
        return $this->getCurrentOS()->isOn64Bit();
    }

    /**
     * @return bool
     */
    public function isOnLocalhost() : bool
    {
        return $this->info[self::LOCAL];
    }

    /**
     * @return bool
     */
    public function isOnConsole() : bool
    {
        return $this->info[self::CONSOLE];
    }
}