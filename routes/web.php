<?php

use App\Http\Controllers\EposterController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgrameController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');
    Route::get('/themes/edit/{day}/{theme}', [ThemeController::class, 'edit'])->name('themes.edit');
    Route::post('/themes/update/{day}/{theme}', [ThemeController::class, 'update'])->name('themes.update');
    Route::put('/themes/update/{day}/{theme}', [ThemeController::class, 'update'])->name('themes.update');
    Route::post('/themes', [ThemeController::class, 'store'])->name('themes.store');
    Route::delete('/themes/{day}/{theme}', [ThemeController::class, 'destroy'])->name('themes.destroy'); 


    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/edit/{itemName}', [ItemController::class, 'edit'])->name('items.edit');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::put('/items/update/{itemName}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/delete/{itemName}', [ItemController::class, 'destroy'])->name('items.destroy');


    Route::get('/programme', [ProgrameController::class, 'index'])->name('programme.index');
    Route::get('/programme/edit/{pdfName}', [ProgrameController::class, 'edit'])->name('programme.edit');
    Route::put('/programme/update/{pdfName}', [ProgrameController::class, 'update'])->name('programme.update');
    Route::delete('/programme/delete/{pdfName}', [ProgrameController::class, 'destroy'])->name('programme.destroy');
    Route::post('/programme', [ProgrameController::class, 'store'])->name('programme.store');

    Route::get('/eposter', [EposterController::class, 'index'])->name('eposter.index');
    Route::get('/eposter/create', [EposterController::class, 'create'])->name('eposter.create');
    Route::post('/eposter', [EposterController::class, 'store'])->name('eposter.store');
    Route::delete('/eposter/{imageName}', [EposterController::class, 'destroy'])->name('eposter.destroy');
    Route::get('/eposter/{imageName}/edit', [EposterController::class, 'edit'])->name('eposter.edit');
    Route::put('/eposter/{imageName}', [EposterController::class, 'update'])->name('eposter.update');
    
    Route::get('/eposter/export', [ExportController::class, 'export'])->name('project.export');
});

require __DIR__.'/auth.php';
