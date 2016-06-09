<?php

use Dgame\Conditional\OS;
use Dgame\Conditional\Version;
use function Dgame\Conditional\condition;
use function Dgame\Conditional\debug;

require_once '../vendor/autoload.php';

final class TestConditional extends PHPUnit_Framework_TestCase
{
    public function testEnableUserVersion()
    {
        ob_start();

        debug('test')->enable();
        condition('test')->output('Hello World');

        $output = ob_get_contents();
        ob_end_clean();

        $this->assertEquals(trim($output), 'string(11) "Hello World"');
    }

    public function testDisableUserVersion()
    {
        $this->expectOutputString(null);

        debug('test')->disable();
        condition('test')->output('Hello World');
    }

    public function testArrayOutput()
    {
        $this->expectOutputRegex('#Array\s\(\s*\[foo\] => bar\s\)#');

        debug('test')->enable();
        condition('test')->output(['foo' => 'bar']);
    }

    public function testOS()
    {
        $this->expectOutputRegex('#Predefined: Windows#');
        Version::Windows()->output('Predefined: Windows');

        $this->expectOutputRegex('#you are on localhost#');
        Version::Localhost()->output('you are on localhost');

        $this->expectOutputRegex('#you are on a console#');
        Version::Console()->output('you are on a console');
    }

    public function testValidOSArchitecture()
    {
        $this->expectOutputRegex('#32 bit#');
        Version::X86()->output('32 bit');

        $this->expectOutputRegex('#Windows, 32 Bit#');
        condition(OS::Is('Windows', Version::X86))->output('Windows, 32 Bit');
        Version::Windows(Version::X86)->output('Predefined: Windows, 32 Bit');
    }

    public function testInvalidOsArchitecture()
    {
        $this->expectOutputString(null);
        Version::X86_64()->output('64 bit');
    }

    public function testOtherwise()
    {
        $this->expectOutputRegex('#Windows#');
        condition(OS::Is('Windows'))->output('Windows')->otherwise()->output('Not Windows.');
    }

    public function testPHPVersion()
    {
        $this->expectOutputRegex('#You are on PHP 7#');
        Version::PHP('7.*')->output('You are on PHP 7');
    }

    public function testValidBooleanCondition()
    {
        $this->expectOutputRegex('#always debug this#');
        condition(true)->output('always debug this');
    }

    public function testInvalidBooleanCondition()
    {
        $this->expectOutputString(null);
        condition(false)->output('never debug this');
    }
}