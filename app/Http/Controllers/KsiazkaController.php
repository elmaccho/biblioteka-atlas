<?php

namespace App\Http\Controllers;

use App\Models\Kategoria;
use App\Models\Ksiazka;
use Illuminate\Http\Request;

class KsiazkaController extends Controller
{
    public function show($id){
        $user = auth()->user();
        $ksiazka = Ksiazka::findOrFail($id);
        return view('book', compact('ksiazka', 'user'));
    }
    public function byKategoria($id)
    {
        $kategoria = Kategoria::findOrFail($id);
        $ksiazki = $kategoria->ksiazki()->paginate(10);
        return view('by_kategoria', compact('ksiazki', 'kategoria'));
    }
}
