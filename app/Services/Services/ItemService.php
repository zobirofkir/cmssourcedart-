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
        $itemsDirectory = public_path('project/application/assets/items');
        $cssFile = public_path('project/application/assets/css/index1000.css');
        
        $items = [];
        
        if (File::exists($itemsDirectory)) {
            $files = File::files($itemsDirectory);
            
            foreach ($files as $file) {
                $items[basename($file)] = $file->getPathname();
            }
        }
        
        if (File::exists($cssFile)) {
            $items[basename($cssFile)] = $cssFile;
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
        $request->validate([
            'name' => 'required|integer',
            'image' => 'required|image',
            'category' => 'required|string',
        ]);
    
        $itemNumber = $request->input('name');
        $itemPath = $request->input('category');
        $image = $request->file('image');
    
        $destinationPath = public_path('project/application/assets/items');
    
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
    
        $fileName = $itemNumber . '.' . $image->getClientOriginalExtension();
        
        $image->move($destinationPath, $fileName);
    
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
            $request->validated();
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
    
                if ($image->isValid()) {
                    File::delete($itemPath);
    
                    $image->move(dirname($itemPath), $itemName);
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