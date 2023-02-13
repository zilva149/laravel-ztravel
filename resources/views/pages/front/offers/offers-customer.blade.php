<x-front-layout :$pageTitle>
    <section
        class="relative min-h-[90vh] text-gray-900 bg-[url('/public/assets/img/hero-boat.jpg')] bg-cover bg-center bg-fixed before:content-[''] before:absolute before:top-0 before:left-0 before:right-0 before:bottom-0 before:bg-[#14261c] before:opacity-[0.6] flex justify-center items-end"
        id="hero">
        <header class="relative mb-36 flex flex-col gap-16 items-center bg-transparent z-99">
            <h1 class="text-white text-5xl font-semibold text-center">Mūsų pasiūlymai</h1>
            <a href="#destinations"
                class="btn-action-link px-0 py-0 w-[70px] h-[70px] text-3xl text-white rounded-full flex justify-center items-center animate-pulse">
                <i class="fa-solid fa-chevron-down"></i>
            </a>
        </header>
    </section>

    <section class="max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8 flex flex-col items-center" id="destinations">
        <h2
            class="relative mb-16 text-3xl text-center before:content-[''] before:absolute before:left-[50%] before:bottom-[-14px] before:w-1/2 before:h-[3px] before:bg-[var(--green)] before:translate-x-[-50%]">
            Pasiūlymai
        </h2>

        <div class="w-full border-[3px] border-solid border-[var(--green)] rounded-lg p-8 mb-14 flex justify-between">
            <form action="{{ route('customer-offers') }}" method="GET" class="w-full max-w-[600px] filter-form flex justify-between gap-6">
                @csrf
                
                <div class="flex gap-3 justify-center items-center">
                    <label class="font-semibold" for="filter">Šalys:</label>
                    <select name="filter" id="filter"
                    class="border-2 border-solid border-[var(--green)] rounded-lg py-1 px-2 pr-4 focus:border-[var(--green)] focus:ring-[var(--green)] focus:ring-offset-0">
                        <option value="all" selected>Visos</option>
                        @foreach ($continents as $continent)
                            <optgroup label="{{ $continent->continent }}">
                                @foreach ($countries as $country)
                                @if ($country->continent === $continent->continent)
                                <option value="{{ $country->id }}" @if ($request->filter && $request->filter == $country->id) selected  @endif>{{ $country->name }}</option>
                                @endif
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            
                <div class="flex gap-3 justify-center items-center">
                    <label class="font-semibold" for="sort">Rikiavimas:</label>
                    <select name="sort" id="sort"
                    class="border-2 border-solid border-[var(--green)] rounded-lg py-1 px-2 pr-8 focus:border-[var(--green)] focus:ring-[var(--green)] focus:ring-offset-0">
                        @foreach ($sortOptions as $key => $value)
                            <option value="{{ $key }}" @if ($request->sort && $request->sort == $key) selected  @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-1">
                    <button type="submit" class="btn-action-link" title="Pateikti">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                    <button type="reset" class="btn-action-link" title="Atnaujinti">
                        <i class="fa-solid fa-rotate"></i>
                    </button>
                </div>
            </form>
                
            <form
            class="relative overflow-hidden w-full max-w-[350px] border-2 border-solid border-[var(--green)] rounded-lg py-1 px-2 focus:border-[var(--green)] focus:ring-[var(--green)] focus:ring-offset-0 flex" action="{{ route('customer-offers') }}" method="GET">
                <input name="s" class="w-full pl-2 pr-20 focus:outline-none" placeholder="Ieškoti vietovės...">
                <button type="submit" class="btn-action-link absolute top-0 bottom-0 right-0 rounded-none">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>            
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 justify-between items-center">
            @if (isset($offers) && count($offers) != 0)
                @foreach ($offers as $offer)        
                    <article class="shadow-md rounded-lg overflow-hidden">
                        <div>
                            <img src="{{ $offer->hotel->image ? $offer->hotel->image : '/assets/img/no-image.jpg' }}" alt="hotel">
                        </div>
                        <div class="p-4 flex flex-col items-start">
                            <p class="mb-1 text-gray-500 text-lg">{{ $offer->destination->name }}, {{ $offer->country->name }}</p>
                            <p class="mb-4">{{ $offer->travel_start }} iki {{ $offer->travel_end }}</p>
                            <div class="mb-6 w-full flex justify-between">
                                <p class="font-semibold">&euro;{{ $offer->price }}</p>
                                <x-front.rating-stars />
                            </div>
                            <a href="{{ route('customer-single-offer', $offer->id) }}" class="btn-action-link text-md">Sužinokite daugiau</a>
                        </div>
                    </article>
                @endforeach
            @else
                <h2 class="col-span-3 text-3xl text-center font-semibold">Nėra pasiūlymų</h2>
            @endif
        </div>
    </section>
</x-front-layout>
