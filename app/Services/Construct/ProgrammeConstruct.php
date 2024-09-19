<?php

namespace App\Services\Construct;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

interface ProgrammeConstruct 
{

    public function update(Request $request, $pdfName);

    public function edit($pdfName);

    public function destroy($pdfName);
    
}