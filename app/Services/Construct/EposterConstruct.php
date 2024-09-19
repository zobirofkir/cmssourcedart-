<?php

namespace App\Services\Construct;

use App\Http\Requests\EposterRequest;

interface EposterConstruct 
{
    public function index();
    public function create();
    public function store(EposterRequest $request);
    public function edit($imageName);
    public function update(EposterRequest $request, $imageName);
    public function destroy($imageName);
}