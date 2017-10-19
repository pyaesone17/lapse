
![Example](https://raw.githubusercontent.com/pyaesone17/lapse/master/lapse.png)

## Introducing

Lapse provides a beautiful dashboard to track your errors in production without having to look up log file. 
Moreover it can notify you via Slack channel and Email alert. In future, I will add more channels.

## Install

Install Via Composer

``` bash
$ composer require pyaesone17/lapse
```

Publish vendor

``` bash
$ php artisan vendor:publish
```

Add slack hook url in config/lapse.php and define channels

``` php
  'slack_channel' => 'https://hooks.slack.com/services/......',
    // Currently three notification channels supported
    // Those are database, slack and email
    'via' => ['database', 'slack']
```

``` bash
$ php artisan vendor:publish
```

Migrate notification table

``` bash
php artisan notifications:table
php artisan migrate
```
## Usage

Include the trait "Pyaesone17\Lapse\ErrorNotifiable" in Exceptions/Handler::class first.

after that register In the report method like this.

``` php

    use Pyaesone17\Lapse\ErrorNotifiable;
    
    ..
    
    class Handler extends ExceptionHandler
    {
        use ErrorNotifiable;

        ...
    
        public function report(Exception $exception)
        {
            if( app()->environment()!='local' ){ // Remove this line if you want lapse to notify in local environment
                $this->sendNotification($exception, function ()
                {
                    // Here you must provide one user,
                    // It can be super admin, admin or normal user,
                    // Anything but at least you have to provide one model
                    // It is require for database notification
                    // and it must be notifiable object, it means class must use
                    // Illuminate\Notifications\Notifiable trait
                    return \App\User::first();
                });
            }
        }
        
        ...
        
    }
```

Laravel Totem's dashboard is inspired by Laravel Horizon. Just like Horizon you can configure authentication to Lapse's dashboard. Add the following to the boot method of your AppServiceProvider. Here you could also check role permision and limit
the dasboard.

``` php
    \Pyaesone17\Lapse\Lapse::auth(function($request) {
        // return true / false . For e.g.
        return \Auth::check();
    });
```
To view the dashboard point your browser to /lapse of your app. For e.g. laravel.dev/lapse.
But the app is in local environment, lapse will not even attend to validate auth, It will display it all.

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
