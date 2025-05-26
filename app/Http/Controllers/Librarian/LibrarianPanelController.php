<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use App\Models\Autor;
use App\Models\Kategoria;
use App\Models\Ksiazka;
use App\Models\Powiadomienie;
use App\Models\Rezerwacja;
use App\Models\User;
use App\Models\Wypozyczenie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibrarianPanelController extends Controller
{
    public function index()
    {
        return view('librarian.index');
    }

    // Książki
    public function books($page = 'index')
    {
        $ksiazki = Ksiazka::orderBy('created_at', 'desc')->paginate(20);
        $autorzy = Autor::all();
        $kategorie = Kategoria::all();

        $allowedPages = ['show', 'edit'];
        return $this->renderView('books', $page, $allowedPages, compact('ksiazki', 'autorzy', 'kategorie'));
    }
    public function edit($id)
    {
        $ksiazka = Ksiazka::findOrFail($id);
        $kategorie = Kategoria::all();
        $autorzy = Autor::all();

        return view('librarian.books.edit', compact('ksiazka', 'kategorie', 'autorzy'));
    }
    public function update(Request $request, $id)
    {
        $ksiazka = Ksiazka::findOrFail($id);

        $validated = $request->validate([
            'tytul' => 'required|string|max:255',
            'opis' => 'nullable|string',
            'amount' => 'required|integer|min:0',
            'img_src' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'autor_id' => 'required|integer',
            'kategoria_id' => 'required|integer',
        ]);

        if ($request->hasFile('img_src')) {
            if ($ksiazka->img_src && Storage::disk('public')->exists($ksiazka->img_src)) {
                Storage::disk('public')->delete($ksiazka->img_src);
            }

            $path = $request->file('img_src')->store('books', 'public');
            $validated['img_src'] = $path;
        }

        // dd($validated);

        $ksiazka->update($validated);

        return redirect()->route('librarian.books', 'show')->with('success', 'Książka zaktualizowana.');
    }

    // Wypożyczenia
    public function rentals($page = 'index')
    {
        $wypozyczenia = Wypozyczenie::orderBy('borrowed_at', 'desc')->paginate(20);
        $ksiazki = Ksiazka::select('id', 'tytul')->get();
        $users = User::select('id', 'name', 'lastname', 'email')->get();

        $allowedPages = ['index', 'new', 'archive', 'active'];
        return $this->renderView('rentals', $page, $allowedPages, compact('wypozyczenia', 'ksiazki', 'users'));
    }
    public function return($id)
    {
        $wypo = Wypozyczenie::findOrFail($id);
        $ksiazka = $wypo->ksiazka;

        $wypo->returned_at = now();
        $wypo->save();

        $ksiazka->amount += 1;
        $ksiazka->save();

        return redirect()->back()->with('success', 'Dodano zwrot');
    }
    public function storeRental(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'ksiazka_id' => 'required|exists:ksiazki,id',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $ksiazka = Ksiazka::findOrFail($validated['ksiazka_id']);
        if ($ksiazka->amount <= 0) {
            return redirect()->back()->with('error', 'Brak dostępnych egzemplarzy.');
        }

        $ksiazka->amount--;
        $ksiazka->save();

        Wypozyczenie::create([
            'user_id' => $validated['user_id'],
            'ksiazka_id' => $validated['ksiazka_id'],
            'borrowed_at' => now(),
            'due_date' => $validated['due_date'],
            'returned_at' => null,
        ]);

        return redirect()->back()->with('success', 'Wypożyczenie dodane.');
    }


    // Rezerwacje
    public function reservations($page = 'active')
    {
        $rezerwacje = Rezerwacja::orderBy('created_at', 'desc')->paginate(20);
        $allowedPages = ['archive', 'active'];
        return $this->renderView('reservations', $page, $allowedPages, compact('rezerwacje'));
    }
    public function cancel($id)
    {
        $rez = Rezerwacja::findOrFail($id);
        $rez->cancelled_at = now();
        $rez->save();

        $user = $rez->user;
        $ksiazka = $rez->ksiazka;
        Powiadomienie::create([
            'user_id' => $user->id,
            'tresc' => 'Anulowano rezerwację książki: ' . $ksiazka->tytul
        ]);

        return redirect()->back()->with('success', 'Rezerwacja została anulowana');
    }
    public function realize($id)
    {
        $rez = Rezerwacja::findOrFail($id);
        $ksiazka = $rez->ksiazka;

        if ($ksiazka->amount === null || $ksiazka->amount <= 0) {
            return redirect()->back()->with('error', 'Brak dostępnych egzemplarzy.');
        }

        $ksiazka->amount--;
        $ksiazka->save();

        $rez->zrealizowano = true;
        $rez->save();

        Wypozyczenie::create([
            'user_id' => $rez->user->id,
            'ksiazka_id' => $ksiazka->id,
            'borrowed_at' => now(),
            'due_date' => now()->addDays(30),
        ]);

        return redirect()->back()->with('success', 'Rezerwacja zrealizowana.');
    }


    // Użytkownicy
    public function users($page = 'users')
    {
        $users = User::paginate(20);
        $allowedPages = ['users', 'show'];
        return $this->renderView('users', $page, $allowedPages, compact('users'));
    }
    // Wyświetlenie profilu użytkownika
    public function userProfile($id)
    {
        $user = User::findOrFail($id);
        $ksiazki = Ksiazka::all();

        $wypozyczenia = Wypozyczenie::where('user_id', $id)->orderBy('borrowed_at', 'desc')->get();

        $wypozyczeniaAktywne = $wypozyczenia->whereNull('returned_at');
        $wypozyczeniaZwrócone = $wypozyczenia->whereNotNull('returned_at');

        $rezerwacje = Rezerwacja::where('user_id', $id)->orderBy('created_at', 'desc')->get();

        $rezerwacjeAktywne = $rezerwacje->whereNull('cancelled_at')->where('zrealizowano', false);
        $rezerwacjeZrealizowane = $rezerwacje->where('zrealizowano', true);
        $rezerwacjeAnulowane = $rezerwacje->whereNotNull('cancelled_at');

        return view('librarian.users.show', compact(
            'user',
            'ksiazki',
            'wypozyczeniaAktywne',
            'wypozyczeniaZwrócone',
            'rezerwacjeAktywne',
            'rezerwacjeZrealizowane',
            'rezerwacjeAnulowane'
        ));
    }


    // Dodanie wypożyczenia dla użytkownika
    public function addRental(Request $request, $id)
    {
        $validated = $request->validate([
            'ksiazka_id' => 'required|exists:ksiazki,id',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $ksiazka = Ksiazka::findOrFail($validated['ksiazka_id']);
        if ($ksiazka->amount <= 0) {
            return redirect()->back()->with('error', 'Brak dostępnych egzemplarzy.');
        }

        $ksiazka->amount--;
        $ksiazka->save();

        Wypozyczenie::create([
            'user_id' => $id,
            'ksiazka_id' => $validated['ksiazka_id'],
            'borrowed_at' => now(),
            'due_date' => $validated['due_date'],
            'returned_at' => null,
        ]);

        return redirect()->back()->with('success', 'Wypożyczenie dodane.');
    }
    // Dodanie rezerwacji dla użytkownika
    public function addReservation(Request $request, $id)
    {
        $validated = $request->validate([
            'ksiazka_id' => 'required|exists:ksiazki,id',
        ]);

        Rezerwacja::create([
            'user_id' => $id,
            'ksiazka_id' => $validated['ksiazka_id'],
            'created_at' => now(),
            'zrealizowano' => false,
        ]);

        return redirect()->back()->with('success', 'Rezerwacja dodana.');
    }


    // Przypomnienie o zbliżającym się zwrocie
    public function showReminderForm()
    {
        $users = User::all();
        $today = now()->startOfDay();
        $fiveDaysLater = now()->addDays(5)->endOfDay();

        $wypozyczenia = Wypozyczenie::whereNull('returned_at')
            ->whereBetween('due_date', [$today, $fiveDaysLater])
            ->get();

        return view('librarian.notifications.index', compact('users', 'wypozyczenia'));
    }

    public function sendReminder(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'ksiazka_id' => 'required|exists:wypozyczenia,ksiazka_id',
            'tresc' => 'required|string',
        ]);

        Powiadomienie::create([
            'user_id' => $request->user_id,
            'tresc' => $request->tresc,
        ]);

        return back()->with('success', 'Powiadomienie wysłane!');
    }


    private function renderView($folder, $page, $allowedPages, $data = [])
    {
        if (!in_array($page, $allowedPages)) {
            abort(404, "Podstrona nie istnieje");
        }

        return view("librarian.$folder.$page", $data);
    }
}
