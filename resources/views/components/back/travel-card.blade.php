@props(['travel'])

<article class="rounded-md shadow-md">
    <div class="p-4 flex flex-col">
        <div class="flex flex-col md:flex-row gap-4 justify-between items-center relative">
            <div
                class="md:w-3/5 flex flex-col justify-center gap-1 xl:flex-row xl:justify-start text-center md:text-start">
                <span class="font-semibold">Pavadinimas:</span>
                <span>{{ $travel['title'] }}</span>
            </div>
            <div class="md:w-1/5 flex gap-1">
                <a class="btn-primary bg-green-500 hover:bg-green-600 px-6 text-xl cursor-pointer md:px-6"
                    title="redaguoti">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a class="btn-primary bg-red-500 hover:bg-red-600 px-6 text-xl cursor-pointer md:px-6" title="ištrinti">
                    <i class="fa-solid fa-trash"></i>
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
                    <span>{{ $travel['id'] }}</span>
                </div>
                <div class="flex gap-1 md:hidden">
                    <span class="font-semibold">Šalis:</span>
                    <span>{{ $travel['country'] }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Viešbutis:</span>
                    <span>{{ $travel['hotel'] }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Data:</span>
                    <span>{{ $travel['startDate'] }} {{ $travel['endDate'] }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Trukmė:</span>
                    <span>{{ $travel['days'] }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Kaina:</span>
                    <span>{{ number_format($travel['price'], 2, '.', ',') }}</span>
                </div>
            </div>
        </div>
    </div>
</article>
