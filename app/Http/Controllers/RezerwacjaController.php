<?php

namespace App\Http\Controllers;

use App\Models\Rezerwacja;
use Illuminate\Http\Request;

class RezerwacjaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ksiazka_id' => 'required|exists:ksiazki,id'
        ]);

        $ksiazkaId = $request->input('ksiazka_id');
        $userId = auth()->id();

        // Sprawdzenie, czy użytkownik już zarezerwował tę książkę, a rezerwacja nie została anulowana
        $istnieje = Rezerwacja::where('user_id', $userId)
            ->where('ksiazka_id', $ksiazkaId)
            ->whereNull('cancelled_at') // Rezerwacja nie może być anulowana
            ->where('zrealizowano', false)
            ->exists();

        if ($istnieje) {
            return back()->withErrors('Już masz aktywną rezerwację tej książki');
        }

        // Tworzymy nową rezerwację
        Rezerwacja::create([
            'user_id' => $userId,
            'ksiazka_id' => $ksiazkaId,
            'reserved_at' => now(),
            'cancelled_at' => null,  // Rezerwacja nie jest anulowana na początku
            'zrealizowano' => false,
        ]);

        return back()->with('success', 'Książka zarezerwowana');
    }
}
