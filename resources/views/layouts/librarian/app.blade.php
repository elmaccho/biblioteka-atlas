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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/side-menu.css', 'resources/css/upper-menu.css', 'resources/js/side-menu.js', 'resources/css/panel/panel.css'])
</head>

<body class="overflow-hidden">
    <div class="d-flex w-100" style="height: 100vh;">
        <div class="side-menu-container">
            <x-panel title="Panel bibliotekarza">
                <a class="link-button" href="{{ route('home') }}">
                    <i class="fa-solid fa-house"></i>
                    <span>Strona główna</span>
                </a>
            </x-panel>
        </div>
        <div class="content-container d-flex flex-column flex-grow-1">
            <div class="content-scroll-area flex-grow-1 overflow-auto">
                @yield('panel_content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>