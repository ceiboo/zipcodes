<?php

namespace Ceiboo\Api\Framework\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = '';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    private $home = '/';


    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->home = base_path('src/apps/api/Framework/');
        $config = $this->loadConfig();
        $this->setDatabase($config);
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group($this->home.'routes/api.php');
    }

    public function loadConfig()
    {
        $config = require $this->home."config/config.php";
        Config::set("ceiboo.api", $config);
        return $config;
    }

    private function setDatabase(array $config)
    {
        // levantar configuración para local, test o prod
        $dbconnection = 'mysql_'.$config['environment'];

        Config::set('database.connections.mysql', @$config["dbconnection"][$dbconnection]);
        Config::set('database.default', 'mysql');
    }
}
