@props([
    'name' => null,
    'heading' => null,
    'icon' => null,
    'disabled' => false,
])

@php
    $itemName = $name ?? Str::random(8);
@endphp

<div {{ $attributes->class(['bg-white dark:bg-zinc-900']) }}>
    {{-- Header --}}
    <button
        type="button"
        x-on:click="toggle('{{ $itemName }}')"
        class="flex w-full items-center justify-between px-4 py-4 text-left transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-zinc-500/20 disabled:opacity-50 disabled:cursor-not-allowed"
        :aria-expanded="isOpen('{{ $itemName }}')"
        @if($disabled) disabled @endif
    >
        <span class="flex items-center gap-3">
            @if($icon)
                <x-flux-clone::icon :name="$icon" class="size-5 text-zinc-400" />
            @endif
            <span class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
                {{ $heading ?? $slot }}
            </span>
        </span>
        
        {{-- Chevron --}}
        <svg 
            class="size-5 text-zinc-400 transition-transform duration-200"
            :class="{ 'rotate-180': isOpen('{{ $itemName }}') }"
            fill="none" 
            viewBox="0 0 24 24" 
            stroke-width="1.5" 
            stroke="currentColor"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg>
    </button>

    {{-- Content --}}
    <div
        x-show="isOpen('{{ $itemName }}')"
        x-collapse
        x-cloak
    >
        <div class="px-4 pb-4 text-sm text-zinc-600 dark:text-zinc-400">
            @if($heading)
                {{ $slot }}
            @endif
        </div>
    </div>
</div>
