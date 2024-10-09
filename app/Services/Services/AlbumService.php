<?php
namespace App\Services\Services;

use App\Http\Requests\AlbumRequest;
use App\Services\Construct\AlbumConstructor;
use Illuminate\Support\Facades\File;

class AlbumService implements AlbumConstructor
{
    public function index() {
        $highResBasePath = public_path('project/application/galerie/imgs/high');
        $albums = [];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $allFiles = File::files($highResBasePath);
        
        $imageFiles = array_filter($allFiles, function ($file) use ($allowedExtensions) {
            return in_array(strtolower($file->getExtension()), $allowedExtensions);
        });
    
        if (!empty($imageFiles)) {
            $albums['High Resolution Images'] = array_map(function($file) use ($highResBasePath) {
                return asset('project/application/galerie/imgs/high/' . basename($file));
            }, $imageFiles);
        }
    
        $existingDaysAlbums = array_keys($albums);
    
        // Example to fetch album names (assuming you want the first one as $albumName)
        $albumName = !empty($existingDaysAlbums) ? $existingDaysAlbums[0] : null;
    
        return view('albums.index', compact('albums', 'existingDaysAlbums', 'albumName'));
    }
        
    public function create()
    {
        //
    }

    public function store(AlbumRequest $request)
    {
        $folder = $request->input('folder');
        $theme = $request->input('theme');
    
        if ($request->hasFile('image')) {
            // Get all uploaded images
            $images = $request->file('image');
            $destinationPath = public_path("project/application/galerie/imgs/high");
    
            // Ensure the destination path exists
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
    
            // Loop through each uploaded image
            foreach ($images as $image) {
                // Count existing files with the same theme, starting from 1
                $existingFiles = File::glob("{$destinationPath}/{$theme}*");
                $fileCount = count($existingFiles) + 1; // Increment to start counting from 1
    
                // Create the image name with the theme and the count
                // Using fileCount directly without str_pad
                $imageName = $theme . $fileCount . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imageName);
    
                // Alternative folder for storing lower resolution images
                $alternativeFolderPath = public_path("project/application/galerie/imgs/low");
    
                // Ensure the alternative folder exists
                if (!File::exists($alternativeFolderPath)) {
                    File::makeDirectory($alternativeFolderPath, 0755, true);
                }
    
                // Copy the image to the alternative folder
                File::copy("{$destinationPath}/{$imageName}", "{$alternativeFolderPath}/{$imageName}");
            }
        }
    
        // Redirect back to the album index with a success message
        return redirect()->route('album.index')->with('success', 'Album stored successfully.');
    }
                    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(AlbumRequest $request, $id)
    {
        //
    }

    public function destroy()
    {
        $highResFolderPath = public_path("project/application/galerie/imgs/high");
        $lowResFolderPath = public_path("project/application/galerie/imgs/low");
    
        // Check if the high-resolution folder exists and delete its contents
        if (File::exists($highResFolderPath)) {
            File::deleteDirectory($highResFolderPath, true); // true to delete contents as well
        }
    
        // Check if the low-resolution folder exists and delete its contents
        if (File::exists($lowResFolderPath)) {
            File::deleteDirectory($lowResFolderPath, true); // true to delete contents as well
        }
    
        return redirect()->route('album.index')->withSuccess('All albums and associated images deleted successfully.');
    }
}