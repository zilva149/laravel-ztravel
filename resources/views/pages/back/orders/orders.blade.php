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
        <div class="flex gap-8 items-center">
            <h2 class="text-3xl font-semibold leading-tight">
                Užsakymai
            </h2>
        </div>
    </x-slot>

    <div class="mb-6 dark:bg-dark-eval-0 dark:text-gray-200">
        <section class="w-full p-6 bg-white rounded-md shadow-md flex flex-col gap-6 dark:bg-dark-eval-1">
            <x-back.order-card :$order />
            <x-back.order-card :$order />
            <x-back.order-card :$order />
            <x-back.order-card :$order />
            <x-back.order-card :$order />
            <x-back.order-card :$order />
        </section>
    </div>
</x-back-layout>
