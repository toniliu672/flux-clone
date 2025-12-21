@props([
    'size' => 'base',
])

@php
    $classes = \FluxClone\FluxClone::classes(
        'text-zinc-700 dark:text-zinc-300',
    )
    ->add(match ($size) {
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'lg' => 'text-lg',
        default => 'text-base',
    });
@endphp

<p {{ $attributes->class($classes) }}>
    {{ $slot }}
</p>
