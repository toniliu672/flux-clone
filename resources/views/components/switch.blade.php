@props([
    'name' => null,
    'label' => null,
    'checked' => false,
    'disabled' => false,
    'description' => null,
])

@php
    $inputId = $name ?? uniqid('switch-');
@endphp

<div class="flex items-center gap-3">
    <button
        type="button"
        role="switch"
        id="{{ $inputId }}"
        x-data="{ on: @js($checked) }"
        x-on:click="on = !on; $dispatch('input', on)"
        :aria-checked="on"
        :class="on ? 'bg-zinc-900 dark:bg-white' : 'bg-zinc-200 dark:bg-zinc-700'"
        @disabled($disabled)
        {{ $attributes->class([
            'relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out',
            'focus:outline-none focus-visible:ring-2 focus-visible:ring-zinc-500 focus-visible:ring-offset-2 focus-visible:ring-offset-white dark:focus-visible:ring-offset-zinc-900',
            'disabled:opacity-50 disabled:cursor-not-allowed',
        ]) }}
    >
        <span class="sr-only">{{ $label ?? 'Toggle' }}</span>
        <span
            aria-hidden="true"
            :class="on ? 'translate-x-5' : 'translate-x-0'"
            class="pointer-events-none inline-block size-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out dark:bg-zinc-900"
            x-bind:class="on ? 'dark:bg-zinc-900' : 'dark:bg-zinc-300'"
        ></span>
    </button>

    {{-- Hidden input for form submission --}}
    @if($name)
        <input type="hidden" name="{{ $name }}" x-bind:value="on ? '1' : '0'" />
    @endif

    @if($label || $description)
        <div class="text-sm">
            @if($label)
                <label for="{{ $inputId }}" class="font-medium text-zinc-900 dark:text-zinc-100 {{ $disabled ? 'opacity-50' : 'cursor-pointer' }}">
                    {{ $label }}
                </label>
            @endif
            @if($description)
                <p class="text-zinc-500 dark:text-zinc-400">{{ $description }}</p>
            @endif
        </div>
    @endif
</div>
