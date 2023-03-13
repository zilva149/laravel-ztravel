<x-front-layout :$pageTitle>
    <section class="section-form min-h-[115vh] pb-8 bg-[url('/public/assets/img/hero-home.jpg')]" id="hero">
        <div class="bg-transparent h-[100px]"></div>
        <header class="hero-header">
            <h1
                class="hero-subtitle text-xl lg:text-2xl">
                Registracija
            </h1>
        </header>
        
        <form method="POST" action="{{ route('register') }}" class="form">
            @csrf

            @if (session()->has('success'))
                <x-message size="lg" operation="success" :text="session('success')" />
            @endif

            @if (session()->has('failure'))
                <x-message size="lg" operation="failure" :text="session('failure')" />
            @endif

            <!-- Name -->
            <div class="mb-6 flex flex-col gap-2">
                <x-form.label for="name" :value="__('Vardas')" />
                <x-form.input id="name" class="block w-full" type="text" name="name" :value="old('name')"
                    autofocus placeholder="{{ __('') }}" autofocus />
                <x-auth-validation-errors :errors="$errors" input='name' />
            </div>

            <!-- Email Address -->
            <div class="mb-6 flex flex-col gap-2">
                <x-form.label for="email" :value="__('El. paštas')" />
                <x-form.input id="email" class="block w-full" type="email" name="email" :value="old('email')"
                    placeholder="{{ __('') }}" autofocus />
                <x-auth-validation-errors :errors="$errors" input='email' />
            </div>

            <!-- Password -->
            <div class="mb-6 flex flex-col gap-2">
                <x-form.label for="password" :value="__('Slaptažodis')" />
                <x-form.input id="password" class="block w-full" type="password" name="password"
                    autocomplete="new-password" placeholder="{{ __('') }}" autofocus />
                <x-auth-validation-errors :errors="$errors" input='password' />
            </div>

            <!-- Confirm Password -->
            <div class="mb-6 flex flex-col gap-2">
                <x-form.label for="password_confirmation" :value="__('Patvirtinti slaptažodį')" />
                <x-form.input id="password_confirmation" class="block w-full" type="password"
                    name="password_confirmation" placeholder="{{ __('') }}" autofocus />
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
