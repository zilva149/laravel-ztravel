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
                <p class="mb-2 flex flex-col gap-1">
                    <span class="font-semibold">Žemynas:</span>
                    {{ $offer->country->continent }}
                </p>
                <p class="mb-2 flex flex-col gap-1">
                    <span class="font-semibold">Vieta:</span>
                    {{ $offer->destination->name }}, {{ $offer->country->name }}
                </p>
                <p class="mb-2 flex flex-col gap-1">
                    <span class="font-semibold">Nakvynė:</span>
                    {{ $offer->hotel->name }}, {{ $offer->hotel->address }}
                </p>
                <p class="flex flex-col gap-1">
                    <span class="font-semibold">Kelionės data:</span>
                    {{ $offer->travel_start }} iki {{ $offer->travel_end }}
                </p>
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex gap-8 justify-start items-center">
                    <p class="text-xl font-semibold">
                        &euro;
                        {{ number_format($offer->price, 2, '.', ',') }}
                    </p>
                    @if (auth()->check())    
                        <a href="{{ route('customer-payment-store', $offer->id) }}" class="btn-action-link text-md lg:text-xl flex gap-4 justify-center items-center">
                            Užsisakyti
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-action-link text-md lg:text-xl flex gap-4 justify-center items-center">
                            Prisijunkite
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @if ($offer->hotel->image)    
            <div class="p-2 lg:p-6 hidden lg:block">
                <img src="{{ $offer->hotel->image ? $offer->hotel->image : '' }}" alt="{{ $offer->hotel->name }}" class="rounded-lg">
            </div>
        @endif
    </div>
</div>