<article class="shadow-md rounded-lg overflow-hidden">
    <div>
        <img src="{{ $hotel->image ? $hotel->image : '/assets/img/no-image.jpg' }}" alt="hotel">
    </div>
    <div class="p-4 flex flex-col items-start">
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
            <span>{{ $hotel->destination }}, {{ $hotel->country }}</span>
        </div>
        <div class="flex gap-1">
            <span class="font-semibold">Adresas:</span>
            <span>{{ $hotel->address }}</span>
        </div>
        <div class="flex gap-1">
            <span class="font-semibold">Žmonių limitas:</span>
            <span>{{ $destination->people_limit }}</span>
        </div>
        <div class="flex gap-1">
            <a href="{{ route('admin-hotel-edit', $hotel->id) }}"
                class="btn-primary bg-green-500 hover:bg-green-600 px-6 text-xl cursor-pointer md:px-6"
                title="redaguoti">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <form action="{{ route('admin-hotel-delete', $hotel->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit"
                    class="btn-primary bg-red-500 hover:bg-red-600 px-6 text-xl cursor-pointer md:px-6"
                    title="ištrinti">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
</article>
