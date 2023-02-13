<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Redaguoti pasiūlymą
            </h2>
        </div>
    </x-slot>

    <section class="flex justify-center">
        <form action="{{ route('admin-offer-update', $offer->id) }}" method="POST"
            class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg dark:bg-dark-eval-1 dark:text-white">
            @csrf
            @method('PUT')

            @if (session()->has('success'))
                <div class="modal mb-4" style="background-color: var(--green)">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="mb-6 flex flex-col gap-2">
                <label for="name">Pasiūlymo pavadinimas:</label>
                <input type="text"
                    class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    name="name" value="{{ old('name', $offer->name) }}" id="name">
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
                    aria-label="country" name="country_id" id="country_id" data-id="country_select">
                    <option selected disabled>-- Rinktis šalį</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" @if ($country->id == old('country_id', $offer->country_id)) selected @endif>
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

            <div id="destination_select_parent">
                <div class="mb-6 flex flex-col gap-2">
                    <label for="destination_id">Vietovė:</label>
                    <select
                        class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                        aria-label="destination" name="destination_id" id="destination_id">
                        <option selected disabled>-- Rinktis vietovę</option>
                        @foreach ($destinations as $destination)
                            @if ($destination->country_id == $offer->country_id)
                                <option value="{{ $destination->id }}"
                                    @if ($destination->id == old('destination_id', $offer->destination_id)) selected @endif>
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
                </div>
            </div>

            <div id="hotel_select_parent">
                <div class="mb-6 flex flex-col gap-2">
                    <label for="hotel_id">Nakvynės vieta:</label>
                    <select
                        class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                        aria-label="hotel" name="hotel_id" id="hotel_id">
                        <option selected disabled>-- Rinktis nakvynę</option>
                        @foreach ($hotels as $hotel)
                            @if ($hotel->destination_id == $offer->destination_id)
                                <option value="{{ $hotel->id }}"
                                    @if ($hotel->id == old('hotel_id', $offer->hotel_id)) selected @endif>
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
                </div>
            </div>

            <div class="mb-6 flex flex-col gap-2">
                <label for="travel_start">Kelionės pradžia:</label>
                <input type="date"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    name="travel_start" value="{{ old('travel_start', $offer->travel_start) }}" id="travel_start"
                    @foreach ($countries as $country)
                        @if ($country->id == old('country_id', $offer->country_id))
                            min="{{ $country->season_start }}" max="{{ $country->season_end }}"
                        @endif
                    @endforeach
                />
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
                    name="travel_end" value="{{ old('travel_end', $offer->travel_end) }}" id="travel_end"
                    @foreach ($countries as $country)
                        @if ($country->id == old('country_id', $offer->country_id))
                            min="{{ $country->season_start }}" max="{{ $country->season_end }}"
                        @endif
                    @endforeach
                />
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
                    name="price" id="price" value="{{ old('price', $offer->price) }}">
                @error('price')
                    <div class="modal-sm" style="background-color: #f01616">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
            </div>


            <div class="flex gap-2">
                <button type="submit" class="btn-primary">Redaguoti</button>
                <a href="{{ route('admin-offers') }}" class="btn-primary">Grįžti</a>
            </div>

        </form>
    </section>

    <script>
        const page = 'offers';
        const countries = {{ Js::from($countries) }};
        let travelStartInput = document.getElementById('travel_start')
        let travelEndInput = document.getElementById('travel_end');
    </script>

</x-back-layout>
