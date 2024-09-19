<?php

namespace App\Http\Controllers;

use App\Services\Facades\ProgrammeFacade;
use Illuminate\Http\Request;

class ProgrammeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        return ProgrammeFacade::index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        return ProgrammeFacade::store($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param [type] $pdfName
     * @return void
     */
    public function edit($pdfName)
    {
        return ProgrammeFacade::edit($pdfName);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param [type] $pdfName
     * @return void
     */
    public function update(Request $request, $pdfName)
    {
        return ProgrammeFacade::update($request, $pdfName);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param [type] $pdfName
     * @return void
     */
    public function destroy($pdfName)
    {
        return ProgrammeFacade::destroy($pdfName);
    }
}
