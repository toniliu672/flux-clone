@props([
    'name',
    'label' => null,
    'icon' => null,
    'disabled' => false,
])

@php
    $label = $label ?? ucfirst($name);
@endphp

<button
    type="button"
    role="tab"
    data-tab-name="{{ $name }}"
    x-on:click="activeTab = '{{ $name }}'"
    :aria-selected="activeTab === '{{ $name }}'"
    :tabindex="activeTab === '{{ $name }}' ? 0 : -1"
    {{ $attributes->class([
        'relative px-4 py-2 text-sm font-medium transition-all focus:outline-none focus:ring-2 focus:ring-zinc-500/20 rounded-md',
        'disabled:opacity-50 disabled:cursor-not-allowed',
    ]) }}
    :class="{
        'text-zinc-900 dark:text-zinc-100 bg-white dark:bg-zinc-900 shadow-sm': activeTab === '{{ $name }}',
        'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100 hover:bg-zinc-50 dark:hover:bg-zinc-800/50': activeTab !== '{{ $name }}'
    }"
    @if($disabled) disabled @endif
>
    <span class="flex items-center gap-2">
        @if($icon)
            <x-flux-clone::icon :name="$icon" class="size-4" />
        @endif
        {{ $label }}
    </span>
</button>
