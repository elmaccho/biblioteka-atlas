@extends('layouts.admin.app')
@vite('resources/css/home-page.css')
@section('panel_content')
    <div class="main-container">
        <form action="{{ route('admin.generujraport') }}" method="GET" class="w-50 mx-auto">
            <div class="mb-3">
                <label for="user_id" class="form-label fw-bold">Użytkownik:</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="" selected disabled>-- Wybierz użytkownika do wygenerowania raportu --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name ?? $user->email }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-danger w-100 fw-bold">Generuj raport</button>
        </form>
    </div>
@endsection