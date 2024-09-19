<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class UploadFacade extends Facade 
{
    protected static function getFacadeAccessor()
    {
        return 'UploadService';
    }
}