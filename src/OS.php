<?php

namespace Dgame\Conditional;

use Dgame\Conditional\Exception\UnknownOSException;
use Dgame\Conditional\Info\Info;

/**
 * Class OS
 * @package Dgame\Conditional
 */
final class OS
{
    const WINDOWS = 'Windows';
    const LINUX   = 'Linux';

    /**
     * @var OS[]
     */
    private static $instances = [];
    /**
     * @var null|string
     */
    private $name = null;
    /**
     * @var int|null
     */
    private $bit = null;
    /**
     * @var null
     */
    private $isValid = null;

    /**
     * @param string   $name
     * @param int|null $bit
     *
     * @return bool
     */
    public static function Is(string $name, int $bit = null) : bool
    {
        $os = Info::Instance()->getCurrentOS();

        if ($bit === null) {
            return $name === $os->getName();
        }

        return $bit === $os->getBitAsInt() && $name === $os->getName();
    }

    /**
     * @param string $name
     * @param int    $bit
     *
     * @return OS
     */
    public static function Instance(string $name, int $bit) : OS
    {
        $id = $bit === null ? $name : sprintf('%s(%d)', $name, $bit);
        if (!array_key_exists($id, self::$instances)) {
            self::$instances[$id] = new self($name, $bit);
        }

        return self::$instances[$id];
    }

    /**
     * OS constructor.
     *
     * @param string $name
     * @param int    $bit
     */
    public function __construct(string $name, int $bit)
    {
        if ($bit > 0 && $bit !== 32 && $bit !== 64) {
            throw new UnknownOSException($name, $bit);
        }

        $this->name = $name;
        $this->bit  = $bit;
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getBitAsInt() : int
    {
        return $this->bit;
    }

    /**
     * @return bool
     */
    public function isOn32Bit() : bool
    {
        return $this->bit === Version::X86;
    }

    /**
     * @return bool
     */
    public function isOn64Bit() : bool
    {
        return $this->bit === Version::X86_64;
    }

    /**
     * @return boolean
     */
    public function isValid() : bool
    {
        if ($this->isValid === null) {
            $this->isValid = self::Is($this->name, $this->bit);
        }

        return $this->isValid;
    }

    /**
     * @return null|string
     */
    public function asString()
    {
        if ($this->bit === null) {
            return $this->name;
        }

        return sprintf('%s(%d)', $this->name, $this->bit);
    }
}