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

    <section class="mb-6 flex flex-col gap-6 dark:bg-dark-eval-0 dark:text-gray-200">
        @if (session()->has('success'))
            <div class="modal mb-4" style="background-color: var(--green)">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (count($offers) !== 0)
            @foreach ($offers as $offer)
                <x-back.offer-card :$offer />
            @endforeach
        @else
            <div class="w-full p-6 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                <h2 class="text-2xl font-semibold">Pasiūlymų sąrašas tuščias</h2>
            </div>
        @endif
    </section>
</x-back-layout>
