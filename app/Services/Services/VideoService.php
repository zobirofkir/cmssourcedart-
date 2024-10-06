<?php

namespace App\Services\Services;

use App\Http\Requests\VideoRequest;
use App\Services\Construct\VideoConstruct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VideoService implements VideoConstruct
{
    /**
     * Display a listing of the videos, grouped by days.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $basePath = public_path('project/application/assets/videos');

        $days = File::directories($basePath);
        $videoFiles = [];

        foreach ($days as $day) {
            $dayName = basename($day);
            $videoFiles[$dayName] = File::files($day);
        }

        $existingDays = array_keys($videoFiles);

        return view('videos.index', compact('videoFiles', 'existingDays'));
    }

    /**
     * Store a newly created video in storage for a specific day.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VideoRequest $request)
    {
        $request->validated();
    
        $day = $request->input('day');
        $theme = $request->input('theme');
        $videoSource = $request->input('video_source');
        $path = public_path("project/application/assets/videos/$day");
    
        if ($videoSource === 'upload') {
            $video = $request->file('video');
    
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
            $video->move($path, $theme . '.' . $video->getClientOriginalExtension());
        } elseif ($videoSource === 'youtube') {

            $youtubeUrl = $request->input('youtube_url');    
            $filePath = "$path/{$theme}.txt";
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
            File::put($filePath, $youtubeUrl);
        }
        return redirect()->route('videos.index')->withSuccess('Video added successfully.');
    }
    
    /**
     * Show the form for editing the specified video.
     *
     * @param string $day
     * @param string $videoName
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($day, $videoName)
    {
        $videoPath = public_path("project/application/assets/videos/$day/$videoName");
        
        if (File::exists($videoPath)) {
            // You might want to read the content or any other necessary data here
            return view('videos.edit', compact('day', 'videoName'));
        }
    
        return redirect()->route('videos.index')->withErrors('Video not found.');
    }
    
    /**
     * Update the specified video in storage.
     *
     * @param Request $request
     * @param string $day
     * @param string $videoName
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VideoRequest $request, $day, $videoName)
    {
        $videoPath = public_path("project/application/assets/videos/$day/$videoName");
    
        if (File::exists($videoPath)) {
            $request->validated();
    
            if ($request->hasFile('video')) {
                $video = $request->file('video');
    
                if ($video->isValid()) {
                    File::delete($videoPath);
    
                    $video->move(dirname($videoPath), $videoName);
                }
            }
    
            return redirect()->route('videos.index')->withSuccess('Video updated successfully.');
        }
    
        return redirect()->back()->withErrors('Unable to update video.');
    }
    
    /**
     * Remove the specified video from storage.
     *
     * @param string $day
     * @param string $videoName
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($day, $videoName)
    {
        $videoPath = public_path("project/application/assets/videos/$day/$videoName");

        if (File::exists($videoPath)) {
            File::delete($videoPath);
            return redirect()->route('videos.index')->with('success', 'Video deleted successfully.');
        }

        return redirect()->route('videos.index')->withErrors('Video not found.');
    }

    /**
     * Create a new day directory.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createDay(Request $request)
    {
        $request->validate([
            'day' => 'required|string',
        ]);

        $day = $request->input('day');
        $path = public_path("project/application/assets/videos/$day");

        // Check if the directory already exists
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
            return redirect()->route('videos.index')->with('success', 'Day created successfully.');
        }

        return redirect()->route('videos.index')->withErrors('Day already exists.');
    }

    /**
     * Remove the specified day from storage.
     *
     * @param string $day
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyDay($day)
    {
        $path = public_path("project/application/assets/videos/$day");

        if (File::exists($path)) {
            File::deleteDirectory($path);
            return redirect()->route('videos.index')->with('success', 'Day deleted successfully.');
        }

        return redirect()->route('videos.index')->withErrors('Day not found.');
    }
}
