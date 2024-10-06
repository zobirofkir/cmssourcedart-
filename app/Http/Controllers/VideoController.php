<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Services\Facades\VideoFacade;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        return VideoFacade::index();
    }
    
    public function store(VideoRequest $request)
    {
        return VideoFacade::store($request);
    }
    
    public function edit($day, $videoName)
    {
        return VideoFacade::edit($day, $videoName);
    }
    
    public function update(VideoRequest $request, $day, $videoName)
    {
        return VideoFacade::update($request, $day, $videoName);
    }
    
    public function destroy($day, $videoName)
    {
        return VideoFacade::destroy($day, $videoName);
    }
    
    public function createDay(VideoRequest $request)
    {
        return VideoFacade::createDay($request);
    }
    
    public function destroyDay($day)
    {
        return VideoFacade::destroyDay($day);
    }
}
