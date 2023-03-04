<x-front-layout :$pageTitle>
    <section class="section-form" style="background-image: url('{{ $offer->hotel->image ? $offer->hotel->image : '/assets/img/hero-home.jpg' }}')" id="hero">
        <div class="bg-transparent h-[100px]"></div>
        <x-front.payment-form :$offer />
    </section>
</x-front-layout>