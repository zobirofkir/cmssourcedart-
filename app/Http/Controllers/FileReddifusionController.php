<?php

namespace App\Http\Controllers;

use App\Services\Facades\FileReddifusionFacade;
use Illuminate\Http\Request;

class FileReddifusionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        return FileReddifusionFacade::index();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param [type] $file
     * @return void
     */
    public function edit($file)
    {
        return FileReddifusionFacade::edit($file);
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
        return FileReddifusionFacade::update($request, $file);
    }

}
