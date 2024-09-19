<?php
namespace App\Services\Services;

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

        $existingDays = array_keys($themes);

        return view('themes.index', compact('themes', 'existingDays'));
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
            'day' => 'required|string',
            'theme' => 'required|string',
            'image' => 'required|image',
        ]);

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
    public function update(Request $request, $day, $theme)
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
}