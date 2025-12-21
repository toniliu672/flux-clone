@props([
    'name',
    'variant' => 'outline',
])

@php
    $classes = \FluxClone\FluxClone::classes('shrink-0')
        ->add(match ($variant) {
            'solid' => '[:where(&)]:size-6',
            'mini' => '[:where(&)]:size-5',
            'micro' => '[:where(&)]:size-4',
            default => '[:where(&)]:size-6', // outline
        });
    
    // Map variant to heroicon prefix
    $prefix = match ($variant) {
        'solid' => 'heroicon-s',
        'mini' => 'heroicon-m',
        'micro' => 'heroicon-m', // micro uses mini too
        default => 'heroicon-o', // outline
    };
@endphp

<x-dynamic-component 
    :component="$prefix . '-' . $name"
    {{ $attributes->class($classes) }}
/>
