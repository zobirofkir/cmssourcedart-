<?php

use App\Http\Controllers\EposterController;
use App\Http\Controllers\EposterFileController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FileReddifusionController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemFileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\ReddifusionController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    /**
     * Profile Controller routes
     */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * Reddifusion Controller routes
     */
    Route::get('/reddifusion', [ReddifusionController::class, 'index'])->name('themes.index');
    Route::get('/reddifusion/edit/{day}/{theme}', [ReddifusionController::class, 'edit'])->name('themes.edit');
    Route::post('/reddifusion/update/{day}/{theme}', [ReddifusionController::class, 'update'])->name('themes.update');
    Route::put('/reddifusion/update/{day}/{theme}', [ReddifusionController::class, 'update'])->name('themes.update');
    Route::post('/reddifusion', [ReddifusionController::class, 'store'])->name('themes.store');
    Route::delete('/reddifusion/{day}/{theme}', [ReddifusionController::class, 'destroy'])->name('themes.destroy'); 
    Route::post('themes/create-day', [ReddifusionController::class, 'createDay'])->name('themes.createDay');
    Route::delete('themes/destroy-day/{day}', [ReddifusionController::class, 'destroyDay'])->name('themes.destroyDay');


    /**
     * Items Controller routes
     */
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/edit/{itemName}', [ItemController::class, 'edit'])->name('items.edit');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::put('/items/update/{itemName}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/delete/{itemName}', [ItemController::class, 'destroy'])->name('items.destroy');

    /**
     * Programme Controller routes
     */
    Route::get('/programme', [ProgrammeController::class, 'index'])->name('programme.index');
    Route::get('/programme/edit/{pdfName}', [ProgrammeController::class, 'edit'])->name('programme.edit');
    Route::put('/programme/update/{pdfName}', [ProgrammeController::class, 'update'])->name('programme.update');
    Route::delete('/programme/delete/{pdfName}', [ProgrammeController::class, 'destroy'])->name('programme.destroy');
    Route::post('/programme', [ProgrammeController::class, 'store'])->name('programme.store');

    /**
     * Eposter Controller routes
     */
    Route::get('/eposter', [EposterController::class, 'index'])->name('eposter.index');
    Route::get('/eposter/create', [EposterController::class, 'create'])->name('eposter.create');
    Route::post('/eposter', [EposterController::class, 'store'])->name('eposter.store');
    Route::delete('/eposter/{imageName}', [EposterController::class, 'destroy'])->name('eposter.destroy');
    Route::get('/eposter/{imageName}/edit', [EposterController::class, 'edit'])->name('eposter.edit');
    Route::put('/eposter/{imageName}', [EposterController::class, 'update'])->name('eposter.update');
    
    /**
     * File Rediffusion Controller routes
     */
    Route::get('/reddifusion/files', [FileReddifusionController::class, 'index'])->name('files.index');
    Route::get('/reddifusion/edit/{file}', [FileReddifusionController::class, 'edit'])->name('file.edit');
    Route::post('/reddifusion/update/{file}', [FileReddifusionController::class, 'update'])->name('file.update');
    Route::post('/reddifusion/store', [FileReddifusionController::class, 'store'])->name('file.store');
    Route::delete('/reddifusion/{file}', [FileReddifusionController::class, 'destroy'])->name('file.delete');
    Route::get('/reddifusion/{file}/restore', [FileReddifusionController::class, 'restore'])->name('file.restore');
    
    /**
     * Project Controller routes
     */
    Route::get('/projects', [UploadController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [UploadController::class, 'create'])->name('projects.create');
    Route::post('/projects', [UploadController::class, 'store'])->name('projects.store');
    Route::delete('/projects/{name}', [UploadController::class, 'destroy'])->name('projects.destroy');
    Route::put('/projects/{name}', [UploadController::class, 'updatePath'])->name('projects.updatePath');

    /**
     * Export Controller routes
     */
    Route::get('/eposter/export', [ExportController::class, 'export'])->name('project.export');
});

require __DIR__.'/auth.php';
