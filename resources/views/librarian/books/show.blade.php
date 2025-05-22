@extends('layouts.librarian.app')
@vite('resources/css/home-page.css')

@section('panel_content')
    <div class="main-container">
        <div class="container mt-5">
            <h2 class="mb-4">Lista książek</h2>

            {{-- <a href="{{ route('librarian.books.create') }}" class="btn btn-success mb-3">Dodaj nową książkę</a> --}}

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Tytuł</th>
                        <th>Opis</th>
                        <th>Ilość</th>
                        <th>Kategoria</th>
                        <th>Autor</th>
                        <th>Zdjęcie</th>
                        <th>Utworzono</th>
                        <th>Edytowano</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ksiazki as $ksiazka)
                        <tr>
                            <td>{{ $ksiazka->id }}</td>
                            <td>{{ $ksiazka->tytul }}</td>
                            <td>{{ Str::limit($ksiazka->opis, 50) }}</td>
                            <td>{{ $ksiazka->amount }}</td>
                            <td>{{ $ksiazka->kategoria->nazwa ?? 'Brak' }}</td>
                            <td>{{ $ksiazka->autor->name ?? 'Brak' }}</td>
                            <td>
                                @if ($ksiazka->img_src)
                                    <img src="{{ asset('storage/' . $ksiazka->img_src) }}" alt="okładka" width="50">
                                @else
                                    Brak
                                @endif
                            </td>
                            <td>{{ $ksiazka->created_at?->format('Y-m-d') }}</td>
                            <td>{{ $ksiazka->updated_at?->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('librarian.books.edit', $ksiazka->id) }}" class="btn btn-sm btn-warning">Edytuj</a>

                                <form action="{{ route('librarian.books.destroy', $ksiazka->id) }}" method="POST"
                                      class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Usuń</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11">Nie znaleziono książek</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $ksiazki->links() }}
        </div>
    </div>
@endsection
