@extends('layouts.admin.app')
@vite('resources/css/home-page.css')

@section('panel_content')
<div class="main-container">
    <h2 class="mb-4">Dodaj nową kategorię</h2>

    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="nazwa">Nazwa</label>
            <input type="text" name="nazwa" class="form-control" required>
        </div>

        <div class="form-group mb-4">
            <label for="photo_src">Obrazek</label>
            <input type="file" name="photo_src" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Dodaj kategorię</button>
    </form>
</div>
@endsection
