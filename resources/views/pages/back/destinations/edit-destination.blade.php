<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Redaguoti vietovę
            </h2>
        </div>
    </x-slot>

    <section class="flex justify-center">
        <form action="{{ route('admin-destination-update', $destination->id) }}" method="POST"
            enctype="multipart/form-data"
            class="form">
            @csrf
            @method('PUT')

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
                        <option value="{{ $country->id }}" @if ($country->id == old('country_id', $destination->country_id)) selected @endif>
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
                    name="name" value="{{ old('name', $destination->name) }}" id="name">
                @error('name')
                    <x-message size="sm" operation="failure" :text="$message" />
                @enderror
            </div>

            <div class="form-input-container">
                <label for="desc">Aprašymas</label>
                <textarea
                    class="form-text"
                    name="desc" id="desc" rows="3">{{ old('desc', $destination->desc) }}</textarea>
                @error('desc')
                    <x-message size="sm" operation="failure" :text="$message" />
                @enderror
            </div>

            @if ($destination->image)
                <div class="form-input-container">
                    <div class="w-full rounded-md overflow-hidden">
                        <img src="{{ $destination->image }}" alt="{{ $destination->name }}">
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
                <a href="{{ route('admin-destinations') }}" class="btn-primary">Grįžti</a>
            </div>
        </form>
    </section>
</x-back-layout>
