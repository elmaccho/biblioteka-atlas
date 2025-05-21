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



    // Wypożyczenia
    public function rentals($page = 'index')
    {
        $wypozyczenia = Wypozyczenie::paginate(20);

        $allowedPages = ['index', 'new', 'archive', 'active'];
        return $this->renderView('rentals', $page, $allowedPages, compact('wypozyczenia'));
    }
    public function return($id)
    {
        $wypo = Wypozyczenie::findOrFail($id);
        $ksiazka = $wypo->ksiazka;

        $wypo->returned_at = now();
        $wypo->save();

        $ksiazka->amount+=1;
        $ksiazka->save();

        return redirect()->back()->with('success', 'Dodano zwrot');
    }


    // Rezerwacje
    public function reservations($page = 'active')
    {
        $rezerwacje = Rezerwacja::paginate(20);
        $allowedPages = ['archive', 'active'];
        return $this->renderView('reservations', $page, $allowedPages, compact('rezerwacje'));
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
        $ksiazka = $rez->ksiazka;

        if ($ksiazka->amount === null || $ksiazka->amount <= 0) {
            return redirect()->back()->with('error', 'Brak dostępnych egzemplarzy.');
        }

        $ksiazka->amount--;
        $ksiazka->save();

        $rez->zrealizowano = true;
        $rez->save();

        Wypozyczenie::create([
            'user_id' => $rez->user->id,
            'ksiazka_id' => $ksiazka->id,
            'borrowed_at' => today(),
            'due_date' => today()->addDays(30),
        ]);

        return redirect()->back()->with('success', 'Rezerwacja zrealizowana.');
    }



    private function renderView($folder, $page, $allowedPages, $data = [])
    {
        if (!in_array($page, $allowedPages)) {
            abort(404, "Podstrona nie istnieje");
        }

        return view("librarian.$folder.$page", $data);
    }
}
