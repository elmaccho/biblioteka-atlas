<div class="d-flex flex-column">
    <div class="side-menu-title d-flex justify-content-between mb-5">
        <h1 class="title"><i class="fa-solid fa-book"></i> Atlas</h1>
        <button class="toggle-menu-btn"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <div class="side-menu-links">
        <div class="side-menu-main-links">

            {{-- Strona główna --}}
            <a class="link-button" href="{{ route('home') }}">
                <i class="fa-solid fa-house"></i> 
                <span>Strona główna</span>
            </a>

            {{-- Kategorie --}}
            <a class="link-button" href="{{ route('kategorie') }}">
                <i class="fa-solid fa-table-list"></i>
                <span>Kategorie</span>
            </a>
        </div>
        <hr>
        <div class="side-menu-user-links">

            {{-- Historia wypożyczeń --}}
            <a class="link-button" href="{{ route('home') }}">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Historia wypożyczeń</span>
            </a>

            {{-- Moje wypożyczenia --}}
            <a class="link-button" href="{{ route('home') }}">
                <i class="fa-solid fa-calendar-check"></i>
                <span>Moje wypożyczenia</span>
            </a>

            {{-- Rezerwacje --}}
            <a class="link-button" href="{{ route('home') }}">
                <i class="fa-solid fa-newspaper"></i>
                <span>Rezerwacje</span>
            </a>

            {{-- Ustawienia --}}
            <a class="link-button" href="{{ route('home') }}">
                <i class="fa-solid fa-gear"></i>
                <span>Ustawienia</span>
            </a>

            {{-- Wyloguj się --}}
            <a class="link-button" href="{{ route('home') }}">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Wyloguj się</span>
            </a>
        </div>
    </div>
</div>