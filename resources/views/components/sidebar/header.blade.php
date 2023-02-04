<div class="flex items-center justify-between flex-shrink-0 px-3">
    <!-- Logo -->
    <a href="{{ route('admin-home') }}" class="inline-flex items-center gap-2">
        <img src="{{ asset('build/assets/img/logo-full.png') }}" alt="ZTravel" aria-hidden="true" class="w-40 h-auto">

        <span class="sr-only">ZTravel</span>
    </a>

    <!-- Toggle button -->
    <x-button type="button" icon-only sr-text="Toggle sidebar" variant="secondary"
        x-show="isSidebarOpen || isSidebarHovered" x-on:click="isSidebarOpen = !isSidebarOpen">
        <x-icons.menu-fold-right x-show="!isSidebarOpen" aria-hidden="true" class="hidden w-6 h-6 lg:block" />

        <x-icons.menu-fold-left x-show="isSidebarOpen" aria-hidden="true" class="hidden w-6 h-6 lg:block" />

        <x-heroicon-o-x aria-hidden="true" class="w-6 h-6 lg:hidden" />
    </x-button>
</div>
