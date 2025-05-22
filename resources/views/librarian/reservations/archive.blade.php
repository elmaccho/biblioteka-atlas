@extends('layouts.librarian.app')
@vite('resources/css/home-page.css')
@section('panel_content')
    <div class="main-container">
        <div class="container mt-5">
            <h2 class="mb-4">Profil użytkownika: {{ $user->name }} {{ $user->lastname }}</h2>

            <h4 class="text-muted mt-5">Rezerwacje - Zrealizowane</h4>
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Książka</th>
                        <th>Zarezerwowano</th>
                        <th>Zrealizowano</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($user->rezerwacje->where('zrealizowano', true) as $rez)
                        <tr>
                            <td>{{ $rez->ksiazka->tytul }}</td>
                            <td>{{ $rez->reserved_at }}</td>
                            <td><span class="badge bg-info text-dark">Zrealizowana</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Brak zrealizowanych rezerwacji</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <h4 class="text-muted mt-5">Rezerwacje - Anulowane</h4>
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Książka</th>
                        <th>Zarezerwowano</th>
                        <th>Anulowano</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($user->rezerwacje->whereNotNull('cancelled_at') as $rez)
                        <tr>
                            <td>{{ $rez->ksiazka->tytul }}</td>
                            <td>{{ $rez->reserved_at }}</td>
                            <td><span class="badge bg-secondary">Anulowana</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Brak anulowanych rezerwacji</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
