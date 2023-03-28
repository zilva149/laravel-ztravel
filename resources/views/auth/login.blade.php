<x-front-layout :$pageTitle>
    <section class="section-form bg-[url('/public/assets/img/hero-home.jpg')]" id="hero">
        <div class="bg-transparent h-[100px]"></div>
        <header class="hero-header">
            <h1
                class="hero-subtitle text-xl lg:text-2xl">
                Prisijunkite
            </h1>
        </header>
        
        <div class="form-xl">
            <div class="w-full flex flex-col gap-10">
                <div class="flex flex-col gap-4">
                    <h2 class="text-white text-base">Prisijungimas klientams:</h2>
                    <span class="text-white text-base">El. paštas: jonas@gmail.com</span>
                    <span class="text-white text-base">Slaptažodis: jonas123</span>
                </div>
                <div class="flex flex-col gap-4">
                    <h2 class="text-white text-base">Prisijungimas adminams:</h2>
                    <span class="text-white text-base">El. paštas: zilvinas@gmail.com</span>
                    <span class="text-white text-base">Slaptažodis: zilvinas123</span>
                </div>
            </div>
            <form method="POST" action="{{ route('login') }}" class="form w-full">
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
        </div>
    </section>
</x-front-layout>
