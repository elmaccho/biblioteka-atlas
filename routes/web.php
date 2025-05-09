<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategorieController;
use App\Http\Controllers\KsiazkaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kategorie', [KategorieController::class, 'index'])->name('kategorie');
Route::get('/ksiazka/{id}', [KsiazkaController::class, 'show'])->name('ksiazka');
Route::get('/kategoria/{id}/ksiazki', [KsiazkaController::class, 'byKategoria'])->name('kategoria.ksiazki');

// Route::get('/', function () {
//     return view('');
// })->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
