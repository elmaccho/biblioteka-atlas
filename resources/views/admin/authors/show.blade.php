@extends('layouts.admin.app')
@vite('resources/css/home-page.css')
@section('panel_content')
    <div class="main-container">
        <h2>Lista autorów</h2>

        @if ($autorzy->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Imię i nazwisko</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($autorzy as $autor)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $autor->name }}</td>
                            <td>
                                <a href="{{ route('admin.authors.edit', $autor->id) }}" class="btn btn-success btn-sm">Edytuj</a>
                                <form action="{{ route('admin.authors.destroy', $autor->id) }}" method="POST"
                                    style="display:inline-block;" class="delete-form">
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