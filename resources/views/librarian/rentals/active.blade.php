@extends('layouts.librarian.app')
@vite('resources/css/home-page.css')
@section('panel_content')
    <div class="main-container">
        <div class="container mt-5">
            <h2 class="mb-4">Wypożyczenia</h2>

            <h4 class="text-success">Aktywne wypożyczenia</h4>
            <table class="table table-bordered table-hover align-middle mb-5">
                <thead class="table-light">
                    <tr>
                        <th>Książka</th>
                        <th>Wypożyczono</th>
                        <th>Data zwrotu</th>
                        <th>Użytkownik</th>
                        <th>Status</th>
                        <th>Akcja</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($wypozyczenia->whereNull('returned_at') as $wypo)
                        <tr>
                            <td>{{ $wypo->ksiazka->tytul }}</td>
                            <td>{{ $wypo->borrowed_at }}</td>
                            <td>{{ $wypo->due_date }}</td>
                            <td>{{ optional($wypo->user)->name . ' ' . optional($wypo->user)->lastname ?? 'Brak danych' }}</td>
                            <td><span class="badge bg-success">Aktywne</span></td>
                            <td>
                                <form action="{{ route('librarian.wypozyczenie.return', $wypo->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-primary">Dodaj zwrot</button>
                                </form>
                            </td>
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