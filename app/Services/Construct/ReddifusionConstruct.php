<?php

namespace App\Services\Construct;

use Illuminate\Http\Request;

interface ReddifusionConstruct 
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
     * @param Request $request
     * @return void
     */
    public function store(Request $request);
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param [type] $day
     * @param [type] $theme
     * @return void
     */
    public function edit($day, $theme);

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param [type] $day
     * @param [type] $theme
     * @return void
     */
    public function update(Request $request, $day, $theme);

    /**
     * Remove the specified resource from storage.
     *
     * @param [type] $day
     * @param [type] $theme
     * @return void
     */
    public function destroy($day, $theme);
}