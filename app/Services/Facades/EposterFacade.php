<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class EposterFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'EposterService';
    }
}