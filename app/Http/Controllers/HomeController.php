<?php

namespace App\Http\Controllers;

use App\Models\Ksiazka;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $ksiazki = Ksiazka::with('autor:id,name')->select("id", "tytul", "opis", "autor_id", "amount", "img_src")->paginate(20);
        return view('home', compact('ksiazki', 'user'));
    }
}
