@props(['offer'])

<article class="bg-white rounded-md shadow-md">
    <div class="p-4 flex flex-col">
        <div class="flex flex-col md:flex-row gap-4 justify-between items-center relative">
            <div>
                <span>{{ $offer->name }}</span>
            </div>
            <div class="flex gap-1">
                <a href="{{ route('admin-offer-edit', $offer->id) }}"
                    class="btn-primary bg-[var(--green)] hover:bg-[var(--dgreen)] px-6 text-xl cursor-pointer md:px-6"
                    title="redaguoti">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <button
                    class="btn-primary h-full bg-[var(--red)] text-xl hover:bg-[var(--dred)] cursor-pointer text-center"
                    title="ištrinti" data-modal-open="modal" data-modal-operation="delete" data-modal-object="pasiūlymą" data-modal-route="{{ route('admin-offer-delete', $offer->id) }}">
                    <i class="fa-solid fa-trash"></i>
                </button>
                <div class="btn-primary text-lg bg-[var(--lblue)] hover:bg-[var(--blue)] px-4 cursor-pointer md:px-6" title="info" data-id="btn-expand">
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </div>
        </div>
        <div class="overflow-hidden max-h-0">
            <div class="pt-4 flex flex-col gap-3">
                <div class="flex gap-1">
                    <span class="font-semibold">ID:</span>
                    <span>{{ $offer->id }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Vietovė:</span>
                    <span>{{ $offer->destination->name }}, {{ $offer->country->name }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Viešbutis:</span>
                    <span>{{ $offer->hotel->name }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Data:</span>
                    <span>{{ $offer->travel_start }} iki {{ $offer->travel_end }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Trukmė (dienos):</span>
                    <span>{{ $offer->duration }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Kaina (EUR):</span>
                    <span>{{ number_format($offer->price, 2, '.', ',') }}</span>
                </div>
            </div>
        </div>
    </div>
</article>
