@props([
    'icon' => null,
    'color' => 'default',
    'tooltip' => null,
    'href' => null,
    'confirm' => false,
    'confirmMessage' => 'Are you sure?',
])

@php
    $colorClasses = match ($color) {
        'danger' => 'text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20',
        'warning' => 'text-yellow-500 hover:text-yellow-600 hover:bg-yellow-50 dark:hover:bg-yellow-900/20',
        'success' => 'text-green-500 hover:text-green-600 hover:bg-green-50 dark:hover:bg-green-900/20',
        'info' => 'text-blue-500 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20',
        default => 'text-zinc-500 hover:text-zinc-700 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:text-zinc-200 dark:hover:bg-zinc-800',
    };

    $baseClasses = 'inline-flex items-center justify-center size-8 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-zinc-500/20';
@endphp

@if($href)
    <a 
        href="{{ $href }}"
        {{ $attributes->class([$baseClasses, $colorClasses]) }}
        @if($tooltip) title="{{ $tooltip }}" @endif
    >
        @if($icon)
            <x-flux-clone::icon :name="$icon" class="size-4" />
        @else
            {{ $slot }}
        @endif
    </a>
@else
    <button
        type="button"
        {{ $attributes->class([$baseClasses, $colorClasses]) }}
        @if($tooltip) title="{{ $tooltip }}" @endif
        @if($confirm)
            x-on:click="if(confirm('{{ $confirmMessage }}')) { $dispatch('action-confirmed') }"
        @endif
    >
        @if($icon)
            <x-flux-clone::icon :name="$icon" class="size-4" />
        @else
            {{ $slot }}
        @endif
    </button>
@endif
