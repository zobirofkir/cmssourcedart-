<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ItemFileController extends Controller
{
    public function index()
    {
        // Define the path to the directory containing HTML files
        $directory = public_path('project/');

        // Get all files from the directory and filter for HTML files
        $files = array_filter(scandir($directory), function($item) use ($directory) {
            return !is_dir($directory . DIRECTORY_SEPARATOR . $item) && pathinfo($item, PATHINFO_EXTENSION) === 'html';
        });

        return view('items.files.index', compact('files'));
    }

    public function edit($file)
    {
        $filePath = public_path("project/$file");

        // Check if the file exists
        if (!File::exists($filePath)) {
            abort(404, 'File not found');
        }

        $content = '';

        // Load content based on file type
        if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['html', 'css', 'js'])) {
            $content = File::get($filePath);
        }

        return view('items.files.edit', ['content' => $content, 'file' => $file]);
    }

    public function update(Request $request, $file)
    {
        $filePath = public_path("project/$file");

        // Check if the file exists
        if (!File::exists($filePath)) {
            return redirect()->back()->withErrors('File not found');
        }

        // Validate and update the file content
        $request->validate([
            'content' => 'required|string',
        ]);

        File::put($filePath, $request->input('content'));

        return redirect()->route('itemsfiles.index')->with('success', 'File updated successfully!');
    }
}
