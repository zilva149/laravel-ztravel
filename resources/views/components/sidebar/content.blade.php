<x-perfect-scrollbar as="nav" aria-label="main" class="px-3 flex flex-col gap-4">

    <div class="flex flex-col flex-1 gap-2 md:gap-4">
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
    
        <x-sidebar.link title="Pasiūlymai" href="{{ route('admin-offers') }}" :isActive="request()->routeIs('admin-offers')">
            <x-slot name="icon">
                <i class="fa-solid fa-store w-6 text-center" aria-hidden="true"></i>
            </x-slot>
        </x-sidebar.link>
    </div>

    <div class="flex flex-col flex-1 gap-2 md:hidden">
        <div class="p-2 text-gray-500 border-b-2 border-b-solid">
            <span>{{ auth()->user()->name }}</span>
        </div>

        <x-sidebar.link title="Paskyra" href="{{ route('profile.edit') }}" :isActive="request()->routeIs('profile.edit')">
            <x-slot name="icon">
                <i class="fa-regular fa-id-card w-6 text-center" aria-hidden="true"></i>
            </x-slot>
        </x-sidebar.link>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-sidebar.link title="Atsijungti" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                <x-slot name="icon">
                    <i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i>
                </x-slot>
            </x-sidebar.link>
        </form>
    </div>


</x-perfect-scrollbar>
