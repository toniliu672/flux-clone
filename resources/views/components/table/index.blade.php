@props([
    'striped' => false,
    'hoverable' => true,
    'bordered' => false,
    'compact' => false,
    'loading' => false,
    'sortBy' => null,
    'sortDirection' => 'asc',
])

@php
    $tableClasses = \FluxClone\FluxClone::classes(
        'min-w-full divide-y divide-zinc-200 dark:divide-zinc-700',
    );
@endphp

<div 
    {{ $attributes->class([
        'relative overflow-hidden rounded-lg border border-zinc-200 dark:border-zinc-700',
    ]) }}
    x-data="{ 
        sortBy: @js($sortBy), 
        sortDirection: @js($sortDirection),
        loading: @js($loading)
    }"
    @if($attributes->wire('model')->value())
        x-init="
            $watch('sortBy', value => $wire.set('{{ $attributes->wire('model')->value() }}.sortBy', value));
            $watch('sortDirection', value => $wire.set('{{ $attributes->wire('model')->value() }}.sortDirection', value));
        "
    @endif
>
    {{-- Loading Overlay --}}
    <div 
        x-show="loading"
        x-transition.opacity
        class="absolute inset-0 z-10 flex items-center justify-center bg-white/80 dark:bg-zinc-900/80"
    >
        <svg class="size-8 animate-spin text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>

    {{-- Table container with horizontal scroll --}}
    <div class="overflow-x-auto">
        <table 
            class="{{ $tableClasses }}"
            data-striped="{{ $striped ? 'true' : 'false' }}"
            data-hoverable="{{ $hoverable ? 'true' : 'false' }}"
            data-compact="{{ $compact ? 'true' : 'false' }}"
        >
            {{ $slot }}
        </table>
    </div>

    {{-- Empty State Slot --}}
    @if(isset($empty))
        <div x-show="!loading" class="hidden [:has(tbody:empty)>&]:block">
            {{ $empty }}
        </div>
    @endif

    {{-- Pagination Slot --}}
    @if(isset($pagination))
        <div class="border-t border-zinc-200 bg-zinc-50 px-4 py-3 dark:border-zinc-700 dark:bg-zinc-800/50">
            {{ $pagination }}
        </div>
    @endif
</div>
