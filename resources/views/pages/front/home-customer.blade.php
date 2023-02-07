<x-front-layout>
    <x-slot name="header">
        <div class="flex gap-8 items-center">
            <h2 class="w-full text-3xl font-semibold leading-tight text-center">
                Pradinis
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @auth
            <p>Home Page, {{ auth()->user()->name }}!</p>
        @else
            <p>Home Page, Welcome!</p>
        @endauth
    </div>
</x-front-layout>
