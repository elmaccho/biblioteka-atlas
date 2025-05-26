<?php

use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategorieController;
use App\Http\Controllers\KsiazkaController;
use App\Http\Controllers\Librarian\LibrarianPanelController;
use App\Http\Controllers\PowiadomieniaController;
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
    Route::patch('/rezerwacje/{id}/anuluj', [RezerwacjaController::class, 'cancel'])->name('rezerwacja.cancel');
    Route::get('/moje_wypozyczenia', [WypozyczeniaController::class, 'index'])->name('wypozyczenia.index');
    Route::get('/historia_wypozyczen', [WypozyczeniaController::class, 'history'])->name('wypozyczenia.historia');
    Route::get('/powiadomienia', [PowiadomieniaController::class, 'index'])->name('powiadomienia.index');
    Route::patch('/powiadomienia/{id}/przeczytaj', [PowiadomieniaController::class, 'marked'])->name('powiadomienia.przeczytaj');

    Route::middleware(['auth', 'role:admin'])->prefix('panel-administracyjny')->name('admin.')->group(function () {
        // == DASHBOARD GŁÓWNY ==
        Route::get('/', [AdminPanelController::class, 'index'])->name('index');

        // == KSIĄŻKI ==
        Route::get('/ksiazki/{page?}', [AdminPanelController::class, 'books'])->name('books');
        Route::post('/ksiazka', [AdminPanelController::class, 'store'])->name('books.store');
        Route::get('/ksiazka/{id}/edit', [AdminPanelController::class, 'edit'])->name('books.edit');
        Route::put('/ksiazka/{id}', [AdminPanelController::class, 'update'])->name('books.update');
        Route::delete('/ksiazka/{id}', [AdminPanelController::class, 'destroy'])->name('books.destroy');


        // == AUTORZY ==
        Route::get('/autorzy', [AdminPanelController::class, 'authors'])->name('authors');
        Route::get('/autorzy/nowy', [AdminPanelController::class, 'createAuthor'])->name('authors.create');
        Route::post('/autorzy', [AdminPanelController::class, 'storeAuthor'])->name('authors.store');
        Route::get('/autorzy/{id}/edit', [AdminPanelController::class, 'editAuthor'])->name('authors.edit');
        Route::put('/autorzy/{id}', [AdminPanelController::class, 'updateAuthor'])->name('authors.update');
        Route::delete('/autorzy/{id}', [AdminPanelController::class, 'destroyAuthor'])->name('authors.destroy');


        // == UŻYTKOWNICY ==
        Route::get('/uzytkownicy', [AdminPanelController::class, 'users'])->name('users');
        Route::get('/uzytkownicy/{id}/profil', [AdminPanelController::class, 'userProfile'])->name('users.profile');
        Route::post('/uzytkownicy/{id}/dodaj-wypozyczenie', [AdminPanelController::class, 'addRental'])->name('users.rental');
        Route::post('/uzytkownicy/{id}/dodaj-rezerwacje', [AdminPanelController::class, 'addReservation'])->name('users.reservation');
        
        
        // == POWIADOMIENIA ==
        Route::get('/powiadomienia', [AdminPanelController::class, 'notifications'])->name('notifications.history');
        
        
        // == SYSTEM ==
        Route::get('/admin_log', [AdminPanelController::class, 'adminlogs'])->name('system.adminlog');


        // == RAPORTY I STATYSTYKI ==
        Route::get('/raporty_i_statystyki', [AdminPanelController::class, 'raports'])->name('raports');
    });

    Route::middleware(['auth', 'role:librarian|admin'])->prefix('panel-bibliotekarza')->name('librarian.')->group(function () {
        // == DASHBOARD GŁÓWNY ==
        Route::get('/', [LibrarianPanelController::class, 'index'])->name('index');

        // == KSIĄŻKI ==
        Route::get('/ksiazki/{page?}', [LibrarianPanelController::class, 'books'])->name('books');
        Route::get('/ksiazka/{id}/edit', [LibrarianPanelController::class, 'edit'])->name('books.edit');
        Route::put('/ksiazka/{id}', [LibrarianPanelController::class, 'update'])->name('books.update');

        // == WYPOŻYCZENIA ==
        Route::get('/wypozyczenia/{page?}', [LibrarianPanelController::class, 'rentals'])->name('rentals');
        Route::patch('/wypozyczenia/{id}/return', [LibrarianPanelController::class, 'return'])->name('wypozyczenie.return');
        Route::post('/wypozyczenia/dodaj_wypozyczenie', [LibrarianPanelController::class, 'storeRental'])->name('wypozyczenie.dodaj');

        // == REZERWACJE ==
        Route::get('/rezerwacje/{page?}', [LibrarianPanelController::class, 'reservations'])->name('reservations');
        Route::patch('/rezerwacje/{id}/cancel', [LibrarianPanelController::class, 'cancel'])->name('rezerwacje.cancel');
        Route::patch('/rezerwacje/{id}/realize', [LibrarianPanelController::class, 'realize'])->name('rezerwacje.realize');

        // == UŻYTKOWNICY ==
        Route::get('/uzytkownicy', [LibrarianPanelController::class, 'users'])->name('users');
        Route::get('/uzytkownicy/{id}/profil', [LibrarianPanelController::class, 'userProfile'])->name('users.profile');
        Route::post('/uzytkownicy/{id}/dodaj-wypozyczenie', [LibrarianPanelController::class, 'addRental'])->name('users.rental');
        Route::post('/uzytkownicy/{id}/dodaj-rezerwacje', [LibrarianPanelController::class, 'addReservation'])->name('users.reservation');
    
        // == POWIADOMIENIA ==
        Route::get('/notifications/reminder', [LibrarianPanelController::class, 'showReminderForm'])->name('notifications.reminderForm');
        Route::post('/notifications/send', [LibrarianPanelController::class, 'sendReminder'])->name('notifications.sendReminder');
    
    });
});

require __DIR__ . '/auth.php';
