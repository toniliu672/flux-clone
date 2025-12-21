@props([
    'href' => null,
    'variant' => 'default',
])

@php
    $classes = \FluxClone\FluxClone::classes(
        'transition-colors duration-150',
    )
    ->add(match ($variant) {
        'subtle' => 'text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200',
        'danger' => 'text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300',
        default => 'text-zinc-700 hover:text-zinc-900 underline underline-offset-2 dark:text-zinc-300 dark:hover:text-zinc-100',
    });
@endphp

<a href="{{ $href ?? '#' }}" {{ $attributes->class($classes) }}>
    {{ $slot }}
</a>
