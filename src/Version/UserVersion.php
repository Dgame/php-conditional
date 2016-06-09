<?php

namespace Dgame\Conditional\Version;

use Dgame\Conditional\Version;

/**
 * Class UserVersion
 * @package Dgame\Conditional\Version
 */
final class UserVersion extends Version
{
    /**
     * @var UserVersion[]
     */
    private static $instances = [];

    /**
     * @var null|string
     */
    private $label = null;
    /**
     * @var bool
     */
    private $isEnabled = true;

    /**
     * UserVersion constructor.
     *
     * @param string $label
     */
    private function __construct(string $label)
    {
        $this->label = $label;
    }

    /**
     * @param string $label
     *
     * @return UserVersion
     */
    public static function Instance(string $label) : UserVersion
    {
        if (!array_key_exists($label, self::$instances)) {
            self::$instances[$label] = new self($label);
        }

        return self::$instances[$label];
    }

    /**
     * @return string
     */
    public function getLabel() : string
    {
        return $this->label;
    }

    /**
     * @return UserVersion
     */
    public function enable() : UserVersion
    {
        $this->isEnabled = true;

        return $this;
    }

    /**
     * @return UserVersion
     */
    public function disable() : UserVersion
    {
        $this->isEnabled = false;

        return $this;
    }

    /**
     * @return bool
     */
    public function isValid() : bool
    {
        return $this->isEnabled;
    }
}