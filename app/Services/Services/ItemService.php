<?php

namespace App\Services\Services;

use App\Services\Construct\ItemConstruct;

use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ItemService implements ItemConstruct 
{
    /**
     * Show the application dashboard.
     *
     * @return void
     */
    public function index()
    {
        $basePath = public_path('project/application/assets/items');
        
        $files = File::files($basePath);
        $items = [];
    
        foreach ($files as $file) {
            $items[basename($file)] = $file->getPathname();
        }
    
        $existingDays = []; 
    
        return view('items.index', compact('items', 'existingDays'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @param ItemRequest $request
     * @return void
     */
    public function store(ItemRequest $request)
    {
        $request->validated();

        $image = $request->file('image');
        $itemName = $image->getClientOriginalName();
        $destinationPath = public_path('project/application/assets/items');

        $image->move($destinationPath, $itemName);

        return redirect()->route('items.index')->withSuccess('Item added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param [type] $itemName
     * @return void
     */
    public function edit($itemName)
    {
        $itemPath = public_path("project/application/assets/items/$itemName");

        if (File::exists($itemPath)) {
            return view('items.edit', compact('itemPath', 'itemName'));
        }

        return redirect()->back()->withErrors('Item not found.');
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
        $itemPath = public_path("project/application/assets/items/$itemName");

        if (File::exists($itemPath)) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                if ($image->isValid()) {
                    $newImagePath = public_path("project/application/assets/items/$itemName");
                    $image->move(dirname($newImagePath), $itemName);
                }
            }

            return redirect()->route('items.index')->withSuccess('Item updated successfully.');
        }

        return redirect()->back()->withErrors('Unable to update item.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param [type] $itemName
     * @return void
     */
    public function destroy($itemName)
    {
            $filePath = public_path("project/application/assets/items/$itemName");
    
            if (File::exists($filePath)) {
                File::delete($filePath);
                return redirect()->route('items.index')->withSuccess('Item deleted successfully.');
            }
    
            return redirect()->back()->withErrors('Item not found.');
        }
}