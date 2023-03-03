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
                    <div class="flex gap-4">
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
            <div class="flex items-center w-[125px]">
                <a href="{{ route('index') }}">
                    <x-application-logo-light class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            @auth
                <div class="flex items-center">
                    <button
                        class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-[var(--green)] focus:outline-none transition duration-150 ease-in-out" id="burger-open">
                        <i class="fa-solid fa-bars text-2xl"></i>
                        <i class="fa-solid fa-xmark text-3xl hidden"></i>
                    </button>
                </div>
            @else
                <div class="flex gap-4">
                    <x-nav-link :href="route('login')">
                        {{ __('Prisijungti') }}
                    </x-nav-link>
                    <x-nav-link :href="route('register')">
                        {{ __('Registruotis') }}
                    </x-nav-link>
                </div>
            @endauth

            @auth              
                <!-- Sidebar -->
                <div class="w-[60%] max-w-[300px] fixed left-0 top-0 bottom-0 z-20 flex flex-col gap-8 py-4 bg-[var(--green)] shadow-lg transition-all" style="transform: translateX(-100%)" id="front-sidebar">
                    <div class="flex items-center justify-between gap-4 flex-shrink-0 px-3">
                        <div class="flex items-center w-2/3">
                            <a href="{{ route('index') }}">
                                <x-application-logo-light class="block h-9 w-auto fill-current text-gray-800" />
                            </a>
                        </div>

                        <button
                        class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-[var(--dgreen)] focus:outline-none transition duration-150 ease-in-out" id="burger-open">
                            <i class="fa-solid fa-xmark text-3xl"></i>
                        </button>
                    </div>

                    <div class="flex flex-col flex-1 gap-2 md:gap-4">
                        <x-sidebar.link title="Pradinis" href="{{ route('index') }}" :isActive="request()->routeIs('index')">
                            <x-slot name="icon">
                                <i class="fa-solid fa-house-user w-6 text-center" aria-hidden="true"></i>
                            </x-slot>
                        </x-sidebar.link>
                    
                        <x-sidebar.link title="Pasiūlymai" href="{{ route('customer-offers') }}" :isActive="request()->routeIs('customer-offers')">
                            <x-slot name="icon">
                                <i class="fa-solid fa-cart-shopping w-6 text-center" aria-hidden="true"></i>
                            </x-slot>
                        </x-sidebar.link>
                    
                        <x-sidebar.link title="Apie mus" href="{{ route('index') }}" :isActive="request()->routeIs('index')">
                            <x-slot name="icon">
                                <i class="fa-solid fa-user w-6 text-center" aria-hidden="true"></i>
                            </x-slot>
                        </x-sidebar.link>
                    
                        <x-sidebar.link title="Kontaktai" href="{{ route('index') }}" :isActive="request()->routeIs('index')">
                            <x-slot name="icon">
                                <i class="fa-solid fa-star w-6 text-center" aria-hidden="true"></i>
                            </x-slot>
                        </x-sidebar.link>
                    </div>

                    <div class="flex flex-col flex-1 gap-2 md:hidden">
                        <div class="p-2 text-gray-500 border-b-2 border-b-solid">
                            <span>{{ auth()->user()->name }}</span>
                        </div>

                        <x-sidebar.link title="Paskyra" href="{{ route('profile.edit') }}" :isActive="request()->routeIs('profile.edit')">
                            <x-slot name="icon">
                                <i class="fa-solid fa-house-user w-6 text-center" aria-hidden="true"></i>
                            </x-slot>
                        </x-sidebar.link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-sidebar.link title="Atsijungti" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <x-slot name="icon">
                                    <i class="fa-solid fa-house-user w-6 text-center" aria-hidden="true"></i>
                                </x-slot>
                            </x-sidebar.link>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>
