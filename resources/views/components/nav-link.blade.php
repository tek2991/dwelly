@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-6 rounded-sm font-GraphikSemibold text-sm text-piss-yellow bg-darker-2 transition duration-200 ease-in-out'
            : 'inline-flex items-center px-6 font-GraphikSemibold text-sm text-darker-2 hover:bg-darker transition duration-200 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
