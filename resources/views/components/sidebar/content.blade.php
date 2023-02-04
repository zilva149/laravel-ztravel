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

    <x-sidebar.link title="Klientai" href="{{ route('admin-clients') }}" :isActive="request()->routeIs('admin-clients')">
        <x-slot name="icon">
            <i class="fa-solid fa-user w-6 text-center" aria-hidden="true"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="Atsiliepimai" href="{{ route('admin-reviews') }}" :isActive="request()->routeIs('admin-reviews')">
        <x-slot name="icon">
            <i class="fa-solid fa-star w-6 text-center" aria-hidden="true"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.dropdown title="Redagavimas" :active="Str::startsWith(
        request()
            ->route()
            ->uri(),
        'buttons',
    )">
        <x-slot name="icon">
            <i class="fa-solid fa-pen-to-square w-6 text-center" aria-hidden="true"></i>
        </x-slot>

        <x-sidebar.sublink title="Šalys" href="{{ route('admin-countries') }}" :active="request()->routeIs('admin-countries')" />
        <x-sidebar.sublink title="Viešbučiai" href="{{ route('admin-hotels') }}" :active="request()->routeIs('admin-hotels')" />
        <x-sidebar.sublink title="Kelionės" href="{{ route('admin-travels') }}" :active="request()->routeIs('admin-travels')" />
    </x-sidebar.dropdown>

</x-perfect-scrollbar>
