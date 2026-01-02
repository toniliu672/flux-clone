@props([
    'variant' => 'info',
])

@php
    $variantClasses = match ($variant) {
        'success' => 'bg-green-50 text-green-700 dark:bg-green-900/50 dark:text-green-300',
        'warning' => 'bg-yellow-50 text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-300',
        'danger'  => 'bg-red-50 text-red-700 dark:bg-red-900/50 dark:text-red-300',
        default   => 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-300', // info
    };
@endphp

<div {{ $attributes->class([
    'p-4 rounded-md text-sm',
    $variantClasses,
]) }}>
    {{ $slot }}
</div>
