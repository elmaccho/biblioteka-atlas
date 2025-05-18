<div class="d-flex flex-column">
    <div class="side-menu-title d-flex justify-content-between mb-5">
        <h1 class="title"><i class="fa-solid fa-book"></i> {{ $title }}</h1>
        <button class="toggle-menu-btn"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <div class="side-menu-links">
        <div class="side-menu-main-links">
            {{ $slot }}
            {{-- Strona główna --}}
            {{-- <a class="link-button" href="{{ route('home') }}">
                <i class="fa-solid fa-house"></i>
                <span>Strona główna</span>
            </a> --}}
            {{-- Wyloguj się --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="link-button" href="{{ route('logout') }}" onclick="event.preventDefault();
                            this.closest('form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Wyloguj się</span>
                </a>
            </form>
        </div>
    </div>
</div>