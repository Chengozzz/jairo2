<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



    Route::middleware(['auth'])->group(function () {
    
        Route::get('/post', [PostController::class, 'index'])->name('post/index');
        Route::get('/post/create', [PostController::class, 'create'])->name('post/create');
        Route::post('/post/store', [PostController::class, 'store'])->name('post/store');
        Route::get('/post/edit', [PostController::class, 'edit'])->name('post/edit');
        Route::put('/post/edit/{id}', [PostController::class, 'update'])->name('post/update');
        Route::get('/post/delete/{id}', [PostController::class, 'delete'])->name('post/delete');
    
    });
    
require __DIR__.'/auth.php';
