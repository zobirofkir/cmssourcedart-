<?php
namespace App\Services\Construct;

use App\Http\Requests\AlbumRequest;

interface AlbumConstructor
{

    /**
     * Show the application dashboard.
     *
     * @return void
     */
    public function index();

    public function create();
    
    public function store(AlbumRequest $request);

    public function show($id);

    public function edit($id);

    public function update(AlbumRequest $request, $id);

    public function destroy();
}