<x-front-layout>
    <section
        class="relative min-h-[115vh] text-gray-900 bg-[url('/public/assets/img/hero-home.jpg')] bg-cover bg-center bg-fixed before:content-[''] before:absolute before:top-0 before:left-0 before:right-0 before:bottom-0 before:bg-[#14261c] before:opacity-[0.6] flex flex-col justify-center items-center"
        id="hero">
        <header class="relative flex flex-col items-center bg-transparent z-99">
            <h1
                class="relative mb-12 text-white text-2xl text-center before:content-[''] before:absolute before:left-[50%] before:bottom-[-14px] before:w-1/2 before:h-[3px] before:bg-[var(--green)] before:translate-x-[-50%]">
                Registracija
            </h1>
        </header>
        <form method="POST" action="{{ route('register') }}"
            class="relative p-6 rounded-lg border-2 shadow-lg bg-[rgba(21,34,56,0.4)] w-full max-w-lg z-99">
            @csrf

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

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
                <button type="submit" class="btn-action-link">Registruotis</button>
            </div>

            <!-- Login Link -->
            <p class="text-sm text-white">
                {{ __('Jau prisiregistravęs?') }}
                <a href="{{ route('login') }}" class="text-[var(--green)] hover:underline">
                    {{ __('Prisijungti') }}
                </a>
            </p>
        </form>
    </section>
</x-front-layout>
