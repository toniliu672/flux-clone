@props([
    'value' => null,
    'placeholder' => 'Select time',
    'use24h' => false,
    'step' => 30,
])

@php
    $times = [];
    for ($h = 0; $h < 24; $h++) {
        for ($m = 0; $m < 60; $m += $step) {
            $hour = str_pad($h, 2, '0', STR_PAD_LEFT);
            $min = str_pad($m, 2, '0', STR_PAD_LEFT);
            $value24 = "$hour:$min";
            
            if ($use24h) {
                $display = $value24;
            } else {
                $period = $h < 12 ? 'AM' : 'PM';
                $hour12 = $h % 12 ?: 12;
                $display = "$hour12:$min $period";
            }
            
            $times[] = ['value' => $value24, 'display' => $display];
        }
    }
@endphp

<div
    x-data="{
        open: false,
        value: '{{ $value }}',
        displayValue: '',
        times: {{ json_encode($times) }},
        init() {
            if (this.value) {
                const found = this.times.find(t => t.value === this.value);
                if (found) this.displayValue = found.display;
            }
        },
        select(time) {
            this.value = time.value;
            this.displayValue = time.display;
            this.open = false;
            this.$dispatch('time-selected', { time: time.value });
        }
    }"
    {{ $attributes->class(['relative']) }}
>
    {{-- Input --}}
    <button
        type="button"
        x-on:click="open = !open"
        class="flex w-full items-center justify-between rounded-lg border border-zinc-300 bg-white px-4 py-2 text-left text-sm focus:border-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-500/20 dark:border-zinc-600 dark:bg-zinc-900"
    >
        <span 
            x-text="displayValue || '{{ $placeholder }}'"
            :class="displayValue ? 'text-zinc-900 dark:text-zinc-100' : 'text-zinc-500'"
        ></span>
        <svg class="size-5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </button>

    {{-- Dropdown --}}
    <div
        x-show="open"
        x-on:click.outside="open = false"
        x-transition
        class="absolute z-50 mt-2 w-full max-h-60 overflow-y-auto rounded-lg border border-zinc-200 bg-white shadow-lg dark:border-zinc-700 dark:bg-zinc-900"
        x-cloak
    >
        <ul class="py-1">
            <template x-for="time in times" :key="time.value">
                <li
                    x-on:click="select(time)"
                    :class="{ 'bg-zinc-100 dark:bg-zinc-800': value === time.value }"
                    class="cursor-pointer px-4 py-2 text-sm text-zinc-900 hover:bg-zinc-50 dark:text-zinc-100 dark:hover:bg-zinc-800"
                    x-text="time.display"
                ></li>
            </template>
        </ul>
    </div>

    <input type="hidden" x-bind:value="value" {{ $attributes->whereStartsWith('wire:model') }} />
</div>
