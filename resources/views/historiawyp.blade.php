@extends('layouts.app')
@section('content')
    <div class="main-container d-flex flex-column align-items-center">
        <div class="container mt-5">
            <h2 class="mb-4">Wypożyczenia</h2>

            <h4 class="text-muted">Archiwum wypożyczeń</h4>
            <table class="table table-bordered table-hover align-middle mb-5">
                <thead class="table-light">
                    <tr>
                        <th>Książka</th>
                        <th>Wypożyczono</th>
                        <th>Data oddania</th>
                        <th>Użytkownik</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($wypozyczenia as $wypo)
                        <tr>
                            <td>{{ $wypo->ksiazka->tytul }}</td>
                            <td>{{ $wypo->borrowed_at }}</td>
                            <td>{{ $wypo->returned_at }}</td>
                            <td>{{ optional($wypo->user)->name . ' ' . optional($wypo->user)->lastname ?? 'Brak danych' }}</td>
                            <td><span class="badge bg-info text-dark">Zwrócono</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Brak aktywnych wypożyczeń</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
@endsection