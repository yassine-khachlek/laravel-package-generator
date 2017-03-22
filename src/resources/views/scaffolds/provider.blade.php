<{{'?'}}php

namespace {{ studly_case($vendor_name) }}\{{ studly_case($package_name) }};

use Illuminate\Support\ServiceProvider;

class {{ studly_case($package_name) }}Provider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    	echo 'hit';
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