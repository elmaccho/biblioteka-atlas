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

    public function rentals($page = 'index')
    {
        $allowedPages = ['index', 'new', 'return', 'extend', 'active'];
        return $this->renderView('rentals', $page, $allowedPages);
    }
    public function reservations($page = 'index')
    {
        $allowedPages = ['index', 'active'];
        return $this->renderView('reservations', $page, $allowedPages);
    }

    private function renderView($folder, $page, $allowedPages)
    {
        if (!in_array($page, $allowedPages)) {
            abort(404, "Podstrona nie istnieje");
        }

        return view("librarian.$folder.$page");
    }
}