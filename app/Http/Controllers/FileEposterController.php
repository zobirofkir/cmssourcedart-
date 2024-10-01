<?php

namespace App\Http\Controllers;

use App\Services\Facades\FileEposterFacade;
use Illuminate\Http\Request;

class FileEposterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        return FileEposterFacade::index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        return FileEposterFacade::store($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param [type] $file
     * @return void
     */
    public function edit($file)
    {
        return FileEposterFacade::edit($file);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param [type] $file
     * @return void
     */
    public function update(Request $request, $file)
    {
        return FileEposterFacade::update($request, $file);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param [type] $file
     * @return void
     */
    public function destroy($file)
    {
        return FileEposterFacade::destroy($file);
    }

    /**
     * Restore a file from the trash.
     *
     * @param string $file
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($file)
    {
        return FileEposterFacade::restore($file);
    }
}
