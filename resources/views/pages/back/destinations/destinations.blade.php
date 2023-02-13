<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="p-4 flex gap-8 items-center justify-center">
            <h2 class="text-3xl font-semibold leading-tight">
                Vietovės
            </h2>
            <a href="{{ route('admin-destination-create') }}" class="btn-primary">Pridėti
                vietovę</a>
        </div>
    </x-slot>

    <div class="mb-6 dark:bg-dark-eval-0 dark:text-gray-200">
        <section class="w-full flex flex-col gap-6 items-center">
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
                <div class="w-full max-w-[600px] p-6 text-center bg-white rounded-md shadow-md flex flex-col gap-6 dark:bg-dark-eval-1">
                    <h2 class="text-2xl font-semibold">Vietovių sąrašas tuščias</h2>
                </div>
            @endif
        </section>
    </div>
</x-back-layout>
