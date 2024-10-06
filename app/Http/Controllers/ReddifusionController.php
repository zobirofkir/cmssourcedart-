<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReddifusionRequest;
use App\Services\Facades\ReddifusionFacade;
use Illuminate\Http\Request;

class ReddifusionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        return ReddifusionFacade::index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return void
     */
    public function store(ReddifusionRequest $request)
    {
        return ReddifusionFacade::store($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param [type] $day
     * @param [type] $theme
     * @return void
     */
    public function edit($day, $theme)
    {
        return ReddifusionFacade::edit($day, $theme);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param [type] $day
     * @param [type] $theme
     * @return void
     */
    public function update(ReddifusionRequest $request, $day, $theme)
    {
        return ReddifusionFacade::update($request, $day, $theme);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param [type] $day
     * @param [type] $theme
     * @return void
     */
    public function destroy($day, $theme)
    {
        return ReddifusionFacade::destroy($day, $theme);
    }

    /**
     * Create a new day in storage.
     *
     * @param Request $request
     * @return void
     */
    public function createDay(Request $request)
    {
        return ReddifusionFacade::createDay($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param [type] $day
     * @return void
     */
    public function destroyDay($day)
    {
        return ReddifusionFacade::destroyDay($day);
    }
}
