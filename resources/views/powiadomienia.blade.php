@extends('layouts.app')
@vite(['resources/css/home-page.css', 'resources/css/book.css'])
@section('content')
    <div class="main-container d-flex flex-column align-items-left">
        <div class="container mt-5">
            <h2 class="mb-4">Powiadomienia</h2>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Treść</th>
                        <th scope="col">Data</th>
                        <th scope="col">Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($powiadomienia as $pow)
                        <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ $pow->tresc }}</td>
                            <td>{{ $pow->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                @if ($pow->read_at == null)
                                <form action="{{ route('powiadomienia.przeczytaj', $pow->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-outline-primary btn-sm">
                                        Oznacz jako przeczytane
                                    </button>
                                </form>
                                    @else
                                    <button class="btn btn-outline-secondary btn-sm disabled">
                                        Przeczytano
                                    </button>
                                @endif
                            </td>
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
    </div>
@endsection