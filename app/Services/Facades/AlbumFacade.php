<?php
namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class AlbumFacade extends Facade    
{
    protected static function getFacadeAccessor()
    {
        return 'AlbumService';
    }
}