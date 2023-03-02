@props(['isReviewed', 'ID', 'rating'])

<button class="flex gap-1 items-center cursor-pointer" title="vertinti" data-modal-open="rating" data-modal-operation="{{ $isReviewed ? 'update' : 'store' }}" data-modal-route="{{ $isReviewed ? route('customer-review-update', $ID) : route('customer-review-store', $ID) }}">
    <div class="flex gap-0 pointer-events-none">
        <input type="radio" name="5" id="rate-5" class="hidden">
        <label for="rate-5" class="fas fa-star text-yellow-500 {{ $rating >= 1 ? 'opacity-100' : 'opacity-40' }} pointer-events-none"></label>
        <input type="radio" name="4" id="rate-4" class="hidden">
        <label for="rate-4" class="fas fa-star text-yellow-500 {{ $rating >= 2 ? 'opacity-100' : 'opacity-40' }} pointer-events-none"></label>
        <input type="radio" name="3" id="rate-3" class="hidden">
        <label for="rate-3" class="fas fa-star text-yellow-500 {{ $rating >= 3 ? 'opacity-100' : 'opacity-40' }} pointer-events-none"></label>
        <input type="radio" name="2" id="rate-2" class="hidden">
        <label for="rate-2" class="fas fa-star text-yellow-500 {{ $rating >= 4 ? 'opacity-100' : 'opacity-40' }} pointer-events-none"></label>
        <input type="radio" name="1" id="rate-1" class="hidden">
        <label for="rate-1" class="fas fa-star text-yellow-500 {{ $rating == 5 ? 'opacity-100' : 'opacity-40' }} pointer-events-none"></label>
    </div>
</button>