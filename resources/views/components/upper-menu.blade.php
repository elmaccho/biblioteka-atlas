<div class="upper-menu-container">
    <button class="toggle-menu-btn"><i class="fa-solid fa-bars"></i></button>
    <form class="search-bar" action="">
        @csrf
        <input type="search" name="" id="" placeholder="Wyszukaj książkę" class="search-bar-input">
    </form>

    @if ($user)
        <div class="user-action-container d-flex align-items-center gap-3">
            <a href="{{ route('powiadomienia.index') }}" class="position-relative d-inline-block">
                <i class="fa-regular fa-bell text-light"></i>
                @if ($user->hasNotifications())
                    <span
                        class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                    </span>
                @endif
            </a>

            <div class="dropdown d-flex gap-2">
                @if ($user->profile_img_src != null)
                    <img src="{{ asset('storage/user/' . $user->profile_img_src) }}" alt="">
                @else
                    <i class="fa-solid fa-circle-user" style="font-size: 30px"></i>
                @endif
                <button class="bg-transparent text-light border-0 dropdown-toggle d-flex align-items-center gap-1" type="button"
                    id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $user->name }}
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a href="{{ route('home') }}" class="dropdown-item text-dark">
                                Profil
                            </a>
                        </li>

                        @if ($user->hasRole('librarian'))
                            <li>
                                <a href="{{ route('librarian.index') }}" class="dropdown-item text-dark">
                                    Panel Bibliotekarza
                                </a>
                            </li>
                            @elseif ($user->hasRole(['admin', 'bibliotekarz']))
                            <li>
                                <a href="{{ route('admin.index') }}" class="dropdown-item text-dark">
                                    Panel Administracyjny
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('librarian.index') }}" class="dropdown-item text-dark">
                                    Panel Bibliotekarza
                                </a>
                            </li>
                            @endif
                            <li>
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item text-dark">
                                    Wyloguj się
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
    @endif
</div>