@props([
    'variant' => 'text',
])

@php
    $classes = \FluxClone\FluxClone::classes(
        'animate-pulse rounded bg-zinc-200 dark:bg-zinc-700',
    )
    ->add(match ($variant) {
        'circular' => 'size-10 rounded-full',
        'rectangular' => 'h-24 w-full',
        'card' => 'h-40 w-full rounded-lg',
        default => 'h-4 w-full', // text
    });
@endphp

<div {{ $attributes->class($classes) }}></div>
