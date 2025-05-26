@extends('layouts.admin.app')
@vite('resources/css/home-page.css')

@section('panel_content')
    <div class="main-container">
        <h2>Dziennik administratora</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Akcja</th>
                    <th>Szczegóły</th>
                    <th>Utworzono</th>
                    <th>Zmodyfikowano</th>
                </tr>
            </thead>
            <tbody>
                @forelse($adminlogs as $log)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $log->user ? $log->user->name . ' ' . $log->user->lastname : 'Brak danych' }}</td>
                        <td>{{ $log->action }}</td>
                        <td>
                            <pre>
                                @if(is_array($log->details) || is_object($log->details))
                                    {{ json_encode($log->details, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                                @else
                                    {{ $log->details }}
                                @endif
                            </pre>
                        </td>
                        <td>{{ $log->created_at }}</td>
                        <td>{{ $log->updated_at }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            Brak logów
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-links">
            {{ $adminlogs->links() }}
        </div>
    </div>
@endsection
