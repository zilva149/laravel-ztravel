<x-front-layout :$pageTitle>
    <section
        class="relative min-h-[90vh] text-gray-900 bg-[url('/public/assets/img/bg-profile.jpg')] bg-cover bg-center bg-fixed before:content-[''] before:absolute before:top-0 before:left-0 before:right-0 before:bottom-0 before:bg-[#14261c] before:opacity-[0.6] flex justify-center items-end"
        id="hero">
        <header class="relative mb-36 flex flex-col gap-16 items-center bg-transparent z-99">
            <h1 class="text-white text-4xl lg:text-5xl font-semibold text-center">Užsakymai</h1>
            <a href="#orders"
                class="btn-action-link px-0 py-0 w-[60px] h-[60px] lg:w-[70px] lg:h-[70px] text-xl lg:text-3xl text-white rounded-full flex justify-center items-center animate-pulse">
                <i class="fa-solid fa-chevron-down"></i>
            </a>
        </header>
    </section>
    <section class="max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8 flex flex-col items-center" id="orders">
        <h2
            class="relative mb-16 text-2xl lg:text-3xl text-center before:content-[''] before:absolute before:left-[50%] before:bottom-[-14px] before:w-1/2 before:h-[3px] before:bg-[var(--green)] before:translate-x-[-50%]">
            Jūsų užsakymai
        </h2>
        <div class="w-full grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-1 gap-6 items-start">
            @if (isset($orders)  && count($orders) != 0)
                @foreach ($orders as $order)
                    <x-front.order-card :$order :$statusOptions />
                @endforeach
            @else
                <p class="w-full text-2xl lg:text-3xl font-semibold text-center">Užsakymų neturite</p>
            @endif
        </div>
    </section>
</x-front-layout>