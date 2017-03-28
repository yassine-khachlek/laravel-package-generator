<{{'?'}}php

namespace {{ studly_case($vendor_name) }}\{{ studly_case($package_name) }};

use Illuminate\Support\ServiceProvider;

class {{ studly_case($package_name) }}ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
        * Routing
        * Extend the app routes by adding a route group under the package namespace.
        */

        /*
        $this->app->router->group(['namespace' => '{{ studly_case($vendor_name) }}\{{ studly_case($package_name) }}\App\Http\Controllers'],
            function(){
                require __DIR__.'/routes/web.php';
            }
        );
        */

        /**
        * Views
        * Load the package views under the package namespace.
        */

        /*
        $this->loadViewsFrom(__DIR__.'/resources/views', '{{ studly_case($vendor_name) }}/{{ studly_case($package_name) }}');
        */

        /*
        $this->publishes(
            [
                __DIR__.'/resources/views' => base_path('resources/views/vendor/{{ studly_case($vendor_name) }}/{{ studly_case($package_name) }}'),
            ]
        );

        $this->publishes([
            __DIR__.'/public' => public_path('vendor/{{ studly_case($vendor_name) }}/{{ studly_case($package_name) }}'),
        ], 'public');

        $this->publishes([
            __DIR__.'/config' => config_path('vendor/{{ studly_case($vendor_name) }}/{{ studly_case($package_name) }}'),
        ]);

        $kernel = $this->app['Illuminate\Contracts\Http\Kernel'];
        
        $kernel->pushMiddleware('{{ studly_case($vendor_name) }}\{{ studly_case($package_name) }}\App\Http\Middleware\Middleware{{ studly_case($vendor_name) }}{{ studly_case($package_name) }}');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \{{ studly_case($vendor_name) }}\{{ studly_case($package_name) }}\App\Console\Commands\{{ studly_case($vendor_name) }}{{ studly_case($package_name) }}::class,
            ]);
        }
        */
    }
    
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /*
        $this->mergeConfigFrom(
            __DIR__.'/config/app.php', 'packages.{{ studly_case($vendor_name) }}.{{ studly_case($package_name) }}.app'
        );

        $this->app->bind('{{ studly_case($vendor_name) }}{{ studly_case($package_name) }}', function(){
            return $this->app->make('{{ studly_case($vendor_name) }}\{{ studly_case($package_name) }}\Classes\{{ studly_case($vendor_name) }}{{ studly_case($package_name) }}');
        });
        */
    }
}