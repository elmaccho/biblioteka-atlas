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
        'resources/css/side-menu.css',
        'resources/css/upper-menu.css',
        'resources/js/side-menu.js',
        'resources/css/panel/panel.css'
    ])
</head>

<body class="overflow-hidden">
    <div class="d-flex w-100" style="height: 100vh;">
        <div class="side-menu-container">
            <x-panel title="Panel administracyjny">
                {{-- <a class="link-button" href="{{ route('home') }}">
                    <i class="fa-solid fa-house"></i>
                    <span>Strona główna</span>
                </a> --}}
                {{-- <div class="mb-3">
                    <button class="btn btn-primary w-100 text-start d-flex align-items-center justify-content-between"
                        type="button" data-bs-toggle="collapse" data-bs-target="#category1" aria-expanded="false"
                        aria-controls="category1">
                        <div><i class="fa-solid fa-house me-2"></i>Strona główna</div>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="collapse" id="category1">
                        <div class="card card-body">
                            <a href="#" class="btn btn-link text-start">Podkategoria 1</a>
                            <a href="#" class="btn btn-link text-start">Podkategoria 2</a>
                            <a href="#" class="btn btn-link text-start">Podkategoria 3</a>
                        </div>
                    </div>
                </div> --}}

                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                Accordion Item #1
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <code>XDDDDDDDDDDd</code>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>