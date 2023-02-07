@php
    $travel = [
        'id' => 1,
        'title' => 'Kelionė į Lenkiją 14 dienų',
        'country' => 'Lenkija',
        'hotel' => 'StarsHotel',
        'startDate' => '2023-03-01',
        'endDate' => '2023-03-15',
        'days' => 14,
        'price' => 499.99,
    ];
@endphp

<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="text-3xl font-semibold leading-tight">
                Kelionės
            </h2>
            <a href="#" class="btn-primary">Pridėti
                kelionę</a>
        </div>
    </x-slot>

    <div class="mb-6 dark:bg-dark-eval-0 dark:text-gray-200">
        <section class="w-full p-6 bg-white rounded-md shadow-md flex flex-col gap-6 dark:bg-dark-eval-1">
            <x-back.travel-card :$travel />
            <x-back.travel-card :$travel />
            <x-back.travel-card :$travel />
            <x-back.travel-card :$travel />
            <x-back.travel-card :$travel />
        </section>
    </div>
</x-back-layout>
