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
            @forelse ($ksiazki as $ksiazka)
                <x-book-card :ksiazka="$ksiazka" :user="$user" />
                @empty
                <div class="row d-flex justify-content-start w-100 mt-3">
                    <p class="text-dark p-0">Brak książek w wybranej kategorii</p>
                </div>
            @endforelse
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $ksiazki->links() }}
        </div>
    </div>
@endsection