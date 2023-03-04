@props(['offer'])

<article class="w-full max-w-[600px] m-auto shadow-md rounded-lg overflow-hidden">
    <div>
        <img src="{{ $offer->hotel->image ? $offer->hotel->image : '/assets/img/no-image.jpg' }}" alt="hotel" class="w-full">
    </div>
    <div class="p-4 flex flex-col items-start">
        <p class="mb-1 text-gray-500 text-lg">{{ $offer->destination->name }}, {{ $offer->country->name }}</p>
        <p class="mb-3 text-sm">{{ $offer->hotel->name }}</p>
        <p class="mb-4">{{ $offer->travel_start }} iki {{ $offer->travel_end }}</p>
        <div class="mb-6 w-full flex justify-between">
            <p class="font-semibold">&euro;{{ $offer->price }}</p>
            <x-front.stars-offer :$offer />
        </div>
        <a href="{{ route('customer-single-offer', $offer->id) }}" class="btn-action-link text-md">Sužinokite daugiau</a>
    </div>
</article>