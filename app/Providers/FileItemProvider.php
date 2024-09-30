<?php

namespace App\Providers;

use App\Services\Services\FileItemService;
use Illuminate\Support\ServiceProvider;

class FileItemProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind("FileItemService", function () {
            return new FileItemService();
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
