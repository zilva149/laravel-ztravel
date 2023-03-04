<x-front-layout :$pageTitle>
    <section class="hero bg-[url('/public/assets/img/bg-profile.jpg')] flex justify-center items-end" id="hero">
        <header class="hero-header mb-36">
            <h1 class="hero-title">Užsakymai</h1>
            <a href="#orders"
                class="btn-scroll-down">
                <i class="fa-solid fa-chevron-down"></i>
            </a>
        </header>
    </section>
    <section class="section" id="orders">
        <h2
            class="section-title">
            Jūsų užsakymai
        </h2>
        <div class="cards-container xl:grid-cols-1">
            @if (isset($orders)  && count($orders) != 0)
                @foreach ($orders as $order)
                    <x-front.order-card :$order :$statusOptions />
                @endforeach
            @else
                <p class="empty-list">Užsakymų neturite</p>
            @endif
        </div>
    </section>
</x-front-layout>