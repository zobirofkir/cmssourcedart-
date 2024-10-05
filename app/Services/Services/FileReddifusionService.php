<?php

namespace App\Services\Services;

use App\Services\Construct\FileReddifusionConstruct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class FileReddifusionService implements FileReddifusionConstruct
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $directory = public_path('project/application/assets');
        $trashDirectory = public_path('project/application/trash');

        $files = array_filter(scandir($directory), function($item) use ($directory) {
            return !is_dir($directory . DIRECTORY_SEPARATOR . $item) && pathinfo($item, PATHINFO_EXTENSION) === 'html';
        });

        $trashFiles = array_filter(scandir($trashDirectory), function($item) use ($trashDirectory) {
            return !is_dir($trashDirectory . DIRECTORY_SEPARATOR . $item) && pathinfo($item, PATHINFO_EXTENSION) === 'html';
        });

        $filesList = array_map(function($file) use ($trashFiles) {
            return [
                'name' => $file,
                'in_trash' => in_array($file, $trashFiles)
            ];
        }, $files);

        return view('themes.files.index', compact('filesList', 'trashFiles'));
    }        

        
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'file_name' => 'required|string',
        ]);

        // Create filename and content variables
        $fileName = $request->input('file_name') . '.html';
        $content = $request->input('content');
        $path = public_path("project/application/assets/{$fileName}");  // Ensure "themes" directory

        if (!File::exists(dirname($path))) {
            try {
                File::makeDirectory(dirname($path), 0755, true);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors('Failed to create directory: ' . $e->getMessage());
            }
        }

        try {
            File::put($path, $content);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Failed to write file: ' . $e->getMessage());
        }

        return redirect()->route('files.index')->with('success', 'HTML file created successfully.');
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
        $request->validate([
            'content' => 'required',
        ]);
    
        $filePath = public_path("project/application/assets/$file");
    
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


    /**
     * Remove the specified resource from storage (soft delete).
     *
     * @param string $file
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($file)
    {
        $filePath = public_path("project/application/assets/$file");
        $trashPath = public_path("project/application/trash/$file");

        // Ensure trash directory exists
        if (!File::exists(public_path("project/application/trash"))) {
            File::makeDirectory(public_path("project/application/trash"), 0755, true);
        }

        // Move the file to the trash folder for soft delete
        if (File::exists($filePath)) {
            File::move($filePath, $trashPath);

            return redirect()->route('files.index')->with('success', 'File deleted successfully.');
        }

        return redirect()->route('files.index')->withErrors('File not found.');
    }

    /**
     * Restore a file from the trash.
     *
     * @param string $file
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($file)
    {
        $trashPath = public_path("project/application/trash/$file");
        $filePath = public_path("project/application/assets/$file");

        // Restore the file from trash
        if (File::exists($trashPath)) {
            File::move($trashPath, $filePath);

            return redirect()->route('files.index')->with('success', 'File restored successfully.');
        }

        return redirect()->route('files.index')->withErrors('File not found in trash.');
    }

}