@props(['order', 'statusOptions'])
<article class="rounded-md shadow-md" id="{{ $order->id }}">
    <div class="p-4 flex flex-col">
        <div class="flex flex-col md:flex-row gap-4 justify-between items-center relative">
            <div class="md:w-3/5 flex flex-row justify-start gap-12 text-center">
                <div
                    class="md:w-2/5 flex justify-center items-center xl:flex-row xl:justify-start text-center md:text-start">
                    <span>{{ $order->firstname }} {{ $order->lastname }}</span>
                </div>
                <div
                    class="md:w-3/5 flex flex-col justify-center items-center gap-3 xl:flex-row xl:justify-start text-center md:text-start">
                    <span class="font-semibold">Statusas:</span>
                    <span class="w-[130px] py-2 text-center rounded-md font-semibold text-white
                    @php
                    if($statusOptions[$order->status] == 'Nepatvirtinta') {
                        echo 'bg-[var(--red)]';
                    } elseif ($statusOptions[$order->status] == 'Patvirtinta') {
                        echo 'bg-[var(--green)]';
                    } else {
                        echo 'bg-gray-400';
                    }
                    @endphp
                    ">{{ $statusOptions[$order->status] }}</span>
                </div>
            </div>
            <div class="md:w-2/5 flex gap-1 justify-end items-center">
                @if ($statusOptions[$order->status] == 'Nepatvirtinta')
                    <form action="{{ route('admin-order-update', $order->id) }}" method="POST" class="flex gap-1">
                        @csrf
                        @method('PUT')

                        <button type="submit" name="status_approve" value="1" class="btn-primary text-lg bg-[var(--green)] hover:bg-[var(--dgreen)] px-4 cursor-pointer md:px-6" title="tvirtinti">
                            <i class="fa-solid fa-check"></i>
                        </button>
                        <button type="submit" name="status_cancel" value="1" class="btn-primary text-lg bg-gray-400 hover:bg-gray-500 px-4 cursor-pointer md:px-6" title="atšaukti">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </form>
                @endif
                <div class="btn-primary text-lg bg-[var(--lblue)] hover:bg-[var(--blue)] px-4 cursor-pointer md:px-6" title="info" data-id="btn-expand">
                    <i class="fa-solid fa-info"></i>
                </div>
            </div>
        </div>
        <div class="overflow-hidden max-h-0">
            <div class="pt-4 flex flex-col gap-3">
                <div class="flex gap-1">
                    <span class="font-semibold">ID:</span>
                    <span>{{ $order->id }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Vartotojo vardas:</span>
                    <span>{{ $order->user->name }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">El. paštas:</span>
                    <span>{{ $order->email }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Adresas:</span>
                    <span>{{ $order->address }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Užsakymo laikas:</span>
                    <span>{{ date($order->created_at) }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Vietovė:</span>
                    <span>{{ $order->destination->name }}, {{ $order->destination->country->name }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Nakvynės vieta:</span>
                    <span>{{ $order->hotel->name }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Pasiūlymas:</span>
                    <span>{{ $order->offer->name }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Data:</span>
                    <span>{{ $order->offer->travel_start }} iki {{ $order->offer->travel_end }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Trukmė (dienomis):</span>
                    <span>{{ $order->duration }}</span>
                </div>
                <div class="flex gap-1">
                    <span class="font-semibold">Kaina (EUR):</span>
                    <span>{{ number_format($order->offer->price, 2, '.', ',') }}</span>
                </div>
            </div>
        </div>
    </div>
</article>
@if (session()->has('success') && session('id') == $order->id)
    <div class="modal mb-4" style="background-color: var(--green)">
        <p>{{ session('success') }}</p>
    </div>
@endif
