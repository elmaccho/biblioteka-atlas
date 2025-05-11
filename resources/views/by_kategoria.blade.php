@extends('layouts.app')
@vite('resources/css/home-page.css')
@section('content')
    <div class="main-container">
        <img src={{ asset('images/image.png') }} alt="banner" class="banner">

        <div class="row mb-0">
            <p class="location m-0">
                <a href="{{ route('home') }}" class="text-decoration-none" style="color: grey;">Strona główna</a>
                <i class="fa-solid fa-arrow-right" style="color: grey; font-size: 10px;"></i>
                <a class="text-decoration-none" style="color: grey;" href="{{ route('kategoria.ksiazki', ['id' => $kategoria->id]) }}">{{ $kategoria->nazwa }}</a>
            </p>
        </div>
        <h2 class="h1">{{ $kategoria->nazwa }}</h2>
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
                        <a href="{{ route('ksiazka', ['id' => $ksiazka->id]) }}" class="book-button book-button-more">Zobacz
                            więcej</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $ksiazki->links() }}
        </div>
    </div>
@endsection