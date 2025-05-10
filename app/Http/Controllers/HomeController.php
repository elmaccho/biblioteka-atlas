<?php

namespace App\Http\Controllers;

use App\Models\Ksiazka;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $ksiazki = Ksiazka::with('autor:id,name')->select("id", "tytul", "opis", "autor_id")->paginate(10);
        return view('home', compact('ksiazki', 'user'));
    }
}
