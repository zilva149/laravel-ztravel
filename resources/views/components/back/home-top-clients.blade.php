@props(['name', 'orderAmount'])

<article class="py-2 px-4 rounded-md shadow-md grid grid-cols-10 items-center">
    <span class="col-start-1 col-span-6">{{ $name }}</span>
    <div class="col-start-7 col-span-4 justify-self-end">
        &euro;{{ number_format($orderAmount, 2, '.', ',') }}
    </div>
</article>
