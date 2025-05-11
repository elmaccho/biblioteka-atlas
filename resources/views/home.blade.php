@extends('layouts.app')
@vite('resources/css/home-page.css')
@section('content')
    <div class="main-container">
        <img src={{ asset('images/image.png') }} alt="banner" class="banner">

        <div class="books-container">
            @foreach ($ksiazki as $ksiazka)
                <div class="book-card">
                    <div class="book-image">
                        <img src="{{ asset('storage/books/metro2033.jpg') }}" alt="">
                    </div>
                    <div class="flex flex-column">
                        <h3 class="book-title">{{ $ksiazka->tytul }}</h3>
                        <p class="book-author m-0">{{ $ksiazka->autor ? $ksiazka->autor->name : "brak XD" }}</p>
                        @if ($user)
                            @if ($ksiazka->amount == 0)
                                <button class="book-button book-button-reserve mb-2">Brak egzemplarzy</button>
                            @else
                                <button class="book-button book-button-reserve mb-2">Zarezerwuj</button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="book-button book-button-reserve mb-2">Zaloguj się by zarezerwować</a>
                        @endif
                        <a href="{{ route('ksiazka', ['id' => $ksiazka->id]) }}" class="book-button book-button-more">Zobacz więcej</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $ksiazki->links() }}
        </div>
    </div>
@endsection