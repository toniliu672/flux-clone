@props([
    'size' => 'base',
    'level' => '2',
])

@php
    $tag = 'h' . $level;
    
    $classes = \FluxClone\FluxClone::classes(
        'font-semibold text-zinc-900 dark:text-zinc-100',
    )
    ->add(match ($size) {
        'xs' => 'text-sm',
        'sm' => 'text-base',
        'lg' => 'text-xl',
        'xl' => 'text-2xl',
        '2xl' => 'text-3xl',
        default => 'text-lg', // base
    });
@endphp

<{{ $tag }} {{ $attributes->class($classes) }}>
    {{ $slot }}
</{{ $tag }}>
