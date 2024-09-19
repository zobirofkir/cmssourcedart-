<?php

namespace App\Providers;

use App\Services\Services\EposterService;
use Illuminate\Support\ServiceProvider;

class EposterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind("EposterService", function (){
            return new EposterService();
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
