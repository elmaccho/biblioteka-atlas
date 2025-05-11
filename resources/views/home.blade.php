@extends('layouts.app')
@vite('resources/css/home-page.css')
@section('content')
    <div class="main-container">
        <img src={{ asset('images/image.png') }} alt="banner" class="banner">

        <div class="books-container">
            @foreach ($ksiazki as $ksiazka)
                <x-book-card :ksiazka="$ksiazka" :user="$user" />
            @endforeach
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $ksiazki->links() }}
        </div>
    </div>
@endsection