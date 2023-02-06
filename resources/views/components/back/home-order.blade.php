@props(['name', 'orderID', 'status'])

<article class="w-full py-4 rounded-md border-solid border-b-2 flex justify-between items-center">
    <span class="w-full lg:w-1/3">{{ $name }}</span>
    <span class="hidden lg:flex lg:gap-1 w-1/3 justify-self-start">
        <span class="font-semibold">Užsakymo ID:</span>
        {{ $orderID }}
    </span>
    <div class="flex justify-center items-center gap-2 lg:w-1/3">
        <button
            class="btn-primary w-full {{ $status === 'pending' ? 'bg-red-700 hover:bg-red-800' : 'bg-green-700 hover:bg-green-800' }}">
            {{ $status === 'pending' ? 'Tvirtinti' : 'Patvirtinta' }}
        </button>
        <a class="btn-primary bg-blue-700 hover:bg-blue-800 px-4 cursor-pointer md:px-6" title="info">
            <i class="fa-solid fa-info"></i>
        </a>
    </div>
</article>
