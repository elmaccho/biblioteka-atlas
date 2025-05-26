<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- ApexCharts --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- FontAwesome --}}
    <script src="https://kit.fontawesome.com/4798a03daf.js" crossorigin="anonymous"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none" href="{{ route('admin.notifications.history') }}">
                                    <span>Historia powiadomień</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="katalog-panel mb-2">
                        <h2 class="accordion-header">
                            <button class="link-button p-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseTwo">
                                <i class="fa-solid fa-book"></i>
                                <span>Katalog książek</span>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                            <div class="accordion-body d-flex flex-column" style="padding-left: 45px">
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none"
                                    href="{{ route('admin.books', 'show') }}">
                                    <span>Wyświetl książki</span>
                                </a>
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none"
                                    href="{{ route('admin.books', 'new') }}">
                                    <span>Dodaj książkę</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="kategorie-panel mb-2">
                        <h2 class="accordion-header">
                            <button class="link-button p-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseCategory" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseCategory">
                                <i class="fa-solid fa-book"></i>
                                <span>Kategorie</span>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseCategory" class="accordion-collapse collapse">
                            <div class="accordion-body d-flex flex-column" style="padding-left: 45px">
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none"
                                    href="{{ route('admin.category', 'index') }}">
                                    <span>Wyświetl kategorie</span>
                                </a>
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none"
                                    href="{{ route('admin.category', 'new') }}">
                                    <span>Dodaj kategorie</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="authors-panel mb-2">
                        <h2 class="accordion-header">
                            <button class="link-button p-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseAuthor" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseAuthor">
                                <i class="fa-solid fa-user-pen"></i>
                                <span>Autorzy</span>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseAuthor" class="accordion-collapse collapse">
                            <div class="accordion-body d-flex flex-column" style="padding-left: 45px">
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none"
                                    href="{{ route('admin.authors') }}">
                                    <span>Wyświetl autorów</span>
                                </a>
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none"
                                    href="{{ route('admin.authors.create') }}">
                                    <span>Dodaj autora</span>
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
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none" href="{{ route('admin.system.adminlog') }}">
                                    <span>Dziennik administratora</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="raportyistats-panel mb-2">
                        <h2 class="accordion-header">
                            <a href="{{ route('admin.raports') }}" class="link-button p-0 justify-content-start">
                                <i class="fa-solid fa-file"></i>
                                <span>Statystyki</span>
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
                                    href="{{ route('admin.raportaktywnosci') }}">
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
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    @if(session('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
    @endif

    @if(session('error'))
        Toast.fire({
            icon: 'error',
            title: '{{ session('error') }}'
        });
    @endif

    @if(session('warning'))
        Toast.fire({
            icon: 'warning',
            title: '{{ session('warning') }}'
        });
    @endif

    @if(session('info'))
        Toast.fire({
            icon: 'info',
            title: '{{ session('info') }}'
        });
    @endif


    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Na pewno chcesz usunąć?',
                text: 'Tej akcji nie można cofnąć!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Usuń!',
                cancelButtonText: 'Jednak nie'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

</html>