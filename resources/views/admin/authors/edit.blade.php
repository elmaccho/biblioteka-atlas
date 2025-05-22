@extends('layouts.admin.app')
@vite('resources/css/home-page.css')
@section('panel_content')
    <div class="main-container">
        <h2>Edytuj autora</h2>
        <form method="POST" action="{{ route('admin.authors.update', $autor->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Imię i Nazwisko</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $autor->name) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
            <a href="{{ route('admin.authors') }}" class="btn btn-secondary">Wróć</a>
        </form>
    </div>
@endsection