<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Raport użytkownika</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            padding: 20px;
        }
        h1, h2, h3 {
            color: #dc3545;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        thead {
            background-color: #f8d7da;
        }
        th, td {
            padding: 10px;
            border: 1px solid #dee2e6;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table-sm th, .table-sm td {
            padding: 5px;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <h1>Raport użytkownika: {{ $user->name }} {{ $user->lastname }}</h1>
    <h1>Email: {{ $user->email }}</h1>
    <p>ID: {{ $user->id }}</p>

    {{-- Rezerwacje --}}
    <h2>Rezerwacje</h2>

    <h3>Zrealizowane</h3>
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Książka ID</th>
                <th>Tytuł</th>
                <th>Data rezerwacji</th>
                <th>Zrealizowano</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rezerwacjeZrealizowane as $rez)
                <tr>
                    <td>{{ $rez->id }}</td>
                    <td>{{ $rez->ksiazka_id }}</td>
                    <td>{{ $rez->ksiazka->tytul }}</td>
                    <td>{{ $rez->reserved_at }}</td>
                    <td>
                        @if ($rez->zrealizowano == 1)
                            Tak    
                            @else
                            Nie
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Brak danych</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3>Anulowane</h3>
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Książka ID</th>
                <th>Tytuł</th>
                <th>Data rezerwacji</th>
                <th>Anulowano</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rezerwacjeAnulowane as $rez)
                <tr>
                    <td>{{ $rez->id }}</td>
                    <td>{{ $rez->ksiazka_id }}</td>
                    <td>{{ $rez->ksiazka->tytul }}</td>
                    <td>{{ $rez->reserved_at }}</td>
                    <td>{{ $rez->cancelled_at }}</td>
                </tr>
            @empty
                <tr><td colspan="4">Brak danych</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3>Aktywne</h3>
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Książka ID</th>
                <th>Tytuł</th>
                <th>Data rezerwacji</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rezerwacjeAktywne as $rez)
                <tr>
                    <td>{{ $rez->id }}</td>
                    <td>{{ $rez->ksiazka_id }}</td>
                    <td>{{ $rez->ksiazka->tytul }}</td>
                    <td>{{ $rez->reserved_at }}</td>
                </tr>
            @empty
                <tr><td colspan="3">Brak danych</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Wypożyczenia --}}
    <h2>Wypożyczenia</h2>

    <h3>Zrealizowane</h3>
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Książka ID</th>
                <th>Tytuł</th>
                <th>Data wypożyczenia</th>
                <th>Oddano</th>
            </tr>
        </thead>
        <tbody>
            @forelse($wypozyczeniaZrealizowane as $wyp)
                <tr>
                    <td>{{ $wyp->id }}</td>
                    <td>{{ $wyp->ksiazka_id }}</td>
                    <td>{{ $wyp->ksiazka->tytul }}</td>
                    <td>{{ $wyp->borrowed_at }}</td>
                    <td>{{ $wyp->returned_at }}</td>
                </tr>
            @empty
                <tr><td colspan="4">Brak danych</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3>Aktywne</h3>
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Książka ID</th>
                <th>Tytuł</th>
                <th>Data wypożyczenia</th>
                <th>Termin zwrotu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($wypozyczeniaAktywne as $wyp)
                <tr>
                    <td>{{ $wyp->id }}</td>
                    <td>{{ $wyp->ksiazka_id }}</td>
                    <td>{{ $wyp->ksiazka->tytul }}</td>
                    <td>{{ $wyp->borrowed_at }}</td>
                    <td>{{ $wyp->due_date }}</td>
                </tr>
            @empty
                <tr><td colspan="4">Brak danych</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
