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
                        <button class="book-button book-button-reserve mb-2">Zarezerwuj</button>
                        <button class="book-button book-button-more">Zobacz więcej</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection