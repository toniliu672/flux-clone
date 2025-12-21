@props([
    'variant' => 'default',
    'name' => null,
])

@php
    $classes = match ($variant) {
        'segmented' => 'inline-flex rounded-lg bg-zinc-100 p-1 dark:bg-zinc-800',
        default => 'flex flex-col gap-3',
    };
@endphp

<div 
    {{ $attributes->class($classes) }}
    role="radiogroup"
    @if($variant === 'segmented')
        x-data="{ selected: null }"
    @endif
>
    {{ $slot }}
</div>
