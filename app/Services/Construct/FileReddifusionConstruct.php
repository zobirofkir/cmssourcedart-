<?php

namespace App\Services\Construct;

use Illuminate\Http\Request;

interface FileReddifusionConstruct 
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index();

    /**
     * Show the form for creating a new resource.
     *
     * @param [type] $file
     * @return void
     */
    public function edit($file);

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param [type] $file
     * @return void
     */
    public function update(Request $request, $file);
}