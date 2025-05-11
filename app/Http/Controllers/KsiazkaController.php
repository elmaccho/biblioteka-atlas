<?php

namespace App\Http\Controllers;

use App\Models\Kategoria;
use App\Models\Ksiazka;
use App\Models\Rezerwacja;
use Illuminate\Http\Request;

class KsiazkaController extends Controller
{
    public function show($id)
    {
        $user = auth()->user();
        $ksiazka = Ksiazka::findOrFail($id);
        // Sprawdzamy, czy użytkownik ma już rezerwację tej książki
        $hasReserved = $user ? Rezerwacja::where('ksiazka_id', $ksiazka->id)
            ->where('user_id', $user->id)
            ->exists() : false;
        return view('book', compact('ksiazka', 'user', 'hasReserved'));
    }

    public function byKategoria($id)
    {
        $user = auth()->user();
        $kategoria = Kategoria::findOrFail($id);
        $ksiazki = $kategoria->ksiazki()->paginate(10);
        return view('by_kategoria', compact('ksiazki', 'kategoria', 'user'));
    }
}
