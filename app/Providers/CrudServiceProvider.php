<?php
namespace App\Providers;

use Route;
use Illuminate\Support\ServiceProvider;
use App\Orgs\Crud\CrudRouter;

class CrudServiceProvider extends ServiceProvider
{
    protected $commands = [
        //
    ];
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    //protected $defer = false;
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CRUD', function ($app) {
            return new CRUD($app);
        });
    }
    public static function resource($name, $controller, array $options = [])
    {
        return new CrudRouter($name, $controller, $options);
    }
}
