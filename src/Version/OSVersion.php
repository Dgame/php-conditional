<?php

namespace Dgame\Conditional\Version;

use Dgame\Conditional\OS;
use Dgame\Conditional\Version;

/**
 * Class OSVersion
 * @package Dgame\Conditional\Version
 */
final class OSVersion extends Version
{
    /**
     * @var OSVersion[]
     */
    private static $instances = [];
    /**
     * @var OS|null
     */
    private $os = null;

    /**
     * OSVersion constructor.
     *
     * @param OS $os
     */
    private function __construct(OS $os)
    {
        $this->os = $os;
    }

    /**
     * @param OS $os
     *
     * @return OSVersion
     */
    public static function Instance(OS $os) : OSVersion
    {
        $name = $os->asString();
        if (!array_key_exists($name, self::$instances)) {
            self::$instances[$name] = new self($os);
        }

        return self::$instances[$name];
    }

    /**
     * @return bool
     */
    public function isValid() : bool
    {
        return $this->os->isValid();
    }
}