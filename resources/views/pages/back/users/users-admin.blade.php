@php
    $user = [
        'id' => 1,
        'username' => 'liepsnele',
        'email' => 'monika@gmail.com',
        'firstname' => 'Monika',
        'lastname' => 'Levickaitė',
        'orders' => 15,
        'expenses' => 29.488,
    ];
@endphp

<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="text-3xl font-semibold leading-tight">
                Vartotojai
            </h2>
        </div>
    </x-slot>

    <div class="mb-6 dark:bg-dark-eval-0 dark:text-gray-200">
        <section class="w-full p-6 bg-white rounded-md shadow-md flex flex-col gap-6 dark:bg-dark-eval-1">
            @foreach ($users as $user)               
                <x-back.user-card :$user />
            @endforeach
        </section>
    </div>
</x-back-layout>
