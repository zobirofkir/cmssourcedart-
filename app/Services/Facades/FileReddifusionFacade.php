<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class FileReddifusionFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'FileReddifusionService';
    }
}