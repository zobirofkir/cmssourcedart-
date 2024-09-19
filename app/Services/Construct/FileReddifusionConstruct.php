<?php

namespace App\Services\Construct;

use Illuminate\Http\Request;

interface FileReddifusionConstruct 
{
    public function index();

    public function edit($file);

    public function update(Request $request, $file);
}