<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Services\Facades\ItemFacade;

class ItemController extends Controller
{
    public function index()
    {
        return ItemFacade::index();
    }

    public function store(ItemRequest $request)
    {
        return ItemFacade::store($request);
    }

    public function edit($itemName)
    {
        return ItemFacade::edit($itemName);
    }

    public function update(ItemRequest $request, $itemName)
    {
        return ItemFacade::update($request, $itemName);
    }  

    public function destroy($itemName)
    {
        return ItemFacade::destroy($itemName);
    }
}
