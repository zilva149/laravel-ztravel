<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="text-3xl font-semibold leading-tight">
                Pasiūlymai
            </h2>
            <a href="{{ route('admin-offer-create') }}" class="btn-primary">Pridėti
                pasiūlymą</a>
        </div>
    </x-slot>

    @if (session()->has('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div class="mb-6 dark:bg-dark-eval-0 dark:text-gray-200">
        <section class="w-full p-6 bg-white rounded-md shadow-md flex flex-col gap-6 dark:bg-dark-eval-1">
            @if (count($offers) !== 0)
                @foreach ($offers as $offer)
                    <x-back.offer-card :$offer />
                @endforeach
            @else
                <h2 class="text-2xl font-semibold">Pasiūlymų sąrašas tuščias</h2>
            @endif
        </section>
    </div>
</x-back-layout>
