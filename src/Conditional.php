<?php

namespace Dgame\Conditional;

use Dgame\Conditional\Info\EnvironmentInfo;
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
     * @return Conditional
     */
    public function output($value) : Conditional
    {
        if (!$this->version->isValid()) {
            return $this;
        }

        if (EnvironmentInfo::Instance()->isOnConsole()) {
            print PHP_EOL;
        } else {
            print '<pre>';
        }

        if (is_array($value) || is_object($value)) {
            print_r($value);
        } else {
            var_dump($value);
        }

        if (EnvironmentInfo::Instance()->isOnConsole()) {
            print PHP_EOL;
        } else {
            print '</pre>';
        }

        return $this;
    }

    /**
     * @param callable $callback
     *
     * @return Conditional
     */
    public function do(callable $callback) : Conditional
    {
        if ($this->version->isValid()) {
            $callback();
        }

        return $this;
    }

    /**
     * @return Conditional
     */
    public function abort() : Conditional
    {
        if ($this->version->isValid()) {
            exit;
        }

        return $this;
    }

    /**
     * @param \Exception $e
     *
     * @return Conditional
     * @throws \Exception
     */
    public function throw(\Exception $e) : Conditional
    {
        if ($this->version->isValid()) {
            throw $e;
        }

        return $this;
    }
}