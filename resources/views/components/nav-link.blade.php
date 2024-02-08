@props(['active'])

@php
$classes = ($active ?? false)
? 'flex space-x-2 items-center hover:text-yellow-900 text-sm text-yellow-500'
: 'flex space-x-2 items-center hover:text-yellow-900 text-sm text-gray-500';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>