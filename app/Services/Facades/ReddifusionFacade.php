<?php
namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class ReddifusionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ReddifusionService';
    }
}