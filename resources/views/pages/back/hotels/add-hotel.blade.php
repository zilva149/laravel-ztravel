<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Pridėti viešbutį
            </h2>
        </div>
    </x-slot>

    @if (session()->has('success'))
        <p>{{ session('success') }}</p>
    @endif

    <section class="flex justify-center">
        @if (count($countries) !== 0)
            <form action="{{ route('admin-hotel-store') }}" method="POST" enctype="multipart/form-data"
                class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg dark:bg-dark-eval-1 dark:text-white">
                @csrf
                <div class="mb-6 flex flex-col gap-2">
                    <label for="country_id">Šalis</label>
                    <select
                        class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                        aria-label="country" name="country_id" id="country_id">
                        <option selected disabled>-- Rinktis šalį</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @if ($country->id == old('country_id', '')) selected @endif>
                                {{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <div class="modal-sm" style="background-color: #f01616">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                <div class="mb-6 flex flex-col gap-2">
                    <label for="name">Pavadinimas</label>
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
                    <label for="desc">Aprašymas</label>
                    <textarea
                        class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                        name="desc" id="desc" rows="3">{{ old('desc', '') }}</textarea>
                    @error('desc')
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
                <button type="submit" class="btn-primary">Pridėti</button>
            </form>
        @else
            <div
                class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg flex flex-col gap-4 items-center dark:bg-dark-eval-1 dark:text-white">
                <h2 class="text-lg font-semibold">Šalių sąrašas tuščias, prašome pridėti naują šalį</h2>
                <a href="{{ route('admin-country-create') }}" class="btn-primary cursor-pointer">Pridėti šalį</a>
            </div>
        @endif
    </section>
</x-back-layout>
