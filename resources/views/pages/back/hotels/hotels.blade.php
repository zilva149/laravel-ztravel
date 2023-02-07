@php
    $hotel = [
        'id' => 1,
        'name' => 'Some random hotel',
        'country' => 'Ispanija',
        'continent' => 'Europa',
        'desc' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatibus voluptates eius at quis tempora nisi illo consequatur quaerat id ducimus! Fugiat, molestias laboriosam id, enim voluptate iste commodi excepturi voluptates sapiente error hic, facere consequuntur! Perferendis, eius reiciendis nobis, hic facere quod ea sequi natus deleniti aut, provident non facilis!',
    ];
@endphp

<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="text-3xl font-semibold leading-tight">
                Viešbučiai
            </h2>
            <a href="{{ route('admin-add-hotel') }}" class="btn-primary">Pridėti
                viešbutį</a>
        </div>
    </x-slot>

    <section class="mb-6 flex flex-col gap-4 dark:bg-dark-eval-0 dark:text-gray-200">
        <x-back.hotel-card :$hotel />
        <x-back.hotel-card :$hotel />
        <x-back.hotel-card :$hotel />
        <x-back.hotel-card :$hotel />
        <x-back.hotel-card :$hotel />
    </section>
</x-back-layout>
