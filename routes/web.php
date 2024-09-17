<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
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
});

require __DIR__.'/auth.php';
