<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class VideoFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'VideoService'; 
    }
}
