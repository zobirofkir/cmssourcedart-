<?php

namespace App\Http\Controllers;

use App\Http\Requests\EposterRequest;
use App\Services\Facades\EposterFacade;

class EposterController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return void
     */
    public function index()
    {
        return EposterFacade::index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return EposterFacade::create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EposterRequest $request
     * @return void
     */
    public function store(EposterRequest $request)
    {
        return EposterFacade::store($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param [type] $imageName
     * @return void
     */
    public function edit($imageName)
    {
        return EposterFacade::edit($imageName);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EposterRequest $request
     * @param [type] $imageName
     * @return void
     */
    public function update(EposterRequest $request, $imageName)
    {
        return EposterFacade::update($request, $imageName);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param [type] $imageName
     * @return void
     */
    public function destroy($imageName)
    {
        return EposterFacade::destroy($imageName);
    }
}
