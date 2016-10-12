<?php

use PHPUnit\Framework\TestCase;
use function Dgame\Conditional\debug;

class DebugTest extends TestCase
{
    public function setUp()
    {
        debug('a')->enable();
        debug('b')->disable();
        debug('c')->enableIf(42 > 23);
        debug('d')->disableIf(23 < 42);
    }

    public function testState()
    {
        $this->assertTrue(debug('a')->isEnabled());
        $this->assertTrue(debug('b')->isDisabled());
        $this->assertTrue(debug('c')->isEnabled());
        $this->assertTrue(debug('d')->isDisabled());
    }

    public function testLabel()
    {
        $this->assertEquals('a', debug('a')->getLabel());
        $this->assertEquals('b', debug('b')->getLabel());
        $this->assertEquals('c', debug('c')->getLabel());
        $this->assertEquals('d', debug('d')->getLabel());
    }

    public function testOutput()
    {
        ob_start();

        debug('a')->output('Hallo');

        $result = ob_get_clean();

        $this->assertEquals('Hallo' . PHP_EOL, $result);
    }

    public function testThen()
    {
        $flag = false;
        debug('a')->then(function() use (&$flag) {
            $flag = true;
        });

        $this->assertTrue($flag);
    }

    public function testOtherwise()
    {
        $flag = true;
        debug('b')->otherwise(function() use (&$flag) {
            $flag = false;
        });

        $this->assertFalse($flag);
    }
}