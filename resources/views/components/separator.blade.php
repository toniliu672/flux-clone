@props([
    'variant' => 'default',
    'orientation' => 'horizontal',
])

@php
    $classes = \FluxClone\FluxClone::classes()
        ->add(match ($orientation) {
            'vertical' => 'h-full w-px',
            default => 'h-px w-full',
        })
        ->add(match ($variant) {
            'subtle' => 'bg-zinc-100 dark:bg-zinc-800',
            default => 'bg-zinc-200 dark:bg-zinc-700',
        });
@endphp

<div {{ $attributes->class($classes) }} role="separator" aria-orientation="{{ $orientation }}"></div>
