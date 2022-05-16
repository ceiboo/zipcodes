<?php

namespace Ceiboo\Api\Framework\Providers;

use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            \Ceiboo\Api\Commands\ImportCommand::class,
            \Ceiboo\Api\Commands\CacheCommand::class
        ]);
    }
}
