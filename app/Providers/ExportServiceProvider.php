<?php

namespace App\Providers;

use App\Services\Services\ExportService;
use Illuminate\Support\ServiceProvider;

class ExportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind("ExportService", function (){
            return new ExportService();
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
