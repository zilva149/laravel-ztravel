<x-front-layout :$pageTitle>
    <section
        class="relative min-h-[90vh] pb-8 text-gray-900 bg-cover bg-center bg-fixed before:content-[''] before:absolute before:top-0 before:left-0 before:right-0 before:bottom-0 before:bg-[#14261c] before:opacity-[0.6] flex flex-col justify-center items-center"
        style="background-image: url('{{ $offer->hotel->image ? $offer->hotel->image : '/assets/img/hero-home.jpg' }}')"
        id="hero">
        <div class="relative w-[90%] max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8 flex flex-col gap-10 rounded-lg border-2 shadow-lg bg-[rgba(21,34,56,0.4)] z-10">
            <h1 class="w-full text-white text-xl lg:text-3xl text-center text-semibold">Užsakymas atliktas sėkmingai!</h1>
            <div class="w-full flex flex-wrap gap-4 justify-center items-center">
                <a href="{{ route('customer-offers') }}" class="btn-action-link text-sm lg:text-lg">Grįžti į pasiūlymus</a>
                <a href="{{ route('customer-orders') }}" class="btn-action-link text-sm lg:text-lg">Mano užsakymai</a>
            </div>
        </div>
    </section>
</x-front-layout>