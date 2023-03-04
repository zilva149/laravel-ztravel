<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Redaguoti šalį
            </h2>
        </div>
    </x-slot>

    <section class="flex justify-center">
        <form action="{{ route('admin-country-update', $country->id) }}" method="POST" enctype="multipart/form-data"
            class="form">
            @csrf
            @method('PUT')

            @if (session()->has('success'))
                <x-message size="lg" operation="success" :text="session('success')" />
            @endif

            <div class="form-input-container">
                <label for="name">Šalis</label>
                <input type="text"
                    class="form-text"
                    name="name" id="name" value="{{ old('name', $country->name) }}"
                    placeholder="Šalies pavadinimas">
                @error('name')
                    <x-message size="sm" operation="failure" :text="$message" />
                @enderror
            </div>

            <div class="form-input-container">
                <label for="continent">Žemynas</label>
                <select
                    class="form-select"
                    aria-label="continent" name="continent" id="continent" required>
                    <option selected disabled>-- Rinktis žemyną</option>
                    @foreach ($continents as $continent)
                        <option value="{{ $continent }}" @if ($continent == old('continent', $country->continent)) selected @endif>
                            {{ $continent }}</option>
                    @endforeach
                </select>
                @error('continent')
                    <x-message size="sm" operation="failure" :text="$message" />
                @enderror
            </div>

            <div class="form-input-container">
                <label for="season_start">Sezono pradžia</label>
                <input type="date"
                    class="form-date"
                    name="season_start" value="{{ old('season_start', $country->season_start) }}" id="season_start"
                    min="{{ date('Y-m-d') }}" />
                @error('season_start')
                    <x-message size="sm" operation="failure" :text="$message" />
                @enderror
            </div>

            <div class="form-input-container">
                <label for="season_end">Sezono pabaiga</label>
                <input type="date"
                    class="form-date"
                    name="season_end" value="{{ old('season_end', $country->season_end) }}" id="season_end"
                    min="{{ date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day')) }}" />
                @error('season_end')
                    <x-message size="sm" operation="failure" :text="$message" />
                @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn-primary">Redaguoti</button>
                <a href="{{ route('admin-countries') }}" class="btn-primary">Grįžti</a>
            </div>
        </form>
    </section>
</x-back-layout>
