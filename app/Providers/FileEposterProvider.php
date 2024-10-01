<?php

namespace App\Providers;

use App\Services\Services\FileEposterService;
use Illuminate\Support\ServiceProvider;

class FileEposterProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind("FileEposterService", function () {
            return new FileEposterService();
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
