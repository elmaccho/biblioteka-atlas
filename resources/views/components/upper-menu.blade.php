<div class="upper-menu-container">
    <form class="search-bar" action="">
        @csrf
        <input type="search" name="" id="" placeholder="Wyszukaj książkę" class="search-bar-input">
    </form>

    <div class="user-action-container">
        <a href="{{ route('home') }}"> <i class="fa-regular fa-bell text-light"></i></a>
        <div class="user-action">
            {{ $user ? $user->name : "Maciej" }}
        </div>
    </div>
</div>