
![Example](https://raw.githubusercontent.com/pyaesone17/lapse/master/lapse_v2.png)

## Introducing

Lapse provides a beautiful dashboard to track your errors in production without having to look up log file. 
Moreover it can notify you via Slack channel and Email alert. And moreover it can notify you via all of the channels from
http://laravel-notification-channels.com/.

Lapse behind the scence depend on https://laravel.com/docs/5.6/notifications. So if you want to know more, please kindly check the link.

For old version please see documentation at https://github.com/pyaesone17/lapse/tree/v1

## Install

Install Via Composer

``` bash
$ composer require pyaesone17/lapse
```

Publish vendor

``` bash
$ php artisan vendor:publish
```

Add slack hook url in config/lapse.php and define channels ( https://api.slack.com/incoming-webhooks )

``` php
    'channels' => [
        'slack' => 'https://hooks.slack.com/services/......',
        'mail' => 'your@mail.com'
    ],
    // Currently two notification channels supported
    // Those are slack and email
    'via' => ['slack']
```

``` bash
$ php artisan vendor:publish
```

Migrate lapses table

``` bash
php artisan migrate
```
## Usage

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
                $this->sendNotification($exception);
            }
        }
        ...  
    }
```

Laravel Lapse's dashboard is inspired by Laravel Horizon. Just like Horizon you can configure authentication to Lapse's dashboard. Add the following to the boot method of your AppServiceProvider. Here you could also check role permision and limit
the dasboard.

``` php
    \Pyaesone17\Lapse\Lapse::auth(function($request) {
        // return true / false . For e.g.
        return \Auth::check();
    });
```
To view the dashboard point your browser to /lapse of your app. For e.g. `laravel.dev/lapse`.
But the app is in local environment, lapse will not even attend to validate auth, It will display it all.

To delete all lapse message via cli , please run

``` bash
$ php artisan clear:lapse
```

## Custom Notification Channel

you can use all notifications from http://laravel-notification-channels.com/ to integrate with lapse

For example, Telegram

install channel via composer

``` bash
    $ composer require laravel-notification-channels/telegram
```

configure the config/lapse.php first

``` php
    use NotificationChannels\Telegram\TelegramChannel;
    'channels' => [
        'slack' => 'https://hooks.slack.com/services/......',
        'telegram' => 'tele_gram_user_id', //optional
    ],
    // Currently two notification channels supported
    // Those are slack and email
    'via' => ['slack', TelegramChannel::class]
```

register telegram provider

``` php
// config/app.php
'providers' => [
    ...
    NotificationChannels\Telegram\TelegramServiceProvider::class,
],
```

Set credentials
```php
    // config/services.php
    'telegram-bot-api' => [
        'token' => env('TELEGRAM_BOT_TOKEN', 'YOUR BOT TOKEN HERE')
    ],
```

Add the formatter for notificaiton
``` php
    use NotificationChannels\Telegram\TelegramMessage;
    use Pyaesone17\Lapse\ErrorNotifiable;
    ..
    
    class Handler extends ExceptionHandler
    {
        use ErrorNotifiable;
        ...
    
        public function report(Exception $exception)
        {
            if( app()->environment()!='local' ){ // Remove this line if you want lapse to notify in local environment
                $this->sendNotification($exception, $this->getFormatters());
            }
        }

        protected function getFormatters()
        {
            $formatters = array(
                'toTelegram' => function($notifiable) {
                    return TelegramMessage::create()
                    ->content("*HELLO!* \n One of your invoices has been paid!");
                }
            );

            return $formatters;
        }
        ...  
    }
```

## Security

If you discover any security related issues, please email promise@gmail.com instead of using the issue tracker.

## Credits

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
