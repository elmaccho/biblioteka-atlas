<?php

namespace App\View\Components;

use App\Models\Rezerwacja;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BookCard extends Component
{
    public $ksiazka;
    public $user;
    public $hasReserved;

    public function __construct($ksiazka, $user)
    {
        $this->ksiazka = $ksiazka;
        $this->user = $user;

        $this->hasReserved = $user ? Rezerwacja::where('ksiazka_id', $ksiazka->id)
            ->where('user_id', $user->id)
            ->exists()
            : false;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.book-card');
    }
}
