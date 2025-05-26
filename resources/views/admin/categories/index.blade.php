@extends('layouts.admin.app')
@vite('resources/css/home-page.css')

@section('panel_content')
<div class="main-container">
    <h2 class="mb-4">Historia powiadomień</h2>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nazwa</th>
                <th>Obrazek</th>
                <th>Data utworzenia</th>
                <th>Data aktualizacji</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $category->nazwa }}</td>
                    <td>
                        @if($category->photo_src)
                            <img src="{{ asset('storage/categories/' . $category->photo_src) }}" alt="obrazek" width="50">
                        @else
                            Brak obrazka
                        @endif
                    </td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>
                        <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-warning">Edytuj</a>
                        <form class="delete-form" action="{{ route('admin.category.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Usuń</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
