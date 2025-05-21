<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use App\Models\Rezerwacja;
use App\Models\Wypozyczenie;
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
        $rezerwacje = Rezerwacja::paginate(20);
        $allowedPages = ['otherreserv', 'active'];
        return $this->renderView('reservations', $page, $allowedPages, compact('rezerwacje'));
    }

    private function renderView($folder, $page, $allowedPages, $data = [])
    {
        if (!in_array($page, $allowedPages)) {
            abort(404, "Podstrona nie istnieje");
        }

        return view("librarian.$folder.$page", $data);
    }

    public function cancel($id)
    {
        $rez = Rezerwacja::findOrFail($id);
        $rez->cancelled_at = now();
        $rez->save();

        return redirect()->back()->with('success', 'Rezerwacja została anulowana');
    }

    public function realize($id)
    {
        $rez = Rezerwacja::findOrFail($id);
        $rez->zrealizowano = true;
        $rez->save();

        $wypo = Wypozyczenie::create([
            'user_id' => $rez->user->id,
            'ksiazka_id' => $rez->ksiazka->id,
            'borrowed_at' => today(),
            'due_date' => today()->addDays(30),
        ]);

        $wypo->save();

        return redirect()->back()->with('success', 'Rezerwacja zrealizowana.');
    }
}
