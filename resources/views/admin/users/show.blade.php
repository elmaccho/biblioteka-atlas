@extends('layouts.admin.app')
@vite('resources/css/home-page.css')
@section('panel_content')
    <div class="main-container">
        <h2 class="mb-4">Profil użytkownika: {{ $user->name }}</h2>

        <p><strong>Email:</strong> {{ $user->email }}</p>

        <h4 class="mb-4">Zmień rolę użytkownika</h4>
        <form method="POST" action="{{ route('admin.users.updateRole', $user->id) }}">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="role">Rola</label>
                <select name="role" class="form-control" required>
                    @foreach(['user', 'librarian', 'admin'] as $rola)
                        <option value="{{ $rola }}" {{ $user->hasRole($rola) ? 'selected' : '' }}>
                            {{ ucfirst($rola) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success mt-2">Zmień rolę</button>
        </form>

        <h4 class="mt-5">Dodaj wypożyczenie</h4>
        <form method="POST" action="{{ route('admin.users.rental', $user->id) }}">
            @csrf
            <div class="form-group">
                <label for="ksiazka_id">Książka</label>
                <select name="ksiazka_id" class="form-control" required>
                    @foreach($ksiazki as $ksiazka)
                        <option value="{{ $ksiazka->id }}">{{ $ksiazka->tytul }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="returned_at">Data oddania</label>
                <input type="date" name="due_date" class="form-control" required min="{{ date('Y-m-d') }}">
                @error('returned_at')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-2">Dodaj wypożyczenie</button>
        </form>

        <h4 class="mt-5">Dodaj rezerwację</h4>
        <form method="POST" action="{{ route('admin.users.reservation', $user->id) }}">
            @csrf
            <div class="form-group">
                <label for="ksiazka_id">Książka</label>
                <select name="ksiazka_id" class="form-control" required>
                    @foreach($ksiazki as $ksiazka)
                        <option value="{{ $ksiazka->id }}">{{ $ksiazka->tytul }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-warning mt-2">Dodaj rezerwację</button>
        </form>

        <h4 class="mt-5 text-success">Aktywne wypożyczenia</h4>
        @if ($wypozyczeniaAktywne->isEmpty())
            <p>Brak aktywnych wypożyczeń</p>
        @else
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Książka</th>
                        <th>Wypożyczono</th>
                        <th>Termin zwrotu</th>
                        <th>Użytkownik</th>
                        <th>Status</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wypozyczeniaAktywne as $wypo)
                        <tr>
                            <td>{{ $wypo->ksiazka->tytul }}</td>
                            <td>{{ $wypo->borrowed_at }}</td>
                            <td>{{ $wypo->due_date }}</td>
                            <td>{{ optional($wypo->user)->name . ' ' . optional($wypo->user)->lastname ?? 'Brak danych' }}</td>
                            <td><span class="badge bg-success">Aktywne</span></td>
                            <td>
                                <form action="{{ route('admin.wypozyczenie.return', $wypo->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-primary">Dodaj zwrot</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <h4 class="mt-5 text-primary">Zwrócone wypożyczenia</h4>
        @if ($wypozyczeniaZwrócone->isEmpty())
            <p>Brak zwróconych wypożyczeń</p>
        @else
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Książka</th>
                        <th>Wypożyczono</th>
                        <th>Zwrocono</th>
                        <th>Użytkownik</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wypozyczeniaZwrócone as $wypo)
                        <tr>
                            <td>{{ $wypo->ksiazka->tytul }}</td>
                            <td>{{ $wypo->borrowed_at }}</td>
                            <td>{{ $wypo->returned_at }}</td>
                            <td>{{ optional($wypo->user)->name . ' ' . optional($wypo->user)->lastname ?? 'Brak danych' }}</td>
                            <td><span class="badge bg-info text-dark">Zwrócono</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <h4 class="mt-5 text-success">Aktywne rezerwacje</h4>
        @if ($rezerwacjeAktywne->isEmpty())
            <p>Brak aktywnych rezerwacji</p>
        @else
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Książka</th>
                        <th>Zarezerwowano</th>
                        <th>Użytkownik</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rezerwacjeAktywne as $rez)
                        <tr>
                            <td>{{ $rez->ksiazka->tytul }}</td>
                            <td>{{ $rez->reserved_at }}</td>
                            <td>{{ optional($rez->user)->name . ' ' . optional($rez->user)->lastname ?? 'Brak danych' }}</td>
                            <td><span class="badge bg-success">Aktywna</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <h4 class="mt-5 text-primary">Zrealizowane rezerwacje</h4>
        @if ($rezerwacjeZrealizowane->isEmpty())
            <p>Brak zrealizowanych rezerwacji</p>
        @else
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Książka</th>
                        <th>Zarezerwowano</th>
                        <th>Użytkownik</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rezerwacjeZrealizowane as $rez)
                        <tr>
                            <td>{{ $rez->ksiazka->tytul }}</td>
                            <td>{{ $rez->reserved_at }}</td>
                            <td>{{ optional($rez->user)->name . ' ' . optional($rez->user)->lastname ?? 'Brak danych' }}</td>
                            <td><span class="badge bg-info text-dark">Zrealizowana</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <h4 class="mt-5 text-secondary">Anulowane rezerwacje</h4>
        @if ($rezerwacjeAnulowane->isEmpty())
            <p>Brak anulowanych rezerwacji</p>
        @else
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Książka</th>
                        <th>Zarezerwowano</th>
                        <th>Użytkownik</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rezerwacjeAnulowane as $rez)
                        <tr>
                            <td>{{ $rez->ksiazka->tytul }}</td>
                            <td>{{ $rez->reserved_at }}</td>
                            <td>{{ optional($rez->user)->name . ' ' . optional($rez->user)->lastname ?? 'Brak danych' }}</td>
                            <td><span class="badge bg-secondary">Anulowana</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

@endsection