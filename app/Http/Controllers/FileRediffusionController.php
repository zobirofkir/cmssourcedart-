<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileRediffusionController extends Controller
{
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

    public function edit($file)
    {
        $filePath = public_path("project/application/assets/$file");
        $content = file_get_contents($filePath);

        return view('themes.files.edit', compact('content', 'file'));
    }

    public function update(Request $request, $file)
    {
        $filePath = public_path("project/application/assets/$file");
        file_put_contents($filePath, $request->input('content'));

        return redirect()->back()->with('success', 'File updated successfully!');
    }
}
