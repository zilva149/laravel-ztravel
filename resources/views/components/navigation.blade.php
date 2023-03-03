<nav x-data="{ open: false }" class="absolute top-0 left-0 right-0 z-[999] bg-transparent">
    <!-- Primary Navigation Menu -->
    <div class="hidden lg:block max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24">
            <div class="flex items-center w-[125px]">
                <a href="{{ route('index') }}">
                    <x-application-logo-light class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <div class="flex items-center gap-8">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('index')" :active="request()->routeIs('index', 'customer-home')">
                        {{ __('Pradinis') }}
                    </x-nav-link>
                    <x-nav-link :href="route('customer-offers')" :active="request()->routeIs('customer-offers')">
                        {{ __('Pasiūlymai') }}
                    </x-nav-link>
                    <x-nav-link :href="route('index')" :active="request()->routeIs('customer-about-us')">
                        {{ __('Apie mus') }}
                    </x-nav-link>
                    <x-nav-link :href="route('index')" :active="request()->routeIs('customer-contact-us')">
                        {{ __('Kontaktai') }}
                    </x-nav-link>
                </div>
                @auth
                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="btn-action-link flex justify-center items-center focus:outline-none">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Paskyra') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('customer-orders')">
                                    {{ __('Užsakymai') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Atsijungti') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <div class="hidden sm:flex gap-4">
                        <a href="{{ route('login') }}" class="btn-action-link">Log in</a>
                        <a href="{{ route('register') }}" class="btn-action-link">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div class="block lg:hidden max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24">
            <!-- Logo -->
            <div class="flex items-center w-[125px]">
                <a href="{{ route('index') }}">
                    <x-application-logo-light class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-[var(--green)] focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
