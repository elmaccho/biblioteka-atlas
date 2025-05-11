@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Twoje rezerwacje</h2>

    <h4 class="text-success">Aktywne rezerwacje</h4>
    <table class="table table-bordered table-hover align-middle mb-5">
        <thead class="table-light">
            <tr>
                <th>Książka</th>
                <th>Zarezerwowano</th>
                <th>Status</th>
                <th>Akcja</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rezerwacje->whereNull('cancelled_at')->where('zrealizowano', false) as $rez)
                <tr>
                    <td>{{ $rez->ksiazka->tytul }}</td>
                    <td>{{ $rez->reserved_at }}</td>
                    <td><span class="badge bg-success">Aktywna</span></td>
                    <td>
                        {{-- <form method="POST" action="{{ route('rezerwacje.cancel', $rez->id) }}">
                            @csrf
                            @method('PATCH') --}}
                            <button class="btn btn-sm btn-danger">Anuluj</button>
                        {{-- </form> --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Brak aktywnych rezerwacji</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h4 class="text-muted">Anulowane i zrealizowane</h4>
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Książka</th>
                <th>Zarezerwowano</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rezerwacje->whereNotNull('cancelled_at')->merge($rezerwacje->where('zrealizowano', true)) as $rez)
                <tr>
                    <td>{{ $rez->ksiazka->tytul }}</td>
                    <td>{{ $rez->reserved_at }}</td>
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
                    <td colspan="3">Nie masz żadnych archiwalnych rezerwacji</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
