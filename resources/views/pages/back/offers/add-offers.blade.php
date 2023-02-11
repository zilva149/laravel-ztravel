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

    <section class="flex justify-center">
        <form action="{{ route('admin-travel-store') }}" method="POST"
            class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg dark:bg-dark-eval-1 dark:text-white">
            @csrf

            <div class="mb-6 flex flex-col gap-2">
                <label for="name">Kelionės pavadinimas:</label>
                <input type="text"
                    class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    name="name" value="{{ old('name', '') }}" id="name">
                @error('name')
                    <div class="modal-sm" style="background-color: #f01616">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-6 flex flex-col gap-2">
                <label for="country_id">Šalis:</label>
                <select
                    class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    aria-label="continent" name="country_id" id="country_id" data-id="select_country">
                    <option selected disabled>-- Rinktis šalį</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" @if ($country->id == old('country_id', '')) selected @endif>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
                @error('country_id')
                    <div class="modal-sm" style="background-color: #f01616">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-6 flex flex-col gap-2" id="select_hotel_parent">
                @if (old('hotel_id') || old('country_id'))
                    <label for="hotel_id">Viešbutis:</label>
                    <select
                        class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                        aria-label="continent" name="hotel_id" id="hotel_id">
                        <option selected disabled>-- Rinktis viešbutį</option>
                        @foreach ($hotels as $hotel)
                            @if ($hotel->country->id == old('country_id'))
                                <option value="{{ $hotel->id }}" @if ($hotel->id == old('hotel_id', '')) selected @endif>
                                    {{ $hotel->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('hotel_id')
                        <div class="modal-sm" style="background-color: #f01616">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror
                @endif
            </div>

            <div class="mb-6 flex flex-col gap-2">
                <label for="travel_start">Kelionės pradžia:</label>
                <input type="date"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    name="travel_start" value="{{ old('travel_start', '') }}" id="travel_start" />
                @error('travel_start')
                    <div class="modal-sm" style="background-color: #f01616">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-6 flex flex-col gap-2">
                <label for="travel_end">Kelionės pabaiga:</label>
                <input type="date"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    name="travel_end" value="{{ old('travel_end', '') }}" id="travel_end" />
                @error('travel_end')
                    <div class="modal-sm" style="background-color: #f01616">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-6 flex flex-col gap-2">
                <label for="price">Kaina (EUR):</label>
                <input type="text"
                    class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    name="price" id="price" value="{{ old('price', '') }}">
                @error('price')
                    <div class="modal-sm" style="background-color: #f01616">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn-primary">Pridėti</button>

        </form>
    </section>

    <script>
        const countries = {{ Js::from($countries) }};
        const countrySelect = document.querySelector("select[data-id='select_country']");
        let travelStartInput = document.getElementById('travel_start')
        let travelEndInput = document.getElementById('travel_end');
    </script>

</x-back-layout>
