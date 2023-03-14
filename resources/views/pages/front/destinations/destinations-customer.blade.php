<x-front-layout :$pageTitle>
    <section
        class="hero bg-[url('/public/assets/img/hero-boat.jpg')] flex justify-center items-end"
        id="hero">
        <header class="hero-header mb-36">
            <h1 class="hero-title">Mūsų vietovės</h1>
            <a href="#destinations"
                class="btn-scroll-down">
                <i class="fa-solid fa-chevron-down"></i>
            </a>
        </header>
    </section>

    <section class="section" id="destinations">
        <h2
            class="section-title">
            Vietovės
        </h2>

        <x-front.filter-card :$continents :$countries :$request />

        <div class="cards-container" id="destinations-container">
            @if (isset($destinations) && count($destinations) != 0)
                @foreach ($destinations as $destination)        
                    <x-front.destination-card :$destination />
                @endforeach
            @else
                <h2 class="empty-list">Nėra vietovių</h2>
            @endif
        </div>
    </section>

    <script>
        const page = 'destinations';
    </script>
</x-front-layout>