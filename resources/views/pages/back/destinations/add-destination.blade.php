<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Pridėti vietovę
            </h2>
        </div>
    </x-slot>

    <section class="flex justify-center">
        @if (count($countries) !== 0)
            <form action="{{ route('admin-destination-store') }}" method="POST" enctype="multipart/form-data"
                class="form">
                @csrf

                @if (session()->has('success'))
                    <x-message size="lg" operation="success" :text="session('success')" />
                @endif

                <div class="form-input-container">
                    <label for="country_id">Šalis</label>
                    <select
                        class="form-select"
                        aria-label="country" name="country_id" id="country_id">
                        <option selected disabled>-- Rinktis šalį</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @if ($country->id == old('country_id', '')) selected @endif>
                                {{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <x-message size="sm" operation="failure" :text="$message" />
                    @enderror
                </div>

                <div class="form-input-container">
                    <label for="name">Vietovės pavadinimas</label>
                    <input type="text"
                        class="form-text"
                        name="name" id="name" value="{{ old('name', '') }}">
                    @error('name')
                        <x-message size="sm" operation="failure" :text="$message" />
                    @enderror
                </div>

                <div class="form-input-container">
                    <label for="desc">Aprašymas</label>
                    <textarea
                        class="form-text"
                        name="desc" id="desc" rows="3">{{ old('desc', '') }}</textarea>
                    @error('desc')
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
                    <a href="{{ route('admin-destinations') }}" class="btn-primary">Grįžti</a>
                </div>
            </form>
        @else
            <div
                class="empty-list">
                <h2 class="text-lg font-semibold">Šalių sąrašas tuščias, prašome pridėti naują šalį</h2>
                <div class="flex gap-2">
                    <a href="{{ route('admin-country-create') }}" class="btn-primary cursor-pointer">Pridėti šalį</a>
                    <a href="{{ route('admin-destinations') }}" class="btn-primary">Grįžti</a>
                </div>
            </div>
        @endif
    </section>
</x-back-layout>
