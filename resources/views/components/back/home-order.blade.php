@props(['name', 'orderID', 'status'])

<article class="py-2 px-4 rounded-md shadow-md grid grid-cols-10 items-center">
    <span class="col-start-1 col-span-6 lg:col-span-4">{{ $name }}</span>
    <span class="lg:col-start-5 lg:col-span-3 hidden lg:flex lg:gap-1 ">
        <span class="font-semibold">Užsakymo ID:</span>
        {{ $orderID }}
    </span>
    <div class="col-start-7 col-span-4 lg:col-start-8 lg:col-span-3 flex justify-center items-center gap-2">
        <button
            class="btn w-2/3 {{ $status === 'pending' ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }}">
            {{ $status === 'pending' ? 'Tvirtinti' : 'Patvirtinta' }}
        </button>
        <a class="btn w-1/3 text-lg bg-sky-500 cursor-pointer flex items-center hover:bg-sky-600" title="info">
            <i class="fa-solid fa-info"></i>
        </a>
    </div>
</article>
