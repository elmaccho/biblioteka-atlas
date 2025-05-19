<?php

use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategorieController;
use App\Http\Controllers\KsiazkaController;
use App\Http\Controllers\Librarian\LibrarianPanelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RezerwacjaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kategorie', [KategorieController::class, 'index'])->name('kategorie');
Route::get('/ksiazka/{id}', [KsiazkaController::class, 'show'])->name('ksiazka');
Route::get('/kategoria/{id}/ksiazki', [KsiazkaController::class, 'byKategoria'])->name('kategoria.ksiazki');

// Route::get('/', function () {
//     return view('');
// })->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/moje_rezerwacje', [RezerwacjaController::class, 'index'])->name('rezerwacje.index');
    Route::get('/ustawienia', [UserController::class, 'edit'])->name('ustawienia');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/rezerwacje', [RezerwacjaController::class, 'store'])->name('rezerwacje.store');

    Route::middleware('role:admin')->group(function () {
        Route::get('/panel-administracyjny', [AdminPanelController::class, 'index'])->name('admin.dashboard');
    });

    Route::middleware('role:librarian|admin')->group(function () {
        Route::get('/panel-bibliotekarza', [LibrarianPanelController::class, 'index'])->name('librarian.dashboard');
    });
});

require __DIR__.'/auth.php';
