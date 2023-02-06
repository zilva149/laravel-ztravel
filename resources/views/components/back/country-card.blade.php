@props(['name', 'continent', 'seasonStart', 'seasonEnd'])

<article class="p-4 rounded-md shadow-md flex flex-wrap justify-between gap-y-4">
    <div class="2/5 md:w-1/5 flex flex-col gap-1">
        <span class="font-semibold">Šalis:</span>
        <span>{{ $name }}</span>
    </div>
    <div class="hidden w-1/5 lg:flex lg:flex-col gap-1">
        <span class="font-semibold">Žemynas:</span>
        <span>{{ $continent }}</span>
    </div>
    <div class="w-3/5 lg:w-2/5 flex flex-col gap-1">
        <span class="font-semibold">Sezono laikas:</span>
        <span>{{ $seasonStart }} - {{ $seasonEnd }}</span>
    </div>
    <div class="w-full md:w-1/5 flex justify-center md:justify-end gap-2">
        <a class="btn-primary bg-green-500 hover:bg-green-600 cursor-pointer text-center" title="redaguoti">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a class="btn-primary bg-red-500 hover:bg-red-600 cursor-pointer text-center" title="ištrinti">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
</article>
