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

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/css/panel/panel.css',
        'resources/css/upper-menu.css',
        'resources/js/side-menu.js'
    ])
</head>

<body class="overflow-hidden">
    <div class="d-flex w-100" style="height: 100vh;">
        <div class="side-menu-container">
            <x-panel title="Panel bibliotekarza">
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
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none" href="{{ route('librarian.notifications.reminderForm') }}">
                                    <span>Wyślij przypomnienie</span>
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
                                    href="{{ route('librarian.books', 'show') }}">
                                    <span>Wyświetl książki</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="rezerwacje-panel mb-2">
                        <h2 class="accordion-header">
                            <button class="link-button p-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-Six" aria-expanded="true"
                                aria-controls="panelsStayOpen-Six">
                                <i class="fa-solid fa-recycle"></i>
                                <span>Rezerwacje</span>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-Six" class="accordion-collapse collapse">
                            <div class="accordion-body d-flex flex-column" style="padding-left: 45px">
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none"
                                    href="{{ route('librarian.reservations', 'active') }}">
                                    <span>Aktywne rezerwacje</span>
                                </a>
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none"
                                    href="{{ route('librarian.reservations', 'archive') }}">
                                    <span>Archiwum</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="wypozyczenia-panel mb-2">
                        <h2 class="accordion-header">
                            <button class="link-button p-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseThree">
                                <i class="fa-solid fa-recycle"></i>
                                <span>Wypożyczenia</span>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                            <div class="accordion-body d-flex flex-column" style="padding-left: 45px">
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none"
                                    href="{{ route('librarian.rentals', 'new') }}">
                                    <span>Nowe wypożyczenie</span>
                                </a>
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none"
                                    href="{{ route('librarian.rentals', 'active') }}">
                                    <span>Lista aktywnych wypożyczeń</span>
                                </a>
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none"
                                    href="{{ route('librarian.rentals', 'archive') }}">
                                    <span>Archiwum</span>
                                </a>
                            </div>
                        </div>
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
                                <a style="color: #BDC3C7;" class="mb-2 text-decoration-none" href="{{ route('librarian.users') }}">
                                    <span>Wyświetl użytkowników</span>
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