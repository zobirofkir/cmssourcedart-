<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Services\Facades\ItemFacade;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        return ItemFacade::index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ItemRequest $request
     * @return void
     */
    public function store(ItemRequest $request)
    {
        return ItemFacade::store($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param [type] $itemName
     * @return void
     */
    public function edit($itemName)
    {
        return ItemFacade::edit($itemName);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ItemRequest $request
     * @param [type] $itemName
     * @return void
     */
    public function update(ItemRequest $request, $itemName)
    {
        return ItemFacade::update($request, $itemName);
    }  

    /**
     * Remove the specified resource from storage.
     *
     * @param [type] $itemName
     * @return void
     */
    public function destroy($itemName)
    {
        return ItemFacade::destroy($itemName);
    }
}
