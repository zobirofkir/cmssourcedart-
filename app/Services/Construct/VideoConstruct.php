<?php

namespace App\Services\Construct;

use App\Http\Requests\VideoRequest;
use Illuminate\Http\Request;

interface VideoConstruct
{
    /**
     * Display a listing of the videos.
     *
     * @return void
     */
    public function index();

    /**
     * Store a newly created video in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(VideoRequest $request);

    /**
     * Show the form for editing the specified video.
     *
     * @param string $videoName
     * @return void
     */
    public function edit($day, $videoName);

    /**
     * Update the specified video in storage.
     *
     * @param Request $request
     * @param string $videoName
     * @return void
     */
    public function update(VideoRequest $request, $day, $videoName);

    /**
     * Remove the specified video from storage.
     *
     * @param string $videoName
     * @return void
     */
    public function destroy($day, $videoName);
}
