<?php

namespace App\Services\Construct;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

interface ProgrammeConstruct 
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param [type] $pdfName
     * @return void
     */
    public function update(Request $request, $pdfName);

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