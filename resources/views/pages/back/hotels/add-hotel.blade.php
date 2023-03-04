<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Pridėti nakvynės vietą
            </h2>
        </div>
    </x-slot>

    <section class="flex justify-center">
        @if (count($countries) === 0)
            <div
                class="empty-list">
                <h2 class="text-lg font-semibold">Šalių sąrašas tuščias, prašome pridėti naują šalį</h2>
                <div class="flex gap-2">
                    <a href="{{ route('admin-country-create') }}" class="btn-primary cursor-pointer">Pridėti šalį</a>
                    <a href="{{ route('admin-hotels') }}" class="btn-primary">Grįžti</a>
                </div>
            </div>
        @elseif (count($destinations) === 0)
            <div
                class="empty-list">
                <h2 class="text-lg font-semibold">Vietovių sąrašas tuščias, prašome pridėti naują vietovę</h2>
                <div class="flex gap-2">
                    <a href="{{ route('admin-destination-create') }}" class="btn-primary cursor-pointer">Pridėti
                        vietovę</a>
                    <a href="{{ route('admin-hotels') }}" class="btn-primary">Grįžti</a>
                </div>
            </div>
        @else
            <form action="{{ route('admin-hotel-store') }}" method="POST" enctype="multipart/form-data"
                class="form">
                @csrf

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
                            <option value="{{ $country->id }}" @if ($country->id == old('country_id', '')) selected @endif>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <x-message size="sm" operation="failure" :text="$message" />
                    @enderror
                </div>

                <div id="destination_select_parent">
                    @if (old('country_id'))
                        <div class="form-input-container">
                            <label for="destination_id">Vietovė:</label>
                            <select
                                class="form-select"
                                aria-label="destination" name="destination_id" id="destination_id">
                                <option selected disabled>-- Rinktis vietovę</option>
                                @foreach ($destinations as $destination)
                                    @if ($destination->country->id == old('country_id'))
                                        <option value="{{ $destination->id }}"
                                            @if ($destination->id == old('destination_id', '')) selected @endif>
                                            {{ $destination->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('destination_id')
                                <x-message size="sm" operation="failure" :text="$message" />
                            @enderror
                        </div>
                    @endif
                </div>

                <div class="form-input-container">
                    <label for="name">Nakvynės vietos pavadinimas</label>
                    <input type="text"
                        class="form-text"
                        name="name" id="name" value="{{ old('name', '') }}">
                    @error('name')
                        <x-message size="sm" operation="failure" :text="$message" />
                    @enderror
                </div>

                <div class="form-input-container">
                    <label for="address">Adresas</label>
                    <input type="text"
                        class="form-text"
                        name="address" id="address" value="{{ old('address', '') }}">
                    @error('address')
                        <x-message size="sm" operation="failure" :text="$message" />
                    @enderror
                </div>

                <div class="form-input-container">
                    <label for="people_limit">Žmonių limitas</label>
                    <input type="text"
                        class="form-text"
                        name="people_limit" id="people_limit" value="{{ old('people_limit', '') }}">
                    @error('people_limit')
                        <x-message size="sm" operation="failure" :text="$message" />
                    @enderror
                </div>

                <div class="form-input-container">
                    <input
                        class="form-text"
                        type="file" name="image">
                    @error('image')
                        <x-message size="sm" operation="failure" :text="$message" />
                    @enderror
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="btn-primary">Pridėti</button>
                    <a href="{{ route('admin-hotels') }}" class="btn-primary">Grįžti</a>
                </div>
            </form>
        @endif
    </section>

    <script>
        const page = 'hotels';
    </script>
</x-back-layout>
