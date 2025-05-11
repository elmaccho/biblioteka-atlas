@extends('layouts.app')
@vite(['resources/css/home-page.css', 'resources/css/book.css'])
@section('content')
    <div class="main-container d-flex flex-column align-items-left">
        <div class="row mb-0">
            <p class="location"> 
                <a href="{{ route('home') }}">Strona główna</a> 
                <i class="fa-solid fa-arrow-right"></i> 
                <a href="{{ route('kategoria.ksiazki', ['id' => $ksiazka->kategoria->id]) }}">{{ $ksiazka->kategoria->nazwa }}</a>  
                <i class="fa-solid fa-arrow-right"></i> 
                <a href="{{ route('ksiazka', ['id' => $ksiazka->id]) }}">{{ $ksiazka->tytul }}</a>
            </p>
        </div>
        <div class="book-contents">
            <div class="book-photo">
                <img src="{{ asset('storage/books/metro2033.jpg') }}" alt="">
            </div>
            <div class="book-content">
                <div class="book-action mb-5">
                    <div>
                        <h3 class="book-title">{{ $ksiazka->tytul }}</h3>
                        <p class="m-0 author mb-5">{{ $ksiazka->autor->name }}</p>
                        <p class="m-0">
                            @if ($ksiazka->amount != 0)
                                Dostępna ilość: {{ $ksiazka->amount }}
                            @endif
                        </p>
                        @if ($user)
                            @if ($ksiazka->amount == 0)    
                                <button class="book-button book-button-reserve mb-2" style="width: 200px;">Brak egzemplarzy</button>
                            @else
                                <button class="book-button book-button-reserve mb-2" style="width: 200px;">Zarezerwuj</button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="book-button book-button-reserve mb-2" style="width: 200px;">Zaloguj się</a>
                        @endif
                    </div>
                </div>
                <div class="book-desc">
                    <h2>Opis</h2>
                    <p style="color: grey;">{{ $ksiazka->opis }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection