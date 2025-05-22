@extends('layouts.librarian.app')
@vite('resources/css/home-page.css')
@section('panel_content')
    <div class="main-container">
        <div class="container">
            <h2 class="mb-4">Lista użytkowników</h2>

            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Imię</th>
                        <th>Email</th>
                        <th>Data rejestracji</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('librarian.users.profile', $user->id) }}" class="btn btn-sm btn-primary">
                                    Profil
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection