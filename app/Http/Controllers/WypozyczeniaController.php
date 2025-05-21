<?php

namespace App\Http\Controllers;

use App\Models\Wypozyczenie;
use Illuminate\Http\Request;

class WypozyczeniaController extends Controller
{
    public function index(){
        $user = auth()->user();
        $wypozyczenia = Wypozyczenie::where('user_id', $user->id)->get();

        return view('wypozyczenia', compact('user', 'wypozyczenia'));
    }
}
