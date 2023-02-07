<x-front-layout>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Prisijungti
            </h2>
        </div>
    </x-slot>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <section class="flex justify-center">
        <form method="POST" action="{{ route('login') }}"
            class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg dark:bg-dark-eval-1 dark:text-white">
            @csrf

            <!-- Email Address -->
            <div class="mb-6 flex flex-col gap-2">
                <x-form.label for="email" :value="__('El. paštas')" />
                <x-form.input id="email" class="block w-full" type="email" name="email" :value="old('email')"
                    placeholder="{{ __('') }}" />
            </div>

            <!-- Password -->
            <div class="mb-6 flex flex-col gap-2">
                <x-form.label for="password" :value="__('Slaptažodis')" />
                <x-form.input id="password" class="block w-full" type="password" name="password"
                    autocomplete="new-password" placeholder="{{ __('') }}" />
            </div>

            <!-- Remember Me -->
            <div class="mb-6 flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="text-purple-500 border-gray-300 rounded focus:border-purple-300 focus:ring focus:ring-purple-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1"
                        name="remember">

                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Atsiminti slaptažodį') }}
                    </span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-500 hover:underline" href="{{ route('password.request') }}">
                        {{ __('Pamiršai slaptažodį?') }}
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="mb-6">
                <button type="submit" class="btn-primary">Pridėti</button>
            </div>

            <!-- Register Link -->
            @if (Route::has('register'))
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Neturi paskyros?') }}
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">
                        {{ __('Registracija') }}
                    </a>
                </p>
            @endif
        </form>
    </section>
</x-front-layout>
