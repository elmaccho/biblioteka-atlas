@extends('layouts.admin.app')
@vite('resources/css/home-page.css')

@section('panel_content')
<div class="main-container">
    <h2 class="mb-4">Historia powiadomień {{ $kategoria->nazwa }}</h2>

    <form action="{{ route('admin.category.update', $kategoria->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nazwa">Nazwa</label>
            <input type="text" name="nazwa" value="{{ $kategoria->nazwa }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="photo_src">Obrazek (jeśli chcesz zmienić)</label>
            <input type="file" name="photo_src" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Zaktualizuj kategorię</button>
    </form>
</div>
@endsection
