@extends('layouts.app')

@section('content')

    <h1>cwelo</h1>

        @foreach ($ksiazki as $ksiazka)
            <div class="flex flex-column">
                <h3>{{ $ksiazka->tytul }}</h3>
                <p>{{ $ksiazka->autor ? $ksiazka->autor->name : "brak XD" }}</p>
                <p>{{ $ksiazka->opis }}</p>
            </div>
            <hr>
        @endforeach
@endsection