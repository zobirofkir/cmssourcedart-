<?php

namespace App\Services\Construct;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ProgrammeRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

interface ProgrammeConstruct 
{
    /**
     * Store a newly created resource in storage.
     *
     * @param ProgrammeRequest $request
     * @return void
     */
    public function store(ProgrammeRequest $request);

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param [type] $pdfName
     * @return void
     */
    public function update(ProgrammeRequest $request, $pdfName);

    /**
     * Show the form for editing the specified resource.
     *
     * @param [type] $pdfName
     * @return void
     */
    public function edit($pdfName);

    /**
     * Remove the specified resource from storage.
     *
     * @param [type] $pdfName
     * @return void
     */
    public function destroy($pdfName);
}