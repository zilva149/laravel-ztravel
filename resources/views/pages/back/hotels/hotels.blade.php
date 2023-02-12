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

    @if (session()->has('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div class="mb-6 dark:bg-dark-eval-0 dark:text-gray-200">
        <section class="grid grid-cols-3 gap-6 justify-between items-center dark:bg-dark-eval-1">
            @if (count($hotels) !== 0)
                @foreach ($hotels as $hotel)
                    <x-back.hotel-card :$hotel />
                @endforeach
            @else
                <h2 class="text-2xl font-semibold">Nakvynės vietų sąrašas tuščias</h2>
            @endif
        </section>
    </div>
</x-back-layout>
