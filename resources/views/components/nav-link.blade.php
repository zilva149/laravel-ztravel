@props(['active'])

@php
    $classes = $active ?? false ? 'inline-flex items-center px-1 py-1 pt-1 border-b-2 border-[var(--green)] text-white focus:outline-none hover:text-[var(--green)] focus:text-[var(--dgreen)] transition duration-150 ease-in-out' : 'inline-flex items-center px-1 py-1 pt-1 border-b-2 border-transparent text-white hover:text-[var(--green)] focus:outline-none focus:text-[var(--dgreen)] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
