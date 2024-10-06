<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Services\Facades\UploadFacade;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        return UploadFacade::index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return UploadFacade::create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(UploadRequest $request)
    {
        return UploadFacade::store($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param [type] $name
     * @return void
     */
    public function destroy($name)
    {
        return UploadFacade::destroy($name);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param [type] $name
     * @return void
     */
    public function updatePath(Request $request, $name)
    {
        return UploadFacade::updatePath($request, $name);
    }   

    /**
     * Delete a directory and all of its contents.
     *
     * @param [type] $dir
     * @return void
     */
    public function deleteDirectory($dir)
    {
        return UploadFacade::deleteDirectory($dir);
    } 
}
