<x-front-layout :$pageTitle>
    <section
        class="hero bg-[url('/public/assets/img/hero-contact.jpg')] flex justify-center items-end"
        id="hero">
        <header class="hero-header mb-36">
            <h1 class="hero-title">Kontaktai</h1>
            <a href="#contacts"
                class="btn-scroll-down">
                <i class="fa-solid fa-chevron-down"></i>
            </a>
        </header>
    </section>

    <section class="section" id="contacts">
        <h2
            class="section-title">
            Susisiekite su mumis
        </h2>

        <div class="w-full bg-[rgba(21,34,56,0.8)] py-10 px-6 text-white rounded-lg shadow-md mb-14 overflow-hidden">
            <div class="w-full flex justify-between flex-col gap-6 lg:flex-row">
                <div class="p-2 lg:p-6 flex flex-col gap-4">
                    <p class="flex flex-col gap-1">
                        <span class="font-semibold">El. paštas:</span>
                        pensininkų g. 14, Vilnius
                    </p>
                    <p class="mb-8 flex flex-col gap-1">
                        <span class="font-semibold">Tel. numberis:</span>
                        +370 61278149
                    </p>
                    <div class="flex gap-6 items-start">
                        <a href="#">
                            <i class="fa-brands fa-facebook text-3xl cursor-pointer transition-all hover:text-[var(--green)]"></i>
                        </a>
                        <a href="#">
                            <i class="fa-brands fa-instagram text-3xl cursor-pointer transition-all hover:text-[var(--green)]"></i>
                        </a>
                        <a href="#">
                            <i class="fa-brands fa-twitter text-3xl cursor-pointer transition-all hover:text-[var(--green)]"></i>
                        </a>
                    </div>
                </div>
                <form action="{{ route('customer-send-message') }}" method="POST" class="w-full p-6 flex flex-col gap-4 border-2 border-solid border-white rounded-lg lg:max-w-[500px]" id="contacts-form">
                    @csrf

                    @if (session()->has('success'))
                        <x-message size="lg" operation="success" :text="session('success')" />
                    @endif

                    <!-- Email Address -->
                    <div class="mb-6 flex flex-col gap-2">
                        <input type="text" class="form-text" name="email" value="{{ old('email', '') }}" placeholder="El. paštas..." />
                        @error('email')
                            <x-message size="sm" operation="failure" :text="$message" />
                        @enderror
                    </div>
    
                    <!-- Message -->
                    <div class="mb-6 flex flex-col gap-2">
                        <textarea class="form-text" name="desc" rows="6" placeholder="Palikite mums žinutę...">{{ old('desc', '') }}</textarea>
                        @error('desc')
                            <x-message size="sm" operation="failure" :text="$message" />
                        @enderror
                    </div>
    
                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="btn-action-link">Siųsti</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-front-layout>