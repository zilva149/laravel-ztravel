<x-front-layout :$pageTitle>
    <section class="section-form bg-[url('/public/assets/img/hero-home.jpg')]" id="hero">
        <div class="bg-transparent h-[100px]"></div>
        <header class="hero-header">
            <h1
                class="hero-subtitle text-xl lg:text-2xl">
                Prisijunkite
            </h1>
        </header>
        
        <x-front.login-form />
    </section>
</x-front-layout>
