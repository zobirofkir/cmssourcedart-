<?php

namespace App\Services\Services;

use App\Services\Construct\FileReddifusionConstruct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileReddifusionService implements FileReddifusionConstruct
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        // Define the path to the directory containing HTML files
        $directory = public_path('project/application/assets');

        // Get all files from the directory and filter for HTML files
        $files = array_filter(scandir($directory), function($item) use ($directory) {
            return !is_dir($directory . DIRECTORY_SEPARATOR . $item) && pathinfo($item, PATHINFO_EXTENSION) === 'html';
        });

        return view('themes.files.index', compact('files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param [type] $file
     * @return void
     */
    public function edit($file)
    {
        $filePath = public_path("project/application/assets/$file");
        $content = file_get_contents($filePath);

        return view('themes.files.edit', compact('content', 'file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param [type] $file
     * @return void
     */
    public function update(Request $request, $file)
    {
        // Validate that 'content' field is provided
        $request->validate([
            'content' => 'required',
        ]);
    
        $filePath = public_path("project/application/assets/$file");
    
        // Check if the file exists before attempting to write
        if (file_exists($filePath)) {
            try {
                file_put_contents($filePath, $request->input('content'));
                return response()->json(['success' => 'File updated successfully!']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Could not save the file. ' . $e->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }

}