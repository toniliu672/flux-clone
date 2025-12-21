@props([
    'size' => 'base',
])

@php
    $classes = \FluxClone\FluxClone::classes(
        'text-zinc-500 dark:text-zinc-400',
    )
    ->add(match ($size) {
        'sm' => 'text-sm',
        'lg' => 'text-base',
        default => 'text-sm', // base
    });
@endphp

<p {{ $attributes->class($classes) }}>
    {{ $slot }}
</p>
