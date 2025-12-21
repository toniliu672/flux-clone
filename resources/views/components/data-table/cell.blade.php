@props([
    'align' => null,
])

@php
    $alignClasses = match ($align) {
        'center' => 'text-center',
        'right' => 'text-right',
        default => 'text-left',
    };
@endphp

<td {{ $attributes->class([
    'px-6 py-4 text-sm text-zinc-900 dark:text-zinc-100 whitespace-nowrap',
    $alignClasses,
]) }}>
    {{ $slot }}
</td>
