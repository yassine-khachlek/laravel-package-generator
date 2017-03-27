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
    	echo '{{ studly_case($vendor_name) }}\{{ studly_case($package_name) }}\{{ studly_case($package_name) }}ServiceProvider';
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