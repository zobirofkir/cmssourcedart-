<?php

namespace App\Http\Controllers;

use App\Services\Facades\ReddifusionFacade;
use Illuminate\Http\Request;

class ReddifusionController extends Controller
{

    public function index()
    {
        return ReddifusionFacade::index();
    }

    public function store(Request $request)
    {
        return ReddifusionFacade::store($request);
    }

    public function edit($day, $theme)
    {
        return ReddifusionFacade::edit($day, $theme);
    }

    public function update(Request $request, $day, $theme)
    {
        return ReddifusionFacade::update($request, $day, $theme);
    }

    public function destroy($day, $theme)
    {
        return ReddifusionFacade::destroy($day, $theme);
    }
}
