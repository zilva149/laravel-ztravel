<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="text-3xl font-semibold leading-tight">
                Atsiliepimai
            </h2>
        </div>
    </x-slot>

    <div class="mb-6 dark:bg-dark-eval-0 dark:text-gray-200">
        <section class="w-full p-6 bg-white rounded-md shadow-md flex flex-col gap-6 dark:bg-dark-eval-1">
            @if (isset($reviews)  && count($reviews) != 0)
                @foreach ($reviews as $review)
                    <x-back.review-card :$review />
                @endforeach
            @else
                <p class="w-full text-xl font-semibold text-center">Nėra atsiliepimų</p>
            @endif
        </section>
    </div>
</x-back-layout>