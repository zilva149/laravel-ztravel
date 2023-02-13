@php
    $order = [
        'id' => 1,
        'firstname' => 'Jonas',
        'lastname' => 'Jonaitis',
        'username' => 'liepsnele',
        'country' => 'Lenkija',
        'hotel' => 'StarsHotel',
        'travel' => 'Kelionė į Lenkiją 14 dienų',
        'startDate' => '2023-03-01',
        'endDate' => '2023-03-15',
        'days' => 14,
        'price' => 499.99,
        'status' => 'pending',
    ];
@endphp

<x-back-layout :$pageTitle>
    <x-slot name="header">
    </x-slot>

    <section
        class="mb-6 p-6 rounded-md bg-white shadow-md grid grid-cols-1 gap-4 dark:bg-dark-eval-1 md:grid-cols-2 2xl:grid-cols-4">
        <x-back.home-link url="{{ route('admin-countries') }}" title='Šalys' class='bg-[var(--green)] hover:bg-[var(--dgreen)]' />
        <x-back.home-link url="{{ route('admin-destinations') }}" title='Vietovės'
            class='bg-[var(--green)] hover:bg-[var(--dgreen)]' />
        <x-back.home-link url="{{ route('admin-hotels') }}" title='Nakvynės vietos'
            class='bg-[var(--green)] hover:bg-[var(--dgreen)]' />
        <x-back.home-link url="{{ route('admin-reviews') }}" title='Atsiliepimai'
            class='bg-[var(--green)] hover:bg-[var(--dgreen)]' />
    </section>

    <div class="mb-6 flex flex-col gap-6 2xl:flex-row dark:bg-dark-eval-0 dark:text-gray-200">
        <section class="w-full p-6 bg-white rounded-md shadow-md flex flex-col gap-8 2xl:w-2/3 dark:bg-dark-eval-1">
            <div class="flex gap-4 justify-center items-center">
                <h3 class="text-xl font-semibold text-center">Užsakymai</h3>
                <a href="{{ route('admin-orders') }}" class="btn-primary">Peržiūrėti
                    visus</a>
            </div>
            <x-back.order-card :$order />
            <x-back.order-card :$order />
            <x-back.order-card :$order />
            <x-back.order-card :$order />
            <x-back.order-card :$order />
        </section>
        <section class="w-full p-6 bg-white rounded-md shadow-md flex flex-col gap-6 2xl:w-1/3 dark:bg-dark-eval-1">
            <div class="flex gap-4 justify-center items-center">
                <h3 class="text-xl font-semibold text-center">TOP vartotojai</h3>
                <a href="{{ route('admin-users') }}" class="btn-primary">Peržiūrėti
                    visus</a>
            </div>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full">
                                <thead class="border-b">
                                    <tr>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Vardas
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Suma
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            liepsnele
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            &euro;{{ number_format(29799.84, 2, '.', ',') }}
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">2</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            zilva149
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            &euro;{{ number_format(14125.99, 2, '.', ',') }}
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">3</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            grybas
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            &euro;{{ number_format(9999, 2, '.', ',') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-back-layout>
