@props([
    'href' => null,
    'icon' => null,
])

<li class="flex items-center gap-2">
    {{-- Separator (shown for all but first item) --}}
    <svg 
        class="size-4 text-zinc-400 first:hidden" 
        fill="none" 
        viewBox="0 0 24 24" 
        stroke-width="1.5" 
        stroke="currentColor"
    >
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
    </svg>

    @if($href)
        <a 
            href="{{ $href }}"
            {{ $attributes->class([
                'flex items-center gap-1.5 text-sm text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200 transition-colors',
            ]) }}
        >
            @if($icon)
                <x-flux-clone::icon :name="$icon" class="size-4" />
            @endif
            {{ $slot }}
        </a>
    @else
        <span {{ $attributes->class(['flex items-center gap-1.5 text-sm font-medium text-zinc-900 dark:text-zinc-100']) }}>
            @if($icon)
                <x-flux-clone::icon :name="$icon" class="size-4" />
            @endif
            {{ $slot }}
        </span>
    @endif
</li>
