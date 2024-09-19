<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class ItemFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'ItemService';
    }
}