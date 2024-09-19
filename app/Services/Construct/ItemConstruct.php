<?php

namespace App\Services\Construct;

use App\Http\Requests\ItemRequest;

interface ItemConstruct
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
     * @param ItemRequest $request
     * @return void
     */
    public function store(ItemRequest $request);

    /**
     * Show the form for editing the specified resource.
     *
     * @param [type] $itemName
     * @return void
     */
    public function edit($itemName);

    /**
     * Update the specified resource in storage.
     *
     * @param ItemRequest $request
     * @param [type] $itemName
     * @return void
     */
    public function update(ItemRequest $request, $itemName);

    /**
     * Remove the specified resource from storage.
     *
     * @param [type] $itemName
     * @return void
     */
    public function destroy($itemName);
}