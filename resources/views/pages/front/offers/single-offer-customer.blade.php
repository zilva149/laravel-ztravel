<x-front-layout :$pageTitle>
    <section
        class="relative min-h-[90vh] text-gray-900 bg-cover bg-center bg-fixed before:content-[''] before:absolute before:top-0 before:left-0 before:right-0 before:bottom-0 before:bg-[#14261c] before:opacity-[0.6] flex justify-center items-end" style="background-image: url('{{ $offer->hotel->image ? $offer->hotel->image : '/assets/img/hero-home.jpg' }}')"
        id="hero">''
        <header class="relative mb-36 flex flex-col gap-16 items-center bg-transparent z-99">
            <h1 class="text-white text-5xl font-semibold text-center">{{ $offer->name }}</h1>
            <a href="#information"
                class="btn-action-link px-0 py-0 w-[70px] h-[70px] text-3xl text-white rounded-full flex justify-center items-center animate-pulse">
                <i class="fa-solid fa-chevron-down"></i>
            </a>
        </header>
    </section>

    <section class="max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8 flex flex-col items-center" id="information">
        <h2
            class="relative mb-16 text-3xl text-center before:content-[''] before:absolute before:left-[50%] before:bottom-[-14px] before:w-1/2 before:h-[3px] before:bg-[var(--green)] before:translate-x-[-50%]">
            Informacija
        </h2>

        <div class="w-full border-[3px] border-solid border-[var(--green)] rounded-lg p-8 mb-14 flex justify-between">
            <h2>informacija</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 justify-between items-center">
            <h2>kažkas</h2>
        </div>
    </section>
</x-front-layout>
