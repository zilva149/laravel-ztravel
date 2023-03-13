@props(['active'])

@php
    $classes = $active ?? false ? 'inline-flex items-center px-1 py-1 pt-1 border-b-2 border-[var(--green)] text-white text-sm focus:outline-none hover:text-[var(--green)] focus:text-[var(--green)] transition duration-150 ease-in-out xl:text-base' : 'inline-flex items-center px-1 py-1 pt-1 border-b-2 border-transparent text-white text-sm hover:text-[var(--green)] focus:outline-none focus:text-[var(--green)] transition duration-150 ease-in-out xl:text-base';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
