<x-front-layout :$pageTitle>
    <section
        class="relative min-h-[95vh] text-gray-900 bg-[url('/public/assets/img/hero-home.jpg')] bg-cover bg-center bg-fixed before:content-[''] before:absolute before:top-0 before:left-0 before:right-0 before:bottom-0 before:bg-[#14261c] before:opacity-[0.6] flex flex-col justify-center items-center"
        id="hero">
        <header class="relative flex flex-col items-center bg-transparent z-99">
            <h1
                class="relative mb-12 text-white text-2xl text-center before:content-[''] before:absolute before:left-[50%] before:bottom-[-14px] before:w-1/2 before:h-[3px] before:bg-[var(--green)] before:translate-x-[-50%]">
                Prisijunkite
            </h1>
        </header>
        <form method="POST" action="{{ route('login') }}"
            class="relative p-6 rounded-lg border-2 shadow-lg bg-[rgba(21,34,56,0.4)] w-full max-w-lg z-99">
            @csrf

            @if (session()->has('success'))
                <div class="modal mb-4" style="background-color: var(--green)">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session()->has('failure'))
                <div class="modal mb-4" style="background-color: var(--red)">
                    <p>{{ session('success') }}</p>
                </div>
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
    </section>
</x-front-layout>
