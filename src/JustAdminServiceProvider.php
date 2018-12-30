<?php

namespace Shef29\JustAdmin;

use File;
use Illuminate\Support\ServiceProvider;

class JustAdminServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../publish/Middleware/' => app_path('Http/Middleware'),
            __DIR__ . '/../publish/migrations/' => database_path('migrations'),
            __DIR__ . '/../publish/Model/' => app_path(),
            __DIR__ . '/../publish/migrations/' => database_path('migrations'),
            __DIR__ . '/../publish/Controllers/' => app_path('Http/Controllers'),
            __DIR__ . '/../publish/resources/' => base_path('resources'),
            __DIR__ . '/../publish/public/' => base_path('public'),
            __DIR__ . '/../publish/Config/config.php' => config_path('crud.php'),
            __DIR__ . '/views' => base_path('resources/views/vendor/just'),

        ]);

//        $this->publishes([
//            __DIR__ . '/views' => base_path('resources/views/vendor/admin'),
//        ], 'views');

        $this->loadViewsFrom(__DIR__ . '/views', 'just');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(
            'Shef29\JustAdmin\JustAdminCommand'
        );
    }
}
