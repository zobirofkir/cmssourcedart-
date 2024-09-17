<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{
    // Method to list all themes by day
    public function index()
    {
        $basePath = public_path('project/application/assets/thems');
        
        // Get list of directories (days)
        $days = File::directories($basePath);

        $themes = [];
        foreach ($days as $day) {
            $dayName = basename($day);
            $themes[$dayName] = File::files($day);
        }

        // Pass existing days to the view
        $existingDays = array_keys($themes);

        return view('themes.index', compact('themes', 'existingDays'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'day' => 'required|string',
            'theme' => 'required|string',
            'image' => 'required|image',
        ]);

        $day = $request->input('day');
        $theme = $request->input('theme');
        $image = $request->file('image');

        // Define the path to store the image
        $path = public_path("project/application/assets/thems/$day");

        // Ensure the directory exists
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        // Move the uploaded image to the destination path
        $image->move($path, $theme . '.' . $image->getClientOriginalExtension());

        return redirect()->route('themes.index')->withSuccess('Theme added successfully.');
    }

    // Method to edit a specific theme
    public function edit($day, $theme)
    {
        $themePath = public_path("project/application/assets/thems/$day/$theme");
        
        if (File::exists($themePath)) {
            $themeContent = File::get($themePath);
            return view('themes.edit', compact('themeContent', 'day', 'theme'));
        }

        return redirect()->back()->withErrors('Theme not found.');
    }

    // Method to update a theme
    public function update(Request $request, $day, $theme)
    {
        $themePath = public_path("project/application/assets/thems/$day/$theme");

        // Update content if exists
        if (File::exists($themePath)) {
            // Update theme content
            File::put($themePath, $request->input('content'));

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                // Ensure the uploaded file is an image and overwrite the old image
                if ($image->isValid()) {
                    $newImagePath = public_path("project/application/assets/thems/$day/$theme");

                    // Move the new image to replace the old one
                    $image->move(dirname($newImagePath), basename($theme));
                }
            }

            return redirect()->route('themes.index')->withSuccess('Theme updated successfully.');
        }

        return redirect()->back()->withErrors('Unable to update theme.');
    }

    // Method to delete a theme
    public function destroy($day, $theme)
    {
        $filePath = public_path("project/application/assets/thems/$day/$theme");

        if (File::exists($filePath)) {
            File::delete($filePath);
            return redirect()->route('themes.index')->withSuccess('Theme deleted successfully.');
        }

        return redirect()->back()->withErrors('Theme not found.');
    }
}
