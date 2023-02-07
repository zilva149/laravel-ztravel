<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Pridėti viešbutį
            </h2>
        </div>
    </x-slot>

    <section class="flex justify-center">
        <form class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg dark:bg-dark-eval-1 dark:text-white">
            <div class="mb-6 flex flex-col gap-2">
                <label for="country">Šalis</label>
                <select
                    class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    aria-label="country" name="country" id="country" required>
                    <option value="" selected disabled>-- Rinktis šalį</option>
                    <option value="0">Ispanija</option>
                    <option value="1">Italija</option>
                    <option value="2">Indija</option>
                    <option value="3">Turkija</option>
                    <option value="3">Kipras</option>
                    <option value="3">Tailandas</option>
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label for="name">Pavadinimas</label>
                <input type="text"
                    class="mb-6 w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    name="name" id="name" placeholder="Viešbučio pavadinimas">
            </div>
            <div class="flex flex-col gap-2">
                <label for="desc">Aprašymas</label>
                <textarea
                    class="mb-6 w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    name="desc" id="desc" rows="3" placeholder="Aprašymas..."></textarea>
            </div>
            <div class="mb-6">
                <input
                    class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    type="file" name="photo">
            </div>
            <button type="submit" class="btn-primary">Pridėti</button>
        </form>
    </section>
</x-back-layout>
