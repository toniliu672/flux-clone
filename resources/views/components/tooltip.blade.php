@props([
    'content',
    'position' => 'top',
])

@php
    $positionClasses = match ($position) {
        'bottom' => 'top-full left-1/2 -translate-x-1/2 mt-2',
        'left' => 'right-full top-1/2 -translate-y-1/2 mr-2',
        'right' => 'left-full top-1/2 -translate-y-1/2 ml-2',
        default => 'bottom-full left-1/2 -translate-x-1/2 mb-2', // top
    };

    $arrowClasses = match ($position) {
        'bottom' => 'bottom-full left-1/2 -translate-x-1/2 border-b-zinc-900 dark:border-b-zinc-700 border-l-transparent border-r-transparent border-t-transparent',
        'left' => 'left-full top-1/2 -translate-y-1/2 border-l-zinc-900 dark:border-l-zinc-700 border-t-transparent border-b-transparent border-r-transparent',
        'right' => 'right-full top-1/2 -translate-y-1/2 border-r-zinc-900 dark:border-r-zinc-700 border-t-transparent border-b-transparent border-l-transparent',
        default => 'top-full left-1/2 -translate-x-1/2 border-t-zinc-900 dark:border-t-zinc-700 border-l-transparent border-r-transparent border-b-transparent', // top
    };
@endphp

<div
    x-data="{ show: false }"
    @mouseenter="show = true"
    @mouseleave="show = false"
    @focus="show = true"
    @blur="show = false"
    {{ $attributes->class(['relative inline-block']) }}
>
    {{-- Trigger --}}
    {{ $slot }}

    {{-- Tooltip --}}
    <div
        x-show="show"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-cloak
        class="absolute z-50 whitespace-nowrap rounded-md bg-zinc-900 px-2.5 py-1.5 text-xs font-medium text-white shadow-lg dark:bg-zinc-700 {{ $positionClasses }}"
        role="tooltip"
    >
        {{ $content }}
        {{-- Arrow --}}
        <div class="absolute border-4 {{ $arrowClasses }}"></div>
    </div>
</div>
