<?php

namespace Ceiboo\Modules\Geo\Providers;

use Illuminate\Support\ServiceProvider;

class GeoServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->commands([
            \Ceiboo\Api\Commands\ImportCommand::class,
            \Ceiboo\Api\Commands\CacheCommand::class
        ]);
    }
}
