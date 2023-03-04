@props(['order', 'statusOptions'])

@php
    $isReviewed = $order->isReviewed;
    if ($isReviewed) {
        $ID = $order->review->id;
        $rating = $order->review->rating;
    } else {
        $ID = $order->id;
        $rating = 0;
    }
@endphp

<article class="border border-solid border-slate-200 rounded-md shadow-md" id="{{ $order->id }}">
    <div class="p-4 flex flex-col">
        <div class="flex flex-col xl:flex-row gap-4 justify-between items-center relative">
            <div class="w-full xl:w-[80%] flex flex-col xl:flex-row justify-between gap-4">
                <div
                    class="w-full xl:w-[20%] flex justify-start items-center">
                    <span>{{ $order->firstname }} {{ $order->lastname }}</span>
                </div>
                <div class="w-full xl:w-[50%] flex justify-start items-center">
                    <span>{{ $order->destination->name }}, {{ $order->destination->country->name }}</span>
                </div>
                <div
                    class="w-full xl:w-[30%] flex justify-start items-center gap-3">
                    <span class="font-semibold">Statusas:</span>
                    <span class="w-[130px] py-2 text-center rounded-md font-semibold text-white
                    @php
                    if($statusOptions[$order->status] == 'Nepatvirtinta') {
                        echo 'bg-[var(--red)]';
                    } elseif ($statusOptions[$order->status] == 'Patvirtinta') {
                        echo 'bg-[var(--green)]';
                    } else {
                        echo 'bg-gray-400';
                    }
                    @endphp
                    ">{{ $statusOptions[$order->status] }}</span>
                </div>
            </div>
            <div class="w-full xl:w-[20%] flex gap-6 xl:justify-end xl:items-center">
                @if ($statusOptions[$order->status] == 'Patvirtinta')    
                    <div class="flex items-center">
                        <x-front.stars-order :$isReviewed :$ID :$rating />
                    </div>
                @endif
                <div class="btn-primary text-lg bg-[var(--lblue)] hover:bg-[var(--blue)] px-4 cursor-pointer ml-auto md:px-6" title="info" data-id="btn-expand">
                    <i class="fa-solid fa-info"></i>
                </div>
            </div>
        </div>
        <div class="overflow-hidden max-h-0">
            <div class="pt-4 flex flex-col gap-3">
                <div class="flex gap-1">
                    <span class="font-semibold">El. paštas:</span>
                    <span>{{ $order->email }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Adresas:</span>
                    <span>{{ $order->address }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Užsakymo laikas:</span>
                    <span>{{ date($order->created_at) }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Nakvynės vieta:</span>
                    <span>{{ $order->hotel->name }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Pasiūlymas:</span>
                    <span>{{ $order->offer->name }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Data:</span>
                    <span>{{ $order->offer->travel_start }} iki {{ $order->offer->travel_end }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Trukmė (dienomis):</span>
                    <span>{{ $order->duration }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Kaina (EUR):</span>
                    <span>{{ number_format($order->offer->price, 2, '.', ',') }}</span>
                </div>
            </div>
        </div>
    </div>
</article>
@if (session()->has('success') && session('id') == $order->id)
    <div class="message mb-4" style="background-color: var(--green)">
        <p>{{ session('success') }}</p>
    </div>
@endif