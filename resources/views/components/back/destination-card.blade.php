@props(['destination'])

<article class="w-full max-w-[900px] rounded-md shadow-md overflow-hidden bg-white flex flex-col dark:bg-dark-eval-1">
    <div class="flex flex-col md:flex-row gap-4 relative">
        <div class="w-full md:w-1/2">
            <img src="{{ $destination->image ? $destination->image : '/assets/img/no-image.jpg' }}"
                alt="{{ $destination->name }}" class="object-cover w-full max-w-full h-full max-h-full">
        </div>
        <div class="w-full md:w-1/2 p-3 flex flex-col justify-between gap-2 text-lg">
            <div class="flex flex-col gap-2">
                <div class="flex gap-1">
                    <span class="font-semibold">ID:</span>
                    <span>{{ $destination->id }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Viešbutis:</span>
                    <span>{{ $destination->name }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Žemynas:</span>
                    <span>{{ $destination->country->continent }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Šalis:</span>
                    <span>{{ $destination->country->name }}</span>
                </div>
            </div>
            <div class="flex gap-1">
                <a href="{{ route('admin-destination-edit', $destination->id) }}"
                    class="btn-primary bg-[var(--green)] hover:bg-[var(--dgreen)] px-6 text-xl cursor-pointer md:px-6"
                    title="redaguoti">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <button
                    class="btn-primary h-full bg-[var(--red)] text-xl hover:bg-[var(--dred)] cursor-pointer text-center"
                    title="ištrinti" data-modal-open="modal" data-modal-operation="delete" data-modal-object="vietovę" data-modal-route="{{ route('admin-destination-delete', $destination->id) }}">
                    <i class="fa-solid fa-trash"></i>
                </button>
                <div class="btn-primary text-lg bg-[var(--lblue)] hover:bg-[var(--blue)] px-4 cursor-pointer md:px-6" title="info" id="destination-expand" data-id="btn-expand">
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="overflow-hidden max-h-0">
        <div class="p-6">
            <span>{{ $destination->desc }}</span>
        </div>
    </div>
</article>
