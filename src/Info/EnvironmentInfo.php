<?php

namespace Dgame\Conditional\Info;

/**
 * Class Info
 * @package Dgame\Conditional\Info
 */
final class EnvironmentInfo
{
    const CONSOLE = 'console';
    const LOCAL   = 'local';

    /**
     * @var EnvironmentInfo|null
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
        if (php_sapi_name() === 'cli' || defined('STDIN')) {
            $this->info[self::CONSOLE] = true;
            $this->info[self::LOCAL]   = false;
        } else {
            $this->info[self::CONSOLE] = false;
            $this->info[self::LOCAL]   = in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']);
        }
    }

    /**
     * @return EnvironmentInfo
     */
    public static function Instance() : EnvironmentInfo
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
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