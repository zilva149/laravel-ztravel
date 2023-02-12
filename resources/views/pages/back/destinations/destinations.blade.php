<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="text-3xl font-semibold leading-tight">
                Vietovės
            </h2>
            <a href="{{ route('admin-destination-create') }}" class="btn-primary">Pridėti
                vietovę</a>
        </div>
    </x-slot>

    <div class="mb-6 dark:bg-dark-eval-0 dark:text-gray-200">
        <section class="w-full p-6 bg-white rounded-md shadow-md flex flex-col gap-6 dark:bg-dark-eval-1">
            @if (session()->has('success'))
                <div class="modal mb-4" style="background-color: var(--green)">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (count($destinations) !== 0)
                @foreach ($destinations as $destination)
                    <x-back.destination-card :$destination />
                @endforeach
            @else
                <h2 class="text-2xl font-semibold">Vietovių sąrašas tuščias</h2>
            @endif
        </section>
    </div>
</x-back-layout>
