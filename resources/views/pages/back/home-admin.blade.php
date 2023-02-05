<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-3xl font-semibold leading-tight">
                Pradinis
            </h2>
        </div>
    </x-slot>

    <section
        class="mb-6 p-6 rounded-md bg-white shadow-md grid grid-cols-1 gap-4 dark:bg-dark-eval-1 md:grid-cols-2 2xl:grid-cols-4">
        <x-back.home-link url="{{ route('admin-countries') }}" title='Šalys' class='bg-red-500 hover:bg-red-600' />
        <x-back.home-link url="{{ route('admin-hotels') }}" title='Viešbučiai' class='bg-green-500 hover:bg-green-600' />
        <x-back.home-link url="{{ route('admin-travels') }}" title='Kelionės' class='bg-sky-500 hover:bg-sky-600' />
        <x-back.home-link url="{{ route('admin-reviews') }}" title='Atsiliepimai'
            class='bg-slate-400 hover:bg-slate-500' />
    </section>

    <div class="mb-6 flex flex-col gap-6 2xl:flex-row dark:bg-dark-eval-0 dark:text-gray-200">
        <section class="w-full p-6 bg-white rounded-md shadow-md flex flex-col gap-6 2xl:w-2/3 dark:bg-dark-eval-1">
            <div class="flex gap-4 justify-center items-center">
                <h3 class="text-xl font-semibold text-center">Užsakymai</h3>
                <a href="{{ route('admin-orders') }}"
                    class="btn w-fit px-4 bg-sky-500 hover:bg-sky-600 flex items-center">Peržiūrėti
                    visus</a>
            </div>
            <x-back.home-order name='Monika Levickaitė' orderID='2' status='pending' />
            <x-back.home-order name='Artūras Valinskas' orderID='4' status='pending' />
            <x-back.home-order name='Kazys Bailiukas' orderID='4' status='approved' />
            <x-back.home-order name='Eglė Vieversytė' orderID='1' status='approved' />
            <x-back.home-order name='Elena Danienė' orderID='3' status='approved' />
            <x-back.home-order name='Marius Būžinskas' orderID='5' status='approved' />
        </section>
        <section class="w-full p-6 bg-white rounded-md shadow-md flex flex-col gap-6 2xl:w-1/3 dark:bg-dark-eval-1">
            <div class="flex gap-4 justify-center items-center">
                <h3 class="text-xl font-semibold text-center">TOP klientai</h3>
                <a href="{{ route('admin-clients') }}"
                    class="btn w-fit px-4 bg-sky-500 hover:bg-sky-600 flex items-center">Peržiūrėti
                    visus</a>
            </div>
            <x-back.home-top-clients name='Monika Levickaitė' orderAmount=12200 />
            <x-back.home-top-clients name='Kazys Bailiukas' orderAmount=8949.78 />
            <x-back.home-top-clients name='Marius Būžinskas' orderAmount=6499.99 />
            <x-back.home-top-clients name='Eglė Vieversytė' orderAmount=1255.55 />
            <x-back.home-top-clients name='Artūras Valinskas' orderAmount=999.49 />
        </section>
    </div>
</x-back-layout>
