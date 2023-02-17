<x-front-layout :$pageTitle>
    <section
        class="relative min-h-[90vh] text-gray-900 bg-[url('/public/assets/img/hero-home.jpg')] bg-cover bg-center bg-fixed before:content-[''] before:absolute before:top-0 before:left-0 before:right-0 before:bottom-0 before:bg-[#14261c] before:opacity-[0.6] flex justify-center items-center"
        id="hero">
        <header class="relative flex flex-col items-center bg-transparent z-99">
            <h2
                class="relative mb-12 text-white text-xl text-center before:content-[''] before:absolute before:left-[50%] before:bottom-[-14px] before:w-1/2 before:h-[3px] before:bg-[var(--green)] before:translate-x-[-50%]">
                Mėgaukites gamta su mumis
            </h2>
            <h1 class="mb-20 text-white text-5xl font-semibold text-center">Svajonių kelionės</h1>
            <a href="{{ route('customer-offers') }}" class="btn-action-link py-3 text-lg">Mūsų pasiūlymai</a>
        </header>
    </section>

    <section class="p-16 bg-gray-200 flex flex-col gap-2 justify-center items-center">
        <h2 class="relative text-xl">
            <i class="fa-solid fa-quote-left text-white text-9xl absolute top-[-100%] left-[-200px]"></i>
            "Tūkstančio žingsnių kelionė prasideda nuo pirmo žingsnio."
        </h2>
        <h3 class="text-md">- Lao Tzu</h3>
    </section>

    <section class="max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
        <h2
            class="relative mb-16 text-3xl text-center before:content-[''] before:absolute before:left-[50%] before:bottom-[-14px] before:w-1/2 before:h-[3px] before:bg-[var(--green)] before:translate-x-[-50%]">
            Populiariausios vietovės
        </h2>
        <div class="flex gap-6 justify-between items-center">
            @foreach ($topDestinations as $destination)
                <article class="shadow-md rounded-lg overflow-hidden">
                    <div>
                        <img src="{{ $destination->image ? $destination->image : '/assets/img/no-image.jpg' }}" alt="hotel">
                    </div>
                    <div class="p-4 flex flex-col items-start">
                        <p class="mb-1 text-gray-500">{{ $destination->country->name }}</p>
                        <p class="mb-4">{{ $destination->name }}</p>
                        <p class="mb-6 font-semibold">Nuo &euro;{{ $destination->min_price }}</p>
                        
                        <a href="#" class="btn-action-link text-md">Sužinokite daugiau</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</x-front-layout>
