@props([
    'variant' => 'filled',
    'size' => 'base',
    'icon' => null,
    'iconTrailing' => null,
    'type' => 'button',
    'square' => false,
    'loading' => false,
    'disabled' => false,
    'href' => null,
])

@php
    $tag = $href ? 'a' : 'button';
    
    $baseClasses = \FluxClone\FluxClone::classes(
        // Base styles
        'inline-flex items-center justify-center gap-2 font-medium transition-all duration-150',
        'focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-white dark:focus-visible:ring-offset-zinc-900',
        'disabled:opacity-50 disabled:cursor-not-allowed',
    )
    ->add(match ($size) {
        'xs' => 'text-xs px-2 py-1 rounded',
        'sm' => 'text-sm px-3 py-1.5 rounded-md',
        'lg' => 'text-base px-5 py-2.5 rounded-lg',
        'xl' => 'text-base px-6 py-3 rounded-xl',
        default => 'text-sm px-4 py-2 rounded-lg', // base
    })
    ->add(match ($variant) {
        'primary' => 'bg-zinc-900 text-white hover:bg-zinc-800 focus-visible:ring-zinc-500 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-100',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus-visible:ring-red-500 dark:bg-red-500 dark:hover:bg-red-600',
        'ghost' => 'bg-transparent text-zinc-700 hover:bg-zinc-100 focus-visible:ring-zinc-500 dark:text-zinc-300 dark:hover:bg-zinc-800',
        'subtle' => 'bg-zinc-100 text-zinc-700 hover:bg-zinc-200 focus-visible:ring-zinc-500 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700',
        'outline' => 'bg-transparent text-zinc-700 border border-zinc-300 hover:bg-zinc-50 focus-visible:ring-zinc-500 dark:text-zinc-300 dark:border-zinc-600 dark:hover:bg-zinc-800',
        default => 'bg-zinc-200 text-zinc-900 hover:bg-zinc-300 focus-visible:ring-zinc-500 dark:bg-zinc-700 dark:text-zinc-100 dark:hover:bg-zinc-600', // filled
    })
    ->when($square, 'aspect-square !px-0');
@endphp

<{{ $tag }}
    @if($href)
        href="{{ $href }}"
    @else
        type="{{ $type }}"
        @if($disabled || $loading) disabled @endif
    @endif
    {{ $attributes->class($baseClasses) }}
    @if($loading)
        wire:loading.attr="disabled"
    @endif
>
    {{-- Loading spinner --}}
    @if($loading)
        <span wire:loading wire:loading.class="inline-flex">
            <svg class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </span>
    @endif

    {{-- Leading icon --}}
    @if($icon)
        <x-flux-clone::icon :name="$icon" class="size-4" />
    @endif

    {{-- Button content --}}
    @if(!$square || $slot->isNotEmpty())
        <span @if($loading) wire:loading.class="opacity-0" wire:loading.class.remove="opacity-100" @endif>
            {{ $slot }}
        </span>
    @endif

    {{-- Trailing icon --}}
    @if($iconTrailing)
        <x-flux-clone::icon :name="$iconTrailing" class="size-4" />
    @endif
</{{ $tag }}>
