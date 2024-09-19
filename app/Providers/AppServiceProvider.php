<?php

namespace App\Providers;

use App\Services\Services\ReddifusionService;
use App\Services\Services\UploadService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('UploadService', function (){
            return new UploadService();
        });

        $this->app->bind("ReddifusionService", function (){
            return new ReddifusionService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
