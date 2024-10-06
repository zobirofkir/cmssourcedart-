<?php

namespace App\Services\Construct;

use App\Http\Requests\ReddifusionRequest;
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
    public function store(ReddifusionRequest $request);
    
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
    public function update(ReddifusionRequest $request, $day, $theme);

    /**
     * Remove the specified resource from storage.
     *
     * @param [type] $day
     * @param [type] $theme
     * @return void
     */
    public function destroy($day, $theme);

    /**
     * Create a new day in storage.
     *
     * @param Request $request
     * @return void
     */
    public function createDay(Request $request);    

    /**
     * Remove the specified day from storage.
     *
     * @param string $day
     * @return void
     */
    public function destroyDay($day);
}