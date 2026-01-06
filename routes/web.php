<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookApiController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/books', function () {
    return view('books');
})->name('books');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::resource('book', BookController::class);

Route::apiResource('api/book', BookApiController::class);
