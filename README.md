
![Example](https://raw.githubusercontent.com/pyaesone17/laravel-lapse/master/lapse.png)

## Introducing

Lapse provides a beautiful dashboard to track your errors in production without having to look up log file. 
Moreover it can notify you via Slack channel and Email alert. In future, I will add more channels.

## Install

Install Via Composer

``` bash
$ composer require laravel-lapse
```

Publish vendor

``` bash
$ php artisan vendor:publish
```

Migrate notification table

``` bash
php artisan notifications:table
php artisan migrate
```
## Usage

Include the trait "Pyaesone17\ErrorNotification\ErrorNotifiable::class" in Exceptions/Handler::class first.

after that register In the report method like this.

``` php
    public function report(Exception $exception)
    {
        $this->sendNotification($exception, function ()
        {
            // Here you must provide one user,
            // It can be super admin, admin or normal user,
            // Anything but at least you have to provide one model
            // It is require for database notification
            return \App\User::first();
        });
    }
```

Currently deleting lapse message doesn't support via UI. To delete all lapse message please run
``` bash
$ php artisan clear:lapse
```

## Security

If you discover any security related issues, please email promise@gmail.com instead of using the issue tracker.

## Credits

- [][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v//.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis///master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g//.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g//.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt//.svg?style=flat-square

[link-packagist]: https://packagist.org/packages//
[link-travis]: https://travis-ci.org//
[link-scrutinizer]: https://scrutinizer-ci.com/g///code-structure
[link-code-quality]: https://scrutinizer-ci.com/g//
[link-downloads]: https://packagist.org/packages//
[link-author]: https://github.com/
[link-contributors]: ../../contributors
