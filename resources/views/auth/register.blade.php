<x-front-layout :$pageTitle>
    <section class="section-form min-h-[115vh] pb-8 bg-[url('/public/assets/img/hero-home.jpg')]" id="hero">
        <div class="bg-transparent h-[100px]"></div>
        <header class="hero-header">
            <h1
                class="hero-subtitle text-xl lg:text-2xl">
                Registracija
            </h1>
        </header>
        
        <x-front.register-form />
    </section>
</x-front-layout>
