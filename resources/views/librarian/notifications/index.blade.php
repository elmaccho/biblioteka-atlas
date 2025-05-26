@extends('layouts.admin.app')
@vite('resources/css/home-page.css')
@section('panel_content')
    <div class="main-container">
        <h2 class="mb-4">Wyślij przypomnienie</h2>

        <form action="{{ route('librarian.notifications.sendReminder') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="user_id" class="form-label">Wybierz użytkownika</label>
                <select name="user_id" id="user_id" class="form-select" {{ $wypozyczenia->count() ? '' : 'disabled' }}>
                    @if($wypozyczenia->count())
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} (ID: {{ $user->id }})</option>
                        @endforeach
                    @else
                        <option selected>Brak dostępnych użytkowników</option>
                    @endif
                </select>
            </div>

            <div class="mb-3">
                <label for="ksiazka_id" class="form-label">Wybierz książkę</label>
                <select name="ksiazka_id" id="ksiazka_id" class="form-select" {{ $wypozyczenia->count() ? '' : 'disabled' }}>
                    @if($wypozyczenia->count())
                        @foreach ($wypozyczenia as $wypozyczenie)
                            <option value="{{ $wypozyczenie->ksiazka_id }}">
                                Książka ID: {{ $wypozyczenie->ksiazka_id }} (Zwrot:
                                {{ \Carbon\Carbon::parse($wypozyczenie->due_date)->format('d.m.Y') }})
                            </option>
                        @endforeach
                    @else
                        <option selected>Brak książek do przypomnienia</option>
                    @endif
                </select>
            </div>

            <div class="mb-3">
                <label for="tresc" class="form-label">Treść powiadomienia</label>
                <textarea name="tresc" id="tresc" rows="4" class="form-control" {{ $wypozyczenia->count() ? '' : 'disabled' }}>Przypominamy o zbliżającym się terminie zwrotu książki.</textarea>
            </div>

            <button type="submit" class="btn btn-primary" {{ $wypozyczenia->count() ? '' : 'disabled' }}>Wyślij powiadomienie</button>
        </form>

        <h3 class="mt-5">Wypożyczenia ze zbliżającym się terminem oddania</h3>

        @if ($wypozyczenia->count())
            <table class="table table-bordered table-hover mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Użytkownik</th>
                        <th>Książka ID</th>
                        <th>Data wypożyczenia</th>
                        <th>Termin oddania</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wypozyczenia as $wypozyczenie)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $wypozyczenie->user->name ?? 'Brak danych' }} (ID: {{ $wypozyczenie->user_id }})</td>
                            <td>{{ $wypozyczenie->ksiazka_id }}</td>
                            <td>{{ $wypozyczenie->borrowed_at ? \Carbon\Carbon::parse($wypozyczenie->borrowed_at)->format('d.m.Y') : '-' }}</td>
                            <td>{{ $wypozyczenie->due_date ? \Carbon\Carbon::parse($wypozyczenie->due_date)->format('d.m.Y') : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="mt-5 text-muted">Brak zbliżających się terminów oddania<p>
        @endif
    </div>
@endsection
