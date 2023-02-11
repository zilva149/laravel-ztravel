<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="Pradinis" href="{{ route('admin-home') }}" :isActive="request()->routeIs('admin-home')">
        <x-slot name="icon">
            <i class="fa-solid fa-house-user w-6 text-center" aria-hidden="true"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="Užsakymai" href="{{ route('admin-orders') }}" :isActive="request()->routeIs('admin-orders')">
        <x-slot name="icon">
            <i class="fa-solid fa-cart-shopping w-6 text-center" aria-hidden="true"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="Vartotojai" href="{{ route('admin-users') }}" :isActive="request()->routeIs('admin-users')">
        <x-slot name="icon">
            <i class="fa-solid fa-user w-6 text-center" aria-hidden="true"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="Atsiliepimai" href="{{ route('admin-reviews') }}" :isActive="request()->routeIs('admin-reviews')">
        <x-slot name="icon">
            <i class="fa-solid fa-star w-6 text-center" aria-hidden="true"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="Šalys" href="{{ route('admin-countries') }}" :isActive="request()->routeIs('admin-countries')">
        <x-slot name="icon">
            <i class="fa-solid fa-globe w-6 text-center" aria-hidden="true"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="Vietovės" href="{{ route('admin-destinations') }}" :isActive="request()->routeIs('admin-destinations')">
        <x-slot name="icon">
            <i class="fa-solid fa-location-dot w-6 text-center" aria-hidden="true"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="Nakvynės vietos" href="{{ route('admin-hotels') }}" :isActive="request()->routeIs('admin-hotels')">
        <x-slot name="icon">
            <i class="fa-solid fa-house w-6 text-center" aria-hidden="true"></i>
        </x-slot>
    </x-sidebar.link>


</x-perfect-scrollbar>
