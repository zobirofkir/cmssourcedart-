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
        // Validate the incoming request
        $request->validate([
            'name' => 'required|integer', // Ensure the item name is a string
            'image' => 'required|image', // Ensure the image is required and is a valid image
        ]);

        // Get the item name and the uploaded image
        $itemName = $request->input('name'); // Get the item name from the request
        $image = $request->file('image'); // Get the uploaded image

        // Define the path to store the image
        $destinationPath = public_path('project/application/assets/items');

        // Check if the directory exists; create if it doesn't
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true); // Create the directory if it doesn't exist
        }

        // Move the uploaded file to the destination path with the item name as the file name
        $image->move($destinationPath, $itemName . '.' . $image->getClientOriginalExtension());

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
            // Validate the request
            $request->validated();
    
            // Check if a new image file is uploaded
            if ($request->hasFile('image')) {
                $image = $request->file('image');
    
                if ($image->isValid()) {
                    // Delete the old image
                    File::delete($itemPath);
    
                    // Move the new image with the same name
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