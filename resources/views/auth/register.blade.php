<x-front-layout>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Registracija
            </h2>
        </div>
    </x-slot>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <section class="flex justify-center">
        <form method="POST" action="{{ route('register') }}"
            class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg dark:bg-dark-eval-1 dark:text-white">
            @csrf

            <!-- Name -->
            <div class="mb-6 flex flex-col gap-2">
                <x-form.label for="name" :value="__('Vardas')" />
                <x-form.input id="name" class="block w-full" type="text" name="name" :value="old('name')"
                    autofocus placeholder="{{ __('') }}" />
            </div>

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

            <!-- Confirm Password -->
            <div class="mb-6 flex flex-col gap-2">
                <x-form.label for="password_confirmation" :value="__('Patvirtinti slaptažodį')" />
                <x-form.input id="password_confirmation" class="block w-full" type="password"
                    name="password_confirmation" placeholder="{{ __('') }}" />
            </div>

            <!-- Submit Button -->
            <div class="mb-6">
                <button type="submit" class="btn-primary">Pridėti</button>
            </div>

            <!-- Login Link -->
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('Jau prisiregistravęs?') }}
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
                    {{ __('Prisijungti') }}
                </a>
            </p>
        </form>
    </section>
</x-front-layout>
