@props(['url', 'title'])

<a href="{{ $url }}"
    {{ $attributes->merge(['class' => 'btn-primary text-center w-full py-6 text-2xl cursor-pointer']) }}>
    {{ $title }}
</a>
