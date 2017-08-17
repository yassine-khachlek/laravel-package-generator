<?php

namespace Yk\LaravelPackageGenerator;

use Illuminate\Support\ServiceProvider;

class LaravelPackageGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Yk\LaravelPackageGenerator');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Yk\LaravelPackageGenerator\App\Console\Commands\Generate::class,
                \Yk\LaravelPackageGenerator\App\Console\Commands\Remove::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/config' => config_path('vendor/yk/laravel-package-generator'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/package.php', 'vendor.yk.laravel-package-generator.package'
        );
    }
}