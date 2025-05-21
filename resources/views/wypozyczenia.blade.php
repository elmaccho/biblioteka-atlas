@extends('layouts.app')
@section('content')
    <div class="container mt-5">
    <h2 class="mb-4">Twoje wypożyczenia</h2>

    <h4 class="text-success">Aktywne wypożyczenia</h4>
    <table class="table table-bordered table-hover align-middle mb-5">
        <thead class="table-light">
            <tr>
                <th>Książka</th>
                <th>Wypożyczono</th>
                <th>Status</th>
                <th>Akcja</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($wypozyczenia as $wyp)
                <tr>
                    <td>{{ $wyp->ksiazka->tytul }}</td>
                    <td>{{ $wyp->reserved_at }}</td>
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
                    <td colspan="4">Brak aktywnych wypożyczeń</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
