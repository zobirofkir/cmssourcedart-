<?php

namespace App\Http\Controllers;

use App\Services\Facades\ProgrammeFacade;
use Illuminate\Http\Request;

class ProgrammeController extends Controller
{

    public function index()
    {
        return ProgrammeFacade::index();
    }

    public function store(Request $request)
    {
        return ProgrammeFacade::store($request);
    }

    public function edit($pdfName)
    {
        return ProgrammeFacade::edit($pdfName);
    }

    public function update(Request $request, $pdfName)
    {
        return ProgrammeFacade::update($request, $pdfName);
    }

    public function destroy($pdfName)
    {
        return ProgrammeFacade::destroy($pdfName);
    }
}
