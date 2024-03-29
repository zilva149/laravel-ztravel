@props(['offer'])

@php
    if($offer->count_rating > 0) {
        $avgRating = number_format($offer->avg_rating, 1, '.');
    }
@endphp

@if (isset($avgRating))    
    <a href="/offers/{{ $offer->id }}#opinions" class="flex gap-2 items-center cursor-pointer">
        <p class="font-bold text-yellow-600">{{ $avgRating }}</p>
        <div class="flex gap-0 pointer-events-none">
            <input type="radio" name="1" id="rate-1" class="hidden">
            <label for="rate-1" class="fas fa-star text-yellow-500 {{ round($avgRating) >= 1 ? 'opacity-100' : 'opacity-40' }} pointer-events-none"></label>
            <input type="radio" name="2" id="rate-2" class="hidden">
            <label for="rate-2" class="fas fa-star text-yellow-500 {{ round($avgRating) >= 2 ? 'opacity-100' : 'opacity-40' }} pointer-events-none"></label>
            <input type="radio" name="3" id="rate-3" class="hidden">
            <label for="rate-3" class="fas fa-star text-yellow-500 {{ round($avgRating) >= 3 ? 'opacity-100' : 'opacity-40' }} pointer-events-none"></label>
            <input type="radio" name="4" id="rate-4" class="hidden">
            <label for="rate-4" class="fas fa-star text-yellow-500 {{ round($avgRating) >= 4 ? 'opacity-100' : 'opacity-40' }} pointer-events-none"></label>
            <input type="radio" name="5" id="rate-5" class="hidden">
            <label for="rate-5" class="fas fa-star text-yellow-500 {{ round($avgRating) == 5 ? 'opacity-100' : 'opacity-40' }} pointer-events-none"></label>
        </div>
        <p>({{ $offer->count_rating }})</p>
    </a>
@endif