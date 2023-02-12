<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Redaguoti nakvynės vietą
            </h2>
        </div>
    </x-slot>

    @if (session()->has('success'))
        <p>{{ session('success') }}</p>
    @endif

    <section class="flex justify-center">
        <form action="{{ route('admin-hotel-update', $hotel->id) }}" method="POST" enctype="multipart/form-data"
            class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg dark:bg-dark-eval-1 dark:text-white">
            @csrf
            @method('PUT')

            <div class="mb-6 flex flex-col gap-2">
                <label for="country_id">Šalis:</label>
                <select
                    class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    aria-label="country" name="country_id" id="country_id">
                    <option selected disabled>-- Rinktis šalį</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" @if ($country->id == old('country_id', $hotel->country_id)) selected @endif>
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
                        <div class="modal-sm" style="background-color: #f01616">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mb-6 flex flex-col gap-2">
                <label for="name">Nakvynės vietos pavadinimas</label>
                <input type="text"
                    class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    name="name" id="name" value="{{ old('name', $hotel->name) }}">
                @error('name')
                    <div class="modal-sm" style="background-color: #f01616">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-6 flex flex-col gap-2">
                <label for="address">Adresas</label>
                <input type="text"
                    class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    name="address" id="address" value="{{ old('address', $hotel->address) }}">
                @error('address')
                    <div class="modal-sm" style="background-color: #f01616">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-6 flex flex-col gap-2">
                <label for="people_limit">Žmonių limitas</label>
                <input type="text"
                    class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    name="people_limit" id="people_limit" value="{{ old('people_limit', $hotel->people_limit) }}">
                @error('people_limit')
                    <div class="modal-sm" style="background-color: #f01616">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-6">
                <input
                    class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    type="file" name="image">
                @error('image')
                    <div class="modal-sm" style="background-color: #f01616">
                        <p>{{ $message }}</p>
                    </div>
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
        const countrySelect = document.getElementById('country_id');
    </script>
</x-back-layout>
