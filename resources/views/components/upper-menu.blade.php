<div class="upper-menu-container">
    <button class="toggle-menu-btn"><i class="fa-solid fa-bars"></i></button>
    <form class="search-bar" action="">
        @csrf
        <input type="search" name="" id="" placeholder="Wyszukaj książkę" class="search-bar-input">
    </form>

    @if ($user)
        <div class="user-action-container d-flex align-items-center gap-3">
            <a href="{{ route('home') }}">
                <i class="fa-regular fa-bell text-light"></i>
            </a>


            <div class="dropdown d-flex gap-2">
                @if ($user->profile_img_src != null)
                    <img src="{{ asset('storage/user/' . $user->profile_img_src) }}" alt="">
                @else
                    <i class="fa-solid fa-circle-user" style="font-size: 30px"></i>
                @endif
                <button class="btn-outline-light dropdown-toggle d-flex align-items-center gap-1" type="button"
                    id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $user->name }}
                </button>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <a href="{{ route('home') }}" class="dropdown-item text-dark">
                            Profil
                        </a>
                    </li>

                    @if ($user->rola == 'bibliotekarz')
                        <li>
                            <a href="{{ route('librarian.dashboard') }}" class="dropdown-item text-dark">
                                Panel
                            </a>
                        </li>
                    @elseif ($user->rola == 'admin')
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item text-dark">
                                Panel
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