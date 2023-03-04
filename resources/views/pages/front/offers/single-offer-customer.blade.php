<x-front-layout :$pageTitle>
    <section
        class="hero flex justify-center items-end" style="background-image: url('{{ $offer->hotel->image ? $offer->hotel->image : '/assets/img/hero-home.jpg' }}')"
        id="hero">''
        <header class="hero-header mb-36">
            <h1 class="hero-title">{{ $offer->name }}</h1>
            <a href="#information"
                class="btn-scroll-down">
                <i class="fa-solid fa-chevron-down"></i>
            </a>
        </header>
    </section>

    <section class="section" id="information">
        <h2
            class="section-title">
            Informacija
        </h2>

        <x-front.offer-info-card :$offer />
    </section>

    <section class="section pt-0" id="opinions">
        <h2
            class="section-title">
            Atsiliepimai
        </h2>

        <div class="cards-container">
            @if (count($offer->reviews) != 0)
                @foreach ($offer->reviews as $review)        
                    <x-front.review-card :$review />
                @endforeach
            @else
                <h2 class="empty-list">Nėra atsiliepimų</h2>
            @endif
        </div>
    </section>
</x-front-layout>
