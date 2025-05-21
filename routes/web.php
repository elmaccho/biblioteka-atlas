<?php

use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategorieController;
use App\Http\Controllers\KsiazkaController;
use App\Http\Controllers\Librarian\LibrarianPanelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RezerwacjaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WypozyczeniaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kategorie', [KategorieController::class, 'index'])->name('kategorie');
Route::get('/ksiazka/{id}', [KsiazkaController::class, 'show'])->name('ksiazka');
Route::get('/kategoria/{id}/ksiazki', [KsiazkaController::class, 'byKategoria'])->name('kategoria.ksiazki');

Route::middleware('auth')->group(function () {
    Route::get('/moje_rezerwacje', [RezerwacjaController::class, 'index'])->name('rezerwacje.index');
    Route::get('/ustawienia', [UserController::class, 'edit'])->name('ustawienia');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/rezerwacje', [RezerwacjaController::class, 'store'])->name('rezerwacje.store');
    Route::get('/moje_wypozyczenia', [WypozyczeniaController::class, 'index'])->name('wypozyczenia.index');

    Route::middleware(['auth', 'role:admin'])->prefix('panel-administracyjny')->name('admin.')->group(function () {
        Route::get('/', [AdminPanelController::class, 'index'])->name('index');

        Route::get('/uzytkownicy/{page?}', [AdminPanelController::class, 'users'])
            ->where('page', 'index|activity_report')
            ->name('users');
    });

    Route::middleware(['auth', 'role:librarian|admin'])->prefix('panel-bibliotekarza')->name('librarian.')->group(function () {
        Route::get('/', [LibrarianPanelController::class, 'index'])->name('index');

        Route::get('/wypozyczenia/{page?}', [LibrarianPanelController::class, 'rentals'])->name('rentals');
        Route::get('/rezerwacje/{page?}', [LibrarianPanelController::class, 'reservations'])->name('reservations');


        // Funkcjonalności rezerwacji
        Route::patch('/rezerwacje/{id}/cancel', [LibrarianPanelController::class, 'cancel'])->name('rezerwacje.cancel');
        Route::patch('/rezerwacje/{id}/realize', [LibrarianPanelController::class, 'realize'])->name('rezerwacje.realize');
        
        // Funkcjonalności wypożyczenia
        Route::patch('/wypozyczenia/{id}/return', [LibrarianPanelController::class, 'return'])->name('wypozyczenie.return');
    });
});

require __DIR__ . '/auth.php';
