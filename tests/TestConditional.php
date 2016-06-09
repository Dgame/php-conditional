<?php

require_once '../vendor/autoload.php';

use function Dgame\Conditional\debug;
use Dgame\Conditional\OS;
use function Dgame\Conditional\version;

final class TestConditional extends PHPUnit_Framework_TestCase
{
    public function testUsage()
    {
        debug('test')->enable();
        debug('test')->disable();
        debug('test')->enable();

        version('test')->output('Hallo');
        version('test')->output(['foo' => 'bar']);
        version('test')->output(['bar' => 'foo']);

        version(OS::Is('Windows'))->output('Windows')->otherwise()->output('Not Windows.');
        Dgame\Conditional\Version::Windows()->output('Predefined: Windows');
        Dgame\Conditional\Version::Localhost()->output('you are on localhost');
        Dgame\Conditional\Version::Console()->output('you are on a console');
        Dgame\Conditional\Version::X86()->output('32 bit');
        Dgame\Conditional\Version::X86_64()->output('64 bit');
        version(OS::Is('Windows', Dgame\Conditional\Version::X86))->output('Windows, 32 Bit');
        Dgame\Conditional\Version::Windows(Dgame\Conditional\Version::X86)->output('Predefined: Windows, 32 Bit');
        Dgame\Conditional\Version::PHP('7.*')->output('You are on PHP 7');
        version(true)->output('always debug this');
        version(false)->output('never debug this');
    }
}