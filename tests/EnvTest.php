<?php

use Dgame\Conditional\Enviroment;
use PHPUnit\Framework\TestCase;

class EnvTest extends TestCase
{
    public function testOS()
    {
        $this->assertTrue(Enviroment::Windows(32)->isEnabled());
    }

    public function testCLI()
    {
        $this->assertTrue(Enviroment::CLI()->isEnabled());
    }

    public function testBit()
    {
        $env = Enviroment::Instance();

        $this->assertTrue($env->isOn32Bit());
        $this->assertFalse($env->isOn64Bit());
        $this->assertTrue($env->isOnXBit(32));
    }

    public function testEnvCLI()
    {
        $env = Enviroment::Instance();

        $this->assertTrue($env->isOnCommandLine());
    }

    public function testEnvOS()
    {
        $env = Enviroment::Instance();

        $this->assertTrue($env->isOnWindows());
    }

    public function testArchitecture()
    {
        $env = Enviroment::Instance();

        $this->assertTrue($env->isOn('x86'));
    }
}