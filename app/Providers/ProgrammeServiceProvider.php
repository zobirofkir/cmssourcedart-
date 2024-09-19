<?php

namespace App\Providers;

use App\Services\Services\ProgrammeService;
use Illuminate\Support\ServiceProvider;

class ProgrammeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind("ProgrammeService", function (){
            return new ProgrammeService();
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
