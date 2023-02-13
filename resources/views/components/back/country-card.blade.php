@props(['country'])

<article class="p-4 rounded-md shadow-md flex flex-wrap justify-between gap-y-4 bg-white">
    <div class="2/5 md:w-1/5 flex flex-col gap-1">
        <span class="font-semibold">Šalis:</span>
        <span>{{ $country->name }}</span>
    </div>
    <div class="hidden w-1/5 lg:flex lg:flex-col gap-1">
        <span class="font-semibold">Žemynas:</span>
        <span>{{ $country->continent }}</span>
    </div>
    <div class="w-3/5 lg:w-2/5 flex flex-col gap-1">
        <span class="font-semibold">Sezono laikas:</span>
        <span>{{ $country->season_start }} - {{ $country->season_end }}</span>
    </div>
    <div class="w-full md:w-1/5 flex justify-center md:justify-end gap-2">
        <a href="{{ route('admin-country-edit', $country->id) }}"
            class="btn-primary h-full text-lg bg-[var(--green)] hover:[var(--dgreen)] cursor-pointer text-center"
            title="redaguoti">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <form action="{{ route('admin-country-delete', $country->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="btn-primary h-full bg-[var(--red)] text-lg hover:bg-[var(--dred)] cursor-pointer text-center"
                title="ištrinti">
                <i class="fa-solid fa-trash"></i>
            </button>
        </form>
    </div>
</article>
