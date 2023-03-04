@props(['review'])

<article class="rounded-md shadow-md">
    <div class="p-4 flex flex-col">
        <div class="flex flex-col md:flex-row gap-4 justify-between items-center relative">
            <div class="w-full flex flex-row gap-12 justify-between md:justify-start items-center">
                <span class="font-bold">{{ $review->user->name }}</span>
                <span class="text-end md:text-start">{{ $review->destination->name }}, {{ $review->country->name }}</span>
            </div>
            <div class="flex gap-12 items-center">
                <x-back.stars-review-card rating="{{ $review->rating }}" />
                <div class="btn-primary text-lg bg-[var(--lblue)] hover:bg-[var(--blue)] px-4 cursor-pointer md:px-6" title="info" data-id="btn-expand">
                    <i class="fa-solid fa-info"></i>
                </div>
            </div>
        </div>
        <div class="overflow-hidden max-h-0">
            <div class="pt-4 flex flex-col gap-3">
                <div class="flex gap-1">
                    <span class="font-semibold">ID:</span>
                    <span>{{ $review->id }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Atsiliepimas:</span>
                    <span>{{ $review->desc }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Sukūrimo laikas:</span>
                    <span>{{ $review->created_at }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Atnaujinimo laikas:</span>
                    <span>{{ $review->updated_at != $review->created_at ? $review->updated_at : 'Neatnaujintas' }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Vartotojo el. paštas:</span>
                    <span>{{ $review->user->email }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Nakvyės namai:</span>
                    <span>{{ $review->hotel->name }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Pasiūlymas:</span>
                    <span>{{ $review->offer->name }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Kelionės data:</span>
                    <span>{{ $review->offer->travel_start }} iki {{ $review->offer->travel_end }}</span>
                </div>
            </div>
        </div>
    </div>
</article>