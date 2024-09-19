<?php

namespace App\Services\Construct;

use App\Http\Requests\ItemRequest;

interface ItemConstruct
{
    public function index();

    public function store(ItemRequest $request);

    public function edit($itemName);

    public function update(ItemRequest $request, $itemName);

    public function destroy($itemName);

    
    
}