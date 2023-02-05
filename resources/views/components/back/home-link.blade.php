@props(['url', 'title'])

<a href="{{ $url }}"
    {{ $attributes->merge(['class' => 'w-full p-6 rounded-md shadow-md text-center text-2xl cursor-pointer tansition-all duration-300']) }}>
    {{ $title }}
</a>
