<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Autor;
use App\Models\Kategoria;
use App\Models\Ksiazka;
use App\Models\Log;
use App\Models\Powiadomienie;
use App\Models\Rezerwacja;
use App\Models\User;
use App\Models\Wypozyczenie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminPanelController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }


    // Książki
    public function books($page = 'index')
    {
        $ksiazki = Ksiazka::orderBy('created_at', 'desc')->paginate(20);
        $autorzy = Autor::all();
        $kategorie = Kategoria::all();

        $allowedPages = ['show', 'edit', 'new'];
        return $this->renderView('books', $page, $allowedPages, compact('ksiazki', 'autorzy', 'kategorie'));
    }
    public function destroy($id)
    {
        $ksiazka = Ksiazka::findOrFail($id);
        $ksiazka->delete();

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'Usunięcie książki',
            'details' => [
                'ksiazka' => $ksiazka->tytul,
            ],
        ]);

        return redirect()->back()->with('success', 'Książka została usunięta.');
    }
    public function edit($id)
    {
        $ksiazka = Ksiazka::findOrFail($id);
        $kategorie = Kategoria::all();
        $autorzy = Autor::all();

        return view('admin.books.edit', compact('ksiazka', 'kategorie', 'autorzy'));
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

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'Edycja książki',
            'details' => [
                'ksiazka' => $ksiazka->tytul,
            ],
        ]);

        $ksiazka->update($validated);

        return redirect()->route('admin.books', 'show')->with('success', 'Książka zaktualizowana.');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tytul' => 'required|string|max:255',
            'opis' => 'nullable|string',
            'amount' => 'required|integer|min:0',
            'img_src' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'autor_id' => 'required|integer',
            'kategoria_id' => 'required|integer'
        ]);

        if ($request->hasFile('img_src')) {
            $path = $request->file('img_src')->store('books', 'public');
            $validated['img_src'] = $path;
        }

        // dd($validated);

        Ksiazka::create($validated);

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'Dodanie książki',
            'details' => [
                'ksiazka' => $validated['tytul'],
            ],
        ]);

        return redirect()->route('admin.books', 'show')->with('success', 'Dodano nową książkę.');
    }

    // Autorzy
    public function authors($page = 'show')
    {
        $autorzy = Autor::orderBy('created_at', 'desc')->paginate(20);

        $allowedPages = ['show', 'new', 'edit'];
        return $this->renderView('authors', $page, $allowedPages, compact('autorzy'));
    }
    public function createAuthor()
    {
        $kategorie = Kategoria::all();
        $autorzy = Autor::all();

        return view('admin.authors.new', compact('kategorie', 'autorzy'));
    }
    public function storeAuthor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Autor::create($validated);

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'Dodanie autora',
            'details' => [
                'autor' => $validated['name']
            ],
        ]);

        return redirect()->route('admin.authors')->with('success', 'Autor dodany.');
    }
    public function editAuthor($id)
    {
        $autor = Autor::findOrFail($id);
        return view('admin.authors.edit', compact('autor'));
    }
    public function updateAuthor(Request $request, $id)
    {
        $autor = Autor::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $autor->update($validated);

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'Edycja autora',
            'details' => [
                'autor' => $validated['name']
            ],
        ]);

        return redirect()->route('admin.authors')->with('success', 'Autor zaktualizowany.');
    }
    public function destroyAuthor($id)
    {
        $autor = Autor::findOrFail($id);
        Log::create([
            'user_id' => auth()->id(),
            'action' => 'Usunięcie autora',
            'details' => [
                'autor' => $autor->name
            ],
        ]);
        $autor->delete();


        return redirect()->route('admin.authors')->with('success', 'Autor usunięty.');
    }



    // Użytkownicy
    public function users($page = 'users')
    {
        $users = User::paginate(20);
        $allowedPages = ['users', 'show', 'edit'];
        return $this->renderView('users', $page, $allowedPages, compact('users'));
    }
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

        return view('admin.users.show', compact(
            'user',
            'ksiazki',
            'wypozyczeniaAktywne',
            'wypozyczeniaZwrócone',
            'rezerwacjeAktywne',
            'rezerwacjeZrealizowane',
            'rezerwacjeAnulowane'
        ));
    }
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->back()->with('success', 'Rola została zmieniona!');
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

        $wyp = Wypozyczenie::create([
            'user_id' => $id,
            'ksiazka_id' => $validated['ksiazka_id'],
            'borrowed_at' => now(),
            'due_date' => $validated['due_date'],
            'returned_at' => null,
        ]);

        Powiadomienie::create([
            'user_id' => $id,
            'tresc' => "Wypożyczono książkę: " . $ksiazka->tytul
        ]);

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'Dodanie wypożyczenia',
            'details' => [
                'wypozyczenie_id' => $wyp->id,
                'user_id' => $id,
                'ksiazka_id' => $validated['ksiazka_id']
            ],
        ]);

        return redirect()->back()->with('success', 'Wypożyczenie dodane.');
    }
    // Dodanie rezerwacji dla użytkownika
    public function addReservation(Request $request, $id)
    {
        $validated = $request->validate([
            'ksiazka_id' => 'required|exists:ksiazki,id',
        ]);

        $rez = Rezerwacja::create([
            'user_id' => $id,
            'ksiazka_id' => $validated['ksiazka_id'],
            'reserved_at' => now(),
            'zrealizowano' => false,
        ]);

        $ksiazka = Ksiazka::findOrFail($validated['ksiazka_id']);

        Powiadomienie::create([
            'user_id' => $id,
            'tresc' => 'Zarezerwowano książkę: ' . $ksiazka->tytul
        ]);

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'Dodanie rezerwacji',
            'details' => [
                'rezerwacja_id' => $rez->id,
                'user_id' => $id,
                'ksiazka_id' => $validated['ksiazka_id']
            ],
        ]);

        return redirect()->back()->with('success', 'Rezerwacja dodana.');
    }
    private function renderView($folder, $page, $allowedPages, $data = [])
    {
        if (!in_array($page, $allowedPages)) {
            abort(404, "Podstrona nie istnieje");
        }

        return view("admin.$folder.$page", $data);
    }

    // Powiadomienia
    public function notifications($page = 'history')
    {
        $powiadomienia = Powiadomienie::paginate(20);

        $allowedPages = ['history'];
        return $this->renderView('notifications', $page, $allowedPages, compact('powiadomienia'));
    }

    // Kategorie
    public function categories($page = 'index')
    {
        $categories = Kategoria::paginate(20);
        $allowedPages = ['index', 'new', 'edit'];
        return $this->renderView('categories', $page, $allowedPages, compact('categories'));
    }
    public function destroyCategory($id)
    {
        $kategoria = Kategoria::findOrFail($id);
        Log::create([
            'user_id' => auth()->id(),
            'action' => 'Usunięcie kategorii',
            'details' => [
                'kategoria' => $kategoria->nazwa,
            ],
        ]);
        $kategoria->delete();


        return redirect()->back()->with('success', 'Kategoria została usunięta.');
    }
    public function editCategory($id)
    {
        $kategoria = Kategoria::findOrFail($id);

        return view('admin.categories.edit', compact('kategoria'));
    }
    public function updateCategory(Request $request, $id)
    {
        $kategoria = Kategoria::findOrFail($id);

        $validated = $request->validate([
            'nazwa' => 'required|string|max:255',
            'photo_src' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($request->hasFile('photo_src')) {
            if ($kategoria->photo_src && Storage::disk('public')->exists($kategoria->photo_src)) {
                Storage::disk('public')->delete($kategoria->photo_src);
            }

            $path = $request->file('photo_src')->store('books', 'public');
            $validated['photo_src'] = $path;
        }


        Log::create([
            'user_id' => auth()->id(),
            'action' => 'Edycja kategorii',
            'details' => [
                'kategoria' => $kategoria->nazwa,
            ],
        ]);

        $kategoria->update($validated);

        return redirect()->route('admin.category', 'index')->with('success', 'Kategoria zaktualizowana.');
    }
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'nazwa' => 'required|string|max:255',
            'photo_src' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if (!$request->hasFile('photo_src')) {
            return redirect()->route('admin.category', 'index')->with('error', 'Obrazek jest wymagany');
        }

        $file = $request->file('photo_src');
        $fileName = uniqid() . '_' . $file->getClientOriginalName();
        $file->storeAs('categories', $fileName, 'public');

        $validated['photo_src'] = $fileName;

        Kategoria::create($validated);

        Log::create([
            'user_id' => auth()->id(),
            'action' => 'Dodanie kategorii',
            'details' => [
                'kategoria' => $validated['nazwa'],
                'obrazek' => $validated['photo_src'],
            ],
        ]);

        return redirect()->route('admin.category', 'index')->with('success', 'Dodano nową kategorię!');
    }


    // System
    public function adminlogs()
    {
        $adminlogs = Log::orderBy('created_at', 'desc')->paginate(30);

        return view('admin.system.admin_log', compact('adminlogs'));
    }

    // Raporty i statystyki
    public function raports()
    {
        $dailyRentals = Wypozyczenie::select(
            DB::raw('DATE(borrowed_at) as date'),
            DB::raw('count(*) as count')
        )
            ->where('borrowed_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $weeklyRentals = Wypozyczenie::select(
            DB::raw('YEAR(borrowed_at) as year'),
            DB::raw('WEEK(borrowed_at) as week'),
            DB::raw('count(*) as count')
        )
            ->where('borrowed_at', '>=', Carbon::now()->subWeeks(4))
            ->groupBy('year', 'week')
            ->orderBy('year')
            ->orderBy('week')
            ->get();

        $monthlyRentals = Wypozyczenie::select(
            DB::raw('YEAR(borrowed_at) as year'),
            DB::raw('MONTH(borrowed_at) as month'),
            DB::raw('count(*) as count')
        )
            ->where('borrowed_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $topBooks = Wypozyczenie::select('ksiazka_id', DB::raw('count(*) as count'))
            ->groupBy('ksiazka_id')
            ->orderByDesc('count')
            ->limit(5)
            ->with('ksiazka')
            ->get();

        $reservationStats = [
            'active' => Rezerwacja::whereNull('cancelled_at')->where('zrealizowano', false)->count(),
            'cancelled' => Rezerwacja::whereNotNull('cancelled_at')->count(),
            'realized' => Rezerwacja::where('zrealizowano', true)->count(),
        ];

        $topUsers = Wypozyczenie::select('user_id', DB::raw('count(*) as count'))
            ->groupBy('user_id')
            ->orderByDesc('count')
            ->limit(5)
            ->with('user')
            ->get();

        $topCategoriesRaw = Wypozyczenie::select('ksiazki.kategoria_id', DB::raw('count(*) as count'))
            ->join('ksiazki', 'wypozyczenia.ksiazka_id', '=', 'ksiazki.id')
            ->groupBy('ksiazki.kategoria_id')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        $categoryIds = $topCategoriesRaw->pluck('kategoria_id');

        $categories = Kategoria::whereIn('id', $categoryIds)->get()->keyBy('id');

        $topCategories = $topCategoriesRaw->map(function ($item) use ($categories) {
            $item->nazwa = $categories[$item->kategoria_id]->nazwa ?? 'Brak nazwy';
            return $item;
        });

        return view('admin.reports.index', compact(
            'dailyRentals',
            'weeklyRentals',
            'monthlyRentals',
            'topBooks',
            'reservationStats',
            'topCategories',
            'topUsers'
        ));
    }

    public function raportaktywnosci()
    {
        $users = User::all();
        return view('admin.users.activity_report', compact('users'));
    }
    public function generujraport(Request $request)
    {
        $id = $request->input('user_id');

        $user = User::findOrFail($id);

        // Rezerwacje z relacją ksiazka
        $rezerwacjeZrealizowane = Rezerwacja::with('ksiazka')
            ->where('user_id', $id)
            ->where('zrealizowano', 1)
            ->get();

        $rezerwacjeAnulowane = Rezerwacja::with('ksiazka')
            ->where('user_id', $id)
            ->whereNotNull('cancelled_at')
            ->get();

        $rezerwacjeAktywne = Rezerwacja::with('ksiazka')
            ->where('user_id', $id)
            ->where('zrealizowano', 0)
            ->whereNull('cancelled_at')
            ->get();

        // Wypożyczenia z relacją ksiazka
        $wypozyczeniaZrealizowane = Wypozyczenie::with('ksiazka')
            ->where('user_id', $id)
            ->whereNotNull('returned_at')
            ->get();

        $wypozyczeniaAktywne = Wypozyczenie::with('ksiazka')
            ->where('user_id', $id)
            ->whereNull('returned_at')
            ->get();

        $data = compact(
            'user',
            'rezerwacjeZrealizowane',
            'rezerwacjeAnulowane',
            'rezerwacjeAktywne',
            'wypozyczeniaZrealizowane',
            'wypozyczeniaAktywne'
        );

        $pdf = PDF::loadView('admin.users.user_report_pdf', $data);

        return $pdf->download("raport_uzytkownika_{$user->id}.pdf");
    }
}
