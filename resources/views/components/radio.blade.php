@props([
    'name' => null,
    'value' => null,
    'checked' => false,
    'disabled' => false,
    'icon' => null,
])

@php
    $inputId = $name ? $name . '-' . ($value ?? uniqid()) : uniqid('radio-');
@endphp

<label for="{{ $inputId }}" class="flex items-center gap-2 cursor-pointer {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}">
    <input
        type="radio"
        id="{{ $inputId }}"
        @if($name) name="{{ $name }}" @endif
        @if($value) value="{{ $value }}" @endif
        @checked($checked)
        @disabled($disabled)
        {{ $attributes->except(['class'])->class([
            'size-4 border-zinc-300 text-zinc-900 shadow-sm transition',
            'focus:ring-2 focus:ring-zinc-500/20 focus:ring-offset-0',
            'disabled:opacity-50 disabled:cursor-not-allowed',
            'dark:border-zinc-600 dark:bg-zinc-900 dark:text-white dark:checked:bg-white dark:checked:border-white',
        ]) }}
    />

    @if($icon)
        <x-flux-clone::icon :name="$icon" class="size-4 text-zinc-500 dark:text-zinc-400" />
    @endif

    <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
        {{ $slot }}
    </span>
</label>
