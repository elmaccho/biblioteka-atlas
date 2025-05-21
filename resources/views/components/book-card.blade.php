<div class="book-card">
    <div class="book-image">
        @if ($ksiazka->img_src)
            <img src="{{ asset('storage/' . $ksiazka->img_src) }}" alt="okładka" width="50">
        @else
            <img src="{{ asset('storage/books/placeholderimage.png') }}" alt="okładka" width="50">
        @endif
    </div>
    <div class="flex flex-column">
        <h3 class="book-title">{{ $ksiazka->tytul }}</h3>
        <p class="book-author m-0">{{ $ksiazka->autor ? $ksiazka->autor->name : "brak XD" }}</p>
        @if ($user)
            @php
                $hasReserved = $user->rezerwacje()
                    ->where('ksiazka_id', $ksiazka->id)
                    ->whereNull('cancelled_at')
                    ->where('zrealizowano', false)
                    ->exists();
            @endphp

            @if ($ksiazka->amount == 0)
                <button class="book-button book-button-reserve mb-2 w-100">Brak egzemplarzy</button>
            @else
                @if ($hasReserved)
                    <button class="book-button mb-2 bg-success w-100">Zarezerwowano!</button>
                @else
                    <form class="w-100 m-0" method="POST" action="{{ route('rezerwacje.store') }}">
                        @csrf
                        <input type="hidden" name="ksiazka_id" value="{{ $ksiazka->id }}">
                        <button class="book-button book-button-reserve w-100 mb-2">Zarezerwuj</button>
                    </form>
                @endif
            @endif
        @else
            <a href="{{ route('login') }}" class="book-button book-button-reserve mb-2">Zaloguj się by zarezerwować</a>
        @endif

        <a href="{{ route('ksiazka', ['id' => $ksiazka->id]) }}" class="book-button book-button-more">Zobacz więcej</a>
    </div>
</div>