<x-front-layout :$pageTitle>
    <section
        class="hero flex justify-center items-end" style="background-image: url('{{ $destination->image ? $destination->image : '/assets/img/hero-home.jpg' }}')"
        id="hero">''
        <header class="hero-header mb-36">
            <h1 class="hero-title">{{ $destination->name }}</h1>
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

        <div class="w-full bg-[rgba(21,34,56,0.8)] p-8 text-white rounded-lg shadow-md mb-14 flex flex-col gap-6 overflow-hidden lg:flex-row">
            <div class="w-full flex flex-col justify-between">
                <div class="mb-6 flex flex-col gap-2">
                    <p class="mb-2 flex flex-col gap-1">
                        <span class="font-semibold">Žemynas:</span>
                        {{ $destination->country->continent }}
                    </p>
                    <p class="mb-2 flex flex-col gap-1">
                        <span class="font-semibold">Šalis:</span>
                        {{ $destination->country->name }}
                    </p>
                    <p class="flex flex-col gap-1">
                        <span class="font-semibold">Sezono laikas:</span>
                        {{ $destination->country->season_start }} iki {{ $destination->country->season_end }}
                    </p>
                </div>
            </div>
            <p class="w-full">{{ $destination->desc }}</p>
        </div>
    </section>

    <section class="section pt-0" id="opinions">
        <h2
            class="section-title">
            Pasiūlymai
        </h2>

        <div class="cards-container">
            @if (count($destination->offers) > 0)
                @foreach ($destination->offers as $offer)        
                    <x-front.offer-card :$offer />
                @endforeach
            @else
                <h2 class="empty-list">Nėra pasiūlymų</h2>
            @endif
        </div>
    </section>
</x-front-layout>
