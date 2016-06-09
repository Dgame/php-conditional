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

        version('test')->debug('Hallo');
        version('test')->debug(['foo' => 'bar']);
        version('test')->debug(['bar' => 'foo']);

        version(OS::Is('Windows'))->debug('Windows')->otherwise()->debug('Not Windows.');
        Dgame\Conditional\Version::Windows()->debug('Predefined: Windows');
        Dgame\Conditional\Version::Localhost()->debug('you are on localhost');
        Dgame\Conditional\Version::Console()->debug('you are on a console');
        Dgame\Conditional\Version::X86()->debug('32 bit');
        Dgame\Conditional\Version::X86_64()->debug('64 bit');
        version(OS::Is('Windows', Dgame\Conditional\Version::X86))->debug('Windows, 32 Bit');
        Dgame\Conditional\Version::Windows(Dgame\Conditional\Version::X86)->debug('Predefined: Windows, 32 Bit');
        Dgame\Conditional\Version::PHP('7.*')->debug('You are on PHP 7');
        version(true)->debug('always debug this');
        version(false)->debug('never debug this');
    }
}