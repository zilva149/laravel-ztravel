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
            class="form">
            @csrf
            @method('PUT')

            @if (session()->has('success'))
                <x-message size="lg" operation="success" :text="session('success')" />
            @endif

            <div class="form-input-container">
                <label for="name">Pasiūlymo pavadinimas:</label>
                <input type="text"
                    class="form-text"
                    name="name" value="{{ old('name', $offer->name) }}" id="name">
                @error('name')
                    <x-message size="sm" operation="failure" :text="$message" />
                @enderror
            </div>

            <div class="form-input-container">
                <label for="country_id">Šalis:</label>
                <select
                    class="form-select"
                    aria-label="country" name="country_id" id="country_id">
                    <option selected disabled>-- Rinktis šalį</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" @if ($country->id == old('country_id', $offer->country_id)) selected @endif>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
                @error('country_id')
                    <x-message size="sm" operation="failure" :text="$message" />
                @enderror
            </div>

            <div id="destination_select_parent">
                <div class="form-input-container">
                    <label for="destination_id">Vietovė:</label>
                    <select
                        class="form-select"
                        aria-label="destination" name="destination_id" id="destination_id">
                        <option selected disabled>-- Rinktis vietovę</option>
                        @if (old('country_id'))    
                            @foreach ($destinations as $destination)
                                @if ($destination->country_id == old('country_id'))
                                    <option value="{{ $destination->id }}"
                                        @if ($destination->id == old('destination_id')) selected @endif>
                                        {{ $destination->name }}
                                    </option>
                                @endif
                            @endforeach
                        @else
                            @foreach ($destinations as $destination)
                                @if ($destination->country_id == $offer->country_id)
                                    <option value="{{ $destination->id }}"
                                        @if ($destination->id == $offer->destination_id) selected @endif>
                                        {{ $destination->name }}
                                    </option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                    @error('destination_id')
                        <x-message size="sm" operation="failure" :text="$message" />
                    @enderror
                </div>
            </div>

            <div id="hotel_select_parent">
                @if (old('country_id') && !old('destination_id'))
                    <div></div>
                @elseif (old('destination_id'))                    
                    <div class="form-input-container">
                        <label for="hotel_id">Nakvynės vieta:</label>
                        <select
                            class="form-select"
                            aria-label="hotel" name="hotel_id" id="hotel_id">
                            <option selected disabled>-- Rinktis nakvynę</option>
                                @foreach ($hotels as $hotel)
                                    @if ($hotel->destination_id == old('destination_id'))
                                        <option value="{{ $hotel->id }}"
                                            @if ($hotel->id == old('hotel_id')) selected @endif>
                                            {{ $hotel->name }}
                                        </option>
                                    @endif        
                                @endforeach
                        </select>
                        @error('hotel_id')
                            <x-message size="sm" operation="failure" :text="$message" />
                        @enderror
                    </div>
                @else
                    <div class="form-input-container">
                        <label for="hotel_id">Nakvynės vieta:</label>
                        <select
                            class="form-select"
                            aria-label="hotel" name="hotel_id" id="hotel_id">
                            <option selected disabled>-- Rinktis nakvynę</option>
                                @foreach ($hotels as $hotel)
                                    @if ($hotel->destination_id == $offer->destination_id)
                                        <option value="{{ $hotel->id }}"
                                            @if ($hotel->id == $offer->hotel_id) selected @endif>
                                            {{ $hotel->name }}
                                        </option>
                                    @endif        
                                @endforeach
                        </select>
                        @error('hotel_id')
                            <x-message size="sm" operation="failure" :text="$message" />
                        @enderror
                    </div>
                @endif  
            </div>

            <div class="form-input-container">
                <label for="travel_start">Kelionės pradžia:</label>
                <input type="date"
                    class="form-date"
                    name="travel_start" value="{{ old('travel_start', $offer->travel_start) }}" id="travel_start"
                    @foreach ($countries as $country)
                        @if ($country->id == old('country_id', $offer->country_id))
                            min="{{ $country->season_start }}" max="{{ $country->season_end }}"
                        @endif
                    @endforeach
                />
                @error('travel_start')
                    <x-message size="sm" operation="failure" :text="$message" />
                @enderror
            </div>

            <div class="form-input-container">
                <label for="travel_end">Kelionės pabaiga:</label>
                <input type="date"
                    class="form-date"
                    name="travel_end" value="{{ old('travel_end', $offer->travel_end) }}" id="travel_end"
                    @foreach ($countries as $country)
                        @if ($country->id == old('country_id', $offer->country_id))
                            min="{{ $country->season_start }}" max="{{ $country->season_end }}"
                        @endif
                    @endforeach
                />
                @error('travel_end')
                    <x-message size="sm" operation="failure" :text="$message" />
                @enderror
            </div>

            <div class="form-input-container">
                <label for="price">Kaina (EUR):</label>
                <input type="text"
                    class="form-text"
                    name="price" id="price" value="{{ old('price', $offer->price) }}">
                @error('price')
                    <x-message size="sm" operation="failure" :text="$message" />
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
