<?php

namespace App\Http\Controllers;

use App\Models\Ksiazka;
use App\Models\Powiadomienie;
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
            return back()->withErrors('Już masz aktywną rezerwację tej książki.');
        }

        Rezerwacja::create([
            'user_id' => $userId,
            'ksiazka_id' => $ksiazkaId,
            'reserved_at' => now(),
            'cancelled_at' => null,
            'zrealizowano' => false,
        ]);

        $ksiazka = Ksiazka::findOrFail($ksiazkaId);

        Powiadomienie::create([
            'user_id' => $userId,
            'tresc' => 'Zarezerwowano książkę: '.$ksiazka->tytul
        ]);

        return back()->with('success', 'Książka zarezerwowana.');
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
            'tresc' => 'Anulowano rezerwację książki: '.$ksiazka->tytul
        ]);

        return redirect()->back()->with('success', 'Rezerwacja została anulowana');
    }
}
