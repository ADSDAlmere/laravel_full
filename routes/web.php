<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

// Route::middleware('auth')->resource('books', BookController::class);
// met deze regel code kan je de volgende regels code vervangen, maar dan moet je de BookController.php aanpassen
// er komt dan een extra functie bij in de BookController.php, namelijk de functie store
Route::middleware('auth')->group(function () {
    Route::get('/book', [BookController::class, 'index'])->name('book.index');
    Route::get('/book/create', [BookController::class, 'edit'])->name('book.create');
    Route::get('/book/{book}', [BookController::class, 'edit'])->name('book.edit');
    Route::post('/book/{book?}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/book/{book}', [BookController::class, 'destroy'])->name('book.destroy');
}); // name mag je weglaten

require __DIR__.'/auth.php';
