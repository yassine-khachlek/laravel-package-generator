<?php

namespace Yk\LaravelPackageGenerator;

use Illuminate\Support\ServiceProvider;

class LaravelPackageGeneratorProvider extends ServiceProvider
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
                \Yk\LaravelPackageGenerator\App\Console\Commands\MakePackage::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}