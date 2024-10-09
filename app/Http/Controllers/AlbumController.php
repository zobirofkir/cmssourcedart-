<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Services\Facades\AlbumFacade;
use Illuminate\Http\Request;

class AlbumController extends Controller
{

    public function index(){
        return AlbumFacade::index();
    }

    public function create(){
        return AlbumFacade::create();
    }

    public function store(AlbumRequest $request){
        return AlbumFacade::store($request);
    }

    public function show($id){
        return AlbumFacade::show($id);
    }

    public function edit($id){
        return AlbumFacade::edit($id);
    }   

    public function update(AlbumRequest $request, $id){
        return AlbumFacade::update($request, $id);
    }

    public function destroy($id){
        return AlbumFacade::destroy($id);
    }
}
