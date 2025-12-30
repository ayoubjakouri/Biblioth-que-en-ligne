<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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
