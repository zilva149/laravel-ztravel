@props(['destination'])

<article class="w-full max-w-[600px] m-auto shadow-md rounded-lg overflow-hidden">
    <div>
        <img src="{{ $destination->image ? $destination->image : '/assets/img/no-image.jpg' }}" alt="hotel" class="w-full">
    </div>
    <div class="p-4 flex flex-col items-start">
        <p class="mb-1 text-gray-500">{{ $destination->country->name }}</p>
        <p class="mb-4">{{ $destination->name }}</p>
        <p class="mb-6 font-semibold">
            @if (isset($destination->min_price))
                Nuo &euro;{{ $destination->min_price }}
            @else
                Pasiūlymų nėra
            @endif
        </p>
        
        <a href="{{ route('customer-single-destination', $destination->id) }}" class="btn-action-link text-md">Sužinokite daugiau</a>
    </div>
</article>