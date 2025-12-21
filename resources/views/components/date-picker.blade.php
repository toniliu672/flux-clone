@props([
    'value' => null,
    'placeholder' => 'Select date',
    'format' => 'Y-m-d',
])

<div
    x-data="{
        open: false,
        value: '{{ $value }}',
        displayValue: '',
        init() {
            if (this.value) {
                this.displayValue = this.formatDate(this.value);
            }
        },
        formatDate(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
        }
    }"
    @date-selected.window="if ($event.target.closest('[x-data]') === $el.querySelector('.calendar-container')) { value = $event.detail.date; displayValue = formatDate($event.detail.date); open = false; }"
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
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
        </svg>
    </button>

    {{-- Calendar Dropdown --}}
    <div
        x-show="open"
        x-on:click.outside="open = false"
        x-transition
        class="calendar-container absolute z-50 mt-2"
        x-cloak
    >
        <x-flux-clone::calendar :value="$value" />
    </div>

    <input type="hidden" x-bind:value="value" {{ $attributes->whereStartsWith('wire:model') }} />
</div>
