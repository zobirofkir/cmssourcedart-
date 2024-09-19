<?php

namespace App\Services\Services;

use App\Services\Construct\UploadConstruct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Str;


class UploadService implements UploadConstruct
{
    /**
     * Show the application dashboard.
     *
     * @return void
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate(['file' => 'required|file' ]);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $uploadPath = 'project/'; 

        $file->move($uploadPath, $filename);

        if ($file->getClientOriginalExtension() === 'zip') {
            $zip = new ZipArchive;
            $zipPath = $uploadPath . $filename;
            $destinationPath = $uploadPath . pathinfo($filename, PATHINFO_FILENAME);

            if ($zip->open($zipPath) === TRUE) {
                $zip->extractTo($destinationPath);
                $zip->close();
                unlink($zipPath);
            } else {
                return redirect()->back()->with('error', 'Failed to unzip the file.');
            }
        }

        return redirect()->route('projects.index')->with('success', 'Project uploaded successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param [type] $name
     * @return void
     */
    public function destroy($name)
    {
        $projectPath = 'project/' . $name;

        if (is_dir($projectPath)) {
            $this->deleteDirectory($projectPath);
            return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
        }

        return redirect()->route('projects.index')->with('error', 'Project not found.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param [type] $name
     * @return void
     */
    public function updatePath(Request $request, $name)
    {
        $request->validate([
            'new_path' => 'required|string',
        ]);
    
        $baseDir = 'project/';
        $oldPath = $baseDir . $name;
        $newPath = realpath($baseDir . $request->input('new_path'));
    
        if (!is_dir($oldPath)) {
            return redirect()->route('projects.index')->with('error', 'Project not found.');
        }
    
        if ($newPath === false || !Str::startsWith($newPath, $baseDir)) {
            return redirect()->route('projects.index')->with('error', 'Invalid path provided.');
        }
    
        if (is_dir($newPath)) {
            return redirect()->route('projects.index')->with('error', 'New path already exists.');
        }
    
        if (rename($oldPath, $newPath)) {
            return redirect()->route('projects.index')->with('success', 'Project path updated successfully.');
        }
    
        return redirect()->route('projects.index')->with('error', 'Failed to update project path.');
    }
    
    /**
     * Delete a directory and all of its contents.
     *
     * @param [type] $dir
     * @return void
     */
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