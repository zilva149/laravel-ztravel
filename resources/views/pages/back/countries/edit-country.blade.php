<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Redaguoti šalį
            </h2>
        </div>
    </x-slot>

    @if (session()->has('success'))
        <p>{{ session('success') }}</p>
    @endif

    @error('continent')
        <p>{{ $message }}</p>
    @enderror
    @error('season_start')
        <p>{{ $message }}</p>
    @enderror
    @error('season_end')
        <p>{{ $message }}</p>
    @enderror
    @error('image')
        <p>{{ $message }}</p>
    @enderror

    <section class="flex justify-center">
        <form action="{{ route('admin-country-update', $country->id) }}" method="POST" enctype="multipart/form-data"
            class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg dark:bg-dark-eval-1 dark:text-white">
            @csrf
            @method('PUT')

            <div class="mb-6 flex flex-col gap-2">
                <label for="name">Šalis</label>
                <input type="text"
                    class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    name="name" id="name" value="{{ $country->name }}" placeholder="Šalies pavadinimas">
            </div>

            <div class="mb-6 flex flex-col gap-2">
                <label for="continent">Žemynas</label>
                <select
                    class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    aria-label="continent" name="continent" id="continent" required>
                    <option selected disabled>-- Rinktis žemyną</option>
                    @foreach ($continents as $continent)
                        <option value="{{ $continent }}" @if ($continent === $country->continent) selected @endif>
                            {{ $continent }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6 flex flex-col gap-2">
                <label for="season_start">Sezono pradžia</label>
                <input type="date"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    name="season_start" value="{{ $country->season_start }}" id="season_start"
                    min="{{ date('Y-m-d') }}" />
            </div>

            <div class="mb-6 flex flex-col gap-2">
                <label for="season_end">Sezono pabaiga</label>
                <input type="date"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    name="season_end" value="{{ $country->season_end }}" id="season_end"
                    min="{{ date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day')) }}" />
            </div>

            @if ($country->image !== '/assets/img/logo.png')
                <div class="mb-6
                    flex flex-col gap-2">
                    <div class="w-full rounded-md overflow-hidden">
                        <img src="{{ $country->image }}" alt="image">
                    </div>
                    <button class="btn-primary w-full" type="submit" name="delete_photo" value="1">Trinti
                        nuotrauką</button>
                </div>
            @endif

            <div class="mb-6">
                <input
                    class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    type="file" name="image">
            </div>

            <button type="submit" class="btn-primary">Redaguoti</button>
        </form>
    </section>
</x-back-layout>
