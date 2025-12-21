@props([
    'name',
    'label' => null,
    'type' => 'select',
    'options' => [],
])

@php
    $label = $label ?? ucfirst(str_replace('_', ' ', $name));
@endphp

<div x-data="{ value: '' }" class="relative">
    @if($type === 'select')
        <select
            x-model="value"
            @change="setFilter('{{ $name }}', value)"
            {{ $attributes->class([
                'rounded-lg border border-zinc-300 bg-white px-3 py-2 pr-8 text-sm',
                'focus:border-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-500/20',
                'dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100',
            ]) }}
        >
            <option value="">{{ $label }}</option>
            @foreach($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}">{{ $optionLabel }}</option>
            @endforeach
        </select>
    @elseif($type === 'boolean')
        <select
            x-model="value"
            @change="setFilter('{{ $name }}', value)"
            {{ $attributes->class([
                'rounded-lg border border-zinc-300 bg-white px-3 py-2 pr-8 text-sm',
                'focus:border-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-500/20',
                'dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100',
            ]) }}
        >
            <option value="">{{ $label }}</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    @elseif($type === 'date')
        <input
            type="date"
            x-model="value"
            @change="setFilter('{{ $name }}', value)"
            placeholder="{{ $label }}"
            {{ $attributes->class([
                'rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm',
                'focus:border-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-500/20',
                'dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100',
            ]) }}
        />
    @endif
</div>
