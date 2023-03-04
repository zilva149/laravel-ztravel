@props(['quote', 'author'])

<section class="p-16 bg-gray-200 flex flex-col gap-2 justify-center items-center">
    <h2 class="w-4/5 max-w-[600px] m-auto relative text-md lg:text-xl text-center">
        <i class="fa-solid fa-quote-left text-white text-6xl lg:text-9xl absolute top-[-100%] left-[-50px] lg:left-[-150px]"></i>
        "{{ $quote }}"
    </h2>
    <h3 class="text-sm lg:text-md">- {{ $author }}</h3>
</section>