<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class ProgrammeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ProgrammeService';
    }
}