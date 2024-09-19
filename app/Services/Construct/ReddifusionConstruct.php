<?php

namespace App\Services\Construct;

use Illuminate\Http\Request;

interface ReddifusionConstruct 
{
    public function index();

    public function store(Request $request);
    
    public function edit($day, $theme);

    public function update(Request $request, $day, $theme);

    public function destroy($day, $theme);
}