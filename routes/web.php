<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookApiController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::middleware('auth')->group(function () {

    Route::get('/about', function () {
        return view('about');
    })->name('about');

    Route::get('/books', [BookController::class, 'catalog'])->name('books');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Route::resource('book', BookController::class);
    Route::apiResource('api/book', BookApiController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
