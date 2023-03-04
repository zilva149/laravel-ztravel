<form method="POST" action="{{ route('login') }}" class="form">
    @csrf

    @if (session()->has('success'))
        <x-message size="lg" operation="success" :text="session('success')" />
    @endif

    @if (session()->has('failure'))
        <x-message size="lg" operation="failure" :text="session('failure')" />
    @endif

    <x-auth-validation-modal :errors="$errors" />
    
    <!-- Email Address -->
    <div class="mb-6 flex flex-col gap-2">
        <x-form.label for="email" :value="__('El. paštas')" />
        <x-form.input id="email" class="block w-full" type="email" name="email" :value="old('email')"
            placeholder="{{ __('') }}" autofocus />
    </div>

    <!-- Password -->
    <div class="mb-6 flex flex-col gap-2">
        <x-form.label for="password" :value="__('Slaptažodis')" />
        <x-form.input id="password" class="block w-full" type="password" name="password"
            autocomplete="new-password" placeholder="{{ __('') }}" autofocus />
    </div>

    <!-- Remember Me -->
    <div class="mb-6 flex items-center justify-between">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox"
                class="text-[var(--green)] border-gray-300 rounded focus:border-[var(--green)] focus:ring focus:ring-[var(--dgreen)]"
                name="remember">

            <span class="ml-2 text-sm text-white">
                {{ __('Atsiminti slaptažodį') }}
            </span>
        </label>

        @if (Route::has('password.request'))
            <a class="text-sm text-[var(--green)] hover:underline" href="{{ route('password.request') }}">
                {{ __('Pamiršai slaptažodį?') }}
            </a>
        @endif
    </div>

    <!-- Submit Button -->
    <div class="mb-6">
        <button type="submit" class="btn-action-link">Prisijungti</button>
    </div>

    <!-- Register Link -->
    @if (Route::has('register'))
        <p class="text-sm text-white">
            {{ __('Neturi paskyros?') }}
            <a href="{{ route('register') }}" class="ml-2 text-[var(--green)] hover:underline">
                {{ __('Registracija') }}
            </a>
        </p>
    @endif
</form>