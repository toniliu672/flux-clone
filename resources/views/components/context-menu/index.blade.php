@props([])

<div
    x-data="{
        open: false,
        x: 0,
        y: 0,
    }"
    x-on:contextmenu.prevent="open = true; x = $event.clientX; y = $event.clientY"
    x-on:click.outside="open = false"
    x-on:keydown.escape.window="open = false"
    {{ $attributes->class(['relative']) }}
>
    {{-- Trigger Area --}}
    {{ $trigger ?? $slot }}

    {{-- Menu --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        :style="`position: fixed; left: ${x}px; top: ${y}px;`"
        class="z-50 min-w-48 rounded-lg border border-zinc-200 bg-white py-1 shadow-lg dark:border-zinc-700 dark:bg-zinc-900"
        x-cloak
    >
        {{ $menu ?? '' }}
    </div>
</div>
