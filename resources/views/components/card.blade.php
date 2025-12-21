@props([
    'padding' => 'base',
])

@php
    $paddingClasses = match ($padding) {
        'none' => 'p-0',
        'sm' => 'p-4',
        'lg' => 'p-8',
        default => 'p-6', // base
    };

    $classes = \FluxClone\FluxClone::classes(
        'rounded-xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-700 dark:bg-zinc-900',
        $paddingClasses,
    );
@endphp

<div {{ $attributes->class($classes) }}>
    {{ $slot }}
</div>
