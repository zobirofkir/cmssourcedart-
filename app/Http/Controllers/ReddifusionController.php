<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
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
    public function update(Request $request, $day, $theme)
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
}
