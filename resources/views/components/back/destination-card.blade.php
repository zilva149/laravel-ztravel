@props(['destination'])

<article class="max-w-[900px] rounded-md shadow-md bg-white dark:bg-dark-eval-1">
    <div class="p-4 flex flex-col">
        <div class="flex flex-col md:flex-row gap-4 relative">
            <div class="w-full md:w-1/2">
                <img src="{{ $destination->image ? $destination->image : '/assets/img/no-image.jpg' }}"
                    alt="{{ $destination->name }}" class="object-cover w-full max-w-full h-full max-h-full">
            </div>
            <div class="w-full md:w-1/2 flex flex-col gap-2 text-lg">
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
                <div class="flex gap-1">
                    <a href="{{ route('admin-destination-edit', $destination->id) }}"
                        class="btn-primary bg-green-500 hover:bg-green-600 px-6 text-xl cursor-pointer md:px-6"
                        title="redaguoti">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <form action="{{ route('admin-destination-delete', $destination->id) }}" method="POST">
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
            <div class="absolute bottom-0 right-0 text-2xl">
                <i class="fa-solid fa-chevron-down cursor-pointer transition-all hover:text-slate-500"
                    data-id="btn-expand"></i>
            </div>
        </div>
        <div class="overflow-hidden max-h-0">
            <div class="pt-6 flex gap-3">
                <span>{{ $destination->desc }}</span>
            </div>
        </div>
    </div>
</article>
