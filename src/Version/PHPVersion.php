<?php

namespace Dgame\Conditional\Version;

use Dgame\Conditional\Version;

/**
 * Class PHPVersion
 * @package Dgame\Conditional\Version
 */
final class PHPVersion extends Version
{
    /**
     * @var PHPVersion[]
     */
    private static $instances = [];
    /**
     * @var null|string
     */
    private $version = null;

    /**
     * PHPVersion constructor.
     *
     * @param string $version
     */
    private function __construct(string $version)
    {
        $this->version = $version;
    }

    /**
     * @param string $version
     *
     * @return PHPVersion
     */
    public static function Instance(string $version) : PHPVersion
    {
        if (!array_key_exists($version, self::$instances)) {
            self::$instances[$version] = new self($version);
        }

        return self::$instances[$version];
    }

    /**
     * @return bool
     */
    public function isValid() : bool
    {
       return version_compare(PHP_VERSION, $this->version, '>=');
    }
}