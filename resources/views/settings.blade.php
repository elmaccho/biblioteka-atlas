@extends('layouts.app')
@vite(['resources/css/home-page.css', 'resources/css/settings.css'])
@section('content')
    <div class="main-container">
        <h2 class="h1 mb-4">Ustawienia</h2>
        <div class="settings-container">
            <div class="user-data-forms">
                <form action="" class="data-form mb-5">
                    @csrf
                    <h4>Edytuj dane</h4>
                    <div class="row mb-2">
                        <label for="name">Imię</label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}">
                    </div>
                    <div class="row mb-2">
                        <label for="lastname">Nazwisko</label>
                        <input type="text" name="lastname" id="lastname" value="{{ $user->lastname }}">
                    </div>
                    <div class="row mb-4">
                        <label for="phone_number">Numer telefonu</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ $user->phone_number }}" placeholder="Numer telefonu">
                    </div>
                    <div class="row">
                        <button type="submit" class="book-button book-button-reserve">Zapisz</button>
                    </div>
                </form>
                <form action="" class="password-form">
                    @csrf
                    <h4>Zmień hasło</h4>
                    <div class="row mb-2">
                        <label for="actual_password">Aktualne hasło</label>
                        <input type="password" name="actual_password" id="actual_password" placeholder="Aktualne hasło">
                    </div>
                    <div class="row mb-4">
                        <label for="new_password">Nowe hasło</label>
                        <input type="password" name="new_password" id="new_password" placeholder="Nowe hasło">
                    </div>
                    <div class="row">
                        <button class="book-button book-button-reserve" type="submit">Zapisz</button>
                    </div>
                </form>
            </div>
<div class="user-photo-form">
    <form action="" class="photo-form" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($user->profile_img_src == null)
            <img id="preview-image" class="settings-user-image mb-4" src="{{ asset('storage/user/default.webp') }}" alt="{{ $user->name }} {{ $user->lastname }}">
        @else
            <img id="preview-image" class="settings-user-image mb-4" src="{{ asset('storage/user/'.$user->profile_img_src) }}" alt="{{ $user->name }} {{ $user->lastname }}">
        @endif

        <div class="row mb-3">
            <input type="file" id="user-image" name="avatar" accept="image/*">
        </div>
        <div class="row">
            <button class="book-button book-button-reserve w" type="submit">Zmień zdjęcie</button>
        </div>
    </form>
</div>
        </div>
    </div>

    <script>
    const input = document.getElementById('user-image');
    const preview = document.getElementById('preview-image');

    input.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.setAttribute('src', e.target.result);
            }

            reader.readAsDataURL(file);
        }
    });
</script>
@endsection