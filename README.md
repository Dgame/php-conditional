# php-conditional

## enjoy conditional php-programming

enable or disable user defined debug-versions
```php
debug('test')->enable();
debug('test')->disable();
```

and use them. If the specific version is enabled, you'll see the output

```php
version('test')->output('Hallo');
version('test')->output(['foo' => 'bar']);
version('test')->output(['bar' => 'foo']);
```

But you can also use predefined versions for different OS or to determine if you are currently on your localhost or a console
```php
Version::Windows()->output('Predefined: Windows');
Version::Localhost()->output('you are on localhost');
Version::Console()->output('you are on a console');
Version::X86()->output('32 bit');
Version::X86_64()->output('64 bit');
version(OS::Is('Windows', Version::X86))->output('Windows, 32 Bit');
Version::Windows(Version::X86)->output('Predefined: Windows, 32 Bit');
Version::PHP('7.*')->output('You are on PHP 7');
```

you can also use an optional else-part, just in case:
```php
version(OS::Is('Windows'))->output('Windows')->otherwise()->output('Not Windows.');
```

and you can output with booleans

```php
version(true)->output('always debug this');
version(false)->output('never debug this');
```

## Browser detection
 TODO
