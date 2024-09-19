<?php

namespace App\Providers;

use App\Services\Services\FileReddifusionService;
use App\Services\Services\FileRediffusionService;
use Illuminate\Support\ServiceProvider;

class FileReddifusionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind("FileReddifusionService", function () {
            return new FileReddifusionService();
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
