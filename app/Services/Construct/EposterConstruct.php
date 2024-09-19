<?php

namespace App\Services\Construct;

use App\Http\Requests\EposterRequest;

interface EposterConstruct 
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
     * @param EposterRequest $request
     * @return void
     */
    public function store(EposterRequest $request);

    /**
     * Show the form for editing the specified resource.
     *
     * @param [type] $imageName
     * @return void
     */
    public function edit($imageName);

    /**
     * Update the specified resource in storage.
     *
     * @param EposterRequest $request
     * @param [type] $imageName
     * @return void
     */
    public function update(EposterRequest $request, $imageName);

    /**
     * Remove the specified resource from storage.
     *
     * @param [type] $imageName
     * @return void
     */
    public function destroy($imageName);
}