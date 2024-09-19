<?php

namespace App\Services\Services;

use App\Services\Construct\ItemConstruct;

use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ItemService implements ItemConstruct 
{
    // Method to list all items
    public function index()
    {
        $basePath = public_path('project/application/assets/items');
        
        // Get list of files
        $files = File::files($basePath);
        $items = [];
    
        foreach ($files as $file) {
            $items[basename($file)] = $file->getPathname();
        }
    
        // Assuming you need a list of directories or similar data
        $existingDays = []; // Define or calculate this if needed
    
        return view('items.index', compact('items', 'existingDays'));
    }
    
    public function store(ItemRequest $request)
    {
        $request->validated();

        $image = $request->file('image');
        $itemName = $image->getClientOriginalName();
        $destinationPath = public_path('project/application/assets/items');

        // Move the uploaded image to the destination path
        $image->move($destinationPath, $itemName);

        return redirect()->route('items.index')->withSuccess('Item added successfully.');
    }

    // Method to edit a specific item
    public function edit($itemName)
    {
        $itemPath = public_path("project/application/assets/items/$itemName");

        if (File::exists($itemPath)) {
            return view('items.edit', compact('itemPath', 'itemName'));
        }

        return redirect()->back()->withErrors('Item not found.');
    }

    // Method to update an item
    public function update(ItemRequest $request, $itemName)
    {
        $itemPath = public_path("project/application/assets/items/$itemName");

        if (File::exists($itemPath)) {
            // Handle image upload if provided
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                // Ensure the uploaded file is an image and overwrite the old image
                if ($image->isValid()) {
                    // Move the new image to replace the old one
                    $newImagePath = public_path("project/application/assets/items/$itemName");
                    $image->move(dirname($newImagePath), $itemName);
                }
            }

            return redirect()->route('items.index')->withSuccess('Item updated successfully.');
        }

        return redirect()->back()->withErrors('Unable to update item.');
    }

    // Method to delete an item
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