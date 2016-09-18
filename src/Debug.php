<?php

namespace Dgame\Conditional;

/**
 * Class Debug
 * @package Dgame\Conditional
 */
final class Debug
{
    /**
     * @var Debug[]
     */
    private static $instances = [];
    /**
     * @var string
     */
    private $label;
    /**
     * @var bool
     */
    private $enabled = false;

    /**
     * Debug constructor.
     *
     * @param string $label
     */
    private function __construct(string $label)
    {
        $this->label = $label;
    }

    /**
     *
     */
    private function __clone()
    {
    }

    /**
     * @param string $label
     *
     * @return Debug
     */
    public static function Instance(string $label): Debug
    {
        if (!array_key_exists($label, self::$instances)) {
            self::$instances[$label] = new self($label);
        }

        return self::$instances[$label];
    }

    /**
     * @return Debug
     */
    public function enable(): Debug
    {
        $this->enabled = true;

        return $this;
    }

    /**
     * @return Debug
     */
    public function disable(): Debug
    {
        $this->enabled = false;

        return $this;
    }

    /**
     * @param bool $condition
     *
     * @return Debug
     */
    public function enableIf(bool $condition): Debug
    {
        $this->enabled = $condition;

        return $this;
    }

    /**
     * @param bool $condition
     *
     * @return Debug
     */
    public function disableIf(bool $condition): Debug
    {
        $this->enabled = !$condition;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return !$this->enabled;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $value
     *
     * @return Debug
     */
    public function output(string $value): Debug
    {
        if ($this->isEnabled()) {
            if (!Enviroment::Instance()->isOnCommandLine()) {
                print '<pre>';
            }

            print $value . PHP_EOL;

            if (!Enviroment::Instance()->isOnCommandLine()) {
                print '</pre>';
            }
        }

        return $this;
    }

    /**
     * @param callable $callback
     *
     * @return Debug
     */
    public function then(callable $callback): Debug
    {
        if ($this->isEnabled()) {
            $callback($this->label);
        }

        return $this;
    }

    /**
     * @param callable $callback
     *
     * @return Debug
     */
    public function otherwise(callable $callback): Debug
    {
        if ($this->isDisabled()) {
            $callback($this->label);
        }

        return $this;
    }
}