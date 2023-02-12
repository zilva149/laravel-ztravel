<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Pridėti pasiūlymą
            </h2>
        </div>
    </x-slot>

    @if (session()->has('success'))
        <p>{{ session('success') }}</p>
    @endif

    <section class="flex justify-center">
        @if (count($countries) === 0)
            <div
                class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg flex flex-col gap-4 items-center dark:bg-dark-eval-1 dark:text-white">
                <h2 class="text-lg font-semibold">Šalių sąrašas tuščias, prašome pridėti naują šalį</h2>
                <div class="flex gap-2">
                    <a href="{{ route('admin-country-create') }}" class="btn-primary cursor-pointer">Pridėti šalį</a>
                    <a href="{{ route('admin-offers') }}" class="btn-primary">Grįžti</a>
                </div>
            </div>
        @elseif(count($destinations) === 0)
            <div
                class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg flex flex-col gap-4 items-center dark:bg-dark-eval-1 dark:text-white">
                <h2 class="text-lg font-semibold">Vieotvių sąrašas tuščias, prašome pridėti naują vietovę</h2>
                <div class="flex gap-2">
                    <a href="{{ route('admin-destination-create') }}" class="btn-primary cursor-pointer">Pridėti
                        vietovę</a>
                    <a href="{{ route('admin-offers') }}" class="btn-primary">Grįžti</a>
                </div>
            </div>
        @elseif(count($hotels) === 0)
            <div
                class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg flex flex-col gap-4 items-center dark:bg-dark-eval-1 dark:text-white">
                <h2 class="text-lg font-semibold">Nakvynės vietų sąrašas tuščias, prašome pridėti naują nakvynės vietą
                </h2>
                <div class="flex gap-2">
                    <a href="{{ route('admin-hotel-create') }}" class="btn-primary cursor-pointer">Pridėti nakvynės
                        vietą</a>
                    <a href="{{ route('admin-offers') }}" class="btn-primary">Grįžti</a>
                </div>
            </div>
        @else
            <form action="{{ route('admin-offer-store') }}" method="POST"
                class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg dark:bg-dark-eval-1 dark:text-white">
                @csrf

                <div class="mb-6 flex flex-col gap-2">
                    <label for="name">Pasiūlymo pavadinimas:</label>
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

                <div class="mb-6 flex flex-col gap-2" id="select_destination_parent">
                    @if (old('country_id') || old('destination_id'))
                        <label for="destination_id">Vietovė:</label>
                        <select
                            class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                            aria-label="continent" name="destination_id" id="destination_id">
                            <option selected disabled>-- Rinktis vietovę</option>
                            @foreach ($destinations as $destination)
                                @if ($destination->country_id == old('country_id'))
                                    <option value="{{ $destination->id }}"
                                        @if ($destination->id == old('destination_id', '')) selected @endif>
                                        {{ $destination->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('destination_id')
                            <div class="modal-sm" style="background-color: #f01616">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    @endif
                </div>

                <div class="mb-6 flex flex-col gap-2" id="select_destination_parent">
                    @if (old('country_id') || old('destination_id') || old('hotel_id'))
                        <label for="hotel_id">Nakvynės vieta:</label>
                        <select
                            class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                            aria-label="continent" name="hotel_id" id="hotel_id">
                            <option selected disabled>-- Rinktis nakvynę</option>
                            @foreach ($hotels as $hotel)
                                @if ($hotel->country_id == old('country_id'))
                                    <option value="{{ $hotel->id }}"
                                        @if ($hotel->id == old('hotel_id', '')) selected @endif>
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


                <div class="flex gap-2">
                    <button type="submit" class="btn-primary">Pridėti</button>
                    <a href="{{ route('admin-offers') }}" class="btn-primary">Grįžti</a>
                </div>

            </form>
        @endif
    </section>

    <script>
        const countries = {{ Js::from($countries) }};
        const countrySelect = document.querySelector("select[data-id='select_country']");
        let travelStartInput = document.getElementById('travel_start')
        let travelEndInput = document.getElementById('travel_end');
    </script>

</x-back-layout>
