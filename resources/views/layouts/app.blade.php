<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- FontAwesome --}}
    <script src="https://kit.fontawesome.com/4798a03daf.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/side-menu.css', 'resources/css/upper-menu.css', 'resources/js/side-menu.js'])
</head>

<body>

    <div class="flex w-100">
        {{-- Side Menu (lewa kolumna) --}}
        <div class="side-menu-container">
            <x-side-menu />
        </div>
    
        {{-- Główna zawartość (prawa kolumna) --}}
        <div class="content-container">
            <x-upper-menu />
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>