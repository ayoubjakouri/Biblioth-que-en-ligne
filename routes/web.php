<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookApiController;
use App\Http\Controllers\SendBookMailController;
use Illuminate\Support\Facades\Session;

Route::get('/', [BookController::class, 'home'])->name('index');

Route::get('lang/{locale}', function (string $locale) {
    if (!in_array($locale, ['en', 'fr'])) {
        abort(400);
    }

    Session::put('locale', $locale);

    return redirect()->back();
})->name('lang');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/about', function () {
        return view('about');
    })->name('about');

    Route::get('/books', [BookController::class, 'catalog'])->name('books');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Route::post('/send-book/{book}', [SendBookMailController::class, 'sendBook'])->name('email.send');

    Route::resource('book', BookController::class);
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::apiResource('api/book', BookApiController::class)->middleware('auth:sanctum');


require __DIR__ . '/auth.php';
