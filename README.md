# php-conditional

## enjoy conditional php-programming

```php
<?php

use function Dgame\Conditional\debug;
use function Dgame\Conditional\version;

require_once 'vendor/autoload.php';

debug('foo')->enable();
debug('foo')->output('Hello, foo');
debug('foo')->then(function(string $label) {
    print 'Debug of ' . $label . ' is enabled' . PHP_EOL;
});

version('7.0.8')->isEqualTo(PHP_VERSION)->output('Hello PHP 7');
version('7')->isLowerOrEqualTo(PHP_VERSION)->then(function(string $version) {
    print 'Version ' . $version . ' is verified' . PHP_EOL;
});

version('7.0.9')->isEqualTo(PHP_VERSION)->output('Production')->otherwise(function(string $version) {
    print $version . ' does not match ' . PHP_VERSION . PHP_EOL;
});

//debug('foo')->output('This is 100% the end')->abort();
//debug('foo')->output('This may be the end')->abortIf(!isset($result));

version('7.1.0alpha2')->isProduction()->output('Production');

class FooBar
{
    public function test(string $label, string $note)
    {
        print __METHOD__ . ' [' . $label . '] : ' . $note . PHP_EOL;
    }
}

$fb = new FooBar();

debug('bar')->enable();
debug('bar')->then([$fb, 'test'], 'yay');
```
