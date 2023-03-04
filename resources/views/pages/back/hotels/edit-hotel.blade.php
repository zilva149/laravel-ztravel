<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Redaguoti nakvynės vietą
            </h2>
        </div>
    </x-slot>

    <section class="flex justify-center">
        <form action="{{ route('admin-hotel-update', $hotel->id) }}" method="POST" enctype="multipart/form-data"
            class="form">
            @csrf
            @method('PUT')

            @if (session()->has('success'))
                <x-message size="lg" operation="success" :text="session('success')" />
            @endif

            <div class="form-input-container">
                <label for="country_id">Šalis:</label>
                <select
                    class="form-select"
                    aria-label="country" name="country_id" id="country_id">
                    <option selected disabled>-- Rinktis šalį</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" @if ($country->id == old('country_id', $hotel->country_id)) selected @endif>
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
                        @foreach ($countries as $country)
                            @if ($country->id == old('country_id', $hotel->country_id))
                                @foreach ($country->destinations as $destination)
                                    <option value="{{ $destination->id }}"
                                        @if ($destination->id == old('destination_id', $hotel->destination_id)) selected @endif>
                                        {{ $destination->name }}
                                    </option>
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                    @error('destination_id')
                        <x-message size="sm" operation="failure" :text="$message" />
                    @enderror
                </div>
            </div>

            <div class="form-input-container">
                <label for="name">Nakvynės vietos pavadinimas</label>
                <input type="text"
                    class="form-text"
                    name="name" id="name" value="{{ old('name', $hotel->name) }}">
                @error('name')
                    <x-message size="sm" operation="failure" :text="$message" />
                @enderror
            </div>

            <div class="form-input-container">
                <label for="address">Adresas</label>
                <input type="text"
                    class="form-text"
                    name="address" id="address" value="{{ old('address', $hotel->address) }}">
                @error('address')
                    <x-message size="sm" operation="failure" :text="$message" />
                @enderror
            </div>

            <div class="form-input-container">
                <label for="people_limit">Žmonių limitas</label>
                <input type="text"
                    class="form-text"
                    name="people_limit" id="people_limit" value="{{ old('people_limit', $hotel->people_limit) }}">
                @error('people_limit')
                    <x-message size="sm" operation="failure" :text="$message" />
                @enderror
            </div>

            @if ($hotel->image)
                <div class="form-input-container">
                    <div class="w-full rounded-md overflow-hidden">
                        <img src="{{ $hotel->image }}" alt="{{ $hotel->name }}">
                    </div>
                    <button class="btn-primary w-full" type="submit" name="delete_photo" value="1">Trinti
                        nuotrauką</button>
                </div>
            @endif

            <div class="form-input-container">
                <input
                    class="form-text"
                    type="file" name="image">
                @error('image')
                    <x-message size="sm" operation="failure" :text="$message" />
                @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn-primary">Redaguoti</button>
                <a href="{{ route('admin-hotels') }}" class="btn-primary">Grįžti</a>
            </div>
        </form>
    </section>

    <script>
        const page = 'hotels';
    </script>
</x-back-layout>
