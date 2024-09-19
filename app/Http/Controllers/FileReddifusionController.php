<?php

namespace App\Http\Controllers;

use App\Services\Facades\FileReddifusionFacade;
use Illuminate\Http\Request;

class FileReddifusionController extends Controller
{
    public function index()
    {
        return FileReddifusionFacade::index();
    }

    public function edit($file)
    {
        return FileReddifusionFacade::edit($file);
    }

    public function update(Request $request, $file)
    {
        return FileReddifusionFacade::update($request, $file);
    }

}
