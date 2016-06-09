<?php

use Dgame\Conditional\Browser;
use Dgame\Conditional\OS;
use Dgame\Conditional\Version;
use Dgame\Conditional\Version\BrowserVersion;
use function Dgame\Conditional\condition;
use function Dgame\Conditional\debug;

require_once 'vendor/autoload.php';

debug('test')->enable();
debug('test')->disable();
debug('test')->enable();

condition('test')->output('Hallo');
condition('test')->output(['foo' => 'bar']);
condition('test')->output(['bar' => 'foo']);

condition(OS::Is('Windows'))->output('Windows')->otherwise()->output('Not Windows.');
Version::Windows()->output('Predefined: Windows');
Version::Localhost()->output('you are on localhost');
Version::Console()->output('you are on a console');
Version::X86()->output('32 bit');
Version::X86_64()->output('64 bit');
condition(OS::Is('Windows', Version::X86))->output('Windows, 32 Bit');
Version::Windows(Version::X86)->output('Predefined: Windows, 32 Bit');
Version::PHP('7.*')->output('You are on PHP 7');
condition(true)->output('always debug this');
condition(false)->output('never debug this');

Version::Chrome()->output('You are on Chrome');

$bv = new BrowserVersion(Browser::CHROME);
$bv->version('49')->conditional()->output('You are on Chrome 49');