<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="text-3xl font-semibold leading-tight">
                Šalys
            </h2>
            <a href="{{ route('admin-countries') }}"
                class="btn w-fit px-4 bg-orange-500 hover:bg-orange-600 flex items-center">Pridėti šalį</a>
        </div>
    </x-slot>

    <div class="mb-6 dark:bg-dark-eval-0 dark:text-gray-200">
        <section class="w-full p-6 bg-white rounded-md shadow-md flex flex-col gap-6 dark:bg-dark-eval-1">
            <x-back.country-card name='Ispanija' continent='Europa' seasonStart="2023-04-12" seasonEnd='2023-06-23' />
            <x-back.country-card name='Italija' continent='Europa' seasonStart="2023-04-12" seasonEnd='2023-06-23' />
            <x-back.country-card name='Meksika' continent='Lotynų Amerika' seasonStart="2023-04-12"
                seasonEnd='2023-06-23' />
            <x-back.country-card name='Tailandas' continent='Azija' seasonStart="2023-04-12" seasonEnd='2023-06-23' />
            <x-back.country-card name='Japonija' continent='Azija' seasonStart="2023-04-12" seasonEnd='2023-06-23' />
        </section>
    </div>
</x-back-layout>
