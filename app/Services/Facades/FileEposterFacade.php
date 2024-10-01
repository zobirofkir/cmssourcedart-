<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class FileEposterFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return void
     */
    public static function getFacadeAccessor()
    {
        return 'FileEposterService';
    }
}