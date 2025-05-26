@extends('layouts.admin.app')
@vite('resources/css/home-page.css')
@section('panel_content')
    <div class="main-container">
        <h2 class="mb-4">Historia powiadomień</h2>

                    <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Treść</th>
                        <th scope="col">Odbiorca</th>
                        <th scope="col">Data</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($powiadomienia as $pow)
                        <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ $pow->tresc }}</td>
                            <td>{{ $pow->user->name }} {{ $pow->user->lastname }}</td>
                            <td>{{ $pow->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                Nie masz jeszcze żadnych powiadomień
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
    </div>
@endsection