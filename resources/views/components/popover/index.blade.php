@props([
    'position' => 'bottom',
    'align' => 'center',
])

@php
    $positionClasses = match ($position) {
        'top' => 'bottom-full mb-2',
        'left' => 'right-full mr-2',
        'right' => 'left-full ml-2',
        default => 'top-full mt-2',
    };

    $alignClasses = match ($align) {
        'start' => 'left-0',
        'end' => 'right-0',
        default => 'left-1/2 -translate-x-1/2',
    };
@endphp

<div 
    x-data="{ open: false }"
    {{ $attributes->class(['relative inline-block']) }}
>
    {{-- Trigger --}}
    <div x-on:click="open = !open">
        {{ $trigger ?? '' }}
    </div>

    {{-- Content --}}
    <div
        x-show="open"
        x-on:click.outside="open = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 {{ $positionClasses }} {{ $alignClasses }}"
        x-cloak
    >
        <div class="rounded-lg border border-zinc-200 bg-white p-4 shadow-lg dark:border-zinc-700 dark:bg-zinc-900">
            {{ $slot }}
        </div>
    </div>
</div>
