<?php

namespace App\Http\Controllers;

use App\Services\Facades\UploadFacade;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        return UploadFacade::index();
    }

    public function create()
    {
        return UploadFacade::create();
    }

    public function store(Request $request)
    {
        return UploadFacade::store($request);
    }

    public function destroy($name)
    {
        return UploadFacade::destroy($name);
    }

    public function updatePath(Request $request, $name)
    {
        return UploadFacade::updatePath($request, $name);
    }   

    public function deleteDirectory($dir)
    {
        return UploadFacade::deleteDirectory($dir);
    } 
}
