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
                        <p class="m-0">Dostępne sztuki: 7</p>
                        @if ($user)
                            <button class="book-button book-button-reserve mb-2" style="width: 200px;">Zarezerwuj</button>
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