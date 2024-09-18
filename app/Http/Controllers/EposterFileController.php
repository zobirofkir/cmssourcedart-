<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EposterFileController extends Controller
{
    public function index()
    {
        // Define the path to the directory containing files
        $directory = public_path('project/application/e-poster');

        // Get all files from the directory
        $files = array_filter(scandir($directory), function($item) use ($directory) {
            return !is_dir($directory . DIRECTORY_SEPARATOR . $item);
        });

        return view('eposter.files.index', compact('files'));
    }

    public function edit($file)
    {
        $filePath = public_path("project/application/e-poster/$file");
        $content = '';

        // Load content based on file type
        if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['html', 'css', 'js'])) {
            $content = file_get_contents($filePath);
        }

        return view('eposter.files.edit', compact('content', 'file'));
    }

    public function update(Request $request, $file)
    {
        $filePath = public_path("project/application/e-poster/$file");
        file_put_contents($filePath, $request->input('content'));

        return redirect()->back()->with('success', 'File updated successfully!');
    }
}
