@extends('layouts.librarian.app')
@vite('resources/css/home-page.css')
@section('panel_content')
    <div class="main-container">
        <div class="container mt-5">
            <h2 class="mb-4">Rezerwacje</h2>

            <h4 class="text-success">Aktywne rezerwacje</h4>
            <table class="table table-bordered table-hover align-middle mb-5">
                <thead class="table-light">
                    <tr>
                        <th>Książka</th>
                        <th>Zarezerwowano</th>
                        <th>Użytkownik</th>
                        <th>Status</th>
                        <th>Akcja</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rezerwacje->whereNull('cancelled_at')->where('zrealizowano', false) as $rez)
                        <tr>
                            <td>{{ $rez->ksiazka->tytul }}</td>
                            <td>{{ $rez->reserved_at }}</td>
                            <td>{{ optional($rez->user)->name . ' ' . optional($rez->user)->lastname ?? 'Brak danych' }}</td>
                            <td><span class="badge bg-success">Aktywna</span></td>
                            <td>
                                <form action="{{ route('librarian.rezerwacje.cancel', $rez->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-danger">Anuluj</button>
                                </form>

                                <form action="{{ route('librarian.rezerwacje.realize', $rez->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-primary">Zrealizuj</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Brak aktywnych rezerwacji</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
@endsection