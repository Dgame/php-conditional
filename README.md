# php-conditional

## enjoy conditional php-programming

enable or disable user defined debug-versions
```php
debug('test')->enable();
debug('test')->disable();
```

and use them. If the specific debug-version is enabled, you'll see the output

```php
condition('test')->output('Hallo');
condition('test')->output(['foo' => 'bar']);
condition('test')->output(['bar' => 'foo']);
```

But you can also use predefined versions for different OS or to determine if you are currently on your localhost or a console
```php
Version::Windows()->output('Predefined: Windows');
Version::Localhost()->output('you are on localhost');
Version::Console()->output('you are on a console');
Version::X86()->output('32 bit');
Version::X86_64()->output('64 bit');
condition(OS::Is('Windows', Version::X86))->output('Windows, 32 Bit');
Version::Windows(Version::X86)->output('Predefined: Windows, 32 Bit');
Version::PHP('7.*')->output('You are on PHP 7');
```

you can also use an optional else-part, just in case:
```php
condition(OS::Is('Windows'))->output('Windows')->otherwise()->output('Not Windows.');
```

and you use `condition` with boolean-conditions

```php
condition(true)->output('always debug this');
condition(false)->output('never debug this');
```

## Browser detection

Detect your current Browser (if any)
```php
Version::Chrome()->output('You are on Chrome');
```

or a bit more specific -  with the browser version
```php
$bv = new BrowserVersion(Browser::CHROME);
$bv->version('49')->conditional()->output('You are on Chrome 49');
```
