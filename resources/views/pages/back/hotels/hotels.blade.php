<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="text-3xl font-semibold leading-tight">
                Nakvynės vietos
            </h2>
            <a href="{{ route('admin-hotel-create') }}" class="btn-primary">Pridėti
                nakvynės vietą</a>
        </div>
    </x-slot>

    <div class="mb-6 dark:bg-dark-eval-0 dark:text-gray-200">
        @if (session()->has('success'))
            <div class="modal mb-4" style="background-color: var(--green)">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (count($hotels) !== 0)
            <section class="grid grid-cols-3 gap-6 justify-between items-center dark:bg-dark-eval-1">
                @foreach ($hotels as $hotel)
                    <x-back.hotel-card :$hotel />
                @endforeach
            </section>
        @else
            <section class="w-full p-6 bg-white rounded-md shadow-md flex flex-col gap-6 dark:bg-dark-eval-1">
                <h2 class="text-2xl font-semibold">Nakvynės vietų sąrašas tuščias</h2>
            </section>
        @endif
    </div>
</x-back-layout>
