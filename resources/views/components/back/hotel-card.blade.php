<article class="bg-white border-2 border-solid border-white shadow-lg rounded-lg overflow-hidden">
    <div>
        <img src="{{ $hotel->image ? $hotel->image : '/assets/img/no-image.jpg' }}" alt="hotel">
    </div>
    <div class="p-4 flex flex-col gap-2 items-start">
        <div class="flex gap-1">
            <span class="font-semibold">ID:</span>
            <span>{{ $hotel->id }}</span>
        </div>
        <div class="flex gap-1">
            <span class="font-semibold">Pavadinimas:</span>
            <span>{{ $hotel->name }}</span>
        </div>
        <div class="flex gap-1">
            <span class="font-semibold">Vietovė:</span>
            <span>{{ $hotel->destination->name }}, {{ $hotel->country->name }}</span>
        </div>
        <div class="flex gap-1">
            <span class="font-semibold">Adresas:</span>
            <span>{{ $hotel->address }}</span>
        </div>
        <div class="flex gap-1">
            <span class="font-semibold">Žmonių limitas:</span>
            <span>{{ $hotel->people_limit }}</span>
        </div>
        <div class="mt-4 flex gap-2">
            <a href="{{ route('admin-hotel-edit', $hotel->id) }}"
                class="btn-primary bg-[var(--green)] hover:bg-[var(--dgreen)] px-6 text-xl cursor-pointer md:px-6"
                title="redaguoti">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <form action="{{ route('admin-hotel-delete', $hotel->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit"
                    class="btn-primary bg-[var(--red)] hover:bg-[var(--dred)] px-6 text-xl cursor-pointer md:px-6"
                    title="ištrinti">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
</article>
