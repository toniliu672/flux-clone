@props([
    'name' => null,
    'size' => 'md',
    'closeable' => true,
])

@php
    $maxWidthClass = match ($size) {
        'sm' => 'sm:max-w-sm',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
        '4xl' => 'sm:max-w-4xl',
        '5xl' => 'sm:max-w-5xl',
        'full' => 'sm:max-w-full',
        default => 'sm:max-w-md',
    };
@endphp

<div
    x-data="{
        show: @if($attributes->wire('model')->value()) @entangle($attributes->wire('model')) @else false @endif,
        focusables() {
            return [...$el.querySelectorAll('a, button:not([disabled]), input:not([disabled]), textarea:not([disabled]), select:not([disabled]), details, [tabindex]:not([tabindex=\'-1\'])')];
        },
        firstFocusable() { return this.focusables()[0]; },
        lastFocusable() { return this.focusables().slice(-1)[0]; },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable(); },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable(); },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1); },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1; },
    }"
    @if($name)
        x-on:open-modal.window="$event.detail === '{{ $name }}' ? show = true : null"
        x-on:close-modal.window="$event.detail === '{{ $name }}' ? show = false : null"
        x-on:close.stop="show = false"
    @endif
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey ? prevFocusable().focus() : nextFocusable().focus()"
    x-show="show"
    x-cloak
    class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
>
    {{-- Backdrop --}}
    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-zinc-900/50 backdrop-blur-sm dark:bg-zinc-950/75"
        @if($closeable) @click="show = false" @endif
    ></div>

    {{-- Modal panel --}}
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div
                x-show="show"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                {{ $attributes->except(['wire:model'])->class([
                    'relative transform overflow-hidden rounded-xl bg-white p-6 text-left shadow-xl transition-all sm:my-8 w-full dark:bg-zinc-900',
                    $maxWidthClass,
                ]) }}
            >
                {{-- Close button --}}
                @if($closeable)
                    <button
                        type="button"
                        @click="show = false"
                        class="absolute right-4 top-4 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300"
                    >
                        <span class="sr-only">Close</span>
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                @endif

                {{-- Modal content --}}
                <div class="space-y-4">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
