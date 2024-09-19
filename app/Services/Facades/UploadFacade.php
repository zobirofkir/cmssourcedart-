<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class UploadFacade extends Facade 
{
    /**
     * Get the registered name of the component.
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return 'UploadService';
    }
}