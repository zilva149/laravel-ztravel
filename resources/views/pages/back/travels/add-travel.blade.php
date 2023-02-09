<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Pridėti kelionę
            </h2>
        </div>
    </x-slot>

    @if (session()->has('success'))
        <p>{{ session('success') }}</p>
    @endif

    @error('name')
        <p>{{ $message }}</p>
    @enderror
    @error('country_id')
        <p>{{ $message }}</p>
    @enderror
    @error('hotel_id')
        <p>{{ $message }}</p>
    @enderror
    @error('travel_start')
        <p>{{ $message }}</p>
    @enderror
    @error('travel_end')
        <p>{{ $message }}</p>
    @enderror
    @error('price')
        <p>{{ $message }}</p>
    @enderror

    <section class="flex justify-center">
        <form action="{{ route('admin-travel-store') }}" method="POST"
            class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg dark:bg-dark-eval-1 dark:text-white">
            @csrf

            <div class="mb-6 flex flex-col gap-2">
                <label for="name">Kelionės pavadinimas:</label>
                <input type="text"
                    class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    name="name" id="name">
            </div>

            <div class="mb-6 flex flex-col gap-2">
                <label for="country_id">Šalis:</label>
                <select
                    class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    aria-label="continent" name="country_id" id="country_id" data-id="select_country">
                    <option selected disabled>-- Rinktis šalį</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6 flex flex-col gap-2" id="select_hotel_parent"></div>

            <div class="mb-6 flex flex-col gap-2">
                <label for="travel_start">Kelionės pradžia:</label>
                <input type="date"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    name="travel_start" id="travel_start" />
            </div>

            <div class="mb-6 flex flex-col gap-2">
                <label for="travel_end">Kelionės pabaiga:</label>
                <input type="date"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    name="travel_end" id="travel_end" />
            </div>

            <div class="mb-6 flex flex-col gap-2">
                <label for="price">Kaina (EUR):</label>
                <input type="text"
                    class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    name="price" id="price">
            </div>

            <button type="submit" class="btn-primary">Pridėti</button>

        </form>
    </section>

    <script>
        const countries = {{ Js::from($countries) }};
        const countrySelect = document.querySelector("select[data-id='select_country']");
        let travelStartInput = document.getElementById('travel_start');
        let travelEndInput = document.getElementById('travel_end');
    </script>

</x-back-layout>
