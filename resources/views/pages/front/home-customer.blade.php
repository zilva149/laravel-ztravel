<x-front-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @auth
            <p>Home Page, {{ auth()->user()->name }}!</p>
        @else
            <p>Home Page, Welcome!</p>
        @endauth
    </div>
</x-front-layout>
