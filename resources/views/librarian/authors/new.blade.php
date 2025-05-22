@extends('layouts.librarian.app')

@section('panel_content')
<div class="container mt-5">
    <h2>Dodaj nowego autora</h2>
    <form method="POST" action="{{ route('librarian.authors.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Imię i Nazwisko</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Dodaj</button>
        <a href="{{ route('librarian.authors') }}" class="btn btn-secondary">Anuluj</a>
    </form>
</div>
@endsection