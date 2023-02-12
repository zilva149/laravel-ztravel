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
                class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg flex flex-col gap-4 items-center dark:bg-dark-eval-1 dark:text-white">
                <h2 class="text-lg font-semibold">Šalių sąrašas tuščias, prašome pridėti naują šalį</h2>
                <div class="flex gap-2">
                    <a href="{{ route('admin-country-create') }}" class="btn-primary cursor-pointer">Pridėti šalį</a>
                    <a href="{{ route('admin-hotels') }}" class="btn-primary">Grįžti</a>
                </div>
            </div>
        @elseif (count($destinations) === 0)
            <div
                class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg flex flex-col gap-4 items-center dark:bg-dark-eval-1 dark:text-white">
                <h2 class="text-lg font-semibold">Vietovių sąrašas tuščias, prašome pridėti naują vietovę</h2>
                <div class="flex gap-2">
                    <a href="{{ route('admin-destination-create') }}" class="btn-primary cursor-pointer">Pridėti
                        vietovę</a>
                    <a href="{{ route('admin-hotels') }}" class="btn-primary">Grįžti</a>
                </div>
            </div>
        @else
            <form action="{{ route('admin-hotel-store') }}" method="POST" enctype="multipart/form-data"
                class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg dark:bg-dark-eval-1 dark:text-white">
                @csrf

                @if (session()->has('success'))
                    <div class="modal mb-4" style="background-color: var(--green)">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <div class="mb-6 flex flex-col gap-2">
                    <label for="country_id">Šalis:</label>
                    <select
                        class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                        aria-label="country" name="country_id" id="country_id">
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

                <div id="destination_select_parent">
                    @if (old('country_id'))
                        <div class="mb-6 flex flex-col gap-2">
                            <label for="destination_id">Vietovė:</label>
                            <select
                                class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
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
                                <div class="modal-sm" style="background-color: #f01616">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    @endif
                </div>

                <div class="mb-6 flex flex-col gap-2">
                    <label for="name">Nakvynės vietos pavadinimas</label>
                    <input type="text"
                        class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                        name="name" id="name" value="{{ old('name', '') }}">
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
                        name="address" id="address" value="{{ old('address', '') }}">
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
                        name="people_limit" id="people_limit" value="{{ old('people_limit', '') }}">
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
                    <button type="submit" class="btn-primary">Pridėti</button>
                    <a href="{{ route('admin-hotels') }}" class="btn-primary">Grįžti</a>
                </div>
            </form>
        @endif
    </section>

    <script>
        const page = 'hotels';
        const countrySelect = document.getElementById('country_id');
    </script>
</x-back-layout>
