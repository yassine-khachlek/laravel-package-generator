# Laravel Package Generator

Create a ready to use Laravel package with one command that create the package scaffold and do everything to load it without the developer intervention by adding it to the composer.json autoload psr-4, launching php artisan optimize and add it to the app/config.php.

### Installation

Install wia composer:

```
composer require yk/laravel-package-generator
```

Add the service provider to the file config/app.php:


```php
Yk\LaravelPackageGenerator\LaravelPackageGeneratorServiceProvider::class,
```

Create your package:

```
php artisan make:package vendor_name package_name
```

## License

### GPLv2

Copyright (c) 2016 Yassine Khachlek <yassine.khachlek@gmail.com>

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.