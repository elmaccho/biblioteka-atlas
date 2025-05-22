@extends('layouts.librarian.app')

@section('panel_content')
<div class="container mt-5">
    <h2>Lista autorów</h2>

    @if ($autorzy->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imię i nazwisko</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($autorzy as $autor)
                    <tr>
                        <td>{{ $autor->id }}</td>
                        <td>{{ $autor->name }}</td>
                        <td>
                            <a href="{{ route('librarian.authors.edit', $autor->id) }}" class="btn btn-primary btn-sm">Edytuj</a>
                            <form action="{{ route('librarian.authors.destroy', $autor->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Usuń</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $autorzy->links() }}
    @else
        <p>Brak autorów, ty głąbie.</p>
    @endif
</div>
@endsection
