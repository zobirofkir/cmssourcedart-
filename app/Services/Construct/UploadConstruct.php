<?php

namespace App\Services\Construct;

use Illuminate\Http\Request;

interface UploadConstruct
{
    public function index();
    public function create();
    public function store(Request $request);
    public function destroy($name);
    public function updatePath(Request $request, $name);
}