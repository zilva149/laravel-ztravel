<x-back-layout :$pageTitle>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Pridėti šalį
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
        <form action="{{ route('admin-country-store') }}" method="POST" enctype="multipart/form-data"
            class="p-6 rounded-md shadow-lg bg-white w-full max-w-lg dark:bg-dark-eval-1 dark:text-white">
            @csrf
            <div class="mb-6 flex flex-col gap-2">
                <label for="name">Šalis:</label>
                <input type="text"
                    class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    name="name" id="name">
            </div>
            <div class="mb-6 flex flex-col gap-2">
                <label for="continent">Žemynas:</label>
                <select
                    class="appearance-none w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded-md transition ease-in-out focus:border-purple-500 focus:outline-none dark:bg-dark-eval-1 dark:text-white"
                    aria-label="continent" name="continent" id="continent">
                    <option selected disabled>-- Rinktis žemyną</option>
                    @foreach ($continents as $continent)
                        <option value="{{ $continent }}">{{ $continent }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-6 flex flex-col gap-2">
                <label for="season_start">Sezono pradžia:</label>
                <input type="date"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    name="season_start" id="season_start" min="{{ date('Y-m-d') }}" />
            </div>
            <div class="mb-6 flex flex-col gap-2">
                <label for="season_end">Sezono pabaiga:</label>
                <input type="date"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    name="season_end" id="season_end" min="{{ date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day')) }}" />
            </div>
            <div class="flex gap-2">
                <button type="submit" class="btn-primary">Pridėti</button>
                <a href="{{ route('admin-countries') }}" class="btn-primary">Grįžti</a>
            </div>
        </form>
    </section>
</x-back-layout>
