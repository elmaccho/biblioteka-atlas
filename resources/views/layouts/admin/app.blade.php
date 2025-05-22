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
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/css/upper-menu.css',
        'resources/js/side-menu.js',
        'resources/css/panel/panel.css'
    ])
</head>

<body class="overflow-hidden">
    <div class="d-flex w-100" style="height: 100vh;">
        <div class="side-menu-container">
            <x-panel title="Panel administracyjny">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="dashboard-panel mb-2">
                        <h2 class="accordion-header">
                            <a href="{{ route('home') }}" class="link-button p-0 justify-content-start">
                                <i class="fa-solid fa-home"></i>
                                <span>Strona główna</span>
                            </a>
                        </h2>
                    </div>

                    <div class="notification-panel mb-2">
                        <h2 class="accordion-header">
                            <button class="link-button p-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                <i class="fa-solid fa-bell"></i>
                                <span>Powiadomienia</span>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                            <div class="accordion-body d-flex flex-column" style="padding-left: 45px">
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none" href="{{ route('home') }}">
                                    <span>Przypomnienia o zwrocie</span>
                                </a>
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none" href="{{ route('home') }}">
                                    <span>Historia powiadomień</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="zasoby-panel mb-2">
                        <h2 class="accordion-header">
                            <button class="link-button p-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseTwo">
                                <i class="fa-solid fa-book"></i>
                                <span>Zasoby biblioteki</span>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                            <div class="accordion-body d-flex flex-column" style="padding-left: 45px">
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none" href="{{ route('home') }}">
                                    <span>Wyświetl książki</span>
                                </a>
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none" href="{{ route('home') }}">
                                    <span>Dodaj nową książkę</span>
                                </a>
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none" href="{{ route('home') }}">
                                    <span>Edytuj książkę</span>
                                </a>
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none" href="{{ route('home') }}">
                                    <span>Kategorie i autorzy</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="operacjesys-panel mb-2">
                        <h2 class="accordion-header">
                            <button class="link-button p-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseThree">
                                <i class="fa-solid fa-recycle"></i>
                                <span>Operacje systemowe</span>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                            <div class="accordion-body d-flex flex-column" style="padding-left: 45px">
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none" href="{{ route('home') }}">
                                    <span>Historia operacji użytkownika</span>
                                </a>
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none" href="{{ route('home') }}">
                                    <span>Dziennik administratora</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="raportyistats-panel mb-2">
                        <h2 class="accordion-header">
                            <a href="#" class="link-button p-0 justify-content-start">
                                <i class="fa-solid fa-file"></i>
                                <span>Raporty i statystyki</span>
                            </a>
                        </h2>
                    </div>

                    <div class="uzytkownicy-panel">
                        <h2 class="accordion-header">
                            <button class="link-button p-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseFive">
                                <i class="fa-solid fa-users"></i>
                                <span>Użytkownicy</span>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
                            <div class="accordion-body d-flex flex-column" style="padding-left: 45px">
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none"
                                    href="{{ route('admin.users', 'index') }}">
                                    <span>Wyświetl użytkowników</span>
                                </a>
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none"
                                    href="{{ route('admin.users', 'activity_report') }}">
                                    <span>Generuj raport aktywności</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </x-panel>
        </div>
        <div class="content-container d-flex flex-column flex-grow-1">
            <div class="content-scroll-area flex-grow-1 overflow-auto">
                @yield('panel_content')
            </div>
        </div>
    </div>
</body>

</html>