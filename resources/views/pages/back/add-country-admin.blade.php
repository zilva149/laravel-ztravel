<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Pridėti šalį
            </h2>
        </div>
    </x-slot>

    <section class="flex justify-center">
        <form class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg dark:bg-dark-eval-1 dark:text-white">
            <div class="mb-6 flex flex-col gap-2">
                <label for="name">Šalis</label>
                <input type="text"
                    class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    name="name" id="name" placeholder="Šalies pavadinimas">
            </div>
            <div class="mb-6 flex flex-col gap-2">
                <label for="continent">Žemynas</label>
                <select
                    class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    aria-label="continent" name="continent" id="continent" required>
                    <option value="" selected disabled>-- Rinktis žemyną</option>
                    <option value="0">Europa</option>
                    <option value="1">Azija</option>
                    <option value="2">Afrika</option>
                    <option value="3">Lotynų Amerika</option>
                    <option value="3">Šiaurės Amerika</option>
                    <option value="3">Okeanija</option>
                </select>
            </div>
            <div class="mb-6 flex flex-col gap-2">
                <label for="dateStart">Sezono pradžia</label>
                <input type="date"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    name="dateStart" id="dateStart" />
            </div>
            <div class="mb-6 flex flex-col gap-2">
                <label for="dateEnd">Sezono pabaiga</label>
                <input type="date"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    name="dateEnd" id="dateEnd" />
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
