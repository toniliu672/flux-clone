@props([
    'align' => 'right',
    'position' => 'bottom',
])

@php
    $alignmentClasses = match ($align) {
        'left' => 'left-0',
        'right' => 'right-0',
        'center' => 'left-1/2 -translate-x-1/2',
        default => 'right-0',
    };

    $positionClasses = match ($position) {
        'top' => 'bottom-full mb-2',
        'bottom' => 'top-full mt-2',
        default => 'top-full mt-2',
    };
@endphp

<div
    x-data="{ open: false }"
    @click.away="open = false"
    @close.stop="open = false"
    {{ $attributes->class(['relative inline-block text-left']) }}
>
    {{-- Trigger --}}
    <div @click="open = !open">
        {{ $trigger ?? '' }}
    </div>

    {{-- Dropdown content --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        x-cloak
        class="absolute z-50 min-w-[10rem] rounded-lg border border-zinc-200 bg-white p-1 shadow-lg dark:border-zinc-700 dark:bg-zinc-900 {{ $alignmentClasses }} {{ $positionClasses }}"
        role="menu"
        aria-orientation="vertical"
    >
        {{ $slot }}
    </div>
</div>
