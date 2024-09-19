<?php

namespace App\Http\Controllers;

use App\Http\Requests\EposterRequest;
use App\Services\Facades\EposterFacade;

class EposterController extends Controller
{
    public function index()
    {
        return EposterFacade::index();
    }

    public function create()
    {
        return EposterFacade::create();
    }

    public function store(EposterRequest $request)
    {
        return EposterFacade::store($request);
    }

    public function edit($imageName)
    {
        return EposterFacade::edit($imageName);
    }

    public function update(EposterRequest $request, $imageName)
    {
        return EposterFacade::update($request, $imageName);
    }

    public function destroy($imageName)
    {
        return EposterFacade::destroy($imageName);
    }

}
