<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ComentarioController;

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
    Route::middleware(['auth'])->group(function () {
    
        Route::get('/comentario', [ComentarioController::class, 'index'])->name('comentario/index');
        Route::get('/comentario/create', [ComentarioController::class, 'create'])->name('comentario/create');
        Route::post('/comentario/store', [ComentarioController::class, 'store'])->name('comentario/store');
        Route::get('/comentario/edit', [ComentarioController::class, 'edit'])->name('comentario/edit');
        Route::put('/comentario/edit/{id}', [ComentarioController::class, 'update'])->name('comentario/update');
        Route::get('/comentario/delete/{id}', [ComentarioController::class, 'delete'])->name('comentario/delete');
    
    });
require __DIR__.'/auth.php';
