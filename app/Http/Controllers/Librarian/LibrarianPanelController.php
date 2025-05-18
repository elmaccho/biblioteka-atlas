<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LibrarianPanelController extends Controller
{
    public function index()
    {
        return view('librarian.index');
    }
}
