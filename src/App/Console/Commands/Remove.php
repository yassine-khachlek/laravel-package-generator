<?php

namespace Yk\LaravelPackageGenerator\App\Console\Commands;

use Illuminate\Console\Command;

use Artisan;
use Config;
use File;

class Remove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:remove {vendor_name} {package_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove a package';

    /**
     * The packages path.
     *
     * @var string
     */
    protected $packages_path = 'packages';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->packages_path = Config::get('vendor.yk.laravel-package-generator.package.path');
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $vendor_name = $this->argument('vendor_name');
        $package_name = $this->argument('package_name');

        $vendor_name = snake_case(str_slug($vendor_name));
        $package_name = snake_case(str_slug($package_name));

        $package_path = base_path(
            join('/',
                [$this->packages_path, $vendor_name, $package_name]
            )
        );

        if ( ! File::exists($package_path)) {
            return $this->error(
                join('\\',
                    [studly_case($vendor_name), studly_case($package_name)]
                ).
                ' package does not exists!'
            );
        }

        $composer_array = File::get(base_path('composer.json'));
        
        $composer_array = json_decode($composer_array, true);

        if (in_array(join('\\',
                    [studly_case($vendor_name), studly_case($package_name)]
                ).'\\', array_keys($composer_array['autoload']['psr-4']))) {
            $this->info('ok');

            unset($composer_array['autoload']['psr-4'][join('\\',
                    [studly_case($vendor_name), studly_case($package_name)]
                ).'\\']);
        
            $composer_array = json_encode($composer_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

            File::put(base_path('composer.json'), $composer_array);
        }

        $config_app = File::get(base_path('config/app.php'));

        $provider = join('\\',
                    [studly_case($vendor_name), studly_case($package_name), studly_case($package_name).'ServiceProvider::class']
                );

        $config_app = str_replace([$provider.',', $provider], ['', ''], $config_app);

        File::put(base_path('config/app.php'), $config_app);

        File::deleteDirectory($package_path);

        $this->info($package_path);
        
    }
}