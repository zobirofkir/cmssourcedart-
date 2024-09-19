<?php

namespace App\Services\Services;

use App\Services\Construct\EposterConstruct;
use App\Http\Requests\EposterRequest;
use Illuminate\Support\Facades\File;


class  EposterService implements EposterConstruct
{
    public function index()
    {
        $images = File::files(public_path('project/application/e-poster/images'));
        $imageNames = array_map(fn($file) => $file->getFilename(), $images);
        return view('eposter.index', ['images' => $imageNames]);
    }
    
    public function create()
    {
        return view('eposter.create');
    }

    public function store(EposterRequest $request)
    {
        $request->validated();

        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $filePath = public_path('project/application/e-poster/images');

        if (!File::isDirectory($filePath)) {
            File::makeDirectory($filePath, 0755, true);
        }

        try {
            $file->move($filePath, $fileName);
            return redirect()->route('eposter.index')->with('success', 'Image uploaded successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Failed to upload image: ' . $e->getMessage());
        }
    }

    public function edit($imageName)
    {
        $filePath = public_path("project/application/e-poster/images/$imageName");
    
        if (!File::exists($filePath)) {
            return redirect()->route('eposter.index')->withErrors('Image not found.');
        }
    
        return view('eposter.edit', compact('imageName'));
    }
    
    public function update(EposterRequest $request, $imageName)
    {
        $request->validated();

        $filePath = public_path("project/application/e-poster/images/$imageName");

        if (!File::exists($filePath)) {
            return redirect()->route('eposter.index')->withErrors('Image not found.');
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $newFileName = $file->getClientOriginalName();
            $newFilePath = public_path('project/application/e-poster/images');

            if (!File::isDirectory($newFilePath)) {
                File::makeDirectory($newFilePath, 0755, true);
            }

            File::delete($filePath);

            try {
                $file->move($newFilePath, $newFileName);
                return redirect()->route('eposter.index')->with('success', 'Image updated successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors('Failed to update image: ' . $e->getMessage());
            }
        }

        return redirect()->back()->withErrors('No file uploaded.');
    }

    public function destroy($imageName)
    {
        $filePath = public_path("project/application/e-poster/images/$imageName");

        if (File::exists($filePath)) {
            File::delete($filePath);
            return redirect()->route('eposter.index')->with('success', 'Image deleted successfully.');
        }

        return redirect()->route('eposter.index')->withErrors('Image not found.');
    }
}