@props([
    'src' => null,
    'alt' => null,
    'size' => 'base',
    'name' => null,
])

@php
    $sizeClasses = match ($size) {
        'xs' => 'size-6 text-xs',
        'sm' => 'size-8 text-sm',
        'lg' => 'size-12 text-lg',
        'xl' => 'size-16 text-xl',
        '2xl' => 'size-20 text-2xl',
        default => 'size-10 text-base', // base
    };

    $initials = $name ? collect(explode(' ', $name))->take(2)->map(fn($w) => strtoupper(substr($w, 0, 1)))->join('') : '?';
@endphp

<div {{ $attributes->class([
    'relative inline-flex items-center justify-center overflow-hidden rounded-full bg-zinc-200 dark:bg-zinc-700',
    $sizeClasses,
]) }}>
    @if($src)
        <img
            src="{{ $src }}"
            alt="{{ $alt ?? $name ?? 'Avatar' }}"
            class="size-full object-cover"
        />
    @else
        <span class="font-medium text-zinc-600 dark:text-zinc-300">
            {{ $initials }}
        </span>
    @endif
</div>
