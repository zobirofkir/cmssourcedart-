<?php

namespace App\Services\Construct;

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
    public function store(Request $request);

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
    public function update(Request $request, $day, $videoName);

    /**
     * Remove the specified video from storage.
     *
     * @param string $videoName
     * @return void
     */
    public function destroy($day, $videoName);
}
