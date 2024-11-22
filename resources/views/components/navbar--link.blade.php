@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'nav-link fw-bold text-dark'
                : 'nav-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
