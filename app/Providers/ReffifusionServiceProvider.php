<?php

namespace App\Providers;

use App\Services\Services\ReddifusionService;
use Illuminate\Support\ServiceProvider;

class ReffifusionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind("ReddifusionService", function (){
            return new ReddifusionService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
