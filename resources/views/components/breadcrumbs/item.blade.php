@props([
    'href' => null,
    'icon' => null,
])

<li class="flex items-center gap-2 group">
    {{-- Separator (shown for all but first item) --}}
    <x-flux-clone::icon 
        name="chevron-right" 
        variant="micro" 
        class="text-zinc-600 first:hidden shrink-0" 
    />

    @if($href)
        <a 
            href="{{ $href }}"
            {{ $attributes->class([
                'flex items-center gap-1.5 text-sm text-zinc-400 hover:text-white transition-colors',
            ]) }}
        >
            @if($icon)
                <x-flux-clone::icon :name="$icon" class="size-4 shrink-0" />
            @endif
            <span>{{ $slot }}</span>
        </a>
    @else
        <div {{ $attributes->class(['flex items-center gap-1.5 text-sm font-semibold text-white tracking-tight']) }}>
            @if($icon)
                <x-flux-clone::icon :name="$icon" class="size-4 shrink-0" />
            @endif
            <span>{{ $slot }}</span>
        </div>
    @endif
</li>
