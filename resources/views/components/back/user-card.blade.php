@props(['user'])

<article class="rounded-md shadow-md">
    <div class="p-4 flex flex-col">
        <div class="flex">
            <div class="w-[20%] md:w-[10%] flex justify-start items-center gap-1">
                <span class="font-semibold">ID:</span>
                <span>{{ $user->id }}</span>
            </div>
            <div class="w-[60%] md:w-[70%] flex justify-start items-center gap-1">
                <span class="font-semibold">Vardas:</span>
                <span>{{ $user->name }}</span>
            </div>
            <div class="w-[20%] flex justify-end items-center text-xl">
                <div class="btn-primary text-lg bg-[var(--green)] hover:bg-[var(--dgreen)] px-4 cursor-pointer md:px-6" title="info" data-id="btn-expand">
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </div>
        </div>
        <div class="overflow-hidden max-h-0">
            <div class="pt-4 flex flex-col gap-3">
                <div class="flex gap-1">
                    <span class="font-semibold">El. paštas:</span>
                <span>{{ $user->email }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Užsakymai:</span>
                    <span>{{ count($user->orders) }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Išlaidos:</span>
                    <span>&euro;{{ number_format($user->sales, 2, '.', ',') }}</span>
                </div>
                <a href="{{ route('admin-user-orders', $user->id) }}" class="btn-primary">Užsakymų istorija</a>
            </div>
        </div>
    </div>
</article>
