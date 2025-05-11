<?php

namespace App\Http\Controllers;

use App\Models\Rezerwacja;
use Illuminate\Http\Request;

class RezerwacjaController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $rezerwacje = $user->rezerwacje()->with('ksiazka')->latest()->get();

        return view('rezerwacje', compact('rezerwacje'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'ksiazka_id' => 'required|exists:ksiazki,id'
        ]);

        $ksiazkaId = $request->input('ksiazka_id');
        $userId = auth()->id();

        $maAktywnaRezerwacje = Rezerwacja::where('user_id', $userId)
            ->where('ksiazka_id', $ksiazkaId)
            ->whereNull('cancelled_at')
            ->where('zrealizowano', false)
            ->exists();

        if ($maAktywnaRezerwacje) {
            return back()->withErrors('Już masz aktywną rezerwację tej książki, ty chciwy śmieciu.');
        }

        Rezerwacja::create([
            'user_id' => $userId,
            'ksiazka_id' => $ksiazkaId,
            'reserved_at' => now(),
            'cancelled_at' => null,
            'zrealizowano' => false,
        ]);

        return back()->with('success', 'Książka zarezerwowana. Ciesz się, baranie.');
    }
}
