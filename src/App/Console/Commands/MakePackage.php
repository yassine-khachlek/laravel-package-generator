<?php

namespace Yk\LaravelPackageGenerator\App\Console\Commands;

use Illuminate\Console\Command;

use Artisan;
use Config;
use File;

class MakePackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:package {vendor_name} {package_name}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new package';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
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
                ['packages', $vendor_name, $package_name]
            )
        );

        if (File::exists($package_path)) {
            return $this->error(
                join('\\',
                    [studly_case($vendor_name), studly_case($package_name)]
                ).
                ' package already exists!'
            );
        }

        if ( ! File::makeDirectory($package_path.'/src', 0775, true) ) {
            return $this->error(
                'Can\'t create the directory '.$package_path
            );
        }        

        $composer_json = File::get(base_path('composer.json'));
        
        $composer_json = json_decode($composer_json);
        
        $composer_json->autoload->{"psr-4"}->{join('\\',
                    [studly_case($vendor_name), studly_case($package_name)]
                ).'\\'} = str_replace(base_path().'/', '', $package_path.'/src/');

        $composer_json = json_encode($composer_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        $config_app = File::get(base_path('config/app.php'));

        $provider = join('\\',
                    [studly_case($vendor_name), studly_case($package_name), studly_case($package_name).'Provider::class']
                );

        $provider_position = strpos($config_app, 'App\Providers\RouteServiceProvider::class');

        File::put(base_path('composer.json'), $composer_json);

        File::put(
            base_path(
                join('/',
                    ['packages', $vendor_name, $package_name, 'src', studly_case($package_name).'Provider.php']
                )
            ),
            view('Yk\LaravelPackageGenerator::scaffolds.provider', [
                'vendor_name' => $vendor_name,
                'package_name' => $package_name
            ])
        );

        $exitCode = Artisan::call('optimize', [
            '--force' => true,
        ]);

        if ($provider_position) {
            
            $provider_position += strlen('App\Providers\RouteServiceProvider::class')+1;

            File::put(base_path('config/app.php'), substr_replace($config_app,"\r\n        ".$provider.",", $provider_position, 0));

        }

        $this->info($package_path);
    }
}