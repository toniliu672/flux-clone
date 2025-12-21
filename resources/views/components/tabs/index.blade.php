@props([
    'variant' => 'default',
    'defaultTab' => null,
])

@php
    $variantClasses = match ($variant) {
        'pills' => 'bg-zinc-100 dark:bg-zinc-800 p-1 rounded-lg',
        'underline' => 'border-b border-zinc-200 dark:border-zinc-700',
        default => '',
    };
@endphp

<div 
    {{ $attributes->class(['flux-clone-tabs']) }}
    x-data="{ 
        activeTab: '{{ $defaultTab }}',
        init() {
            if (!this.activeTab) {
                const firstTab = this.$el.querySelector('[data-tab-name]');
                if (firstTab) this.activeTab = firstTab.dataset.tabName;
            }
        }
    }"
>
    {{-- Tab List --}}
    <div 
        class="{{ $variantClasses }}"
        role="tablist"
    >
        <div class="flex gap-1">
            {{ $tabs ?? '' }}
        </div>
    </div>

    {{-- Tab Panels --}}
    <div class="mt-4">
        {{ $slot }}
    </div>
</div>
