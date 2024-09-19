<?php

namespace App\Services\Construct;

use Illuminate\Http\Request;

interface UploadConstruct
{
    /**
     * Show the application dashboard.
     *
     * @return void
     */
    public function index();

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create();

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request);

    /**
     * Show the form for editing the specified resource.
     *
     * @param [type] $name
     * @return void
     */
    public function destroy($name);

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param [type] $name
     * @return void
     */
    public function updatePath(Request $request, $name);
}