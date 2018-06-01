<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // add the root disk to filesystem configuration
        app()->config['filesystems.disks.'.config('fadmin.base.root_disk_name')] = [
            'driver' => 'local',
            'root'   => base_path(),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (app()->isLocal()) {
            $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        }
        // $this->app->register(\Cviebrock\EloquentSluggable\ServiceProvider::class);
    }
}
