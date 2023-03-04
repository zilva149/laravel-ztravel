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
        <div class="cards-container">
            @if (isset($topDestinations) && count($topDestinations) != 0)
                @foreach ($topDestinations as $destination)
                    <x-front.destination-card :$destination />
                @endforeach
            @else
                <h2 class="empty-list">Nėra vietovių</h2>
            @endif
        </div>
    </section>
</x-front-layout>
