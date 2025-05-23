<x-guest-layout>
    <div class="p-4">

        <div class="mb-4 text-sm text-gray-600">
            Zapomniałeś hasła? Nie ma problemu. Po prostu podaj nam swój adres e-mail, a my wyślemy Ci link do resetowania hasła, który pozwoli Ci wybrać nowe.
        </div>
    
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
    
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
    
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="btn btn-primary">
                    Wyślij link do zresetowania hasła
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
