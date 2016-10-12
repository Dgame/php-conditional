<?php

use function Dgame\Conditional\version;
use PHPUnit\Framework\TestCase;

class VersionTest extends TestCase
{
    public function testBelow()
    {
        $this->assertTrue(version('7.0')->isBelow());
        $this->assertTrue(version('5.6')->isBelow());
        $this->assertTrue(version('7.0')->orBelow());
        $this->assertTrue(version('5.6')->orBelow());
        $this->assertTrue(version(PHP_VERSION)->orBelow());
    }

    public function testAbove()
    {
        list($mayor, $minor, $patch) = explode('.', PHP_VERSION);

        $this->assertTrue(version('7.0' . ($patch + 1))->isAbove());
        $this->assertTrue(version('7.' . ($minor + 1))->isAbove());
        $this->assertTrue(version(PHP_VERSION)->orAbove());
    }

    public function testExact()
    {
        $this->assertTrue(version(PHP_VERSION)->isExact());
    }
}