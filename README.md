toDir
=====
Send globs to another paths.

## Installation
```bash
$ composer require --dev junty/junty-todir
```

## Usage
On your ```juntyfile.php```:
```php
require 'vendor/autoload.php';

use Junty\Runner;
use Junty\ToDir\ToDirPlugin;

$junty = new Runner();

$junty->task('catch_txt', function () {
    $this->src('./*.txt')
        ->forStreams(new ToDirPlugin('txt_files')); // Send all txt files to txt_files
});
```
### Nativaly!
This plugin comes nativaly with Junty, so you don't need to install.
```php
// ...
->forStreams($this->toDir('directory_name'))
```