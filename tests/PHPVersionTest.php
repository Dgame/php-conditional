<?php

use PHPUnit\Framework\TestCase;
use function Dgame\Conditional\versionPHP;

class PHPVersionTest extends TestCase
{
    public function testBelow()
    {
        $this->assertTrue(versionPHP('5.6')->isBelow());
        $this->assertTrue(versionPHP('7.0')->orBelow());
        $this->assertTrue(versionPHP('5.6')->orBelow());
        $this->assertTrue(versionPHP(PHP_VERSION)->orBelow());
    }

    public function testAbove()
    {
        $this->assertTrue(versionPHP('8.0.0')->isAbove());
        $this->assertTrue(versionPHP(PHP_VERSION)->orAbove());
    }

    public function testExact()
    {
        $this->assertTrue(versionPHP(PHP_VERSION)->is());
    }
}