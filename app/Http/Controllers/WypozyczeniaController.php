<?php

namespace App\Http\Controllers;

use App\Models\Wypozyczenie;
use Illuminate\Http\Request;

class WypozyczeniaController extends Controller
{
    public function index(){
        $user = auth()->user();
        $wypozyczenia = Wypozyczenie::where('user_id', $user->id)->whereNull('returned_at')->where('przedluzono', false)->get();

        return view('wypozyczenia', compact('user', 'wypozyczenia'));
    }

    public function history(){
        $user = auth()->user();
        $wypozyczenia = Wypozyczenie::where('user_id', $user->id)->whereNotNull('returned_at')->orderBy('borrowed_at', 'desc')->get(); 

        return view('historiawyp', compact('wypozyczenia'));
    }
}
