<?php

namespace Pyaesone17\Lapse;

use Illuminate\Support\ServiceProvider;
use Route;

class LapseServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        app('router')->aliasMiddleware('cors', \Pyaesone17\Lapse\Http\Middleware\CORS::class);
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->registerRoutes();
        $this->registerCommands();
        $this->registerResources();
        $this->defineAssetPublishing();
        $this->registerConfig();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        if (! defined('LAPSE_PATH')) {
            define('LAPSE_PATH', realpath(__DIR__.'/../'));
        }

        $this->mergeConfigFrom(
            __DIR__.'/../config/lapse.php', 'lapse'
        );
    }

    /**
     * Register the Error routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group([
            'prefix' => config('lapse.prefix') . '/lapse' ,
            'as' => 'lapse.',
            'namespace' => 'Pyaesone17\Lapse\Http\Controllers',
            'middleware' => ['web', 'cors'],
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    /**
     * Register the Error routes.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../config/lapse.php' => config_path('lapse.php'),
        ]);
    }
    /**
     * Register the Error resources.
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lapse');
    }

    /**
     * Define the asset publishing configuration.
     *
     * @return void
     */
    public function defineAssetPublishing()
    {
        $this->publishes([
            LAPSE_PATH.'/public' => public_path('vendor/lapse'),
        ], 'lapse-assets');
    }


    /**
     * Register the console command to clear lapses.
     *
     * @return void
     */
    public function registerCommands()
    {
        $this->commands([
            Commands\ClearLapse::class
        ]);
    }
}
