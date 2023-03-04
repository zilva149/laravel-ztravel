<!-- Sidebar -->
<div class="w-[60%] max-w-[300px] fixed left-0 top-0 bottom-0 z-[999] flex flex-col gap-8 py-4 bg-[var(--green)] shadow-lg transition-all" style="transform: translateX(-100%)" id="front-sidebar">
    <div class="flex items-center justify-between gap-4 flex-shrink-0 px-3">
        <div class="flex items-center w-2/3">
            <a href="{{ route('index') }}">
                <x-application-logo-light class="block h-9 w-auto fill-current text-gray-800" />
            </a>
        </div>

        <button
        class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-[var(--dgreen)] focus:outline-none transition duration-150 ease-in-out" id="burger-close">
            <i class="fa-solid fa-xmark text-3xl"></i>
        </button>
    </div>

    @guest
        <div class="pl-4 flex flex-col gap-2 md:gap-4">
            <a href="{{ route('login') }}" class="w-full p-2 flex gap-4 items-center shadow-lg rounded-l-lg {{ request()->routeIs('login') ? 'bg-[var(--dgreen)] text-white' : 'bg-white text-[var(--green)]'}} transition-all hover:bg-[var(--dgreen)] hover:text-white">
                <i class="fa-solid fa-right-to-bracket w-6 text-center" aria-hidden="true"></i>
                Prisijungti
            </a>

            <a href="{{ route('register') }}" class="w-full p-2 flex gap-4 items-center shadow-lg rounded-l-lg {{ request()->routeIs('register') ? 'bg-[var(--dgreen)] text-white' : 'bg-white text-[var(--green)]'}} transition-all hover:bg-[var(--dgreen)] hover:text-white">
                <i class="fa-solid fa-user-plus w-6 text-center" aria-hidden="true"></i>
                Registruotis
            </a>
        </div>
    @endguest
    
    <div class="pl-4 flex flex-col flex-1 gap-2 md:gap-4">
        <a href="{{ route('index') }}" class="w-full p-2 flex gap-4 items-center shadow-lg rounded-l-lg {{ request()->routeIs('index') ? 'bg-[var(--dgreen)] text-white' : 'bg-white text-[var(--green)]'}} transition-all hover:bg-[var(--dgreen)] hover:text-white">
            <i class="fa-solid fa-house-user w-6 text-center" aria-hidden="true"></i>
            Pradinis
        </a>

        <a href="{{ route('customer-offers') }}" class="w-full p-2 flex gap-4 items-center shadow-lg rounded-l-lg {{ request()->routeIs('customer-offers') ? 'bg-[var(--dgreen)] text-white' : 'bg-white text-[var(--green)]'}} transition-all hover:bg-[var(--dgreen)] hover:text-white">
            <i class="fa-solid fa-plane-departure w-6 text-center" aria-hidden="true"></i>
            Pasiūlymai
        </a>

        <a href="{{ route('index') }}" class="w-full p-2 flex gap-4 items-center shadow-lg rounded-l-lg {{ request()->routeIs('customer-about-us') ? 'bg-[var(--dgreen)] text-white' : 'bg-white text-[var(--green)]'}} transition-all hover:bg-[var(--dgreen)] hover:text-white">
            <i class="fa-solid fa-info w-6 text-center" aria-hidden="true"></i>
            Apie mus
        </a>

        <a href="{{ route('index') }}" class="w-full p-2 flex gap-4 items-center shadow-lg rounded-l-lg {{ request()->routeIs('customer-contacts') ? 'bg-[var(--dgreen)] text-white' : 'bg-white text-[var(--green)]'}} transition-all hover:bg-[var(--dgreen)] hover:text-white">
            <i class="fa-solid fa-address-book w-6 text-center" aria-hidden="true"></i>
            Kontaktai
        </a>
    </div>

    @auth       
        <div class="pl-4 flex flex-col flex-1 gap-2">
            <div class="p-2 text-lg text-white border-b-2 border-b-solid">
                <span>{{ auth()->user()->name }}</span>
            </div>

            <a href="{{ route('profile.edit') }}" class="w-full p-2 flex gap-4 items-center shadow-lg rounded-l-lg {{ request()->routeIs('profile.edit') ? 'bg-[var(--dgreen)] text-white' : 'bg-white text-[var(--green)]'}} transition-all hover:bg-[var(--dgreen)] hover:text-white">
                <i class="fa-regular fa-id-card w-6 text-center"></i>
                Paskyra
            </a>

            <a href="{{ route('customer-orders') }}" class="w-full p-2 flex gap-4 items-center shadow-lg rounded-l-lg {{ request()->routeIs('customer-orders') ? 'bg-[var(--dgreen)] text-white' : 'bg-white text-[var(--green)]'}} transition-all hover:bg-[var(--dgreen)] hover:text-white">
                <i class="fa-solid fa-cart-shopping w-6 text-center" aria-hidden="true"></i>
                Užsakymai
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="#" class="w-full p-2 flex gap-4 items-center shadow-lg rounded-l-lg bg-white text-[var(--green)] transition-all hover:bg-[var(--dgreen)] hover:text-white" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fa-solid fa-right-from-bracket w-6 text-center"></i>
                    Atsijungti
                </a>
            </form>
        </div>
    @endauth
</div>