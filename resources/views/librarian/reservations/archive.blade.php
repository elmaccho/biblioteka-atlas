@extends('layouts.librarian.app')
@vite('resources/css/home-page.css')
@section('panel_content')
    <div class="main-container">
        <div class="container mt-5">
            <h2 class="mb-4">Rezerwacje</h2>

            <h4 class="text-muted">Archiwum rezerwacji</h4>
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Książka</th>
                        <th>Zarezerwowano</th>
                        <th>Użytkownik</th> {{-- NOWE --}}
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rezerwacje->whereNotNull('cancelled_at')->merge($rezerwacje->where('zrealizowano', true)) as $rez)
                        <tr>
                            <td>{{ $rez->ksiazka->tytul }}</td>
                            <td>{{ $rez->reserved_at }}</td>
                            <td>{{ optional($rez->user)->name . ' ' . optional($rez->user)->lastname ?? 'Brak danych' }}</td>
                            <td>
                                @if ($rez->cancelled_at)
                                    <span class="badge bg-secondary">Anulowana</span>
                                @elseif ($rez->zrealizowano)
                                    <span class="badge bg-info text-dark">Zrealizowana</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Nie masz żadnych archiwalnych rezerwacji</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection