<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file', // Removed mime type restriction
        ]);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $uploadPath = 'project/'; // Your target path

        // Move the uploaded file to the target directory with its original name
        $file->move($uploadPath, $filename);

        // If the file is a ZIP file, handle extraction
        if ($file->getClientOriginalExtension() === 'zip') {
            $zip = new ZipArchive;
            $zipPath = $uploadPath . $filename;
            $destinationPath = $uploadPath . pathinfo($filename, PATHINFO_FILENAME);

            if ($zip->open($zipPath) === TRUE) {
                $zip->extractTo($destinationPath);
                $zip->close();
                // Remove the zip file after extraction
                unlink($zipPath);
            } else {
                return redirect()->back()->with('error', 'Failed to unzip the file.');
            }
        }

        return redirect()->route('projects.index')->with('success', 'Project uploaded successfully.');
    }

    public function index()
    {
        $files = array_diff(scandir('project/'), ['..', '.']);
        $projects = array_map(function ($file) {
            return (object) [
                'name' => pathinfo($file, PATHINFO_FILENAME),
                'path' => 'project/' . $file
            ];
        }, $files);

        return view('projects.index', compact('projects'));
    }

    public function destroy($name)
    {
        $projectPath = 'project/' . $name;

        // Check if project directory exists
        if (is_dir($projectPath)) {
            // Delete the directory and its contents
            $this->deleteDirectory($projectPath);
            return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
        }

        return redirect()->route('projects.index')->with('error', 'Project not found.');
    }

    public function updatePath(Request $request, $name)
    {
        $request->validate([
            'new_path' => 'required|string',
        ]);
    
        $baseDir = 'project/';
        $oldPath = $baseDir . $name;
        $newPath = realpath($baseDir . $request->input('new_path'));
    
        // Ensure the old path exists
        if (!is_dir($oldPath)) {
            return redirect()->route('projects.index')->with('error', 'Project not found.');
        }
    
        // Check if the new path is within the base directory
        if ($newPath === false || !Str::startsWith($newPath, $baseDir)) {
            return redirect()->route('projects.index')->with('error', 'Invalid path provided.');
        }
    
        // Ensure the new path does not already exist
        if (is_dir($newPath)) {
            return redirect()->route('projects.index')->with('error', 'New path already exists.');
        }
    
        // Perform the rename operation
        if (rename($oldPath, $newPath)) {
            return redirect()->route('projects.index')->with('success', 'Project path updated successfully.');
        }
    
        return redirect()->route('projects.index')->with('error', 'Failed to update project path.');
    }
    
    private function deleteDirectory($dir)
    {
        if (is_dir($dir)) {
            $items = array_diff(scandir($dir), ['.', '..']);
            foreach ($items as $item) {
                $path = $dir . DIRECTORY_SEPARATOR . $item;
                is_dir($path) ? $this->deleteDirectory($path) : unlink($path);
            }
            rmdir($dir);
        }
    }
}
