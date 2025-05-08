<?php

namespace App\Http\Controllers;

use App\Models\Kategoria;
use Illuminate\Http\Request;

class KategorieController extends Controller
{
    public function index()
    {
        $kategorie = Kategoria::orderBy('nazwa', 'asc')->get();
        return view('categories', compact('kategorie'));
    }
}
