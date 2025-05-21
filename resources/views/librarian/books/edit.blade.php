@extends('layouts.librarian.app')
@vite('resources/css/home-page.css')

@section('panel_content')
    <div class="main-container">
        <div class="container mt-5">
            <h2 class="mb-4">Edytuj książkę</h2>

            <form action="{{ route('librarian.books.update', $ksiazka->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="tytul" class="form-label">Tytuł</label>
                    <input type="text" name="tytul" class="form-control" value="{{ old('tytul', $ksiazka->tytul) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="opis" class="form-label">Opis</label>
                    <textarea name="opis" class="form-control">{{ old('opis', $ksiazka->opis) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Ilość</label>
                    <input type="number" name="amount" class="form-control" value="{{ old('amount', $ksiazka->amount) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="img_src" class="form-label">Okładka (zdjęcie)</label>
                    <input type="file" name="img_src" class="form-control" accept="image/*">
                    @if ($ksiazka->img_src)
                        <img src="{{ asset('storage/' . $ksiazka->img_src) }}" alt="Okładka"
                            style="max-width:150px; margin-top:10px;">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                <a href="{{ route('librarian.books') }}" class="btn btn-secondary">Wróć</a>
            </form>
        </div>
    </div>
@endsection