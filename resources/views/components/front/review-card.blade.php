@props(['review'])

<article class="w-full h-full px-4 shadow-md rounded-lg flex flex-col gap-4">
    <div class="py-4 flex justify-between border-b-2 border-solid">
        <p class="text-xl font-bold">{{ $review->user->name }}</p>
        <x-front.stars-review rating="{{ $review->rating }}" />
    </div>
    <div class="py-4">
        <p>{{ $review->desc }}</p>
    </div>
</article>