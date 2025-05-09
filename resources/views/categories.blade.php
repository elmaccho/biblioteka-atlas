@extends('layouts.app')
@vite('resources/css/categories.css')
@section('content')
    <div class="main-container d-flex flex-column align-items-center">
        <img src={{ asset('images/image.png') }} alt="banner" class="mb-5" class="banner">

        <div class="categories-container">
            @foreach ($kategorie as $kategoria)
                <a href="{{ route('kategoria.ksiazki', ['id' => $kategoria->id]) }}" class="d-flex flex-column align-items-center text-dark text-decoration-none m-3 category-link">
                    <i class="fa-solid fa-font-awesome"></i>
                    <p>{{ $kategoria->nazwa }}</p>
                </a>
            @endforeach
        </div>
    </div>
@endsection