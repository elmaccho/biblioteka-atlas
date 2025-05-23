<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primiary']) }} class="btn btn-primary">
    {{ $slot }}
</button>
