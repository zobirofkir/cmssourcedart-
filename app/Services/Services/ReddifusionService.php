<?php
namespace App\Services\Services;

use App\Http\Requests\ReddifusionRequest;
use App\Services\Construct\ReddifusionConstruct;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ReddifusionService implements ReddifusionConstruct
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $basePath = public_path('project/application/assets/thems');
        
        $days = File::directories($basePath);

        $themes = [];
        foreach ($days as $day) {
            $dayName = basename($day);
            $themes[$dayName] = File::files($day);
        }

        $existingDaysThemes = array_keys($themes);

        $basePath = public_path('project/application/assets/videos');

        $days = File::directories($basePath);
        $videoFiles = [];

        foreach ($days as $day) {
            $dayName = basename($day);
            $videoFiles[$dayName] = File::files($day);
        }

        $existingDays = array_keys($videoFiles);

        return view('themes.index', compact('themes', 'existingDaysThemes', 'videoFiles', 'existingDays'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(ReddifusionRequest $request)
    {
        $request->validated();

        $day = $request->input('day');
        $theme = $request->input('theme');
        $image = $request->file('image');

        $path = public_path("project/application/assets/thems/$day");

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $image->move($path, $theme . '.' . $image->getClientOriginalExtension());

        return redirect()->route('themes.index')->withSuccess('Theme added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param [type] $day
     * @param [type] $theme
     * @return void
     */
    public function edit($day, $theme)
    {
        $themePath = public_path("project/application/assets/thems/$day/$theme");
        
        if (File::exists($themePath)) {
            $themeContent = File::get($themePath);
            return view('themes.edit', compact('themeContent', 'day', 'theme'));
        }

        return redirect()->back()->withErrors('Theme not found.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param [type] $day
     * @param [type] $theme
     * @return void
     */
    public function update(ReddifusionRequest $request, $day, $theme)
    {
        $themePath = public_path("project/application/assets/thems/$day/$theme");

        if (File::exists($themePath)) {
            File::put($themePath, $request->input('content'));

            if ($request->hasFile('image')) {
                $image = $request->file('image');

                if ($image->isValid()) {
                    $newImagePath = public_path("project/application/assets/thems/$day/$theme");

                    $image->move(dirname($newImagePath), basename($theme));
                }
            }

            return redirect()->route('themes.index')->withSuccess('Theme updated successfully.');
        }

        return redirect()->back()->withErrors('Unable to update theme.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param [type] $day
     * @param [type] $theme
     * @return void
     */
    public function destroy($day, $theme)
    {
        $filePath = public_path("project/application/assets/thems/$day/$theme");

        if (File::exists($filePath)) {
            File::delete($filePath);
            return redirect()->route('themes.index')->withSuccess('Theme deleted successfully.');
        }

        return redirect()->back()->withErrors('Theme not found.');
    }

    /**
     * Store a newly created day in storage.
     *
     * @param Request $request
     * @return void
     */
    public function createDay(Request $request)
    {
        $request->validate([
            'day' => 'required|string',
            'file' => 'required|file|mimes:png',
        ]);
    
        $day = $request->input('day');
        $path = public_path("project/application/assets/thems/$day");
    
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
    
            $file = $request->file('file');
            $file->move($path, $file->getClientOriginalName());
    
            return redirect()->route('themes.index')->withSuccess('Day created successfully.');
        }
    
        return redirect()->route('themes.index')->withErrors('Day already exists.');
    }
    
    
    /**
     * Remove the specified day from storage.
     *
     * @param string $day
     * @return void
     */
    public function destroyDay($day)
    {
        $path = public_path("project/application/assets/thems/$day");

        if (File::exists($path)) {
            File::deleteDirectory($path);
            return redirect()->route('themes.index')->withSuccess('Day deleted successfully.');
        }

        return redirect()->back()->withErrors('Day not found.');
    }

}