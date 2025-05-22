@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Dodaj nową książkę</h2>

    <form method="POST" action="{{ route('librarian.books.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="tytul" class="form-label">Tytuł</label>
            <input type="text" name="tytul" id="tytul" class="form-control" value="{{ old('tytul') }}" required>
        </div>

        <div class="mb-3">
            <label for="opis" class="form-label">Opis</label>
            <textarea name="opis" id="opis" class="form-control" rows="4">{{ old('opis') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Ilość</label>
            <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" min="0" required>
        </div>

        <div class="mb-3">
            <label for="kategoria_id" class="form-label">Kategoria</label>
            <select name="kategoria_id" id="kategoria_id" class="form-select" required>
                <option value="">Wybierz kategorię</option>
                @foreach ($kategorie as $kategoria)
                    <option value="{{ $kategoria->id }}" {{ old('kategoria_id') == $kategoria->id ? 'selected' : '' }}>
                        {{ $kategoria->nazwa }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="autor_id" class="form-label">Autor</label>
            <select name="autor_id" id="autor_id" class="form-select" required>
                <option value="">Wybierz autora</option>
                @foreach ($autorzy as $autor)
                    <option value="{{ $autor->id }}" {{ old('autor_id') == $autor->id ? 'selected' : '' }}>
                        {{ $autor->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="img_src" class="form-label">Obrazek (okładka)</label>
            <input type="file" name="img_src" id="img_src" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Dodaj książkę</button>
    </form>
</div>
@endsection
