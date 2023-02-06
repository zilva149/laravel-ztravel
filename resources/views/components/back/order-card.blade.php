@props(['order'])

<article class="rounded-md shadow-md">
    <div class="p-4 flex flex-col">
        <div class="flex flex-col md:flex-row gap-4 justify-between items-center relative">
            <div
                class="md:w-2/5 flex flex-col justify-center gap-1 xl:flex-row xl:justify-start text-center md:text-start">
                <span class="font-semibold">Vardas:</span>
                <span>{{ $order['firstname'] }} {{ $order['lastname'] }}</span>
            </div>
            <div class="md:w-2/5 flex gap-1">
                <a
                    class="btn-primary cursor-pointer w-full max-w-[150px] {{ $order['status'] === 'pending' ? 'bg-red-700 hover:bg-red-800' : 'bg-green-700 hover:bg-green-800' }}">
                    {{ $order['status'] === 'pending' ? 'Tvirtinti' : 'Patvirtinta' }}
                </a>
            </div>
            <div class="md:w-1/5 text-2xl text-end">
                <i class="fa-solid fa-chevron-down cursor-pointer transition-all hover:text-slate-500"
                    data-id="btn-expand"></i>
            </div>
        </div>
        <div class="overflow-hidden max-h-0">
            <div class="pt-4 flex flex-col gap-3">
                <div class="flex gap-1 md:hidden">
                    <span class="font-semibold">ID:</span>
                    <span>{{ $order['id'] }}</span>
                </div>
                <div class="flex gap-1 md:hidden">
                    <span class="font-semibold">Šalis:</span>
                    <span>{{ $order['country'] }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Viešbutis:</span>
                    <span>{{ $order['hotel'] }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Kelionė:</span>
                    <span>{{ $order['travel'] }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Data:</span>
                    <span>{{ $order['startDate'] }} {{ $order['endDate'] }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Trukmė:</span>
                    <span>{{ $order['days'] }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Kaina:</span>
                    <span>{{ number_format($order['price'], 2, '.', ',') }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Statusas:</span>
                    <span>{{ $order['status'] === 'pending' ? 'Nepatvirtinta' : 'Patvirtinta' }}</span>
                </div>
            </div>
        </div>
    </div>
</article>
