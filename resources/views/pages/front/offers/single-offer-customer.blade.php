<x-front-layout :$pageTitle>
    <section
        class="relative min-h-[90vh] text-gray-900 bg-cover bg-center bg-fixed before:content-[''] before:absolute before:top-0 before:left-0 before:right-0 before:bottom-0 before:bg-[#14261c] before:opacity-[0.6] flex justify-center items-end" style="background-image: url('{{ $offer->hotel->image ? $offer->hotel->image : '/assets/img/hero-home.jpg' }}')"
        id="hero">''
        <header class="relative mb-36 flex flex-col gap-16 items-center bg-transparent z-99">
            <h1 class="text-white text-4xl lg:text-5xl font-semibold text-center">{{ $offer->name }}</h1>
            <a href="#information"
                class="btn-action-link px-0 py-0 w-[60px] h-[60px] lg:w-[70px] lg:h-[70px] text-xl lg:text-3xl text-white rounded-full flex justify-center items-center animate-pulse">
                <i class="fa-solid fa-chevron-down"></i>
            </a>
        </header>
    </section>

    <section class="max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8 flex flex-col items-center" id="information">
        <h2
            class="relative mb-16 text-2xl lg:text-3xl text-center before:content-[''] before:absolute before:left-[50%] before:bottom-[-14px] before:w-1/2 before:h-[3px] before:bg-[var(--green)] before:translate-x-[-50%]">
            Informacija
        </h2>

        <div class="w-full bg-[rgba(21,34,56,0.8)] p-6 text-white rounded-lg shadow-md mb-14 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                @if ($offer->destination->image)
                    <div class="p-2 lg:p-6">
                        <img src="{{ $offer->destination->image }}" alt="{{ $offer->destination->name }}" class="rounded-lg">
                    </div>
                    <div class="p-2 lg:p-6">
                        <p>{{ $offer->destination->desc }}</p>
                    </div>
                @else
                    <div class="p-2 lg:p-6 lg:col-span-2">
                        <p>{{ $offer->destination->desc }}</p>
                    </div>
                @endif
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="p-2 lg:p-6 flex flex-col justify-between">
                    <div class="mb-6 flex flex-col gap-2">
                        <p class="mb-2 flex flex-col gap-1"><span class="font-semibold">Žemynas:</span>{{ $offer->country->continent }}</p>
                        <p class="mb-2 flex flex-col gap-1"><span class="font-semibold">Vieta:</span>{{ $offer->destination->name }}, {{ $offer->country->name }}</p>
                        <p class="mb-2 flex flex-col gap-1"><span class="font-semibold">Nakvynė:</span>{{ $offer->hotel->name }}, {{ $offer->hotel->address }}</p>
                        <p class="flex flex-col gap-1"><span class="font-semibold">Kelionės data:</span>{{ $offer->travel_start }} iki {{ $offer->travel_end }}</p>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div class="flex gap-8 justify-start items-center">
                            <p class="text-xl font-semibold">&euro;{{ number_format($offer->price, 2, '.', ',') }}</p>
                            <a href="{{ route('customer-payment-store', $offer->id) }}" class="btn-action-link text-md lg:text-xl flex gap-4 justify-center items-center">
                                Užsisakyti
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                        </div>
                        @if (session()->has('success'))
                            <div class="modal mb-4" style="background-color: var(--green)">
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                @if ($offer->hotel->image)    
                    <div class="p-2 lg:p-6 hidden lg:block">
                        <img src="{{ $offer->hotel->image ? $offer->hotel->image : '' }}" alt="{{ $offer->hotel->name }}" class="rounded-lg">
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8 flex flex-col items-center" id="opinions">
        <h2
            class="relative mb-16 text-2xl lg:text-3xl text-center before:content-[''] before:absolute before:left-[50%] before:bottom-[-14px] before:w-1/2 before:h-[3px] before:bg-[var(--green)] before:translate-x-[-50%]">
            Atsiliepimai
        </h2>

        <div class="w-full p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @if (count($offer->reviews) != 0)
                @foreach ($offer->reviews as $review)        
                    <article class="px-4 shadow-md rounded-lg flex flex-col gap-4">
                        <div class="py-4 flex justify-between border-b-2 border-solid">
                            <p class="text-xl font-bold">{{ $review->user->name }}</p>
                            <x-front.stars-review rating="{{ $review->rating }}" />
                        </div>
                        <div class="py-4">
                            <p>{{ $review->desc }}</p>
                        </div>
                    </article>
                @endforeach
            @else
                <h2 class="col-span-3 text-2xl lg:text-3xl text-center font-semibold">Nėra atsiliepimų</h2>
            @endif
        </div>
    </section>
</x-front-layout>
