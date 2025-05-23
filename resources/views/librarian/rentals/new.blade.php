@extends('layouts.librarian.app')
@vite('resources/css/home-page.css')
@section('panel_content')
    <div class="main-container">
        <h4 class="mt-5">Dodaj wypożyczenie</h4>
        <form method="POST" action="{{ route('librarian.wypozyczenie.dodaj') }}">
            @csrf
            <div class="form-group">
                <label for="user_id">Użytkownik</label>
                <select name="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->lastname }} | {{ $user->email }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="ksiazka_id">Książka</label>
                <select name="ksiazka_id" class="form-control" required>
                    @foreach($ksiazki as $ksiazka)
                        <option value="{{ $ksiazka->id }}">{{ $ksiazka->tytul }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3 mb-2">
                <label for="returned_at">Data oddania</label>
                <input type="date" name="due_date" class="form-control" required min="{{ date('Y-m-d') }}">
                @error('returned_at')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-2">Dodaj wypożyczenie</button>
        </form>
    </div>
@endsection