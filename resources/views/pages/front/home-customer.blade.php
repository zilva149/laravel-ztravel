<x-front-layout :$pageTitle>
    <section
        class="hero bg-[url('/public/assets/img/hero-home.jpg')]"
        id="hero">
        <header class="hero-header">
            <h2
                class="hero-subtitle">
                Mėgaukites gamta su mumis
            </h2>
            <h1 class="hero-title">Svajonių kelionės</h1>
            <a href="{{ route('customer-offers') }}" class="btn-action-link py-3">Mūsų pasiūlymai</a>
        </header>
    </section>

    <x-front.section-quote quote="Tūkstančio žingsnių kelionė prasideda nuo pirmo žingsnio." author="Lao Tzu" />

    <section class="section">
        <h2
            class="section-title">
            Populiariausios vietovės
        </h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 justify-between items-center">
            @foreach ($topDestinations as $destination)
                <x-front.destination-card :$destination />
            @endforeach
        </div>
    </section>
</x-front-layout>
