<div class="flex items-center justify-between gap-4 flex-shrink-0 px-3">
    <!-- Logo -->
    <a href="{{ route('admin-home') }}">
        <img src="{{ asset('assets/img/logo-full.png') }}" alt="ZTravel" aria-hidden="true" class="w-full">

        <span class="sr-only">ZTravel</span>
    </a>

    <!-- Toggle button -->
    <x-button type="button" icon-only sr-text="Toggle sidebar" variant="primary"
        x-show="isSidebarOpen || isSidebarHovered" x-on:click="isSidebarOpen = !isSidebarOpen">
        <x-icons.menu-fold-right x-show="!isSidebarOpen" aria-hidden="true" class="hidden w-6 h-6 lg:block" />

        <x-icons.menu-fold-left x-show="isSidebarOpen" aria-hidden="true" class="hidden w-6 h-6 lg:block" />

        <x-heroicon-o-x aria-hidden="true" class="w-6 h-6 lg:hidden" />
    </x-button>
</div>
