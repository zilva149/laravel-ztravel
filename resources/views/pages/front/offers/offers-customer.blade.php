<x-front-layout :$pageTitle>
    <section
        class="hero bg-[url('/public/assets/img/hero-boat.jpg')] flex justify-center items-end"
        id="hero">
        <header class="hero-header mb-36">
            <h1 class="hero-title">Mūsų pasiūlymai</h1>
            <a href="#offers"
                class="btn-scroll-down">
                <i class="fa-solid fa-chevron-down"></i>
            </a>
        </header>
    </section>

    <section class="section" id="offers">
        <h2
            class="section-title">
            Pasiūlymai
        </h2>

        <x-front.filter-card :$continents :$countries :$request :$sortOptions />

        <div class="cards-container" id="offers-container">
            @if (isset($offers) && count($offers) != 0)
                @foreach ($offers as $offer)        
                    <x-front.offer-card :$offer />
                @endforeach
            @else
                <h2 class="empty-list">Nėra pasiūlymų</h2>
            @endif
        </div>
    </section>
</x-front-layout>
