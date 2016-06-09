<?php

namespace Dgame\Conditional;

use Dgame\Conditional\Info\Info;
use Dgame\Conditional\Version\BooleanVersion;

/**
 * Class Conditional
 * @package Dgame\Conditional
 */
final class Conditional
{
    /**
     * @var Version|null
     */
    private $version = null;

    /**
     * Conditional constructor.
     *
     * @param Version $version
     */
    public function __construct(Version $version)
    {
        $this->version = $version;
    }

    /**
     * @return Version
     */
    public function getVersion() : Version
    {
        return $this->version;
    }

    /**
     * @return Conditional
     */
    public function otherwise() : Conditional
    {
        return new Conditional(new BooleanVersion(!$this->version->isValid()));
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function output($value)
    {
        if (!$this->version->isValid()) {
            return $this;
        }

        if (Info::Instance()->isOnConsole()) {
            print PHP_EOL;
        } else {
            print '<pre>';
        }

        if (is_array($value) || is_object($value)) {
            print_r($value);
        } else {
            var_dump($value);
        }

        if (Info::Instance()->isOnConsole()) {
            print PHP_EOL;
        } else {
            print '</pre>';
        }

        return $this;
    }

    /**
     * @param callable $callback
     *
     * @return $this
     */
    public function do(callable $callback)
    {
        if ($this->version->isValid()) {
            $callback();
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function abort()
    {
        if ($this->version->isValid()) {
            exit;
        }

        return $this;
    }

    /**
     * @param \Exception $e
     *
     * @return $this
     * @throws \Exception
     */
    public function throw(\Exception $e)
    {
        if ($this->version->isValid()) {
            throw $e;
        }

        return $this;
    }
}