<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Redaguoti viešbutį
            </h2>
        </div>
    </x-slot>

    @if (session()->has('success'))
        <p>{{ session('success') }}</p>
    @endif

    @error('country')
        <p>{{ $message }}</p>
    @enderror
    @error('name')
        <p>{{ $message }}</p>
    @enderror
    @error('desc')
        <p>{{ $message }}</p>
    @enderror
    @error('image')
        <p>{{ $message }}</p>
    @enderror

    <section class="flex justify-center">
        <form action="{{ route('admin-hotel-update', $hotel->id) }}" method="POST" enctype="multipart/form-data"
            class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg dark:bg-dark-eval-1 dark:text-white">
            @csrf
            @method('PUT')

            <div class="mb-6 flex flex-col gap-2">
                <label for="country">Šalis</label>
                <select
                    class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    aria-label="country" name="country" id="country">
                    <option value="" selected disabled>-- Rinktis šalį</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->name }}" @if ($hotel->country->name === $country->name) selected @endif>
                            {{ $country->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col gap-2">
                <label for="name">Pavadinimas</label>
                <input type="text"
                    class="mb-6 w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    name="name" value="{{ $hotel->name }}" id="name">
            </div>

            <div class="flex flex-col gap-2">
                <label for="desc">Aprašymas</label>
                <textarea
                    class="mb-6 w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    name="desc" id="desc" rows="3">{{ $hotel->desc }}</textarea>
            </div>

            @if ($hotel->image !== '/assets/img/logo.png')
                <div class="mb-6 flex flex-col gap-2">
                    <div class="w-full rounded-md overflow-hidden">
                        <img src="{{ $hotel->image }}" alt="{{ $hotel->name }}">
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

            <button type="submit" class="btn-primary">Pridėti</button>
        </form>
    </section>
</x-back-layout>
