@props(['name', 'continent', 'seasonStart', 'seasonEnd'])

<article class="py-2 px-4 rounded-md shadow-md grid grid-cols-10 items-center gap-y-2">
    <div class="flex flex-col gap-1 col-start-1 col-span-4 md:col-span-3 lg:col-span-2">
        <span class="font-semibold">Šalis:</span>
        <span>{{ $name }}</span>
    </div>
    <div class="hidden lg:flex lg:flex-col gap-1 col-start-3 col-span-2">
        <span class="font-semibold">Žemynas:</span>
        <span>{{ $continent }}</span>
    </div>
    <div class="flex flex-col gap-1 col-start-5 col-span-6 md:col-start-4 md:col-span-4 lg:col-start-5 lg:col-span-4">
        <span class="font-semibold">Sezono laikas:</span>
        <span>{{ $seasonStart }} - {{ $seasonEnd }}</span>
    </div>
    <div
        class="flex justify-center items-center gap-2 col-start-1 col-span-10 md:col-start-8 md:col-span-3 lg:col-start-9 lg:col-span-2">
        <a class="btn w-1/2 bg-green-500 hover:bg-green-600 cursor-pointer flex items-center" title="redaguoti">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a class="btn w-1/2 text-lg bg-red-500 hover:bg-red-600 cursor-pointer flex items-center" title="trinti">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
</article>
